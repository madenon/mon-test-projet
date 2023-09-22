<?php

namespace App\Actions\Fortify;

use App\Enums\Genre;
use App\Models\Team;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;
use Illuminate\Validation\Rules\Enum;





class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;
    

    /**
     * Create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {

        Validator::make($input, [
            'name' => ['required', 'string', 'max:20'],
            'email' => ['required', 'string', 'email', 'max:50', 'unique:users'],
            'password' => $this->passwordRules(),
            'phone' => ['required' , 'string', 'min:7', 'max:13'],
            'gender' => [new Enum(Genre::class)],
            'bio' => ['string', 'max:255'],
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        return DB::transaction(function () use ($input) {
            return tap(User::create([
                'name' => $input['name'],
                'email' => $input['email'],
                'password' => Hash::make($input['password']),
                
                
            ]), function (User $user) use ($input) {
                $this->createTeam($user);
                $this->createUserInfos($user, $input);
            });
        });
    }

    

    /**
     * Create a personal team for the user.
     */
    protected function createTeam(User $user): void
    {
        $user->ownedTeams()->save(Team::forceCreate([
            'user_id' => $user->id,
            'name' => explode(' ', $user->name, 2)[0]."'s Team",
            'personal_team' => true,
        ]));
    }

    protected function createUserInfos(User $user, array $input)
    {

        $user->userInfo()->create([
            'user_id' => $user->id,
            'phone' => $input['phone'],
            'gender' => $input['gender'],
            'bio' => $input['bio'],
        ]);

        
    }
}
