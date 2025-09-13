<?php

namespace App\Http\Controllers;

use App\Models\accounts;
use App\Models\products;
use App\Models\purchase;
use App\Models\purchase_details;
use App\Models\purchase_payments;
use App\Models\stock;
use App\Models\transactions;
use App\Models\units;
use App\Models\warehouses;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Imports\PurchasesImport;
use App\Models\auctions;
use App\Models\yards;
use Maatwebsite\Excel\Facades\Excel;


class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $start = $request->start ?? firstDayOfMonth();
        $end = $request->end ?? lastDayOfMonth();

        $purchases = purchase::whereBetween("date", [$start, $end])->orderby('id', 'desc')->get();

        return view('purchase.index', compact('purchases', 'start', 'end'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $yards = yards::all();
        $auctions = auctions::all();

        $lastpurchase = purchase::orderby('id', 'desc')->first();

        $transporters = accounts::where('type', 'Transporter')->get();

        
        $rate = purchase::latest()->first()->conversion_rate ?? 0;

        return view('purchase.create', compact('auctions', 'yards', 'lastpurchase', 'transporters', 'rate'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       try
        {
            $request->validate(
                [
                    'chassis'   =>  'required|unique:purchases,chassis',
                ],
                [
                    'chassis.unique' => 'Chassis No. Already Exist',
                ]
            );
            DB::beginTransaction();
            $ref = getRef();
            $purchase = purchase::create(
                [
                    "year"                  =>  $request->year,
                    "maker"                 =>  $request->maker,
                    "model"                 =>  $request->model,
                    "chassis"               =>  $request->chassis,
                    "engine"                =>  $request->engine,
                    "date"                  =>  $request->date,
                    "auction"               =>  $request->auction,
                    "price"                 =>  $request->price,
                    "ptax"                  =>  $request->ptax,
                    "transport_charges"     =>  $request->transport_charges,
                    "total"                 =>  $request->total,
                    "rate"                  =>  $request->conversion_rate,
                    "net_dirham"            =>  $request->net_dirham,
                    "adate"                 =>  $request->adate,
                    "ddate"                 =>  $request->ddate,
                    "number_plate"          =>  $request->number_plate,
                    "nvalidity"             =>  $request->nvalidity,
                    "notes"                 =>  $request->notes,
                    "refID"                 =>  $ref,
                ]
            );

            DB::commit();
            return to_route('purchase.show', $purchase->id)->with('success', "Purchase Created");
        }
        catch(\Exception $e)
        {
            DB::rollback();
            return back()->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(purchase $purchase)
    {
        return view('purchase.view', compact('purchase'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $purchase = purchase::find($id);
        $yards = yards::all();
        $auctions = auctions::all();

        $transporters = accounts::where('type', 'Transporter')->get();

        return view('purchase.edit', compact('purchase', 'yards', 'auctions', 'transporters'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try
        {
            $request->validate(
                [
                    'chassis'   =>  'required|unique:purchases,chassis,'.$id,
                ],
                [
                    'chassis.unique' => 'Chassis No. Already Exist',
                ]
            );
            DB::beginTransaction();
           
            $purchase = purchase::find($id);
            $purchase->update(
                [
                    "transporter_id"        =>  $request->transporter,
                    "year"                  =>  $request->year,
                    "maker"                 =>  $request->maker,
                    "model"                 =>  $request->model,
                    "chassis"               =>  $request->chassis,
                    "loot"                  =>  $request->loot,
                    "yard"                  =>  $request->yard,
                    "date"                  =>  $request->date,
                    "auction"               =>  $request->auction,
                    "price"                 =>  $request->price,
                    "ptax"                  =>  $request->ptax,
                    "afee"                  =>  $request->afee,
                    "atax"                  =>  $request->atax,
                    "transport_charges"     =>  $request->transport_charges,
                    "total"                 =>  $request->total,
                    "recycle"               =>  $request->recycle,
                    "adate"                 =>  $request->adate,
                    "ddate"                 =>  $request->ddate,
                    "number_plate"          =>  $request->number_plate,
                    "nvalidity"             =>  $request->nvalidity,
                    "notes"                 =>  $request->notes,
                ]
            );

            DB::commit();
            return to_route('purchase.show', $purchase->id)->with('success', "Purchase Updated");
        }
        catch(\Exception $e)
        {
            DB::rollback();
            return back()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {

        try
        {
            DB::beginTransaction();
            $purchase = purchase::find($id);
            $purchase->delete();
            DB::commit();
            session()->forget('confirmed_password');
            return redirect()->route('purchase.index')->with('success', "Purchase Deleted");
        }
        catch(\Exception $e)
        {
            DB::rollBack();
            session()->forget('confirmed_password');
            return redirect()->route('purchase.index')->with('error', $e->getMessage());
        }
    }


    public function import(Request $request)
    {
        try
        {
            $file = $request->file('excel');
        $extension = $file->getClientOriginalExtension();
        if($extension == "xlsx")
        {
            Excel::import(new PurchasesImport, $file);
            return back()->with("success", "Successfully imported");
        }
        else
        {
            return back()->with("error", "Invalid file extension");
        }
        }
        catch(\Exception $e)
        {
            return back()->with('error', $e->getMessage());
        }
    }
}
