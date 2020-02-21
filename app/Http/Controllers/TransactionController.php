<?php

namespace App\Http\Controllers;

use App\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $transactions = Transaction::paginate(10);
        return view('vendor.multiauth.admin.transactions')->with('transactions', $transactions);
    }

    public function show($id)
    {
        $transaction = Transaction::find($id);
        return view('vendor.multiauth.admin.showTransaction')->with('transaction', $transaction);
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
