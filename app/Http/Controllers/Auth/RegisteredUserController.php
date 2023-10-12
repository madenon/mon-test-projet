<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserInfos;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
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
            'profile_photo_path' => ['image', 'max:12288', 'mimes:jpeg,jpg,png'],

        ], [
            'email' => 'Ce email exist dèja.',
            'phone.min' => 'Le numéro de téléphone doit comporter au moins 7 chiffres et au maximum 11 chiffres.',
            'nickname' => 'Ce pseudonyme existe déjà.',
            'password' => 'Le mot de passe doit contenir au moins 6 caractères, une combinaison de majuscules et de minuscules, un chiffre et un symbole.',
            'profile_photo_path' => "L'image doit être moins de 12 Mo."
        ]);

        DB::transaction(function () use ($request) {

            // Verify if the profile photo is included in the submitted form
            $storePicture = $request->hasFile('profile_photo_path') ? $this->uploadProfilePicture($request->file('profile_photo_path')) : null;

            $user = User::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'profile_photo_path' => $storePicture,
            ]);

            $this->createUserInfos($user, $request->only(['phone', 'nickname', 'gender', 'bio']));

            event(new Registered($user));

            Auth::login($user);
        });



        return redirect(RouteServiceProvider::HOME);
    }

    protected function uploadProfilePicture(UploadedFile $file): string
    {
        // Validate and store the profile picture using Laravel's file storage system
        if ($file->isValid()) {
            $path = $file->store('public/profile_pictures'); // Store the file in 'storage/app/public/profile_pictures'
            return Storage::url($path); // Return the URL to the stored file
        }

        return ''; // Return an empty string if the file upload fails
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
