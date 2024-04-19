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
        $user = auth()->user();

        $userPropositionIds = $user->prepositions()->pluck('id');

        $myOfferIds = $user->offer()->pluck('id');

        $transactions = Transaction::where(function ($query) use ($userPropositionIds, $myOfferIds) {
            $query->whereIn('proposition_id', $userPropositionIds)
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
        if ($status = request('status')) {

            if($status == 'pending') {
                $transactions = $transactions->where(function ($query) {
                    $query->where('applicant_status', 'En cours')
                        ->orWhere('offeror_status','En cours');
                });
            }
            else if($status == 'accepted'){
                $transactions = $transactions->where(function ($query) {
                    $query->where('applicant_status', 'Réussi')
                        ->where('offeror_status','Réussi');
                });
            }else{// rejected
                $transactions = $transactions->where(function ($query) {
                    $query->where('applicant_status', 'Échouée')
                        ->orWhere('offeror_status','Échouée');
                });
            }
        }

        if ($startDate = request('start_date')) {
            $transactions->whereDate('transactions.created_at', '>=', $startDate);
        }

        if ($endDate = request('end_date')) {
            $transactions->whereDate('transactions.created_at', '<=', $endDate);
        }

        if ($numberTrans = request('number_trans')) {
            $transactions->where('transactions.uuid', 'like', '%' . $numberTrans . '%');
        }

        if ($nameOffer = request('name_offer')) {
            $transactions->whereHas('proposition', function ($query) use ($nameOffer) {
                $query->whereHas('offer', function ($query) use ($nameOffer) {
                    $query->where('title', 'like', '%' . $nameOffer . '%');
                });
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
            $taker->notify(new NewTransaction($transaction,$taker));
           
        } else {
            $transaction->offeror_status=$status;
            $taker=User::find($user->id);
            $taker->notify(new NewTransaction($transaction,$taker));
        }
        
        if($transaction->applicant_status != 'En cours' && $transaction->offeror_status != 'En cours' ){
            $prep = $transaction->proposition;
            $prep->validation = 'confirmedTransaction';
            $prep->save();
        }
        if($transaction->applicant_status == 'Rejetée' || $transaction->offeror_status == 'Rejetée' ){
            $offer = $transaction->proposition->offer;
            foreach($offer->preposition as $prep){
                $prep->status = "En cours";
                $prep->validation = 'none';
                $prep->save();
            }   
        }
        
        if($transaction->applicant_status == 'Réussi' && $transaction->offeror_status == 'Réussi' ){
            $offer = $transaction->proposition->offer;
            $offer->is_online = false;
            $offer->active_offer = false;
            $offer->save();
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
