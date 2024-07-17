<x-registerGuest>
    <div class="flex flex-col md:flex-row">
        <div class="md:w-1/2 bg-primary-color bg-cover bg-center  text-white partie-droit-register"
            style='background-image: url("images/signup-bg-pattern.svg");'>
            <div class="w-[70%] mx-auto my-44 p-3">
                <h1 class="font-semibold text-3xl">Pourquoi Créer Un Compte Professionel? </h1>
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
                <h1 class="text-center text-primary-color text-4xl">{{ __('Devenir professionel') }}</h1>
            </div>
            <div class="flex justify-center mt-10 rounded-md bg-gray-100 py-3 types-div w-full">
                <div class="border border-gray-300 rounded-md py-2 px-10 bg-primary-color text-white cursor-pointer w-1/2 flex justify-center"
                    id="professionnel" onclick="selectType('professionnel')">
                    <div>Professionnel</div>
                </div>
                
            </div>
            {{-- <input type="hidden" name="role" id="selectedType" value="particulier"> --}}
            
            <form method="POST" action="{{ route('becomePro') }}" enctype="multipart/form-data">
                @csrf
                
                <div class="mt-4 professional">
                    <x-text-input id="social_reason" class="block mt-1 w-full focus:border-primary-color" type="text"
                        name="social_reason" value="" placeholder="Raison social" />
                    <x-input-error :messages="$errors->get('social_reason')" class="mt-2" />
                </div>
                
                <div class="mt-4 professional">
                    <x-text-input id="siren_number" class="block mt-1 w-full focus:border-primary-color" type="text"
                    name="siren_number" value="" placeholder="Numero Siren" />
                    <x-input-error :messages="$errors->get('siren_number')" class="mt-2" />
                </div>
                
                <div class="mt-4 professional flex items-center w-full relative border-dashed border-2 border-gray-300 rounded-md px-3 py-2 div-file">
                    <label for="company_identification_document" class="cursor-pointer w-full">
                        <input id="company_identification_document" type="file" name="company_identification_document" accept="application/pdf"
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
                    <input type="checkbox" id="agree" name="agree" class=" border-gray-300 rounded text-primary-color"
                    required>
                    <label for="agree" class="ml-2 text-gray-700 ">
                        {{ __('I\'ve read and agree with your ') }} <a href="#"
                            class="font-semibold text-black hover:underline">Privacy
                            Policy</a> and <a href="#" class="font-semibold text-black hover:underline">Terms &
                            Conditions</a>
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
    let selectedType = 'professionel';


const companyFileInput = document.getElementById('company_identification_document');
const selectedCompanyFileName = document.getElementById('selectedCompanyFileName');
companyFileInput.addEventListener('change', (event) => {
    selectedCompanyFileName.textContent = event.target.files[0] ? event.target.files[0].name : 'Aucun fichier sélectionné';
});


</script>
