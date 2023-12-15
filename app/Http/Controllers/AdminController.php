<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use App\Models\Category;
use App\Models\Department;
use App\Models\Offer;
use App\Models\Transaction;
use App\Models\Preposition;
use App\Models\Region;
use App\Models\UserInfos;
use App\Models\Type;
use App\Models\User;
use App\Models\Role;
class AdminController extends Controller
{
    public function index(Request $request)
    {
        
        return view('admin.index');

    }
    public function users(Request $request)
    {
        $roles = Role::all();
        $query = User::query();
    
        // Filter by role
        if ($request->has('role') && $request->role!='') {
            $query->where('role', $request->role);
        }
    
        if ($request->has('sort_created_at')) {
            $sortOrder = $request->input('sort_created_at');
            $query->orderBy('created_at', $sortOrder);
        }
        if ($request->has('search')) {
            $searchTerm = $request->input('search');
            $query->where(function ($query) use ($searchTerm) {
                $query->where('name', 'like', "%$searchTerm%")
                      ->orWhere('email', 'like', "%$searchTerm%");
            });
        }
    
        $users = $query->paginate(10);
    
    
        return view('admin.user-list', compact('users', 'roles'));
    }
public function offers(Request $request){
    $query = Offer::query();
    
    if ($request->has('userId')) {
        $query->where('user_id', $request->userId);
    }
    if ($request->has('category')  && $request->category!='') {
        $categoryId = $request->input('category');
        $query->with('subcategory.parent') // Load the subcategory and its parent
        ->whereHas('subcategory.parent', function ($query) use ($categoryId) {
            $query->where('id', $categoryId);
        });    }

    if ($request->has('type')  && $request->type!='') {
        $query->where('type_id', $request->input('type'));
    }

    if ($request->has('region') && $request->region!='' ) {
        $regionId = $request->input('region');
        
        $query->whereHas('department.region', function ($query) use ($regionId) {
            $query->where('id', $regionId);
        });    }
   $offers= $query->orderBy('created_at', 'DESC')->paginate(10);
   $categories=Category::all();
   $types=Type::all();
   $regions=Region::all();
   $departments=Department::all();
   
    return view('admin.offer-list', compact('offers','categories','types','regions','departments'));
}  
public function transactions(Request $request){
    $transactions = Transaction::with('proposition.user');
    if ($request->has('userId')) {
        $offers = Offer::where('user_id', $request->userId)->get();
        $prepositions = Preposition::where('user_id', $request->userId)->get();
        
        $transactionsFromOffers = $offers->flatMap(function ($offer) {
            if($offer->prepositions){
            return $offer->prepositions->flatMap->transactions;}
        });
        
        $transactionsFromPrepositions = $prepositions->flatMap->transactions;
        
        $transactions = $transactionsFromOffers->concat($transactionsFromPrepositions);

    }else {
        $transactions=$transactions->get();
    }

return view('admin.transaction-list', compact('transactions'));
}

    public function login(): View
    {
        return view('admin.login');
    }
    public function show($id)
    {
        $user = User::findOrFail($id);
        $offers = $user->offer;
        $mesPropositions=$user->prepositions;
$totalTransactions = 0;
$totalTransactionsFromOffers = 0;
foreach ($offers as $offer) {
    // Count transactions from propositions of the offer
    $totalTransactionsFromOffers += $offer->preposition->flatMap->transactions
        ->where('status', 'Réussi')
        ->count();
}

// Count transactions from propositions
$totalTransactionsFromMesPropositions = $mesPropositions->flatMap->transactions
    ->where('status', 'Réussi')
    ->count();

// Total transactions
$totalTransactions = $totalTransactionsFromOffers + $totalTransactionsFromMesPropositions;

        $userInfo = UserInfos::where('user_id', $user->id)->first();
        $offerPrepostion = $mesPropositions->count();
        $finishedOffers =$totalTransactions ;
         $offersInProgress = $user->offer()->whereNull('deleted_at')->get()->count();

         $medalBronzeSilver=30;
         $medalSilverGold=60;
 
         $ratings=$user->ratings;
         $ratingsCount=$ratings->count();
         $ratingsAvg=$ratings->avg('stars');
         $followersCount=$user->followings->count();
 
         return view('admin.user-details', compact(
             'user',
             'userInfo', 
             'offerPrepostion', 
             'finishedOffers', 
             'offersInProgress',
             'medalBronzeSilver',
             'medalSilverGold',
             'ratingsAvg',
             'ratingsCount',
             'followersCount',
         ));    }
        /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->route('admin.index');
    }

    public function editTransaction($id)
    {
        $transaction = Transaction::findOrFail($id);
        // Add logic to fetch any additional data needed for editing

        return view('admin.edit-transaction', compact('transaction'));
    }

    public function updateTransaction(Request $request, $id)
    {
        // Add validation as needed
        $transaction = Transaction::findOrFail($id);
        $transaction->update($request->all());

        return redirect()->route('admin.transactions')->with('success', 'Transaction updated successfully');
    }

    public function deleteTransaction($id)
    {
        $transaction = Transaction::findOrFail($id);
       $transaction->delete();

        //return redirect()->route('admin.transactions')->with('success', 'Transaction deleted successfully');
    }
    public function propositions(Request $request){
        $prepositions = Preposition::with('user', 'offer')
        ->select('prepositions.*', 'users.first_name as user_name', 'offers.title as offer_name')
        ->join('users', 'users.id', '=', 'prepositions.user_id')
        ->join('offers', 'offers.id', '=', 'prepositions.offer_id');
    
    if ($request->has('userId')) {
        $prepositions->where('prepositions.user_id', $request->userId);
    }
    
    $prepositions = $prepositions->get();
    
        

    return view('admin.proposition-list', compact('prepositions'));
    }

}
