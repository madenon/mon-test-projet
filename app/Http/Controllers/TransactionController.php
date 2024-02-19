<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\Dispute;
use App\Models\User;
use App\Notifications\NewDispute;
use App\Events\TransactionStatusUpdated;
use App\Notifications\NewTransaction;

class TransactionController extends Controller
{
    public function index(Request $request){
       // Assuming you're in a controller method
        $user = auth()->user();

        // Get proposition IDs where the user is the proposition user
        $userPropositionIds = $user->prepositions()->pluck('id');

        // Get offer IDs from the user's offers
        $myOfferIds = $user->offer()->pluck('id');

        // Retrieve transactions based on the specified conditions
        $transactions = Transaction::where(function ($query) use ($userPropositionIds, $myOfferIds) {
            // Transactions with proposition_id in $userPropositionIds
            $query->whereIn('proposition_id', $userPropositionIds)
                // OR transactions with proposition_id in propositions related to user's offers
                ->orWhereIn('proposition_id', function ($query) use ($myOfferIds) {
                    $query->select('id')
                        ->from('prepositions')
                        ->whereIn('offer_id', $myOfferIds);
                });
        })->orderBy('created_at','desc');

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
            $taker=User::find($transaction->offer->user->id);
            $taker->notify(new NewTransaction($transaction));
           
        } else {
            $transaction->offeror_status=$status;
            $taker=User::find($user->id);
            $taker->notify(new NewTransaction($transaction));
        }
        
        if($transaction->applicant_status != 'En cours' && $transaction->offeror_status != 'En cours' ){
            $prep = $transaction->proposition;
            $prep->validation = 'confirmedTransaction';
            $prep->save();
        }
        
        $failureReason = request()->input('failure_reason', null);
           
        $transaction->reason = $failureReason;
        
        TransactionStatusUpdated::dispatch($transaction);
        $transaction->save();
       
        return response()->json(['message' => 'Transaction status updated successfully']);
    }
    
    public function show($id)
    {
        $transaction = Transaction::findOrFail($id);
         return view('transactions.show', compact(
             'transaction'
         ));    
    }
    public function dispute(Request $request,$transactionId){
        $dispute=Dispute::create([
            'title' => $request->title,
            'disputer_id' => auth()->id(), 
            'transaction_id' => $transactionId, 
            'description' => $request->description,
        ]);
        foreach(User::all() as $user){
            if($user->is_admin)
            $user->notify(new NewDispute($dispute));             
        }
        $transaction = Transaction::find($transactionId);
        // $transaction->appealed=true;
        $transaction->save();
        return $dispute;
    }
}
