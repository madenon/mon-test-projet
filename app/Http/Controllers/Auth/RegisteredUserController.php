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
use App\Notifications\proRequest;
use Imagick;
use App\Helpers\ImageHelper;

use Intervention\Image\Facades\Image;




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
           // 'password' => ['required', 'confirmed', Rules\Password::defaults()],
           'phone' => ['required', 'string', 'unique:user_infos', 'regex:/^\+33\d{9}$/'],
           'gender' => [new Enum(Gender::class)],
            'bio' => ['nullable', 'string', 'max:300'],
            'nickname' => ['required', 'unique:user_infos', 'min:2', 'max:100'],
            'profile_photo_path' => ['required','image', 'max:12288', 'mimes:jpeg,jpg,png'],
            'is_pro' => ['required']
        ], [
            'email' => 'Ce email existe dèja.',
            'phone.unique' => 'Ce numero existe dèja.',
            'phone.regex' => 'Le format est +33*********',
            'phone.min' => 'Le numéro de téléphone doit comporter au moins 7 chiffres et au maximum 11 chiffres.',
            'nickname' => 'Ce pseudonyme existe déjà.',
           // 'password' => 'Le mot de passe doit contenir au moins 6 caractères, une combinaison de majuscules et de minuscules, un chiffre et un symbole.',
            'profile_photo_path.max' => "L'image doit être moins de 12 Mo.",
            'profile_photo_path.required' => "Veuillez télécharger une photo de profil.",
            'profile_photo_path.mimes' => 'L\'image téléchargés doivent être au format jpg, jpeg ou png.',
            'is_pro' => "Le type est requis"
        ]);
        if (!$request->google_id) {
            $request->validate([
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
            ], [
                'password' => 'Le mot de passe doit contenir au moins 6 caractères, une combinaison de majuscules et de minuscules, un chiffre et un symbole.',
            ]);
        }
        
         //dd("is_pro ".$request->is_pro );
        if($request->is_pro === true){
            $request->validate([
                'social_reason' => ['required', 'string', 'min:2', 'max:150'],
                'siren_number' => ['required', 'string', 'min:2', 'max:150'],
                'company_identification_document' => ['required','mimes:pdf', 'max:10000'],
            ], [
                'social_reason' => 'La raison sociale est invalide',
                'siren_number' => 'Le numero de sirene est invalide',
                'company_identification_document' => 'Le document d\'identification d\'entreprise est invalide',
            ]);
            
        }
        DB::transaction(function () use ($request) {

            $extention = explode("/", $request->profile_photo_path->getMimeType())[1];
            $storePicture = uniqid() . '.' . $extention;
            
            $user = User::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'password' => $request->has('password') ? Hash::make($request->password) : null,
                'google_id'=> $request->google_id,
                'profile_photo_path' => $storePicture,
                'avatar'=> $storePicture,
                'name' => $request->nickname,
                'is_pro' => false,
                "role" => "user",
                'statusPro' => $request->is_pro ? "pending" : "none",
            ]);
          //  Storage::putFileAs('public/profile_pictures', $request->profile_photo_path, $storePicture);
            
          // Get the uploaded file
        $file = $request->file('profile_photo_path');
       $storePath = 'public/profile_pictures/' . $storePicture;
        ImageHelper::addWatermarkAndSave($file,$storePath);
            if(request()->hasfile('company_identification_document')){
                $extention = explode("/", $request->company_identification_document->getMimeType())[1];
                $storePicture = uniqid() . '.' . $extention;
                Storage::putFileAs('public/company_identification_document', $request->company_identification_document, $storePicture);
            }else $storePicture = null;            
            
            $request->merge(['bio' => 'none']);
            $this->createUserInfos($user, $request->only([
                'phone', 'nickname', 'gender', 'bio','social_reason','siren_number'
            ]), $storePicture);

            event(new Registered($user));
            if(request()->hasfile('company_identification_document')){
            foreach(User::all() as $oneuser){
                if($oneuser->is_admin)
                $oneuser->notify(new proRequest($user));             
            }
        }
        });
        return redirect()->route('verification.notice');

        // return redirect(RouteServiceProvider::HOME);
    }
    
    
    protected function createUserInfos(User $user, array $data, $storePicture)
    {
                
        $user->userInfo()->create([
            'user_id' => $user->id,
            'phone' => $data['phone'],
            'nickname' => $data['nickname'],
            'gender' => $data['gender'],
            'bio' => $data['bio'],
            'social_reason' => $data['social_reason'],
            'siren_number' => $data['siren_number'],
            'company_identification_document' => $storePicture,
        ]);
    }
    
    public function createPro(): View
    {
        return view('auth.becomePro');
    }
    
    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function storePro(Request $request): RedirectResponse
    {
        $request->validate([
            'social_reason' => ['required', 'string', 'min:2', 'max:150'],
            'siren_number' => ['required', 'string', 'min:2', 'max:150'],
            'company_identification_document' => ['required','mimes:pdf', 'max:10000'],
        ], [
            'social_reason' => 'La raison sociale est invalide',
            'siren_number' => 'Le numero de sirene est invalide',
            'company_identification_document' => 'Le document est invalide. Veuillez entrer un fichier au format PDF.',
        ]);
        DB::transaction(function () use ($request) {            
            $extention = explode("/", $request->company_identification_document->getMimeType())[1];
            $storePicture = uniqid() . '.' . $extention;
            
            Storage::putFileAs('public/company_identification_document', $request->company_identification_document, $storePicture);
            
            $user = Auth::user();
                        
            $user->statusPro = "pending";
            $user->save();
            $user->userInfo()->updateOrCreate([
                'user_id' => $user->id,
            ],[
                'social_reason' => $request->social_reason,
                'siren_number' => $request->siren_number,
                'company_identification_document' => $storePicture,
            ]); 
            
            foreach(User::all() as $oneuser){
                if($oneuser->is_admin)
                $oneuser->notify(new proRequest($user));             
            }
            
        });
        
        return redirect()->route('myaccount.pro');
    }
}
