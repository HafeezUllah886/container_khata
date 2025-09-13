<?php

namespace App\Http\Controllers;

use App\Models\payment_categories;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PaymentCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories =payment_categories::all();
        return view('finance.payment_category.index',compact('categories'));
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
        $request->validate([
            'name'=>'required|unique:payment_categories,name',
            'for'=>'required',
        ]);
        payment_categories::create($request->only('name','for'));
        return redirect()->back()->with('success','Payment Category Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(payment_categories $payment_categories)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(payment_categories $payment_categories)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'=>'required|unique:payment_categories,name,'.$id,
            'for'=>'required',
        ]);
        payment_categories::find($id)->update($request->only('name','for'));
        return redirect()->back()->with('success','Payment Category Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        payment_categories::find($id)->delete();
        return redirect()->back()->with('success','Payment Category Deleted Successfully');
    }
}
