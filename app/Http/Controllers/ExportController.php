<?php

namespace App\Http\Controllers;

use App\Models\export;
use App\Http\Controllers\Controller;
use App\Models\accounts;
use App\Models\export_cars;
use App\Models\export_engines;
use App\Models\export_misc;
use App\Models\export_parts;
use App\Models\parts;
use App\Models\purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $start = $request->start ?? firstDayOfMonth();
        $end = $request->end ?? lastDayOfMonth();
        $exports = export::whereBetween('date', [$start, $end])->get();
        return view('export.index', compact('exports', 'start', 'end'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = purchase::where('status', 'Available')->get();
        $parts = parts::all();
        $consignees = accounts::consignee()->get();
        return view('export.create', compact('products', 'parts', 'consignees'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
     try {
        DB::beginTransaction(); 
        $export = export::create(
            [
                'consignee_id'      => $request->consignee,
                'date'              => $request->date,
                'inv_no'            => $request->inv_no,
                'info_party_id'     => $request->info_party,
                'c_no'              => $request->c_no,
                'weight'            => $request->weight,
                'amount'            => 0,
            ]
        );

        $amount = 0;

        if ($request->car_id) {

        $car_ids = $request->car_id;
        foreach ($car_ids as $key => $car_id) {
            $purchase = purchase::find($car_id);
            $purchase->update([
                'status' => 'Exported',
            ]);
            export_cars::create(
                [
                    'export_id' => $export->id,
                    'purchase_id' => $car_id,
                    'chassis' => $purchase->chassis,
                    'price' => $request->car_price[$key],
                    'remarks' => $request->car_remarks[$key],
                ]
            );
            $amount += $request->car_price[$key];
        }
        }
        if ($request->part_name) {
        $parts = $request->part_name;
        foreach ($parts as $key => $part) {
            export_parts::create(
                [
                    'export_id' => $export->id,
                    'part_name' => $part,
                    'qty' => $request->part_qty[$key],
                ]
            );
        }
        }
        if ($request->engine_series) {  
        $engines = $request->engine_series;
        foreach ($engines as $key => $engine) {
            export_engines::create(
                [
                    'export_id' => $export->id,
                    'series' => $engine,
                    'model' => $request->engine_model[$key],
                    'price' => $request->engine_price[$key],
                ]
            );
            $amount += $request->engine_price[$key];
        }
        }
        if ($request->misc_description) {

        $miscs = $request->misc_description;
        foreach ($miscs as $key => $misc) {
            export_misc::create(
                [
                    'export_id' => $export->id,
                    'description' => $misc,
                    'qty' => $request->misc_qty[$key],
                    'price' => $request->misc_price[$key],
                ]
            );
            $amount += $request->misc_price[$key];

        }
        }
  
        $export->update([
            'amount' => $amount,
        ]);

        DB::commit();
        return redirect()->route('export.index')->with('success', 'Export created successfully');
      } catch (\Exception $e) {
        DB::rollBack();
        return redirect()->back()->with('error', $e->getMessage());
      } 
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $export = export::find($id);
        return view('export.view', compact('export'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(export $export)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, export $export)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(export $export)
    {
        //
    }

    public function getProduct($id)
    {
        $product = purchase::find($id);
        return response()->json($product);
    }
}
