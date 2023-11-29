<?php

use App\Http\Controllers\AllOffers;
use App\Http\Controllers\AlloffersController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PropositionController;
use App\Http\Controllers\MyAccountController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\SocialShareButtonsController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\MeetupController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PusherController;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

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
Route::get('file/{name}',function(Request $request){
    $url=storage_path('app/public/profile_pictures/'.$request->name);
    return response()->file($url);
 });

Route::get(
    'file/offer-pictures/{name}',
    function(Request $request){
        $url=storage_path('app/public/offer_pictures/'.$request->name);
        return response()->file($url);
    }
)->name('offer-pictures-file-path');
Route::get(
    'file/proposition-pictures/{name}',
    function(Request $request){
        $url=storage_path('app/public/proposition_pictures/'.$request->name);
        return response()->file($url);
    }
)->name('proposition-pictures-file-path');
Route::get(
    'file/profile_pictures/{name}',
    function(Request $request){
        $url=storage_path('app/public/profile_pictures/'.$request->name);
        return response()->file($url);
    }
)->name('profile_pictures-file-path');

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


//Define Admin Routes
Route::controller(AdminController::class)->prefix('/admin')->group(function () {
    Route::get('/',  'index')->middleware('admin')->name('admin.index');
    Route::get('/login','login')->name('admin.login');
    Route::post('/login','store');
});

//Define Admin Routes
Route::controller(PusherController::class)->prefix('/messages')->group(function () {
    Route::get('/',  'index')->middleware('admin')->name('messages.index');
    Route::post('/broadcast','broadcast')->name('messages.login');
    Route::post('/receive','receive');
});

// Define  Verification Routes
Route::controller(VerificationController::class)->group(function() {
    Route::get('/email/verify', 'notice')->middleware('auth')->name('verification.notice');
    Route::get('/email/verify/{id}/{hash}', 'verify')->middleware(['auth', 'signed'])->name('verification.verify');
    Route::post('/email/resend', 'resend')->middleware(['auth', 'throttle:6,1'])->name('verification.resend');
});


Route::get('/offres', [OfferController::class, 'index'])->name('offer.index');
Route::get('/offres/search', [OfferController::class, 'search'])->name('offer.search');

//Route::get('/offres/{categoryslug}', [OfferController::class, 'offersByCategory'])->name('offer.offersByCategory');
Route::middleware('auth')->group(function () {
    Route::get('/offres/creer', [OfferController::class, 'create'])->name('offer.create');
    Route::post('/offer', [OfferController::class, 'store'])->name('offer.store');
});


Route::get('/offres/{offerId}/{slug}', [OfferController::class, 'show'])->name('offer.offer');

Route::get('/offres/{type}/{category}', [CategoryController::class, 'index'])->name('category.index');
Route::get('/offres/{offer}/{category_id}/{category_name}', [CategoryController::class, 'showSimilarOffers'])->name('category.showSimilarOffers');
Route::get('/offres/{slug}', [CategoryController::class, 'showOffersByCategory'])->name('category.showOffersByCategory');

Route::get('/alloffers', [AlloffersController::class, 'index'])->name('alloffers.index');


Route::get('/offres/{type}', [TypeController::class, 'index'])->name('type.index');
Route::get('/propositions/create/{offerid}/{userid}', [PropositionController::class, 'create'])->name('propositions.create');
Route::post('/proposition', [PropositionController::class, 'store'])->name('propositions.store');
Route::get('/propositions', [PropositionController::class, 'index'])->name('propositions.index');
Route::post('/update-proposition/{prepositionId}', [PropositionController::class, 'update'])->name('update-proposition');
Route::post('/update-proposition-status', [PropositionController::class, 'updateStatus']);
Route::delete('/delete-proposition/{prepositionId}', [PropositionController::class, 'destroy'])->name('delete-proposition');
Route::post('/schedule-meetup', [MeetupController::class, 'scheduleMeetup']);
Route::post('/update-meet-status/{meetId}', [MeetupController::class, 'updateMeetStatus']);
// transactions 
Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');

Route::get('/contact', [ContactController::class, 'show']);
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/moncompte', [MyAccountController::class, 'index'])->name('myaccount.index');
    Route::get('/moncompte/offres', [MyAccountController::class, 'showOffer'])->name('myaccount.offers');
    Route::post('/moncompte/offres/{offer}/activate', [OfferController::class, 'activate'])->name('myaccount.activate');
    Route::post('/moncompte/offres/{offer}/deactivate', [OfferController::class, 'deactivate'])->name('myaccount.deactivate');
    Route::get('/moncompte/modifier/{offerId}', [MyAccountController::class, 'editOffer'])->name('myaccount.editOffer');
    Route::put('/moncompte/mettreajours/{offerId}', [MyAccountController::class, 'updateOffer'])->name('myaccount.updateOffer');
    Route::delete('/moncompte/offres/{offer}', [OfferController::class, 'destroyOffer'])->name('myaccount.deleteOffer');
});

require __DIR__.'/auth.php';


