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
        $user = $transaction->proposition->user;
        
        if (auth()->check() && auth()->user()->id === $user->id) {
            $transaction->applicant_status=$status;
        } else {
            $transaction->offeror_status=$status;
        }
        
        $failureReason = request()->input('failure_reason', null);
           
            $transaction->reason = $failureReason;
            $transaction->save();
       
        return response()->json(['message' => 'Transaction status updated successfully']);
    }
}
