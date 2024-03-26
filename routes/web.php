<?php

use App\Http\Controllers\AllOffers;
use App\Http\Controllers\AlloffersController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PropositionController;
use App\Http\Controllers\MyAccountController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\SocialShareButtonsController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\MeetupController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PusherController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\FollowingController;
use App\Http\Controllers\ContestController;
use App\Http\Controllers\vendor\Chatify\MessagesController;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('storage/{name}',function(Request $request){
    $url=storage_path('app/public/profile_pictures/'.$request->name);
    return response()->file($url);
 });

Route::get(
    'storage/offer-pictures/{name}',
    function(Request $request){
        $url=storage_path('app/public/offer_pictures/'.$request->name);
        return response()->file($url);
    }
)->name('offer-pictures-file-path');
Route::get(
    'storage/proposition-pictures/{name}',
    function(Request $request){
        $url=storage_path('app/public/proposition_pictures/'.$request->name);
        return response()->file($url);
    }
)->name('proposition-pictures-file-path');
Route::get(
    'storage/profile_pictures/{name}',
    function(Request $request){
        $url=storage_path('app/public/profile_pictures/'.$request->name);
        return response()->file($url);
    }
)->name('profile_pictures-file-path');
Route::get(
    'storage/logos/{name}',
    function(Request $request){
        $url=storage_path('app/public/'.$request->name);
        return response()->file($url);
    }
)->name('logo_pictures-file-path');
Route::get(
    'storage/attachments/{name}',
    function(Request $request){
        $url=storage_path('app/public/attachments/'.$request->name);
        return response()->file($url);
    }
)->name('attachments-file-path');
Route::get(
    'storage/company_document_identification/{name}',
    function(Request $request){
        $url=storage_path('app/public/company_document_identification/'.$request->name);
        return response()->file($url);
    }
)->name('company_document_identification-file-path');

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/help', function () {
    return view('help');
})->name('help');
Route::get('/about', function(){
    return view('about');
 })->name('about');



//Define Admin Routes
Route::controller(AdminController::class)->prefix('/admin')->group(function () {
    Route::get('/',  'index')->middleware('admin')->name('admin.index');
    Route::get('/userss',  'users')->middleware('admin')->name('admin.users');
    Route::get('/userss/{id}',  'show')->middleware('admin')->name('admin.user-details');
    Route::get('/pro',  'accountPro')->middleware('admin')->name('admin.pro');
    Route::post('/becomePro',  'becomePro')->middleware('admin')->name('admin.becomePro');
    Route::get('/offers',  'offers')->middleware('admin','check.offers')->name('admin.offers');
    Route::get('/transactions',  'transactions')->middleware('admin')->name('admin.transactions');
    Route::get('/transactions/{id}',  'editTransaction')->middleware('admin')->name('admin.edit-transaction');
    Route::put('/transactions/{id}',  'updateTransaction')->middleware('admin')->name('admin.update-transaction');
    Route::delete('/transactions/delete-transaction/{id}',  'deleteTransaction')->middleware('admin')->name('admin.delete-transaction');
   // propositions 
   Route::get('/propositions',  'propositions')->middleware('admin')->name('admin.propositions');
   Route::get('/campaigns',  'campaigns')->middleware('admin','check.offers')->name('admin.campaigns');
   Route::get('/campaigns/add',  'addCampaign','check.offers')->middleware('admin')->name('admin.add-campaign');
   Route::post('/campaigns/add',  'storeCampaign','check.offers')->middleware('admin')->name('admin.storeCampaign');
   
   Route::post('/messages',  'messages')->middleware('admin')->name('admin.usercontacts');
   Route::post('/messages/{id}',  'messages')->middleware('admin')->name('admin.usermessages');
   
   Route::get('/reports',  'reports')->middleware('admin')->name('admin.reports');
   Route::get('/disputes',  'disputes')->middleware('admin')->name('admin.disputes');
   Route::get('/newsletters',  'newsletters')->middleware('admin')->name('admin.newsletters');
   Route::get('/resolving',  function () {
        return view('admin.resolving');
    })->middleware('admin')->name('admin.resolving');
    
   Route::get('/offerInfos',  function () {
        return view('admin.offer-info');
    })->middleware('admin')->name('admin.offerInfos');
    
   Route::get('/badges',  'badges')->middleware('admin')->name('admin.badges');
   Route::get('/contests',  'contest')->middleware('admin')->name('admin.contests');
   Route::get('/contests/{id}',  'showContest')->middleware('admin')->name('admin.contests.show');
   
   Route::get('/campaigns/{id}',  'editCampaign')->middleware('admin')->name('admin.edit-campaign');
   Route::put('/campaigns/{id}',  'updateCampaign')->middleware('admin')->name('admin.update-campaign');
   Route::delete('/campaigns/delete-campaign/{id}',  'deleteCampaign')->middleware('admin')->name('admin.delete-campaign');

    Route::get('/sponsors',  'sponsors')->middleware('admin')->name('admin.sponsors');
    Route::get('/sponsors/add',  'addSponsor')->middleware('admin')->name('admin.add-sponsor');
    Route::post('/sponsors/add',  'storeSponsor')->middleware('admin')->name('admin.storeSponsor');
    Route::delete('/sponsors/delete-sponsor/{id}',  'deleteSponsor')->middleware('admin')->name('admin.delete-sponsor');
    Route::get('/login','login')->name('admin.login');
    Route::post('/login','store');
    Route::get('/information', 'editInformation')->middleware('admin')->name('admin.edit-information');
    Route::put('/information', 'updateInformation')->middleware('admin')->name('admin.update-information');
    
    
    Route::get('/offres/modifier/{offerId}', [MyAccountController::class, 'editOffer'])->middleware('admin')->name('admin.editOffer');
    Route::put('/offres/{offerId}', [MyAccountController::class, 'updateOffer'])->middleware('admin')->name('admin.updateOffer');
    Route::post('/proposition/freeze/{id}', 'freezeProposition')->middleware('admin')->name('admin.freezeProposition');
    
});

Route::get('/admin/offres/{offerId}/{slug}', [OfferController::class, 'show'])->middleware('admin')->name('admin.showOffer');
Route::delete('/admin/offres/{offer}', [OfferController::class, 'destroyOffer'])->middleware('admin')->name('admin.deleteOffer');

//Define Admin Routes
Route::controller(PusherController::class)->prefix('/messages')->group(function () {
    Route::get('/',  'index')->middleware('admin')->name('messages.index');
    Route::post('/broadcast','broadcast')->name('messages.login');
    Route::post('/receive','receive');
});

route::middleware('auth')->group(function(){
    Route::post('/stars/{user_id}/{rated_by_user_id}', [MyAccountController::class, 'rateUser'])->name('user.rate');
});

Route::post('/update-transaction-status/{transactionId}/{status}', [TransactionController::class, 'updateTransactionStatus']);

//Route::get('/offres/{categoryslug}', [OfferController::class, 'offersByCategory'])->name('offer.offersByCategory');
Route::middleware('auth', 'check.offers', 'verified')->group(function () {
    Route::get('/offres/creer', [OfferController::class, 'create'])->name('offer.create');
    Route::post('/offer', [OfferController::class, 'store'])->name('offer.store');
    Route::post('/offer/storeImage', [OfferController::class, 'storeOfferImage'])->name('offer.storeImage');
    Route::get('/offer/chat/{offerId}', [OfferController::class, 'chat'])->name('offer.chat');
    Route::post('/offer/report/{offerId}', [OfferController::class, 'report'])->name('offer.report');

});

Route::middleware('check.offers')->group(function () {
    Route::get('/offres/{offerId}/{slug}', [OfferController::class, 'show'])->name('offer.offer');

    Route::get('/offres/{type}/{category}', [CategoryController::class, 'index'])->name('category.index');
    Route::get('/offres/{offer}/{category_id}/{category_name}', [CategoryController::class, 'showSimilarOffers'])->name('category.showSimilarOffers');
    Route::get('/offres/{slug}', [CategoryController::class, 'showOffersByCategory'])->name('category.showOffersByCategory');
    Route::post('/offres/{offer}/addToFavorites', [OfferController::class, 'addToFavorites'])->name('offers.addToFavorites');
    Route::delete('/offres/{offer}/removeFromFavorites', [OfferController::class, 'removeFromFavorites'])->name('offers.removeFromFavorites');
    Route::delete('/offres/removeOfferImage', [OfferController::class, 'deleteImage'])->name('offers.deleteImage');
    Route::get('/alloffers', [AlloffersController::class, 'index'])->name('alloffers.index');
Route::post('/offres/updateActiveAnimation', [OfferController::class, 'updateActiveAnimation'])->name('offers.updateActiveAnimation');



    Route::get('/offres/{type}', [TypeController::class, 'index'])->name('type.index');
    Route::get('/offres', [OfferController::class, 'index'])->name('offer.index');
    Route::get('/offres/search', [OfferController::class, 'search'])->name('offer.search');
});


Route::middleware('auth', 'verified')->group(function () {
    Route::get('/propositions/create/{offerid}/{userid}', [PropositionController::class, 'create'])->name('propositions.create');
    Route::post('/propositions', [PropositionController::class, 'store'])->name('propositions.store');
    Route::get('/propositions', [PropositionController::class, 'index'])->name('propositions.index');
    Route::get('/propositions/{id}', [PropositionController::class, 'show'])->name('propositions.show');
    Route::get('/propositions/chat/{prepositionId}', [PropositionController::class, 'chat'])->name('propositions.chat');
    Route::get('/propositions/chat-sender/{prepositionId}', [PropositionController::class, 'chat_proposition_sender'])->name('propositions.chat-sender');
    Route::post('/update-proposition/{prepositionId}', [PropositionController::class, 'update'])->name('update-proposition');
    Route::post('/update-proposition-status', [PropositionController::class, 'updateStatus']);
    Route::post('/confirm-proposition', [PropositionController::class, 'confirm']);
    Route::delete('/delete-proposition/{prepositionId}', [PropositionController::class, 'destroy'])->name('delete-proposition');
    Route::post('/proposition/dispute/{id}', [PropositionController::class, 'dispute'])->name('propositions.dispute');
});
Route::post('/schedule-meetup', [MeetupController::class, 'scheduleMeetup']);
Route::post('/update-meet-status/{meetId}', [MeetupController::class, 'updateMeetStatus']);

// transactions 
Route::middleware('auth', 'verified')->group(function () {
    Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');
    Route::get('/transactions/{id}', [TransactionController::class, 'show'])->name('transactions.show');
    Route::post('/transactions/dispute/{id}', [TransactionController::class, 'dispute'])->name('transactions.dispute');
});
//notifications
Route::get('/contact', [ContactController::class, 'show']);
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');

Route::post('/newsletters', function (Request $request) {
    $newsletter=App\Models\Newsletter::updateOrCreate(['email' => $request->email],['email' => $request->email]);
    return redirect()->route('home');
})->name('newsletters.addEmail');

Route::middleware('auth','verified')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::get('/profile/{id}', [ProfileController::class, 'showProfile'])->name('profile.showProfile');

Route::middleware('auth','check.offers')->group(function () {
    Route::get('/moncompte', [MyAccountController::class, 'index'])->name('myaccount.index');
    Route::get('/moncompte/pro', [MyAccountController::class, 'accountPro'])->name('myaccount.pro');
    Route::get('/moncompte/offres', [MyAccountController::class, 'showOffer'])->name('myaccount.offers');
    Route::post('/moncompte/offres/{offer}/activate', [OfferController::class, 'activate'])->name('myaccount.activate');
    Route::post('/moncompte/offres/{offer}/deactivate', [OfferController::class, 'deactivate'])->name('myaccount.deactivate');
    Route::get('/moncompte/modifier/{offerId}', [MyAccountController::class, 'editOffer'])->name('myaccount.editOffer');
    Route::put('/moncompte/mettreajours/{offerId}', [MyAccountController::class, 'updateOffer'])->name('myaccount.updateOffer');
    Route::delete('/moncompte/offres/{offer}', [OfferController::class, 'destroyOffer'])->name('myaccount.deleteOffer');
    Route::get('/moncompte/favoris', [MyAccountController::class, 'showFavorite'])->name('myaccount.favorites');
    Route::post('/moncompte/updateofferimages/{offerId}', [MyAccountController::class, 'updateOfferImages'])->name('myaccount.updateOfferImages');
});
Route::get('/compte/{id}', [AccountController::class, 'index'])->name('account.index');
Route::get('/ratings/{id}', [RatingController::class, 'index'])->name('ratings.index');
Route::middleware('auth', 'verified')->group(function () {
    Route::get(RouteServiceProvider::MYMESSAGES.'/{id}/{msgId}', [MessagesController::class,'viewMessage'])->name('messages.viewMessage');    
});
Route::middleware('auth',)->group(function () {
    Route::post('/ratings/rateOfferCounterParty', [RatingController::class,'rateCounterParty'])->name('ratings.rateCounterParty');    
    Route::get('/followings/{followedId}', [FollowingController::class,'follow'])->name('followings.follow');    
    Route::get('/unfollowings/{followedId}', [FollowingController::class,'unfollow'])->name('followings.unfollow');    
});

Route::controller(ContestController::class)->prefix('/contests')->group(function () {
    Route::get('/', 'index')->name('contests.index');
    Route::post('/reinitiliaze', 'reinitiliaze' )->middleware('admin')->name('contests.reinitiliaze');
    Route::get('/compete/{contestId}', 'index')->name('contests.compete');
    Route::get('/{contestId}', 'contestRegistration' )->name('contests.registration');
});


require __DIR__.'/auth.php';


