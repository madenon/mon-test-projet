<x-registerGuest-layout class="w-full ">
    <div class="flex flex-col md:flex-row">
        <div class="md:w-1/2 ">
            <img src="images/Bannar.png" href="bannar" alt="Bannière de l'inscription" class="w-full h-full " />
        </div>
        <div class="md:w-1/2 p-14 form-div">
            <div class="mt-[8vh]">
                <h1 class="text-center registreTitle text-4xl">{{ __('S\'enregistrer') }}</h1>

                {{-- <div class="flex space-x-4">
                    <input type="text" placeholder="Nom"
                        class="flex-1 border border-gray-300 px-3 py-2 focus:border-#24A19C outline-none rounded-md">
                    <input type="text" placeholder="Prénom"
                        class="flex-1 border border-gray-300 px-3 py-2 focus:border-24A19C outline-none rounded-md">
                </div> --}}
            </div>
            <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                @csrf
                <div class="flex  justify-center mt-10 rounded-md bg-gray-100 py-3 types-div">
                    <div class="border border-gray-300 rounded-l-md py-2 px-3 bg-type text-white cursor-pointer "
                        id="particulier" onclick="selectType('particulier')">
                        Particulier
                    </div>
                    <div class="border-t border-b border border-gray-300 rounded-r-md py-2 px-3 bg-white cursor-pointer"
                        id="professionnel" onclick="selectType('professionnel')">
                        Professionnel
                    </div>
                    <input type="hidden" name="role" id="selectedType" value="particulier">
                </div>

                <div class="flex justify-center items-center space-x-4 mt-[6vh]">
                    <!--  Bouton "Sign In with Google" -->
                    <a href=""
                        class="bg-white border border-gray-300 hover:border-gray-400 text-gray-700 px-4 py-2 rounded-md flex items-center space-x-2">
                        <img src="{{ asset('/images/google-icon.svg') }}" alt="Google Icon" class="w-6 h-6">
                        <span>Sign In with Google</span>
                    </a>

                    <!-- Bouton "Sign In with Facebook" -->
                    <a href=""
                        class="bg-white border border-gray-300 hover:border-gray-400 text-gray-700 px-4 py-2 rounded-md flex items-center space-x-2">
                        <img src="{{ asset('/images/facebook-icon.svg') }}" alt="Google Icon" class="w-6 h-6">
                        <span>Sign In with Facebook</span>
                    </a>
                </div>
                <!-- En-tête de la section de connexion -->
                <div class="text-center text-gray-600 mt-4 mb-4 title-div">
                    <span class="border-b border-gray-300 inline-block w-1/4"></span>
                    <span class="mx-2 text-base text-gray-600 text-Inscrivez">Inscrivez-vous avec votre e-mail</span>
                    <span class="border-b border-gray-300 inline-block w-1/4"></span>
                </div>
                <div class="flex gap-3 mt-4  py-3 genre-div">
                    <div class="border   border-gray-300 rounded-md py-3 px-7 bg-type text-white cursor-pointer "
                        id="female" onclick="selectGenre('female')">
                        Mme
                    </div>
                    <div class=" border border-gray-300 rounded-md py-3 px-7 bg-white cursor-pointer" id="male"
                        onclick="selectGenre('male')">
                        M
                    </div>
                    <input type="hidden" name="gender" id="selectedGenre" value="female">
                </div>
                {{--
                <div class="row mb-3">
                    <label for="gender" class="col-md-4 col-form-label text-md-end">{{ __('Gender') }}</label>
                    <div class="flex">
                        <div class="col-md-6">
                            <label for="female" class="col-md-4 col-form-label text-md-end">{{ __('Female') }}</label>
                            <input id="female" type="radio" name="gender" value="{{ App\Enums\Gender::Female }}"
                                class="form-checkbox h-5 w-5 text-indigo-600 mt-1" />

                        </div>
                        <div class="col-md-6">
                            <label for="male" class="col-md-4 col-form-label text-md-end">{{ __('Male') }}</label>
                            <input id="male" type="radio" name="gender" value="{{ App\Enums\Gender::Male }}"
                                class="form-checkbox h-5 w-5 text-indigo-600 mt-1" />

                        </div>
                    </div>
                </div> --}}
                <div class="flex space-x-4 mb-3">
                    <x-text-input id="first_name" class="block mt-1 w-full border-focus" type="text" name="first_name"
                        :value="old('first_name')" required autofocus autocomplete="first_name" placeholder="Nom" />
                    <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
                    <x-text-input id="last_name" class="block mt-1 w-full border-focus" type="text" name="last_name"
                        :value="old('last_name')" required autofocus autocomplete="last_name" placeholder="Prenom" />
                    <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
                </div>
                <div class="flex space-x-4">
                    <x-text-input id="email" class="block mt-1 w-full border-focus" type="email" name="email"
                        :value="old('email')" required autofocus autocomplete="email" placeholder="Email" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    <x-text-input id="phone" class="block mt-1 w-full border-focus" type="text" name="phone"
                        :value="old('phone')" required autofocus autocomplete="phone" placeholder="Téléphone" />
                    <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                </div>
                <div class="mt-4">
                    <x-text-input id="pseudo" class="block mt-1 w-full border-focus" type="text" name="pseudo" value=""
                        placeholder="Pseudo" />
                    <x-input-error :messages="$errors->get('pseudo')" class="mt-2" />
                </div>

                <div class="mt-4 relative">
                    <div class="relative">
                        <x-text-input id="password" type="password" name="password"
                            class="border border-gray-300 rounded-md px-3 py-2 pr-10 focus:border-24A19C outline-none w-full border-focus"
                            required autocomplete="new-password" placeholder="Mot de passe" />
                        <div class="absolute inset-y-0 right-0 flex items-center pr-3 border-focus">
                            <button type="button" id="togglePassword" class="cursor-pointer focus:outline-none">
                                <i id="eyeIcon" class="fas fa-eye text-gray-500"></i>
                            </button>
                        </div>
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>
                <div class="mt-4 relative">
                    <div class="relative">
                        <x-text-input id="password_confirmation"
                            class="border border-gray-300 rounded-md px-3 py-2 pr-10 focus:border-24A19C outline-none w-full border-focus"
                            type="password" name="password_confirmation" required autocomplete="new-password"
                            placeholder="Confirmation de mot de passe" />
                        <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                            <button type="button" id="togglePasswordConfirmation"
                                class="cursor-pointer focus:outline-none">
                                <i id="eyeIconConfirmation" class="fas fa-eye text-gray-500"></i>
                            </button>
                        </div>
                    </div>

                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>
                <div class="mt-4">
                    <textarea id="aPropos" class="block mt-1 w-full rounded-md border-gray-400 mb-10 border-focus"
                        name="aPropos" required placeholder="À propos de moi"></textarea>
                    <x-input-error :messages="$errors->get('aPropos')" class="mt-2" />
                </div>
                <div
                    class="flex items-center w-full relative border-dashed border-2 border-gray-300 rounded-md px-3 py-2">
                    <label for="profile_photo_path" class="cursor-pointer w-full">
                        <input id="profile_photo_path" type="file" name="profile_photo_path"
                            class="absolute inset-0 opacity-0 z-10 w-full border-focus" style="width: 0; height: 0;">
                        <div class="flex items-center justify-center gap-4 text-center w-full">
                            <img src="images/IconContainer.svg" alt="" srcset="">
                            <p class="text-gray-600 mt-2">Photo de profil</p>
                        </div>
                    </label>

                    <!-- Affiche le nom du fichier sélectionné (facultatif) -->
                    <span id="selectedFileName" class="text-gray-600 mt-2">Aucun fichier sélectionné</span>
                    <x-input-error :messages="$errors->get('profile_photo_path')" class="mt-2" />
                </div>
                <div class="my-6 flex items-center ">
                    <input type="checkbox" id="agree" name="agree"
                        class="h-4 w-4  border-gray-300 rounded input-check-color" required>
                    <label for="agree" class="ml-2 text-gray-700 ">
                        {{ __('I\'ve read and agree with your ') }} <a href="#"
                            class="font-semibold text-black hover:underline">Privacy
                            Policy</a> and <a href="#" class="font-semibold text-black hover:underline">Terms &
                            Conditions</a>
                    </label>
                </div>
                <button class="w-full text-white bg-black font-semibold py-3 rounded-md bg-btn-register " type="submit">
                    <div class="  transition-transform transform hover:translate-x-3 flex items-center justify-center">

                        {{ __('S\'enregistrer ') }}
                        <img src="/images/ArrowRight.svg" alt="" class="ml-2 ">
                    </div>
                </button>


                {{-- <div class="flex items-center justify-end mt-4">
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                        href="{{ route('login') }}">
                        {{ __('Already registered?') }}
                    </a> --}}
                </div>
            </form>
        </div>

    </div>

</x-registerGuest-layout>

<script>
    let selectedType = 'particulier';

function selectType(type) {
    const particulier = document.getElementById('particulier');
    const professionnel = document.getElementById('professionnel');

    if (selectedType) {
    document.getElementById(selectedType).classList.remove('bg-type', 'text-white');
    document.getElementById(selectedType).classList.add('bg-white', 'text-dark');
    }

    document.getElementById(type).classList.remove('bg-white', 'text-dark');
    document.getElementById(type).classList.add('bg-type', 'text-white');
    selectedType = type;

    document.querySelector('input[id="selectedType"]').value = type;
}
    let selectedGenre = 'female';

    function selectGenre(genre) {
    const mme = document.getElementById('female');
    const m = document.getElementById('male');

    if (selectedGenre) {
    document.getElementById(selectedGenre).classList.remove('bg-type', 'text-white');
    document.getElementById(selectedGenre).classList.add('bg-white', 'text-dark');
    }

    document.getElementById(genre).classList.remove('bg-white', 'text-dark');
    document.getElementById(genre).classList.add('bg-type', 'text-white');

selectedGenre = genre;
    console.log(selectedGenre);
    document.querySelector('input[name="gender"]').value = genre;
    }

const fileInput = document.getElementById('profile_photo_path');
const selectedFileName = document.getElementById('selectedFileName');

fileInput.addEventListener('change', (event) => {
selectedFileName.textContent = event.target.files[0] ? event.target.files[0].name : 'Aucun fichier sélectionné';
});


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

    const passwordConfirmationInput = document.getElementById('password_confirmation');
    const toggleConfirmationButton = document.getElementById('togglePasswordConfirmation');
    const eyeIconConfirmation = document.getElementById('eyeIconConfirmation');

    toggleConfirmationButton.addEventListener('click', () => {
    if (passwordConfirmationInput.type === 'password') {
    passwordConfirmationInput.type = 'text';
    eyeIconConfirmation.classList.remove('fa-eye');
    eyeIconConfirmation.classList.add('fa-eye-slash');
    } else {
    passwordConfirmationInput.type = 'password';
    eyeIconConfirmation.classList.remove('fa-eye-slash');
    eyeIconConfirmation.classList.add('fa-eye');
    }
    });

</script>
