<?php

namespace App\Http\Controllers;

use App\Models\transactions;
use Illuminate\Http\Request;

class dashboardController extends Controller
{
    public function index(Request $request)
    {
        $from = $request->from ?? firstDayOfMonth();
        $to = $request->to ?? date('Y-m-d');

        $transactions =  transactions::whereBetween('date', [$from, $to])->get();

        $pre_balance = transactions::where('date', '<', $from)->sum('cr') - transactions::where('date', '<', $from)->sum('db');
        

        return view('dashboard.index', compact('transactions', 'from', 'to', 'pre_balance'));
    }

    public function addAmount(Request $request)
    {
        $ref = getRef();
       
        $transaction = new transactions();
        $transaction->date = $request->date;
        $transaction->cr = $request->amount;
        $transaction->db = 0;
        $transaction->container = $request->containerID;
        $transaction->notes = $request->notes;
        $transaction->refID = $ref;
        $transaction->save();

        return redirect()->back()->with('success', 'Amount added successfully');
    }

    public function receiveUae(Request $request)
    {
        $ref = getRef();
        
        $transaction = new transactions();
        $transaction->date = $request->date;
        $transaction->cr = 0;
        $transaction->db = $request->amount_pkr;
        $transaction->notes = $request->notes;
        $transaction->rate = $request->rate;
        $transaction->uae = $request->uae;
        $transaction->refID = $ref;
        $transaction->save();

        return redirect()->back()->with('success', 'Received UAE successfully');
    }

    public function editAmount(Request $request)
    {
        $transaction = transactions::find($request->id);
        $transaction->date = $request->date;
        $transaction->cr = $request->amount;
        $transaction->container = $request->containerID;
        $transaction->notes = $request->notes;
        $transaction->save();

        return redirect()->back()->with('success', 'Amount updated successfully');
    }

    public function editReceiveUae(Request $request)
    {
        $transaction = transactions::find($request->id);
        $transaction->date = $request->date;
        $transaction->db = $request->amount_pkr;
        $transaction->notes = $request->notes;
        $transaction->rate = $request->rate;
        $transaction->uae = $request->uae;
        $transaction->save();

        return redirect()->back()->with('success', 'Received UAE updated successfully');
    }

    public function delete($id, $from, $to)
    {
        $transaction = transactions::find($id);
        $transaction->delete();

        session()->forget('confirmed_password');

        return to_route('dashboard', ['from' => $from, 'to' => $to])->with('error', 'Transaction deleted successfully');
    }

    public function print($from, $to)
    {
        $transactions =  transactions::whereBetween('date', [$from, $to])->get();

        $pre_balance = transactions::where('date', '<', $from)->sum('cr') - transactions::where('date', '<', $from)->sum('db');

        $cur_balance = transactions::sum('cr') - transactions::sum('db');

        return view('dashboard.print', compact('transactions', 'from', 'to', 'pre_balance', 'cur_balance'));
    }

}
