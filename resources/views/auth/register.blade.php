<x-guest-layout>
    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="first_name" :value="__('First Name')" />
            <x-text-input id="first_name" class="block mt-1 w-full" type="text" name="first_name" :value="old('first_name')" required autofocus autocomplete="first_name" />
            <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="last_name" :value="__('Last Name')" />
            <x-text-input id="last_name" class="block mt-1 w-full" type="text" name="last_name" :value="old('last_name')" required />
            <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Phone -->

        <div class="mt-4">
            <x-input-label for="phone" :value="__('Phone')" />
            <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone')" required autocomplete="phone" />
            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
        </div>


        <!-- Description -->

        <div class="mt-4">
            <x-input-label for="bio" :value="__('A propos de vous')" />
            <x-text-input id="bio" class="block mt-1 w-full" type="text" name="bio" value="" />
            <x-input-error :messages="$errors->get('bio')" class="mt-2" />
        </div>

        <!-- Nickname -->

        <div class="mt-4">
            <x-input-label for="nickname" :value="__('Nickname')" />
            <x-text-input id="nickname" class="block mt-1 w-full" type="text" name="nickname"  required  />
            <x-input-error :messages="$errors->get('nickname')" class="mt-2" />
        </div>


        <!-- Gender -->

        <div class="row mb-3">
            <label for="gender" class="col-md-4 col-form-label text-md-end">{{ __('Gender') }}</label>
            <div class="flex">
                <div class="col-md-6">
                    <label for="female" class="col-md-4 col-form-label text-md-end">{{ __('Female') }}</label>
                    <input id="female" type="radio" name="gender" value="{{ App\Enums\Gender::Female }}" class="form-checkbox h-5 w-5 text-indigo-600 mt-1" />
                    
                </div>
                <div class="col-md-6">
                    <label for="male" class="col-md-4 col-form-label text-md-end">{{ __('Male') }}</label>
                    <input id="male" type="radio" name="gender" value="{{ App\Enums\Gender::Male }}" class="form-checkbox h-5 w-5 text-indigo-600 mt-1" />
                    
                </div>
            </div>
        </div>


        <!-- Profile Picture -->

        <div class="row mb-3">
            <input type="file" name="profile_photo_path">
        </div>
        




        
        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ml-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
