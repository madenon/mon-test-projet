<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="mt-[6vh]">
        <h1 class="text-center text-primary-color text-4xl">{{ __('Se connecter') }}</h1>
    </div>
    <div class="flex justify-center items-center space-x-4 mt-[6vh] google-fb">
        <!--  Bouton "Sign In with Google" 
        <a href="{{ url('auth/google') }}"
            class="bg-white border border-gray-300 hover:border-gray-400 text-gray-700 px-4 py-2 rounded-md flex items-center space-x-2 google">
            <svg class="w-6 h-6" viewBox="0 0 256 262" xmlns="http://www.w3.org/2000/svg"
                preserveAspectRatio="xMidYMid">
                <path
                    d="M255.878 133.451c0-10.734-.871-18.567-2.756-26.69H130.55v48.448h71.947c-1.45 12.04-9.283 30.172-26.69 42.356l-.244 1.622 38.755 30.023 2.685.268c24.659-22.774 38.875-56.282 38.875-96.027"
                    fill="#4285F4" />
                <path
                    d="M130.55 261.1c35.248 0 64.839-11.605 86.453-31.622l-41.196-31.913c-11.024 7.688-25.82 13.055-45.257 13.055-34.523 0-63.824-22.773-74.269-54.25l-1.531.13-40.298 31.187-.527 1.465C35.393 231.798 79.49 261.1 130.55 261.1"
                    fill="#34A853" />
                <path
                    d="M56.281 156.37c-2.756-8.123-4.351-16.827-4.351-25.82 0-8.994 1.595-17.697 4.206-25.82l-.073-1.73L15.26 71.312l-1.335.635C5.077 89.644 0 109.517 0 130.55s5.077 40.905 13.925 58.602l42.356-32.782"
                    fill="#FBBC05" />
                <path
                    d="M130.55 50.479c24.514 0 41.05 10.589 50.479 19.438l36.844-35.974C195.245 12.91 165.798 0 130.55 0 79.49 0 35.393 29.301 13.925 71.947l42.211 32.783c10.59-31.477 39.891-54.251 74.414-54.251"
                    fill="#EB4335" />
            </svg>
            <span>Connexion avec Google</span>
        </a>

        <!-- Bouton " Sign In with Facebook" 
        <a href=""
            class="facebook bg-white border border-gray-300 hover:border-gray-400 text-gray-700 px-4 py-2 rounded-md flex items-center space-x-2">
            <svg class="w-6 h-6" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M11.6666 20H7.70126V10.1414H5V6.9316H7.70116V4.64762C7.70116 1.9411 8.89588 0 12.8505 0C13.6869 0 15 0.168134 15 0.168134V3.14858H13.6208C12.2155 3.14858 11.6668 3.5749 11.6668 4.75352V6.9316H14.9474L14.6553 10.1414H11.6667L11.6666 20Z"
                    fill="#1877F2" />
            </svg>

            <span>Connexion avec Facebook</span>
        </a> -->
    </div>
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <!-- En-tête de la section de connexion -->
        <div class="text-center text-gray-600 mt-4 mb-4 title-div-login " >
            <span class="border-b border-gray-300 inline-block w-1/6"></span>
            <span class="mx-2 text-base text-gray-600 text-Inscrivez">ou Connectez-vous avec votre e-mail</span>
            <span class="border-b border-gray-300 inline-block w-1/6"></span>
        </div>
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
        <!-- Remember Me -->
       <div class="flex items-center justify-between mt-4">
        <label for="remember_me" class="inline-flex items-center">
            <input id="remember_me" type="checkbox"
                class="rounded text-primary-color border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
            <span class="ml-2 text-sm text-gray-600">{{ __('Gardez-moi connecté') }}</span>
        </label>

        @if (Route::has('password.request'))
        <a class=" text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
            href="{{ route('password.request') }}">
            {{ __('Mot de passe oublié') }}
        </a>
        @endif
    </div>
<button class="my-5 w-full text-white  font-semibold py-3 rounded-md bg-primary-color hover:bg-primary-hover " type="submit">
    <div class="  transition-transform transform hover:translate-x-3 flex items-center justify-center">

        {{ __('Se connecter ') }}
        <img src="/images/ArrowRight.svg" alt="" class="ml-2 ">
    </div>
</button>
    </form>
    <div class="mb-2 text-center">
        <span class="text-gray-800">{{ __("Vous n'avez pas de compte?") }} <a href="{{ route('register') }}"
                class="font-semibold text-gray-800">{{ __('Inscrivez-vous') }}</a></span>
    </div>
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
