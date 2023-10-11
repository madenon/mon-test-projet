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
            'email' => ['required', 'string', 'email', 'min:5', 'max:100', 'unique:' . UserInfos::class],
            'phone' => ['required', 'unique:users', 'regex:/^[0-9]{7,20}$/'],
            'aPropos' => ['required', 'string', 'max:255'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            // 'gender' => [new Enum(Gender::class)],
            'pseudo' => ['nullable', 'string', 'max:300'],
            'profile_photo_path' => ['image', 'max:12288', 'mimes:jpeg,jpg,png'],
        ], [
            'first_name.required' => 'Le prénom est requis.',
            'first_name.min' => 'Le prénom doit avoir au moins :min caractères.',
            'first_name.max' => 'Le prénom ne peut pas dépasser :max caractères.',
            'last_name.required' => 'Le nom de famille est requis.',
            'last_name.min' => 'Le nom de famille doit avoir au moins :min caractères.',
            'last_name.max' => 'Le nom de famille ne peut pas dépasser :max caractères.',
            'email.required' => 'L\'adresse e-mail est requise.',
            'email.email' => 'L\'adresse e-mail doit être une adresse e-mail valide.',
            'email.min' => 'L\'adresse e-mail doit avoir au moins :min caractères.',
            'email.max' => 'L\'adresse e-mail ne peut pas dépasser :max caractères.',
            'email.unique' => 'Cette adresse e-mail est déjà utilisée.',
            'phone.required' => 'Le numéro de téléphone est requis.',
            'phone.regex' => 'Le numéro de téléphone n\'est pas au bon format.',
            'phone.unique' => 'Ce numéro de téléphone est déjà utilisé.',
            'password.required' => 'Le mot de passe est requis.',
            'password.confirmed' => 'La confirmation du mot de passe ne correspond pas.',
            'password.min' => 'Le mot de passe doit avoir au moins :min caractères.',
            'gender.enum' => 'Genre invalide.',
            'pseudo.max' => 'Le pseudonyme ne peut pas dépasser :max caractères.',
            'profile_photo_path.image' => 'L\'image doit être au format image (jpeg, jpg, png).',
            'profile_photo_path.max' => 'L\'image ne peut pas dépasser :max kilo-octets.',
            'profile_photo_path.mimes' => 'L\'image doit être au format jpeg, jpg ou png.',
        ], [
            'min' => ':attribute doit avoir au moins :min caractères.',
            'max' => ':attribute ne peut pas dépasser :max caractères.',
        ]);


        DB::transaction(function() use($request){

            $storePicture = $request->hasFile('profile_photo_path')? $this->uploadProfilePicture($request->file('profile_photo_path')): null;

            $user = User::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'gender' => $request->gender,
                'pseudo' => $request->pseudo,
                'role' => $request->role,
                'aPropos' => $request->aPropos,
                'password' => Hash::make($request->password),
                'profile_photo_path' =>  $storePicture,
            ]);

            // $this->createUserInfos($user, $request->only(['first_name','last_name','role',"password",'email','phone', 'pseudo', 'gender', 'aPropos',"profile_photo_path"]));

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
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'role' => $data['role'],
            'password' => Hash::make($data['password']),
            'phone' => $data['phone'],
            'pseudo' => $data['pseudo'],
            'gender' => $data['gender'],
            'aPropos' => $data['aPropos'],
            'profile_photo_path' => $data['profile_photo_path'],
        ]);
    }
}
