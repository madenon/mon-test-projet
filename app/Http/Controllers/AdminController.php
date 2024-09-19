<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Campaign;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use App\Enums\ExperienceLevel;
use App\Enums\Condition;
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
use App\Models\Badge;
use App\Models\Report;
use App\Models\Contest;
use App\Models\Newsletter;
use App\Models\Sponsor;
use Illuminate\Support\Facades\Auth;
use App\Charts;
use App\Models\Information;
use App\Models\OfferImages;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;




class AdminController extends Controller
{
    public function index(Request $request)
    {
        $users=User::get();
        $offers=Offer::get();
        $transactions=Transaction::get();
        
        $times=['allTime','monthThree','week','month'];
        $time= $request->time;
        if(!$time)$time='allTime';
        $rot=0;
        if($time == 'allTime')$rot= 0;
        if($time == 'monthThree')$rot= -90;
        if($time == 'month')$rot = 180;
        if($time == 'week')$rot = 90;
        
        $offer_options = [
            'chart_title' => 'Offers',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\Offer',
            'group_by_field' => 'created_at',
            'group_by_period' => ($time == 'allTime') ? 'month' : (($time == 'monthThree') ? 'week' : (($time == 'month') ? 'week' : 'day')),
            'chart_type' => 'line',
            'filter_field' => 'created_at',
            'filter_days' => ($time == 'allTime') ? 365 : (($time == 'monthThree') ? 90 : (($time == 'month') ? 30 : 7)),
        ];
        
        $offerChart = new LaravelChart($offer_options);
        
        $proposition_options = [
            'chart_title' => 'Propositions',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\Preposition',
            'group_by_field' => 'created_at',
            'group_by_period' => ($time == 'allTime') ? 'month' : (($time == 'monthThree') ? 'week' : (($time == 'month') ? 'week' : 'day')),
            'chart_type' => 'line',
            'filter_field' => 'created_at',
            'filter_days' => ($time == 'allTime') ? 365 : (($time == 'monthThree') ? 90 : (($time == 'month') ? 30 : 7)),
        ];
        $transaction_options = [
            'chart_title' => 'Transactions',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\Transaction',
            'group_by_field' => 'created_at',
            'group_by_period' => ($time == 'allTime') ? 'month' : (($time == 'monthThree') ? 'week' : (($time == 'month') ? 'week' : 'day')),
            'chart_type' => 'line',
            'filter_field' => 'created_at',
            'filter_days' => ($time == 'allTime') ? 365 : (($time == 'monthThree') ? 90 : (($time == 'month') ? 30 : 7)),
        ];
        
        $PropTransChart = new LaravelChart($proposition_options, $transaction_options);
        
        $dispute_options = [
            'chart_title' => 'Disputes',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\Preposition',
            'group_by_field' => 'created_at',
            'group_by_period' => ($time == 'allTime') ? 'month' : (($time == 'monthThree') ? 'week' : (($time == 'month') ? 'week' : 'day')),
            'chart_type' => 'line',
            'filter_field' => 'created_at',
            'filter_days' => ($time == 'allTime') ? 365 : (($time == 'monthThree') ? 90 : (($time == 'month') ? 30 : 7)),
        ];
        $report_options = [
            'chart_title' => 'Reports',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\Report',
            'group_by_field' => 'created_at',
            'group_by_period' => ($time == 'allTime') ? 'month' : (($time == 'monthThree') ? 'week' : (($time == 'month') ? 'week' : 'day')),
            'chart_type' => 'line',
            'filter_field' => 'created_at',
            'filter_days' => ($time == 'allTime') ? 365 : (($time == 'monthThree') ? 90 : (($time == 'month') ? 30 : 7)),
        ];
        $user_options = [
            'chart_title' => 'Users',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\User',
            'group_by_field' => 'created_at',
            'group_by_period' => ($time == 'allTime') ? 'month' : (($time == 'monthThree') ? 'week' : (($time == 'month') ? 'week' : 'day')),
            'chart_type' => 'line',
            'filter_field' => 'created_at',
            'filter_days' => ($time == 'allTime') ? 365 : (($time == 'monthThree') ? 90 : (($time == 'month') ? 30 : 7)),
        ];
        
        $DisRepUserChart = new LaravelChart($dispute_options, $report_options, $user_options);
    
        return view('admin.index', compact('users','offers','transactions', 'offerChart',
            'PropTransChart','DisRepUserChart','rot'));

    }
    public function users(Request $request)
    {
        $roles = Role::all();
        $query = User::query();
            
        if ($request->has('role') && $request->role!='') {
            $query->where('role', $request->role);
        }
        if ($request->has('status') && $request->status!='') {
            if ($request->status == 'actif') {
                $query->whereNotNull('email_verified_at');
            } elseif ($request->status == 'inactif') {
                $query->whereNull('email_verified_at');
            }        
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
    public function accountPro(Request $request)
    {
        $statuts = ["none","pending","rejected","accepted"];
        $query = User::query();
    
        // Filter by role
        if ($request->has('statut') && $request->statut!='') {
            $query->where('statusPro', $request->statut);
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
        $query->where('statusPro','!=','none');
        $users = $query->paginate(10);
    
    
        return view('admin.account-pro', compact('users', 'statuts'));
    }
    public function becomePro(Request $request)
    {
        $user = User::find($request->userId);
        if($user){
            $user->statusPro = $request->status;
            if($request->status == "accepted") $user->pro_on = true;
            else $user->pro_on = false;
            $user->pro_reason = $request->reason;
            $user->save();
        }
        return $user;
    }
public function offers(Request $request){
    $query=Offer::withTrashed();
    if ($request->has('search')) {
        $searchTerm = $request->input('search');
        $query->where(function ($query) use ($searchTerm) {
            $query->where('title', 'like', "%$searchTerm%")
                  ->orWhere('description', 'like', "%$searchTerm%")
                  ->orWhere('slug', 'like', "%$searchTerm%");
        });
    }
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
    if ($request->has('countdown')  && $request->countdown==1) {
        $query->whereNotNull('expiration_date');
    }
    if ($request->has('online_only')  && $request->online_only==1) {
        $query->whereHas('user', function ($query) {
            $query->where('is_online', '=', 1);
        });
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
    if ($request->has('search')) {
        $searchTerm = $request->input('search');
        $transactions->where(function ($query) use ($searchTerm) {
            $query->where('name', 'like', "%$searchTerm%");
        });
    }
   
    // Filter by status
    if ($request->has('status')) {
        $status = $request->input('status');

        switch ($status) {
            case 'accepted':
                $transactions->where('offeror_status', 'Réussie')->where('applicant_status', 'Réussie');
                 break;

            case 'in_progress':
                $transactions->where('offeror_status', 'En cours')->orWhere('applicant_status', 'En cours');
                break;

            case 'rejected':
                $transactions->where('offeror_status', 'Échouée')->where('applicant_status', 'Échouée');
                break;
            default:
                // show all
        }
    }
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
            ->where('offeror_status', 'Réussi')
            ->where('applicant_status', 'Réussi')
            ->count();
        }

        // Count transactions from propositions
        $totalTransactionsFromMesPropositions = $mesPropositions->flatMap->transactions
        ->where('offeror_status', 'Réussi')
        ->where('applicant_status', 'Réussi')            
        ->count();

        // Total transactions
        $totalTransactions = $totalTransactionsFromOffers + $totalTransactionsFromMesPropositions;

        $userInfo = UserInfos::where('user_id', $user->id)->first();
        $offerPrepostion = $mesPropositions->count();
        $finishedOffers =$totalTransactions ;
         $offersInProgress = $user->offer()->whereNull('deleted_at')->get()->count();
 
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
             'ratingsAvg',
             'ratingsCount',
             'followersCount',
         ));    
    }
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
    public function editCampaign($id)
    {
        $campaign = Campaign::findOrFail($id);

        return view('admin.edit-campaign', compact('campaign'));
    }

    public function updateTransaction(Request $request, $id)
    {
        // Add validation as needed
        $transaction = Transaction::findOrFail($id);
        $transaction->update($request->all());

        return redirect()->route('admin.transactions')->with('success', 'Transaction updated successfully');
    }
    public function updateCampaign(Request $request, $id)
    {
        // Add validation as needed
        $campaign = Campaign::findOrFail($id);
        $campaign->update($request->all());

        return redirect()->route('admin.campaigns')->with('success', ' updated successfully');
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
        if ($request->has('search')) {
            $searchTerm = $request->input('search');
            $prepositions->where(function ($query) use ($searchTerm) {
                $query->where('prepositions.name', 'like', "%$searchTerm%")
                      ->orWhere('prepositions.negotiation', 'like', "%$searchTerm%");
            });
        }
        // Filter by status
        if ($request->has('status')) {
            $status = $request->input('status');

            switch ($status) {
                case 'accepted':
                    $prepositions->where('status', 'Acceptée');
                    break;

                case 'in_progress':
                    $prepositions->where('status', 'En cours');
                    break;

                case 'rejected':
                    $prepositions->where('status', 'Rejetée');
                    break;
                default:
                    // show all
            }
        }
        if ($request->has('userId')) {
            $prepositions->where('prepositions.user_id', $request->userId);
        }
        
        $prepositions = $prepositions->get();
        
            

        return view('admin.proposition-list', compact('prepositions'));
    }
    public function campaigns(Request $request){
        $campaigns = Campaign::all();
        $sponsors = Sponsor::all();
        
        return view('admin.campaign-list', compact('campaigns','sponsors'));
    }
     public function deleteCampaign($id)
    {
        $campaign = Campaign::findOrFail($id);
       $campaign->delete();

        return redirect()->back()->with('success', 'Campaign deleted successfully');
    }
    public function addCampaign(Request $request){
        $campaigns = Campaign::all();
        $sponsors = Sponsor::all();
            
        return view('admin.add-campaign', compact('campaigns','sponsors'));
    }
    public function storeCampaign(Request $request){
       
        // Validate the form data
        $request->validate([
            'name' => 'required|string|max:255',
            'link' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'discount_percentage' => 'nullable|numeric|min:0|max:100',
            'products_included' => 'nullable|string',
            'sponsor_id' => 'nullable|exists:sponsors,id',
            'banner' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'page' => 'required|string',
        'position' => 'required|string'
        ]);
        $bannerPath = null;
        if ($request->hasFile('banner')) {
            $bannerPath = $request->file('banner')->store('banners', 'public');
        }
// Create a new campaign
$campaignData = $request->except('banner'); // Get all request data except 'banner'
$campaignData['banner'] = $bannerPath; // Add the banner path to the campaign data

Campaign::create($campaignData); 

        // Redirect back with a success message
        return redirect()->route('admin.campaigns')->with('success', 'La campagne a été ajoutée avec succès.');
    }


    public function messages(Request $request,$id=null)
    {
        if ($request->has('me_id')) {
            session(['me_id' => $request->input('me_id')]);
            $me_id=session('me_id');
        }
        $messenger_color = Auth::user()->messenger_color;
        return view('admin.message-list', [
            'id' => $id ?? 0,
            'messengerColor' => $messenger_color ? $messenger_color : $this->chatify->getFallbackColor(),
            'dark_mode' => Auth::user()->dark_mode < 1 ? 'light' : 'dark',
        ]);
        
    }

    public function reports(Request $request)
    {
        return view('admin.report-list');
    }
    
    public function disputes(Request $request)
    {    
        return view('admin.dispute-list');
    }
    public function freezeProposition($id)
    {    
        $preposition = Preposition::find($id);
        $preposition->freezed= true;
        $preposition->save();
        return redirect->back();
    }
    
    public function newsletters(Request $request)
    {
        $newletters=Newsletter::query()->paginate(10);
        return view('admin.newsletters', compact('newletters'));
    }
    
    public function badges(Request $request)
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
        
        
        return view('admin.badge-list', compact('users', 'roles'));
    }
    
    public function contest(Request $request)
    {    
        $query = User::query();
        
        if ($request->has('search')) {
            $searchTerm = $request->input('search');
            $query->where(function ($query) use ($searchTerm) {
                $query->where('name', 'like', "%$searchTerm%");
            });
        }
        
        $query->has('offer');
        
        $contest = Contest::find(1);
        
        if($contest) {
            $query->whereHas('offer', function ($query) use ($contest){
                $query->where('created_at', '>=', $contest->last_datetime);
            });
        }

    
        $users = $query->paginate(10);
    
    
    
        return view('admin.contest-list', compact('users'));
    }
    
    
    public function showContest($id)
    {    
        $contest=Contest::find($id);
        
        return view('admin.contest-details', compact('contest'));
    }
    
    
    public function editInformation()
    {
        $information = Information::first(); // Assuming you have only one row in the table

        return view('admin.informations', compact('information'));
    }

    public function updateInformation(Request $request)
    {
        $request->validate([
            'facebook' => 'nullable|string',
            'instagram' => 'nullable|string',
            'youtube' => 'nullable|string',
            'email' => 'nullable|string|email',
            'phone' => 'nullable|string',
            'contrat' => 'nullable|string',
        ]);

        $information = Information::first(); // Assuming you have only one row in the table

        if ($information) {
            $information->update($request->all());
        } else {
            Information::create($request->all());
        }

        return redirect()->route('admin.edit-information')->with('success', 'Information updated successfully!');
    }
    
    
    public function editOffer($offerId)
    {    
        $this->authorize('modify-offer', Offer::find($offerId));
        $user = Auth::user();
        $categories = Category::whereNull("parent_id")->get();
        $subcategories = Category::where("parent_id", '!=', NULL)->get();
        $regions = Region::all();
        $departments = Department::all();
        $types = Type::all();
                $offer = Offer::find($offerId);
        $experienceLevels = ExperienceLevel::toArray();
        $conditions = Condition::toArray();
        $images = OfferImages::where('offer_id',$offerId)->get();

        return view('admin.edit-offer')->with([
            'user' => $user,
            'types' => $types,
            'departments' => $departments,
            'regions' => $regions,
            'categories' => $categories,
            'offer' => $offer,
            'subcategories' => $subcategories,
            'experienceLevels' => $experienceLevels,
            'conditions' => $conditions,
            'images'=> $images
        ]);
        
    }

    public function updateOffer(Request $request, $offerId)
    {    
        (new OfferController)->update($request, $offerId);            
        return redirect(route('admin.offers'))->with(['success', 'Annonce mis à jours', ['offerId']]);
    }
}
