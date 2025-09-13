<?php

namespace App\Http\Controllers;

use App\Models\receive_payments;
use App\Http\Controllers\Controller;
use App\Imports\receive_payment;
use App\Models\accounts;
use App\Models\payment_categories;
use App\Models\transactions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class ReceivePaymentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $receive_payments = receive_payments::orderBy('date', 'desc')->get();
        $payment_categories = payment_categories::where('for', 'Receive')->get();
        $banks = accounts::bank()->get();
        return view('finance.receiving.index', compact('receive_payments','payment_categories','banks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
      
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $refID = getRef();
            receive_payments::create(
            [
                'category_id'    => $request->categoryID,
                'bank_id'    => $request->bankID,
                'date'          => $request->date,
                'amount'        => $request->amount,
                'notes'         => $request->notes,
                'refID'         => $refID,
            ]
        );

        $category = payment_categories::find($request->categoryID);

        $notes = "Received from $request->received_from category $category->name - Notes: $request->notes";

        createTransaction($request->bankID,$request->date,$request->amount,0,$notes, $refID);
        DB::commit();
        return redirect()->route('receive_payments.index')->with('success', 'Payment received successfully');
        } catch (\Exception $th) {
            DB::rollBack();
            return redirect()->route('receive_payments.index')->with('error', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $receiving = receive_payments::find($id);
        return view('finance.receiving.receipt', compact('receiving'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(receive_payments $receive_payments)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, receive_payments $receive_payments)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete($refID)
    {
        try {
            DB::beginTransaction();
            receive_payments::where('refID', $refID)->delete();
            transactions::where('refID', $refID)->delete();
            DB::commit();
            session()->forget('confirmed_password');
            return redirect()->route('receive_payments.index')->with('success', 'Payment received successfully');
        } catch (\Exception $th) {
            DB::rollBack();
            session()->forget('confirmed_password');
            return redirect()->route('receive_payments.index')->with('error', $th->getMessage());
        }
    }

    public function import(Request $request)
    {

        // Step 1: Validate Input
        $request->validate([
            'excel_file'   => 'required|file|mimes:xlsx,csv,xls',
            'category_id'  => 'required|exists:payment_categories,id',
            'bank_id'      => 'required|exists:accounts,id',
        ]);
    
        // Step 2: Begin DB Transaction
        DB::beginTransaction();
    
       try { 
            // Step 3: Run Import */
            Excel::import(
                new receive_payment(
                    $request->category_id,
                    $request->bank_id
                ),
                $request->file('excel_file')
            );
    
            // Step 4: Commit transaction
            DB::commit();
    
            return back()->with('success', 'Payments imported successfully.');
       } catch (\Throwable $e) {
            // Step 5: Rollback on error
            DB::rollBack();
    
            // Optional: Log the error
            \Log::error('Excel Import Failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
    
            return back()->with('error', 'Import failed: ' . $e->getMessage());
        }
    }
}

