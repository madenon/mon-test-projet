
<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="mt-[6vh]">
        <h1 class="text-center text-primary-color text-4xl">{{ __("Se connecter en tant qu'Admin") }}</h1>
    </div>

    <div class="flex justify-center items-center space-x-1 my-3 google-fb">
        @if (session('error'))
             <x-input-error :messages="session('error')" class="mt-2" />
        @endif
    </div>

    <form method="POST" action="{{ route('admin.login') }}">
        @csrf
        <!-- Email Address -->
        <div>
            {{--  <x-input-label for="email" :value="__('Email')" />  --}}
            <x-text-input id="email" class=" mt-1 w-full  focus:border-primary-color" type="email" name="email" :value="old('email')" required
                autofocus autocomplete="username" placeholder="Addresse e-mail" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4 relative">
            <div class="relative">
                <x-text-input id="password" type="password" name="password"
                    class="border border-gray-300  focus:border-primary-color rounded-md px-3 py-2 pr-10 focus:border-24A19C outline-none w-full"
                    required autocomplete="new-password" placeholder="Mot de passe" />
                <div class="absolute inset-y-0 right-0 flex items-center pr-3  focus:border-primary-color">
                    <button type="button" id="togglePassword" class="cursor-pointer focus:outline-none">
                        <i id="eyeIcon" class="fas fa-eye text-gray-500"></i>
                    </button>
                </div>
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
    </div>
<button class="my-5 w-full text-white  font-semibold py-3 rounded-md bg-primary-color hover:bg-primary-hover " type="submit">
    <div class="  transition-transform transform hover:translate-x-3 flex items-center justify-center">

        {{ __('Se connecter ') }}
        <img src="/images/ArrowRight.svg" alt="" class="ml-2 ">
    </div>
</button>
    </form>

</x-guest-layout>
<script>
    const passwordInput = document.getElementById('password');
    const toggleButton = document.getElementById('togglePassword');
    const eyeIcon = document.getElementById('eyeIcon');

    toggleButton.addEventListener('click', () => {
    if (passwordInput.type === 'password') {
    passwordInput.type = 'text';
    eyeIcon.classList.remove('fa-eye');
    eyeIcon.classList.add('fa-eye-slash');
    } else {
    passwordInput.type = 'password';
    eyeIcon.classList.remove('fa-eye-slash');
    eyeIcon.classList.add('fa-eye');
    }
    });
</script>
