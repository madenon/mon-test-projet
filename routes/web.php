<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MyAccountController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TypeController;
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
// Route::get('file/{name}',function(Request $request){
//     $url=storage_path('app/public/offer_pictures/'.$request->name);
//     return response()->file($url);
//  });


Route::get(
    'file/offer-pictures/{name}',
    function(Request $request){
        $url=storage_path('app/public/offer_pictures/'.$request->name);
        return response()->file($url);
    }
)->name('offer-pictures-file-path');

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/dashboard');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::get('/offres', [OfferController::class, 'index'])->name('offer.index');



//Route::get('/offres/{categoryslug}', [OfferController::class, 'offersByCategory'])->name('offer.offersByCategory');

Route::middleware('auth')->group(function () {
    Route::get('/offres/creer', [OfferController::class, 'create'])->name('offer.create');
    Route::post('/offer', [OfferController::class, 'store'])->name('offer.store');
    //Route::delete('/offer', [OfferController::class, 'destroy'])->name('offer.destroy');
});

Route::get('/offres/{offer}/{slug}', [OfferController::class, 'show'])->name('offer.offer');

Route::get('/offres/{type}/{category}', [CategoryController::class, 'index'])->name('category.index');

Route::get('/offres/{type}', [TypeController::class, 'index'])->name('type.index');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/myaccount', [MyAccountController::class, 'index'])->name('myaccount.index');
    Route::get('/myaccount/offres', [MyAccountController::class, 'showOffer'])->name('myaccount.offers');
    Route::get('/myaccount/modifier/{offerId}', [MyAccountController::class, 'editOffer'])->name('myaccount.editOffer');

});



require __DIR__.'/auth.php';


