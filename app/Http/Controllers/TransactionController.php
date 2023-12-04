<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index(){
        $transactions = Transaction::with('proposition.user')->get();

    return view('transactions.index', compact('transactions'));
    }
    public function updateTransactionStatus($transactionId, $status)
    {
        $transaction = Transaction::where('id', $transactionId)->firstOrFail();
        $failureReason = request()->input('failure_reason', null);
            // Update the status based on $status
            $transaction->status = $status;
            $transaction->reason = $failureReason;
            $transaction->save();
       
        return response()->json(['message' => 'Transaction status updated successfully']);
    }
}
