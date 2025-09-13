<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\purchase;
use Illuminate\Http\Request;

class purchaseReportController extends Controller
{
    public function index()
    {
        return view('reports.purchase.index');
    }

    public function data(Request $request)
    {

        $from = $request->from;
        $to = $request->to;

        $purchases = purchase::whereBetween('date', [$from, $to])->get();

        return view('reports.purchase.details', compact('purchases', 'from', 'to'));
    }
}
