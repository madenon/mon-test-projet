<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Laravel\Socialite\Facades\Socialite;
class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->user()->is_online=true;
        $request->user()->active_status=true;
        $request->user()->last_login=now();

        $request->user()->save();

        $request->session()->regenerate();


        return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {

        $request->user()->is_online=false;
        $request->user()->active_status=false;
        $request->user()->last_login=now();
        $request->user()->save();

        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        $google_user = Socialite::driver('google')->user();
        $user=User::where('google_id',$google_user->getId())->first();
        if(!$user){
$newuser=User::create([
    'name' =>  $google_user->getName(),
    'email' => $google_user->getEmail(),
    'google_id' => $google_user->getId()

]);
Auth::login($newuser);
 redirect()->intended(RouteServiceProvider::HOME);
}
else {
    Auth::login($user);
     redirect()->intended(RouteServiceProvider::HOME);

}

        // Use $user to log in or register the user
    }
}
