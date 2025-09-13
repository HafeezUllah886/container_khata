<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\purchase;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function index($filter)
    {
        
        if($filter == 'All') {
            $purchases = purchase::all();
        }
        else{
            $purchases = purchase::where('status', $filter)->get();
        }
        
        return view('stock.index', compact('purchases', 'filter'));
    }
}
