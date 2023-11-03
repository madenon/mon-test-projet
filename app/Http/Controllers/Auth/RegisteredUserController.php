<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules;
use Illuminate\Validation\Rules\Enum;
use Illuminate\View\View;
use App\Enums\Gender;


class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'first_name' => ['required', 'string', 'min:2', 'max:50'],
            'last_name' => ['required', 'string', 'min:2', 'max:50'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'phone' => ['required', 'string', 'unique:user_infos', 'regex:/(33)[0-9]{9}/'],
            'gender' => [new Enum(Gender::class)],
            'bio' => ['nullable', 'string', 'max:300'],
            'nickname' => ['required', 'unique:user_infos', 'min:2', 'max:100'],
            'profile_photo_path' => ['nullable','image', 'max:12288', 'mimes:jpeg,jpg,png'],

        ], [
            'email' => 'Ce email exist dèja.',
            'phone.min' => 'Le numéro de téléphone doit comporter au moins 7 chiffres et au maximum 11 chiffres.',
            'nickname' => 'Ce pseudonyme existe déjà.',
            'password' => 'Le mot de passe doit contenir au moins 6 caractères, une combinaison de majuscules et de minuscules, un chiffre et un symbole.',
            'profile_photo_path.max' => "L'image doit être moins de 12 Mo.",
            'profile_photo_path.mimes' => 'L\'image téléchargés doivent être au format jpg, jpeg ou png.',
        ]);

        DB::transaction(function () use ($request) {

            $extention = explode("/", $request->profile_photo_path->getMimeType())[1];
            $storePicture = uniqid() . '.' . $extention;
        
            $user = User::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'profile_photo_path' => $storePicture,
            ]);

            Storage::putFileAs('public/profile_pictures', $request->profile_photo_path, $storePicture);
            
            $this->createUserInfos($user, $request->only(['phone', 'nickname', 'gender', 'bio']));

            event(new Registered($user));

            Auth::login($user);
        });



        return redirect(RouteServiceProvider::HOME);
    }


    protected function createUserInfos(User $user, array $data)
    {

        $user->userInfo()->create([
            'user_id' => $user->id,
            'phone' => $data['phone'],
            'nickname' => $data['nickname'],
            'gender' => $data['gender'],
            'bio' => $data['bio'],
        ]);
    }
}
