<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    //index page
    public function index()
    {
        //transactions from newest to oldest
        $transactions = Transaction::where('account_id', auth()->user()->id)->orderBy('created_at', 'desc')->paginate(10);
        return view('shop.transaction.show', compact('transactions'));
    }
}
