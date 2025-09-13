<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\yards;
use Illuminate\Http\Request;

class YardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $yards = yards::all();

        return view('setting.yards', compact('yards'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|unique:yards,name'
            ]
        );

        yards::create(
            [
                'name' => $request->name,
                'address' => $request->address,
                'contact' => $request->contact
            ]
        );

        return back()->with('success', 'Yard Created');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, yards $yard)
    {
        $request->validate(
            [
                'name' => 'required|unique:yards,name,' . $yard->id,
            ]
        );

        $yard->update(
            [
                'name' => $request->name,
                'address' => $request->address,
                'contact' => $request->contact
            ]
        );

        return back()->with('success', "Yard Updated");
    }

    /**
     * Remove the specified resource from storage.
     */
   
}
