<x-registerGuest>
    <div class="flex flex-col md:flex-row">
        <div class="md:w-1/2 ">
            <img src="images/Bannar.png" href="bannar" alt="Bannière de l'inscription" class="w-full h-full " />
        </div>
        <div class="md:w-1/2 p-14 form-div">
            <div class="mt-[8vh]">
                <h1 class="text-center registreTitle text-4xl">{{ __('S\'enregistrer') }}</h1>
            </div>
            <div class="flex  justify-center mt-10 rounded-md bg-gray-100 py-3 types-div">
                <div class="border border-gray-300 rounded-l-md py-2 px-3 bg-type text-white cursor-pointer "
                    id="particulier" onclick="selectType('particulier')">
                    Particulier
                </div>
                <div class="border-t border-b border border-gray-300 rounded-r-md py-2 px-3 bg-white cursor-pointer"
                    id="professionnel" onclick="selectType('professionnel')">
                    Professionnel
                </div>
                {{-- <input type="hidden" name="role" id="selectedType" value="particulier"> --}}
            </div>
            <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                @csrf

                <div class="flex justify-center items-center space-x-4 mt-[6vh]">
                    <!--  Bouton "Sign In with Google" -->
                    <a href=""
                        class="bg-white border border-gray-300 hover:border-gray-400 text-gray-700 px-4 py-2 rounded-md flex items-center space-x-2">
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
                        <span>Sign In with Google</span>
                    </a>

                    <!-- Bouton " Sign In with Facebook" -->
                    <a href=""
                        class="bg-white border border-gray-300 hover:border-gray-400 text-gray-700 px-4 py-2 rounded-md flex items-center space-x-2">
                        <svg class="w-6 h-6" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M11.6666 20H7.70126V10.1414H5V6.9316H7.70116V4.64762C7.70116 1.9411 8.89588 0 12.8505 0C13.6869 0 15 0.168134 15 0.168134V3.14858H13.6208C12.2155 3.14858 11.6668 3.5749 11.6668 4.75352V6.9316H14.9474L14.6553 10.1414H11.6667L11.6666 20Z"
                                fill="#1877F2" />
                        </svg>

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
                    <x-text-input id="nickname" class="block mt-1 w-full border-focus" type="text" name="nickname"
                        value="" placeholder="Pseudo" />
                    <x-input-error :messages="$errors->get('nickname')" class="mt-2" />
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
                    <textarea id="bio" class="block mt-1 w-full rounded-md border-gray-400 mb-10 border-focus"
                        name="bio" required placeholder="À propos de moi"></textarea>
                    <x-input-error :messages="$errors->get('bio')" class="mt-2" />
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
        </div>
        </form>
    </div>

    </div>

</x-registerGuest>

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
