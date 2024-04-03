<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Déposer une offre') }}
        </h2>
    </x-slot>
    <div class="container">
        <nav style="--bs-breadcrumb-divider: '>'" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">{{ Diglactic\Breadcrumbs\Breadcrumbs::render('create') }}</li>
            </ol>
        </nav>
    </div>
    <div class="container">
        <ol class="ml-0 pl-0 flex items-center w-full text-sm font-medium text-center text-gray-500 dark:text-gray-400 sm:text-base">
            <li class="stepTitle flex md:w-full items-center text-blue-600 dark:text-blue-500 sm:after:content-[''] after:w-full after:h-1 after:border-b after:border-gray-200 after:border-1 after:hidden sm:after:inline-block after:mx-4 xl:after:mx-10 dark:after:border-gray-700">
                <span class="flex items-center after:content-['/'] sm:after:hidden after:mx-2 after:text-gray-200 dark:after:text-gray-500">
                    <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                    </svg>
                    <span class="me-1 sm:me-2 num">1</span>
                    <span class="name">Type</span>
                </span>
            </li>
            <li class="stepTitle flex md:w-full items-center after:content-[''] after:w-full after:h-1 after:border-b after:border-gray-200 after:border-1 after:hidden sm:after:inline-block after:mx-4 xl:after:mx-10 dark:after:border-gray-700">
                <span class="flex items-center after:content-['/'] sm:after:hidden after:mx-2 after:text-gray-200 dark:after:text-gray-500">
                    <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 me-2.5  hidden" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                    </svg>
                    <span class="me-1 sm:me-2 num">2</span>
                    <span class="name">Localisation</span>

                </span>
            </li>
            <li class="stepTitle flex md:w-full items-center after:content-[''] after:w-full after:h-1 after:border-b after:border-gray-200 after:border-1 after:hidden sm:after:inline-block after:mx-4 xl:after:mx-10 dark:after:border-gray-700">
                <span class="flex items-center after:content-['/'] sm:after:hidden after:mx-2 after:text-gray-200 dark:after:text-gray-500">
                    <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 me-2.5 hidden" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                    </svg>
                    <span class="me-1 sm:me-2 num">3</span>
                    <span class="name">Description</span>
                </span>
            </li>
            <li class="stepTitle flex md:w-full items-center after:content-[''] after:w-full after:h-1 after:border-b after:border-gray-200 after:border-1 after:hidden sm:after:inline-block after:mx-4 xl:after:mx-10 dark:after:border-gray-700">
                <span class="flex items-center after:content-['/'] sm:after:hidden after:mx-2 after:text-gray-200 dark:after:text-gray-500">
                    <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 me-2.5 hidden" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                    </svg>
                    <span class="me-1 sm:me-2 num">4</span>
                    <span class="name">Echange</span>
                    
                </span>
            </li>
            <li class="stepTitle flex items-center ">
                <span class="flex items-center ">
                    <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 me-2.5 hidden" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                    </svg>
                    <span class="me-1 sm:me-2 num">5</span>
                    <span class="name">Poster</span>
                </span>
            </li>
        </ol>

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <div class="">
            <form method="POST" id="createPostForm" action="{{ route('offer.store') }}" class="mt-6 space-y-6"
                enctype="multipart/form-data">
                @csrf
                @method('POST')
                <div class="stepTab py-4 mt-12">
                    <div class="flex gap-4 lg:gap-8 flex-wrap ">
                        <div class="md:flex-1 w-full">
                            <label for="" class="text-sm text-text block">Type</label>
                            <select  name='type'
                                class="w-[100%] rounded-md border-line text-sm text-titles focus:border-primary-hover focus:ring-primary-hover"
                                id="type-dropdown" onchange="changerType(this)">
                                <option value="0" selected hidden>Choisir le type de troc *</option>
                                @foreach($types as $type)
                                <option value="{{ $type->id }}">{{ $type->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="md:flex-1 w-full hidden " id="experience-dropdown">
                            <label for="" class="text-sm text-text block">Expérience du service</label>
                            <select name='experience'
                                class="w-[100%] rounded-md border-line text-sm text-titles focus:border-primary-hover focus:ring-primary-hover">
                                <option value="0" selected>Choisir l'expérience</option>
                                @foreach ($experienceLevels as $key => $value)
                                <option value="{{ $value }}">{{ $key }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="md:flex-1 w-full hidden" id="condition-dropdown">
                            <label for="" class="text-sm text-text block">Etat</label>
                            <select name='condition'
                                class="w-[100%] rounded-md border-line text-sm text-titles focus:border-primary-hover focus:ring-primary-hover">
                                <option value="0" selected>
                                    {{ __('Choisir l\'état') }}
                                </option>
                                @foreach ($conditions as $key => $value)
                                <option value="{{ $value }}">{{ $key }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="md:flex-1 w-full">
                            <label for="" class="text-sm text-text block">Catégorie du troc</label>
                            <select  name='category' id="select_type"
                                class="w-[100%] rounded-md border-line text-sm text-titles focus:border-primary-hover focus:ring-primary-hover"
                                onchange="changerCategory(this)">
                                <option value="0" selected hidden>Choisir la Catégorie *</option>
                            </select>
                        </div>
                        <div class="md:flex-1 w-full">
                            <label for="" class="text-sm text-text block">Sous catégorie du troc</label>
                            <select  name='subcategory' id="select_category"
                                class="w-[100%] rounded-md border-line text-sm text-titles focus:border-primary-hover focus:ring-primary-hover">
                                <option value="0" selected hidden>Choisir la sous catégorie *</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="stepTab py-4 mt-4">
                    <div class="row">
                        <div class="col-md-4 col-12">
                            <div class="flex flex-col  w-full mb-3">
                                <label for="" class="text-sm text-text block">Région</label>
                                <select  name='region' onchange="changerDepartement(this)"
                                    class="w-[100%] rounded-md border-line text-sm text-titles focus:border-primary-hover focus:ring-primary-hover">
                                    <option value="" selected hidden>Choisir une région *</option>
                                    @foreach($regions as $region)
                                    <option value="{{ $region->id }}">{{ $region->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4 col-12">
                            <div class="flex flex-col w-full mbdropdown-3">
                                <label for="" class="text-sm text-text block">Département</label>
                                <select  name='department' id="select_department"
                                    onchange="changerNumDepartement(this)"
                                    class="w-[100%] rounded-md border-line text-sm text-titles focus:border-primary-hover focus:ring-primary-hover">
                                    <option value="0" selected hidden>Choisir un département *</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4 col-12">
                            <div class="flex flex-col w-full">
                                <label for="" class="text-sm text-text block">N° département</label>
                                <input type="text" 
                                    class="focus:border-primary-color w-full rounded-md border-line text-sm text-titles  focus:ring-primary-hover"
                                    readonly id="num-departement" />
                            </div>
                        </div>
                        <div class="col-4"></div>
                    </div>
                </div>
                <div class="stepTab py-4 mt-4">
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="w-full">
                                <label for="title" class="text-sm text-text block">Titre</label>
                                <input id="title" name="title" placeholder="Titre d'annonce ici" type="text"
                                    class="w-full rounded-md border-line text-sm text-titles focus:border-primary-hover focus:ring-primary-hover"
                                     autofocus />
                                <x-input-error class="mt-2" :messages="$errors->get('title')" />
                            </div>
                            <div class="py-3">
                                <label for="description" class="text-sm text-text">Description</label>
                                <textarea id="description" name="description" type="text"
                                    class="w-full min-h-[200px] rounded-md border-line text-sm text-titles focus:border-primary-hover focus:ring-primary-hover"
                                    ></textarea>
                                <x-input-error class="mt-2" :messages="$errors->get('description')" />
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="flex flex-col div-image ">
                                <span for="" class="text-sm text-text">
                                    {{ __('Insérer la photo de couverture') }}</span>
                                <div class="flex items-center border-dashed border-2 border-line rounded-md px-3 ">
                                    <label for="default_image" class="cursor-pointer w-full" >
                                        <input id="default_image" type="file" name="default_image" accept="image/*"  oninput="validatePrimaryPhoto()"
                                            class="absolute inset-0 opacity-0 z-10 w-full focus:border-primary-color"
                                            style="width: 0; height: 0;">
                                        <div class="flex items-center justify-center gap-4 text-center w-full">
                                            <img src="/images/IconContainer.svg" alt="" srcset="">
                                            <p id="browse_default_text" class="text-text text-sm mt-3">
                                                {{ __('Parcourir l\'image ') }}</span></p>
                                        </div>
                                    </label>
                                    <!-- Affiche le nom du fichier sélectionné (facultatif) -->
                                    <span id="selectedFileName" class="text-text text-sm mt-2">Aucun fichier
                                        sélectionné</span>
                                </div>
                                <div class="my-2">
                                    <img id="defaultImageSelected" src="" alt="" width="150px">
                                </div>
                                <x-input-error :messages="$errors->get('default_image')" class="mt-2" />
                                <span for="" class="text-sm text-text mt-4">
                                    {{ __('Insérer plus de photo detaillées') }}</span>
                                <div class="flex items-center border-dashed border-2 border-line rounded-md px-3 bg-neutral-300">
                                    <label for="additional_images" class="cursor-pointer w-full" >
                                        <input id="additional_images" type="file" name="additional_images[]" accept="image/*" multiple disabled
                                        class="absolute inset-0 opacity-0 z-10 w-full focus:border-primary-color"
                                        style="width: 0; height: 0;" />
                                        <div class="flex items-center justify-center gap-4 text-center w-full">
                                            <img src="/images/IconContainer.svg" alt="" srcset="">
                                            <p id="browse_additional_text" class="text-text text-sm mt-3">{{ __('Parcourir l\'image ') }}</p>
                                        </div>
                                    </label>
                                    <!-- Affiche le nom du fichier sélectionné (facultatif) -->
                                    <span id="selectedFileNameMultiple" class="text-text text-sm mt-2">Aucun fichier
                                        sélectionné</span>
                                    </div>
                                    <x-input-error :messages="$errors->get('additional_images')" class="mt-2" />
                                </div>
                                <div id="additionalImageSelected" class="my-2 flex justify-start flex-wrap">
                                    
                                </div>
                            </div>
                    </div>
                </div>
                <div class="stepTab py-4 mt-4">
                    <div class="container">
                        <div id="partner" class="hidden">
                            <!-- Left Section: Your Troc Preferences -->
                            <div class="col-md-6">
                                <h3 class="text-lg font-bold text-titles mb-3">Nombre de partenaires</h3>
                                <hr>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="partnerCheckbox" name="partnerCheckbox"
                                            onchange="addTeam()">
                                        <label class="form-check-label" for="partnerCheckbox">Equipe(s)</label>
                                    </div>
                                    <div id="addTeamContainer"></div>

                                    <!-- Input lines for adding values -->
                                    <!-- <div class="input-group mt-3">
                                        <input type="text" name="dynamicInputs[]" class="form-control" >
                                    </div> -->

                                    <!-- Container to hold dynamically added input lines -->
                            </div>
                        </div>
                        <div id="donation" class="hidden">
                            <!-- Left Section: Your Troc Preferences -->
                            <div class="col-md-12">
                                <h3 class="text-lg font-bold text-titles mb-3">Don</h3>
                                <hr>
                                    <style>
                                        @keyframes revealText {
                                            0% {
                                                width: 0;
                                            }
                                            100% {
                                                width: 100%;
                                            }
                                        }

                                        .donation-container {
                                            display: flex;
                                            align-items: center;
                                            justify-content: start;
                                        }
                                        
                                        .donation-text {
                                            display: inline-block;
                                            animation: revealText 3s steps(13, end) forwards;
                                            overflow: hidden;
                                            white-space: nowrap;
                                        }
                                    </style>

                                    <div class="donation-container">
                                        <p class="donation-text text-xl">Merci de faire parti des donateurs!</p>
                                    </div>
                            </div>
                        </div>
                        <div id="exchange" class="row">
                            <!-- Left Section: Your Troc Preferences -->
                            <div class="col-md-6">
                                <h3 class="text-lg font-bold text-titles mb-3">Votre troc (Contre quoi voulez-vous échanger ?)</h3>
                                <hr>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="exchangeCheckbox" name="exchangeCheckbox" checked>
                                        <label class="form-check-label" for="exchangeCheckbox">Etudier toutes les propositions</label>
                                    </div>

                                    <!-- Input lines for adding values -->
                                    <div class="input-group mt-3">
                                        <input type="text" name="dynamicInputs[]" class="form-control notRequired" placeholder="1 er Troc">
                                        <button class="btn btn-outline-secondary" type="button" onclick="addInput()">+</button>
                                    </div>

                                    <!-- Container to hold dynamically added input lines -->
                                    <div id="dynamicInputsContainer"></div>
                            </div>

                            <!-- Right Section: Your Estimation -->
                            <div class="col-md-6">
                                <h3 class="text-lg font-bold text-titles mb-3">Votre estimation</h3>
                                <hr>
                                    <div class="form-group">
                                        <label for="valueInput">Valeur</label>
                                        <input type="number" step="any" min="0" class="form-control" id="valueInput" name="valueInput" placeholder="Prix en €" value="0">
                                    </div>

                                    <!-- Checkbox for "autorise la vente" -->
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="sellCheckbox" id="sellCheckbox">
                                        <label class="form-check-label" for="sellCheckbox">Autorise la vente</label>
                                    </div>
                                    <!-- Checkbox for "autorise la vente" -->
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="sendCheckbox" id="sendCheckbox">
                                        <label class="form-check-label" for="sendCheckbox">Autorise l'envoi</label>
                                    </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
                <div class="stepTab">
                    <div class=" border-b border-line py-4 mt-4">
                        <div>
                            <h3 class="text-lg font-bold text-titles mb-3">Compte à rebours</h3>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="countdownCheckbox" name="countdownCheckbox">
                                <label class="form-check-label" for="countdownCheckbox">Déclencher un compte à rebours</label>
                            </div>
    
                            <div id="countdownOptions" style="display: none;">
                            <div class="flex space-x-4">
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" id="option2" name="countdown_option" value="2">
                                    <label class="form-check-label" for="option2">2 heures</label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" id="option4" name="countdown_option" value="4">
                                    <label class="form-check-label" for="option4">4 heures</label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" id="option6" name="countdown_option" value="6">
                                    <label class="form-check-label" for="option6">6 heures</label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" id="option6" name="countdown_option" value="6">
                                    <label class="form-check-label" for="option6">12 heures</label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" id="option6" name="countdown_option" value="6">
                                    <label class="form-check-label" for="option6">24 heures</label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" id="option6" name="countdown_option" value="6">
                                    <label class="form-check-label" for="option6">48 heures</label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" id="option6" name="countdown_option" value="6">
                                    <label class="form-check-label" for="option6">72 heures</label>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
    
                    <!-- Add this input field for the expiration date -->
                    <input type="datetime-local" name="expiration_date" id="expiration_date" hidden>
    
                    <div class="py-4 mt-4">
                        <h3 class="text-lg font-bold text-titles mb-3">Mise en ligne de l'annonce</h3>
                        <div class="flex space-x-4">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="immediatCheckbox" name="launchOption" value="immediat">
                                    <label class="form-check-label" for="immediatCheckbox">Immédiat</label>
                                </div>
    
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="differeCheckbox" name="launchOption" value="differe">
                                    <label class="form-check-label" for="differeCheckbox">Différé</label>
                                </div>
                        </div>
                        <div id="differeOptions" style="display: none;">
                            <label class="form-check-label m-3" for="countdownCheckbox">Choisir le délai de mise en ligne de l'annonce :</label>
                            <div class="flex space-x-4">
    
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" id="option2h" name="launchTime" value="6h">
                                    <label class="form-check-label" for="option2h">6 heures</label>
                                </div>
    
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" id="option4h" name="launchTime" value="12h">
                                    <label class="form-check-label" for="option4h">12 heures</label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" id="option4h" name="launchTime" value="1j">
                                    <label class="form-check-label" for="option4h">1J</label>
                                </div>  
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" id="option4h" name="launchTime" value="3j">
                                    <label class="form-check-label" for="option4h">3J</label>
                                </div>  
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" id="option4h" name="launchTime" value="5j">
                                    <label class="form-check-label" for="option4h">5J</label>
                                </div>  <div class="form-check">
                                    <input type="radio" class="form-check-input" id="option4h" name="launchTime" value="7j">
                                    <label class="form-check-label" for="option4h">7J</label>
                                </div>   
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" id="option4h" name="launchTime" value="30j">
                                    <label class="form-check-label" for="option4h">30J</label>
                                </div>        
                            </div>
                        </div>
                    </div> 
                </div>

                <div class="flex justify-end gap-2">
                    <button id="cancelBtn" class="text-white rounded-md w-48 h-12 flex justify-center items-center bg-gray-900  hover:bg-black">
                        <a class="no-underline font-medium text-white " href="{{route('myaccount.offers')}}">Annuler</a>
                    </button>
                    <button id="prevBtn" class="text-white rounded-md w-48 h-12 flex justify-center items-center bg-gray-900  hover:bg-black"
                        onclick="nextPrev(-1)" type="button">
                        <span class="no-underline font-medium text-white ">Précendent</span>
                    </button>
                    <button id="nextBtn" class="text-white rounded-md w-48 h-12 flex justify-center items-center bg-primary-color hover:bg-primary-hover"
                        onclick="nextPrev(1)" type="button">
                        <span class="no-underline font-medium text-white " >Suivant</span>
                    </button>
                    <button id="submitBtn" class="text-white rounded-md w-48 h-12 flex justify-center items-center bg-primary-color hover:bg-primary-hover"
                        type="submit">
                        {{ __('Publier  l\'annonce') }}
                    </button>
                </div>

            </form>
        </div>
    </div>

</x-app-layout>
<style>
    .stepTab{
        display : none;
    }
</style>
<script>
     // Add event listeners to show/hide additional options based on checkbox state
    let inputCount = 1;
    function addInput() {
        console.log(inputCount);
        if(inputCount<3){
            var container = document.getElementById("dynamicInputsContainer");
            var input = document.createElement("input");
            input.type = "text";
            input.name = "dynamicInputs[]";
            input.className = "form-control mt-3 notRequired";
            var pl = `${inputCount + 1} eme Troc`;
            input.placeholder = pl;
            container.appendChild(input);
            inputCount++;
        }
        else{
            appendError("Le nombre maximal de troc possible est de trois");
        }
    }
    function addTeam() {
        let checkbox = document.getElementById('partnerCheckbox');

        var container = document.getElementById("addTeamContainer");
        if(checkbox.checked){
            var input = document.createElement("input");
            input.type = "number";
            input.name = "dynamicInputs[]";
            input.className = "form-control mt-3";
            input.placeholder = "Nombre d'équipes";
            // input.setAttribute("readonly", "readonly");
            container.appendChild(input);
        }else{
            while (container && container.firstChild) {
                container.removeChild(container.firstChild);
            }
        }
    }
    // 
    const conditionDropdownElement = document.getElementById('condition-dropdown')
    const yearsOfExperienceDropdownElement = document.getElementById('experience-dropdown')

    const experienceOrLevel = (selectedValue) => {
        const hasCondition = [6,1, ,"6","1"]
        const hasExprience = 2
        if(hasCondition.includes(selectedValue)){
            // if bien, don, moment => show condition dropdown
            conditionDropdownElement.style.display = "inline-block"
            yearsOfExperienceDropdownElement.style.display = "none"

        } else if(selectedValue === 2 || selectedValue === "2") {
            // if service        => show experience dropdown
            conditionDropdownElement.style.display = "none"
            yearsOfExperienceDropdownElement.style.display = "inline-block"
        } else {
            // else              => show nothing
            conditionDropdownElement.style.display = "none"
            yearsOfExperienceDropdownElement.style.display = "none"
        }
    }
    // Type dropdown change handler
    const onTypeDropdownChanged = (e) => {
        const selectedValue = e.target.value
        experienceOrLevel(selectedValue)
    }
    const typeDropdownElement = document.getElementById('type-dropdown')
    typeDropdownElement.addEventListener("change", onTypeDropdownChanged)

    const inputElement = document.getElementById("default_image");
    const spanElement = document.getElementById("selectedFileName");
    const defaultImageSelected = document.getElementById("defaultImageSelected");
    const browse_default_text = document.getElementById("browse_default_text");
    
    
    inputElement.addEventListener("change", function () {
        const selectedFiles = inputElement.files;
        if (selectedFiles.length > 0) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                defaultImageSelected.src = e.target.result;
            }
            reader.readAsDataURL(selectedFiles[0]);
            
            spanElement.textContent = selectedFiles[0].name;
            browse_default_text.classList.add("hidden");
        } else {
            spanElement.textContent = "Aucun fichier sélectionné";
            if(browse_default_text.classList.contains("hidden"))
            browse_default_text.classList.remove("hidden");
    }
});


const additional_images = document.getElementById("additional_images");
const spanElementMultiple = document.getElementById("selectedFileNameMultiple");
const additionalImageSelected = document.getElementById("additionalImageSelected");
var selectedFilesMultiple = [];
const browse_additional_text = document.getElementById("browse_additional_text");

additional_images.addEventListener("change", function () {
    selectedFilesMultiple = selectedFilesMultiple.concat(Array.from(additional_images.files));
    if (selectedFilesMultiple.length > 0) {
        while(additionalImageSelected.firstChild){
            additionalImageSelected.removeChild(additionalImageSelected.firstChild);
        };
        browse_additional_text.classList.add("hidden");
        selectedFilesMultiple.forEach((item, index) => {
            const divElement = document.createElement('div');
            divElement.className = 'me-4';
            
            const imgElement = document.createElement('img');
            const reader = new FileReader();
            reader.onload = function (e) {
                imgElement.src = e.target.result;
                imgElement.setAttribute("style","height:30px");
            }
            reader.readAsDataURL(item);
            imgElement.alt = '';
            const buttonElement = document.createElement('button');
            const imgTrashElement = document.createElement('img');
            buttonElement.className = 'w-full';
            imgTrashElement.src = '{{asset("/images/trash-icon.png")}}';
            imgTrashElement.className = 'mx-auto my-2';
            imgTrashElement.style.width = "25px";
            buttonElement.onclick = () =>{
                event.preventDefault();
                buttonElement.parentNode.remove();
                selectedFilesMultiple.splice(index, 1);
                spanElementMultiple.textContent = selectedFilesMultiple.length + " fichier(s) sélectionné(s)";
            };

            buttonElement.appendChild(imgTrashElement);
            divElement.appendChild(imgElement);
            divElement.appendChild(buttonElement);
            additionalImageSelected.appendChild(divElement);
            
            
        });
        spanElementMultiple.textContent = selectedFilesMultiple.length + " fichier(s) sélectionné(s)";
        var dataTransfer = new DataTransfer();
        selectedFilesMultiple.forEach(function(file) {
            dataTransfer.items.add(file);
        });
        additional_images.files = dataTransfer.files;
        
    } else {
        spanElementMultiple.textContent = "Aucun fichier sélectionné";
        if(browse_additional_text.classList.contains("hidden"))
        browse_additional_text.classList.remove("hidden");
    }
});

const changerCategory = (e) => {
    const subcategories = @json($subcategories);
    const selectedCategoryId = e.value;
    const subcategoryOptions = subcategories.filter(item => item.parent_id == selectedCategoryId);
    const selectCategory = document.getElementById('select_category');
    
    while (selectCategory.options.length > 1) {
        selectCategory.remove(1);
    }
    
        subcategoryOptions.forEach(item => {
            const option = document.createElement("option");
            option.value = item.id;
            option.innerHTML = item.name;
            selectCategory.append(option);
        });
    };
    
    const changerType = (e) => {
        const types = @json($types);
        const selectedTypeId = e.value;
        console.log({selectedTypeId});
        document.cookie = "selectedTypeId = " + selectedTypeId;
        var partner = document.getElementById('partner');
        var donation = document.getElementById('donation');
        var exchange = document.getElementById('exchange');
        
        const type = types.filter(item => item.id == selectedTypeId)[0];
        const categories = type["categories"];
        const selectType = document.getElementById('select_type');
        
        while (selectType.options.length > 1) {
            selectType.remove(1);
        }
    
        
        categories.forEach(item => {
            const option = document.createElement("option");
            option.value = item.id;
            option.innerHTML = item.name;
            selectType.append(option);
        });
        // Exchange part
        if(selectedTypeId == 7){// moment
            if (donation.classList.contains('row')){
                donation.classList.remove('row');
                donation.classList.add('hidden');
                Array.from(donation.getElementsByTagName("input")).forEach(e =>{
                    e.classList.add("notRequired");
                });
            }
            if (exchange.classList.contains('row')){
                exchange.classList.remove('row');
                exchange.classList.add('hidden');
                Array.from(exchange.getElementsByTagName("input")).forEach(e =>{
                    e.classList.add("notRequired");
                });
            }
            if (partner.classList.contains('hidden')){
                partner.classList.remove('hidden');
                partner.classList.add('row');
            }
            
        }else if(selectedTypeId == 6){ // don
            if (partner.classList.contains('row')){
                partner.classList.remove('row');
                partner.classList.add('hidden');
                Array.from(partner.getElementsByTagName("input")).forEach(e =>{
                    e.classList.add("notRequired");
                });
            }
            if (exchange.classList.contains('row')){
                exchange.classList.remove('row');
                exchange.classList.add('hidden');
                Array.from(exchange.getElementsByTagName("input")).forEach(e =>{
                    e.classList.add("notRequired");
                });
            }
            if (donation.classList.contains('hidden')){
                donation.classList.remove('hidden');
                donation.classList.add('row');
            }
        }else{ 
            if (partner.classList.contains('row')){
                partner.classList.remove('row');
                partner.classList.add('hidden');
                Array.from(partner.getElementsByTagName("input")).forEach(e =>{
                    e.classList.add("notRequired");
                });
            }
            if (donation.classList.contains('row')){
                donation.classList.remove('row');
                donation.classList.add('hidden');
                Array.from(donation.getElementsByTagName("input")).forEach(e =>{
                    e.classList.add("notRequired");
                });
            }
            if (exchange.classList.contains('hidden')){
                exchange.classList.remove('hidden');
                exchange.classList.add('row');
            }
            
        }


    };


const changerDepartement = (e) => {
    const departments = @json($departments);
    console.log(e.value);
    const departmentOptions = departments.filter(item => item.region_id == e.value);
    const selectDepartment = document.getElementById('select_department');

    while (selectDepartment.options.length > 1) {
        selectDepartment.remove(1);
    }

    departmentOptions.forEach(item => {
        const option = document.createElement("option");
        option.value = item.id;
        option.innerHTML = item.name;
        selectDepartment.append(option);
    });
};

const changerNumDepartement = (e) => {
    const departmentsList = @json($departments);
    console.log('Selected value:', e.value);
    const numDepartment = document.getElementById('num-departement');
    const department = departmentsList.find(item => item.id == e.value);
    console.log('Department found:', department);
    numDepartment.value = department ? department.department_number : '';
};

$('#mySelect').change(function () {
            var selectedValue = $(this).val();});


// compte a rebours
    document.addEventListener('DOMContentLoaded', function () {
        const countdownCheckbox = document.getElementById('countdownCheckbox');
        const countdownOptions = document.getElementById('countdownOptions');
        const expirationDateInput = document.getElementById('expiration_date');

        // Show/hide countdown options based on checkbox
        countdownCheckbox.addEventListener('change', function () {
            countdownOptions.style.display = this.checked ? 'block' : 'none';
        });

        // Update the expiration date input based on the selected countdown option
        document.querySelectorAll('input[name="countdown_option"]').forEach(function (option) {
            option.addEventListener('change', function () {
                const selectedOption = document.querySelector('input[name="countdown_option"]:checked');
                const countdownValue = selectedOption ? selectedOption.value : null;

                if (countdownValue) {
                    const expirationDate = calculateExpirationDate(countdownValue);
                    expirationDateInput.value = expirationDate;
                }
            });
        });

        // Function to calculate the expiration date based on the selected countdown option
        function calculateExpirationDate(countdownOption) {
            const now = new Date();
            const expirationDate = new Date(now.getTime() + countdownOption * 60 * 60 * 1000); // Add hours

            // Format the date as 'YYYY-MM-DDTHH:mm'
            const formattedDate = expirationDate.toISOString().slice(0, 16);
            return formattedDate;
        }
        // compte a rebours
        // Add event listeners to show/hide deferred options based on user selection
        var immediatCheckbox = document.getElementById('immediatCheckbox');
            var differeCheckbox = document.getElementById('differeCheckbox');
            var differeOptions = document.getElementById('differeOptions');

            immediatCheckbox.addEventListener('change', function () {
                if (immediatCheckbox.checked) {
                    differeCheckbox.checked = false;
                    differeOptions.style.display = 'none';
                }
            });

            differeCheckbox.addEventListener('change', function () {
                if (differeCheckbox.checked) {
                    immediatCheckbox.checked = false;
                    differeOptions.style.display = 'block';
                } else {
                    differeOptions.style.display = 'none';
                }
            });
    });

function validatePrimaryPhoto() {
    const default_image = document.getElementById("default_image").value.trim();
    var additional_images = document.getElementById("additional_images");
    if ( default_image === '') {
        additional_images.value = ''; 
        additional_images.disabled = true; 
        // console.log(additional_images.parentElement.parentElement);
        
    } else {
        additional_images.parentElement.parentElement.classList.remove("bg-neutral-300");
        console.log(additional_images.parentElement.parentElement);
        additional_images.disabled = false; 
    }
}



var currentTab = 0; 
showTab(currentTab);
function showTab(n) {
  var x = document.getElementsByClassName("stepTab");
  x[n].style.display = "block";
  // ... and fix the Previous/Next buttons:
  if (n == 0) {
    document.getElementById("prevBtn").style.display = "none";
    document.getElementById("cancelBtn").style.display = "inline";
  } else {
      document.getElementById("prevBtn").style.display = "inline";
      document.getElementById("cancelBtn").style.display = "none";
  }
  if (n == (x.length - 1)) {
    document.getElementById("nextBtn").style.display = "none";
    document.getElementById("submitBtn").style.display = "inline";
  } else {
    document.getElementById("nextBtn").style.display = "inline";
    document.getElementById("submitBtn").style.display = "none";
  }
  // ... and run a function that displays the correct step indicator:
  fixStepIndicator(n)
}

function nextPrev(n) {
  var x = document.getElementsByClassName("stepTab");
    
  if (n == 1 && !validateForm()) {
    return false;
  }

  x[currentTab].style.display = "none";
  
  currentTab = currentTab + n;
  
  
  showTab(currentTab);
}
function appendError(text){
    var errorContainer = document.getElementById("stepErrors");
    if(!errorContainer){
        errorContainer = document.createElement("div");
        errorContainer.classList.add("alert", "alert-danger");
        errorContainer.id = "stepErrors";
        var ul = document.createElement("ul");
        ul.id = "ulErrors";
        errorContainer.appendChild(ul);
        var createPostForm = document.getElementById("createPostForm");
        createPostForm.appendChild(errorContainer);
    }
    
    var ulErrors= document.getElementById("ulErrors");
    while (ulErrors && ulErrors.firstChild) {
        ulErrors.removeChild(parent.firstChild);
    }
    
    var li = document.createElement("il");
    li.textContent = text;
    ulErrors.appendChild(li);
}

function validateForm() {
  var i, valid = true;
  var x = document.getElementsByClassName("stepTab");
  var y = x[currentTab].getElementsByTagName("input");
  var z = x[currentTab].getElementsByTagName("select");
  for (i = 0; i < y.length; i++) {
    if ((window.getComputedStyle(y[i].parentNode, null).display != "none") && y[i].value === "" ) {
      if(y[i].classList.contains("notRequired"))continue;
      y[i].classList.add("invalid");
        
      appendError("Veuillez ne pas laisser les champs en * vide, elles sont obligatoires");
      valid = false;
    }else{
        y[i].classList.remove("invalid");
    }
  }
  for (i = 0; i < z.length; i++) {
    if ((window.getComputedStyle(z[i].parentNode, null).display != "none") && z[i].value === "0") {
        z[i].classList.add("invalid");
        
        appendError("Veuillez selectionner un element, les champs en * sont obligatoires");
        valid = false;
    }else{
        z[i].classList.remove("invalid");
    }
  }
  console.log({valid});
  console.log({y});
  console.log({z});
  if (valid) {
    document.getElementsByClassName("stepTab")[currentTab].classList.add("finish");
  }
  return valid; 
}

function fixStepIndicator(n) {
  // This function removes the "active" class of all steps...
  var i;
  var u = document.querySelectorAll(".stepTitle span .num");
  var v = document.querySelectorAll(".stepTitle span .name");
  var y = document.querySelectorAll(".stepTitle span svg");
  var z = document.querySelectorAll(".stepTitle");
  
  console.log({n});
  for (i = 0; i < u.length; i++) {
    if(i < n){//svg
        u[i].classList.add("hidden");
        y[i].classList.remove("hidden");
    }else{//span
        u[i].classList.remove("hidden");
        y[i].classList.add("hidden");
    }
    if(i <= n){
        z[i].classList.add("text-blue-600","dark:text-blue-50");
    }else{
        z[i].classList.remove("text-blue-600","dark:text-blue-50");
    }
    if(i<n){
        v[i].classList.add("hidden","sm:visible","sm:block");
    }else if(i==n){
        v[i].classList.remove("hidden","sm:visible","sm:block");
    }else{
        v[i].classList.add("hidden","sm:visible","sm:block");
    }
  }
  
  var errorContainer = document.getElementById("stepErrors");
  if(errorContainer) errorContainer.remove();
  
}

</script>
