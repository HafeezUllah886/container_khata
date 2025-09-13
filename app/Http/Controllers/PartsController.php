<?php

namespace App\Http\Controllers;

use App\Models\parts;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PartsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $parts = parts::all();
        return view('parts.index', compact('parts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('parts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|unique:parts,name',
            ]
        );

        $part = new parts();
        $part->name = $request->name;
        $part->save();

        return redirect()->route('parts.index')->with('success', 'Part created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(parts $parts)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(parts $parts)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'name' => 'required|unique:parts,name,' . $id,
            ]
        );

        $part = parts::find($id);

      $part->update($request->all());

        return redirect()->route('parts.index')->with('success', 'Part updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(parts $parts)
    {
        //
    }
}
