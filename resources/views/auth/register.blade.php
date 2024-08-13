<x-registerGuest>
    <div class="flex flex-col md:flex-row">
        <div class="md:w-1/2 bg-primary-color bg-cover bg-center  text-white partie-droit-register"
            style='background-image: url("images/signup-bg-pattern.svg");'>
            <div class="w-[70%] mx-auto my-44 p-3">
                <h1 class="font-semibold text-3xl">Pourquoi Créer Un Compte? </h1>
                <div class="flex gap-5 mt-7 w-[80%] items-center border-b border-line pb-7">
                    <img src="/images/icons8-time-100 1.svg" alt="" class="mb-7">
                    <div class="flex flex-col gap-3">
                        <h2 class="font-semibold text-lg mt-2">Gagnez du temps</h2>
                        <span>Publiez vos annonces rapidement, avec vos informations pré-remplies chaque fois que vous
                            souhaitez déposer une nouvelle annonce.</span>
                    </div>
                </div>
                <div class="flex gap-5 mt-7 w-[80%] items-center border-b border-line pb-7">
                    <img src="/images/icons8-bell-80 1.svg" alt="" class="mb-7">
                    <div class="flex flex-col gap-3">
                        <h2 class="font-semibold text-lg mt-2">Soyez les premiers informés</h2>
                        <span>Créez des alertes Immo ou Emploi et ne manquez jamais l’annonce qui vous intéresse.</span>
                    </div>
                </div>
                <div class="flex gap-5 mt-7 w-[80%] items-centerpb-7">
                    <img src="/images/icons8-ophthalmology-100 1.svg" alt="" class="mb-7">
                    <div class="flex flex-col gap-3">
                        <h2 class="font-semibold text-lg mt-2">Visibilité</h2>
                        <span>Suivez les statistiques de vos annonces (nombre de fois où votre annonce a été vue, nombre
                            de contacts reçus).</span>
                    </div>
                </div>
            </div>
            <div class="w-[90%] mx-auto text-sm text-center">
                <a href="">
                    Politique de confidentialité
                </a>
                <a href="">
                    {{ __('Conditions générales d\'utilisation') }}
                </a>

            </div>
        </div>
        <div class="md:w-1/2 p-14 form-div partie-gauche-register">
            <div class="mt-[8vh]">
                <h1 class="text-center text-primary-color text-4xl">{{ __('S\'enregistrer') }}</h1>
            </div>
            <div class="flex  justify-center mt-10 rounded-md bg-gray-100 py-3 types-div">
                <div class="border border-gray-300 rounded-l-md py-2 bg-primary-color text-white cursor-pointer w-1/2 flex justify-center"
                    id="particulier" onclick="selectType('particulier')">
                    <div>Particulier</div>
                </div>
                <div class="border-t border-b border border-gray-300 rounded-r-md py-2 px-3 bg-white cursor-pointer w-1/2 flex justify-center"
                    id="professionnel" onclick="selectType('professionnel')">
                    <div>Professionnel</div>
                </div>
                {{-- <input type="hidden" name="role" id="selectedType" value="particulier"> --}}
            </div>
            <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                @csrf
               <!--  <div class="flex justify-center items-center space-x-4 mt-[6vh]">
                     Bouton "Sign In with Google" 
                    <a href="{{ url('auth/google') }}"
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
                            <span>Connexion avec Google</span>
                        </a>
                    
                         Bouton " Sign In with Facebook" 
                        <a href=""
                        class="bg-white border border-gray-300 hover:border-gray-400 text-gray-700 px-4 py-2 rounded-md flex items-center space-x-2">
                        <svg class="w-6 h-6" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M11.6666 20H7.70126V10.1414H5V6.9316H7.70116V4.64762C7.70116 1.9411 8.89588 0 12.8505 0C13.6869 0 15 0.168134 15 0.168134V3.14858H13.6208C12.2155 3.14858 11.6668 3.5749 11.6668 4.75352V6.9316H14.9474L14.6553 10.1414H11.6667L11.6666 20Z"
                                fill="#1877F2" />
                            </svg>
                            
                            <span>Connexion avec Facebook</span>
                        </a>
                </div>-->
                <div>
                    <input type="hidden" id="is_pro" name="is_pro" value="false" />
                </div>
                <!-- En-tête de la section de connexion -->
                <div class="text-center text-gray-600 mt-4 mb-4 title-div">
                    <span class="border-b border-gray-300 inline-block w-1/4"></span>
                    <span class="mx-2 text-base text-gray-600 text-Inscrivez">Inscrivez-vous avec votre e-mail</span>
                    <span class="border-b border-gray-300 inline-block w-1/4"></span>
                </div>
                <div class="flex gap-3 mt-4  py-3 genre-div">
                    <div class="border   border-gray-300 rounded-md py-3 px-7 bg-primary-color text-white cursor-pointer "
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
                    <x-text-input id="first_name" class="block mt-1 w-full focus:border-primary-color" type="text"
                    name="first_name" :value="old('first_name', isset($user['given_name']) ? $user['given_name'] : '')" required autofocus autocomplete="first_name"
                        placeholder="Nom" />
                    <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
                    <x-text-input id="last_name" class="block mt-1 w-full focus:border-primary-color" type="text"
                        name="last_name" :value="old('last_name', isset($user['family_name']) ? $user['family_name'] : '')" required autofocus autocomplete="last_name"
                        placeholder="Prenom" />
                    <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
                </div>
                <div class="flex flex-col space-y-4 sm:flex-row sm:space-x-8 sm:space-y-0">
                    <div class="flex-1">
                        <x-text-input id="email" class="block w-full mt-1 focus:border-primary-color" type="email"
                            name="email" :value="old('email', isset($user['email']) ? $user['email'] : '')" required autofocus autocomplete="email"
                            placeholder="Email" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div class="flex-1">
                        <style>
                            /* Chrome, Safari, Edge, Opera */
                            input::-webkit-outer-spin-button,
                            input::-webkit-inner-spin-button {
                                -webkit-appearance: none;
                                margin: 0;
                            }

                            /* Firefox */
                            input[type=number] {
                                -moz-appearance: textfield;
                            }
                        </style>
                        <x-text-input id="phone" class="block w-full mt-1 focus:border-primary-color" type="text" pattern="^\+33\d{9}$"
                            name="phone" :value="old('phone')" value="+33" required autofocus autocomplete="phone"
                            placeholder="Téléphone" />
                        <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                    </div>
                </div>

                <div class="mt-4">
                    <x-text-input id="nickname" class="block mt-1 w-full focus:border-primary-color" type="text"
                        name="nickname" value="" placeholder="Pseudo" />
                    <x-input-error :messages="$errors->get('nickname')" class="mt-2" />
                </div>
                <input type="hidden" name="google_id" value="{{ isset($user['id']) ? $user['id'] : null }}">

@if(!isset($user))
                <div class="mt-4 relative">
                    <div class="relative password-input">
                        <x-text-input id="password" type="password" name="password"
                            class="border password-input border-gray-300 rounded-md px-3 py-2 pr-10 focus:border-24A19C outline-none w-full focus:border-primary-color"
                             autocomplete="new-password" placeholder="Mot de passe" />
                        <div class="absolute inset-y-0 right-0 flex items-center pr-3 focus:border-primary-color">
                            <button type="button" id="togglePassword" class="cursor-pointer focus:outline-none">
                                <i id="eyeIcon" class="fas fa-eye text-gray-500"></i>
                            </button>
                        </div>
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>
                <div class="mt-4 relative">
                    <div class="relative password-input">
                        <x-text-input id="password_confirmation"
                            class="border border-gray-300 rounded-md px-3 py-2 pr-10 focus:border-24A19C outline-none w-full focus:border-primary-color"
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
                @endif
                <div class="flex items-center w-full relative border-dashed border-2 border-gray-300 rounded-md mt-4 px-3 py-2 div-file">
                    <label for="profile_photo_path" class="cursor-pointer w-full">
                        <input id="profile_photo_path" type="file" name="profile_photo_path" accept="image/*"
                            class="absolute inset-0 opacity-0 z-10 w-full focus:border-primary-color"
                            style="width: 0; height: 0;">
                        <div class="flex items-center justify-center gap-4 text-center w-full">
                            <img src="../../images/IconContainer.svg" alt="" srcset="">
                            <p class="text-gray-600 mt-2">Photo de profil</p>
                        </div>
                    </label>

                    <!-- Affiche le nom du fichier sélectionné (facultatif) -->
                    <span id="selectedFileName" class="text-gray-600 mt-2">Aucun fichier sélectionné</span>
                    <x-input-error :messages="$errors->get('profile_photo_path')" class="mt-2" id="profilePhotoErrors" />
                </div>
                <div class="my-3 hidden">
                                    <div class="relative w-60 h-36">
                                        <img id="defaultImageSelected" src="" alt="" class="w-full h-full object-cover ">
                                        <button id="deleteDefaultImage" class="absolute top-0 right-0">
                                            <img src="{{ asset('/images/close-icon2.png') }}" alt="Delete" class="w-6 h-6">
                                        </button>
                                    </div>
                                </div>
                <div class="mt-4 professional hidden">
                    <x-text-input id="social_reason" class="block mt-1 w-full focus:border-primary-color" type="text"
                        name="social_reason" value="" placeholder="Raison social" />
                    <x-input-error :messages="$errors->get('social_reason')" class="mt-2" />
                </div>
                
                <div class="mt-4 professional hidden">
                    <x-text-input id="siren_number" class="block mt-1 w-full focus:border-primary-color" type="number"
                    name="siren_number" value="" placeholder="Numero Siren" />
                    <x-input-error :messages="$errors->get('siren_number')" class="mt-2" />
                </div>
                
                <div class="mt-4 professional hidden flex items-center w-full relative border-dashed border-2 border-gray-300 rounded-md px-3 py-2 div-file">
                    <label for="company_identification_document" class="cursor-pointer w-full">
                        <input id="company_identification_document" type="file" name="company_identification_document" accept="image/*, application/pdf"
                            class="absolute inset-0 opacity-0 z-10 w-full focus:border-primary-color"
                            style="width: 0; height: 0;">
                        <div class="flex items-center justify-center gap-4 text-center w-full">
                            <img src="images/IconContainer.svg" alt="" srcset="">
                            <p class="text-gray-600 mt-2">Document d'identification de l'entreprise</p>
                        </div>
                    </label>

                    <!-- Affiche le nom du fichier sélectionné (facultatif) -->
                    <span id="selectedCompanyFileName" class="text-gray-600 mt-2">Aucun fichier sélectionné</span>
                    <x-input-error :messages="$errors->get('company_identification_document')" class="mt-2" />
                </div>
                
                <div class="my-6 flex items-center checkbox-register">
                    <input type="checkbox" id="agree" name="agree" class="border-gray-300 rounded text-primary-color" required>
                    <label for="agree" class="ml-2 text-gray-700">
                        {{ __('J\'ai lu et j\'accepte votre ') }} <a href="#" class="font-semibold text-black hover:underline">Politique de Confidentialité</a> et <a href="#" class="font-semibold text-black hover:underline">Conditions Générales</a>
                    </label>
                </div>

                <button class="w-full text-white  font-semibold py-3 rounded-md bg-primary-color hover:bg-primary-hover"
                    type="submit">
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
        document.getElementById(selectedType).classList.remove('bg-primary-color', 'text-white');
    document.getElementById(selectedType).classList.add('bg-white', 'text-dark');
    }

    document.getElementById(type).classList.remove('bg-white', 'text-dark');
    document.getElementById(type).classList.add('bg-primary-color', 'text-white');
    selectedType = type;
    const professionals = document.getElementsByClassName("professional");
    console.log(professionals);
    if(selectedType == 'particulier'){
        document.getElementById("is_pro").value = false;
        for (let i = 0; i < professionals.length; i++) {
            professionals[i].classList.add("hidden");
        }
    }else{
        document.getElementById("is_pro").value = true;
        for (let i = 0; i < professionals.length; i++) {
            professionals[i].classList.remove("hidden");
        }
    }
    
    document.querySelector('input[id="selectedType"]').value = type;
}
    let selectedGenre = 'female';

    function selectGenre(genre) {
    const mme = document.getElementById('female');
    const m = document.getElementById('male');

    if (selectedGenre) {
    document.getElementById(selectedGenre).classList.remove('bg-primary-color', 'text-white');
    document.getElementById(selectedGenre).classList.add('bg-white', 'text-dark');
    }

    document.getElementById(genre).classList.remove('bg-white', 'text-dark');
    document.getElementById(genre).classList.add('bg-primary-color', 'text-white');

selectedGenre = genre;
    console.log(selectedGenre);
    document.querySelector('input[name="gender"]').value = genre;
    }

const fileInput = document.getElementById('profile_photo_path');
const selectedFileName = document.getElementById('selectedFileName');
const companyFileInput = document.getElementById('company_identification_document');
const selectedCompanyFileName = document.getElementById('selectedCompanyFileName');

companyFileInput.addEventListener('change', (event) => {
    selectedCompanyFileName.textContent = event.target.files[0] ? event.target.files[0].name : 'Aucun fichier sélectionné';
});

    const spanElement = document.getElementById("selectedFileName");
    const defaultImageSelected = document.getElementById("defaultImageSelected");
    const deleteDefaultImage = document.getElementById("deleteDefaultImage");
    
    fileInput.addEventListener("change", function () {
        const selectedFiles = fileInput.files;
        if (selectedFiles.length > 0) {
            var reader = new FileReader();
            reader.onload = function (e) {
                defaultImageSelected.src = e.target.result;
            }
            reader.readAsDataURL(selectedFiles[0]);
            spanElement.textContent = selectedFiles[0].name;
            defaultImageSelected.parentElement.parentElement.classList.remove("hidden");
            const errorList = document.querySelector('ul.text-red-600');
            
            // Clear all error messages
            if (errorList) {
                while (errorList.firstChild) {
                    errorList.removeChild(errorList.firstChild);
                }
            }
           // browse_default_text.classList.add("hidden");
        } else {
            spanElement.textContent = "Aucun fichier sélectionné";
           // if(browse_default_text.classList.contains("hidden"))
           // browse_default_text.classList.remove("hidden");
    }
    
    deleteDefaultImage.onclick = () =>{
        event.preventDefault();
        const div = deleteDefaultImage.parentElement.parentElement;
       // if(browse_default_text.classList.contains("hidden"))
       // browse_default_text.classList.remove("hidden");
        if(!div.classList.contains("hidden"))
        div.classList.add("hidden");
    spanElement.textContent = "Aucun fichier sélectionné";
        defaultImageSelected.src = '';
        fileInput.value = '';
        if(!defaultImageSelected.parentElement.parentElement.classList.contains("hidden"))
        defaultImageSelected.parentElement.parentElement.classList.add("hidden");

    };

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