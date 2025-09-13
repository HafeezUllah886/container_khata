<?php

namespace App\Http\Controllers;

use App\Models\auctions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuctionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $auctions = auctions::all();

        return view('setting.auction', compact('auctions'));
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

        
        $request->validate(
            [
                'name' => 'required|unique:auctions,name'
            ]
        );

        auctions::create(
            [
                'name' => $request->name,
            ]
        );

        return back()->with('success', 'Auction Created');
    }

    /**
     * Display the specified resource.
     */
    public function show(auctions $auction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(auctions $auction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, auctions $auction)
    {
        $request->validate(
            [
                'name' => 'required|unique:auctions,name,' . $auction->id,
            ]
        );

        $auction->update(
            [
                'name' => $request->name,
            ]
        );

        return back()->with('success', "Auction Updated");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(auctions $auction)
    {
        //
    }
}
