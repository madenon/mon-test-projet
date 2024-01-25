<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index(Request $request){
        $transactions = Transaction::with('proposition.user');
        if (!($request->has('in_progress')) || $request->input('in_progress')==1){
            $transactions = $transactions->where(function ($query) {
                $query->where('applicant_status', 'En cours')
                    ->orWhere('offeror_status','En cours');
            });
        }
        
        $transactions = $transactions->get();

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
        
        if($transaction->applicant_status != 'En cours' && $transaction->offeror_status != 'En cours' ){
            $prep = $transaction->proposition;
            $prep->validation = 'confirmedTransaction';
            $prep->save();
        }
        
        $failureReason = request()->input('failure_reason', null);
           
            $transaction->reason = $failureReason;
            $transaction->save();
       
        return response()->json(['message' => 'Transaction status updated successfully']);
    }
}
