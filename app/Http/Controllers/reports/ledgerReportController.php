<?php

namespace App\Http\Controllers\reports;

use App\Http\Controllers\Controller;
use App\Models\accounts;
use App\Models\transactions;
use Illuminate\Http\Request;

class ledgerReportController extends Controller
{
    public function index()
    {
        return view('reports.ledger_report.index');
    }   

    public function reportData(Request $request)
    {
        $from = $request->from;
        $to = $request->to;

        $accounts = accounts::where('type', 'Bank')->pluck('id');

        $transactions = transactions::whereIn('account_id', $accounts)->whereBetween('date', [$from, $to])->get();

        $pre_cr = transactions::whereIn('account_id', $accounts)->whereDate('date', '<', $from)->sum('cr');
        $pre_db = transactions::whereIn('account_id', $accounts)->whereDate('date', '<', $from)->sum('db');
        $pre_balance = $pre_cr - $pre_db;

        $cur_cr = transactions::whereIn('account_id', $accounts)->sum('cr');
        $cur_db = transactions::whereIn('account_id', $accounts)->sum('db');

        $cur_balance = $cur_cr - $cur_db;

        return view('reports.ledger_report.details', compact('accounts', 'transactions', 'pre_balance', 'cur_balance', 'from', 'to'));
    }
}
