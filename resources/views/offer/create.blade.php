<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Déposer une offre') }}
        </h2>
    </x-slot>
    <div class="container">
        <nav style="--bs-breadcrumb-divider: '>'" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">{{ Breadcrumbs::render('offers') }}</li>
                <li class="breadcrumb-item active" aria-current="page">Déposer une offre</li>
            </ol>
        </nav>
    </div>
    <div class="container">
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
            <form method="POST" action="{{ route('offer.store') }}" class="mt-6 space-y-6"
                enctype="multipart/form-data">
                @csrf
                @method('POST')
                <div class="border-b border-line py-4 mt-12">
                    <div class="flex gap-4 lg:gap-8 flex-wrap ">
                        <div class="md:flex-1 w-full">
                            <label for="" class="text-sm text-text block">Type</label>
                            <select required name='type'
                                class="w-[100%] rounded-md border-line text-sm text-titles focus:border-primary-hover focus:ring-primary-hover"
                                id="type-dropdown">
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
                                <option value="0" selected>Choisir l’expérience</option>
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
                            <select required name='category'
                                class="w-[100%] rounded-md border-line text-sm text-titles focus:border-primary-hover focus:ring-primary-hover"
                                onchange="changerCategory(this)">
                                <option value="0" selected hidden>Choisir la Catégorie *</option>
                                @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="md:flex-1 w-full">
                            <label for="" class="text-sm text-text block">Sous catégorie du troc</label>
                            <select required name='subcategory' id="select_category"
                                class="w-[100%] rounded-md border-line text-sm text-titles focus:border-primary-hover focus:ring-primary-hover">
                                <option value="0" selected hidden>Choisir la sous catégorie *</option>
                                @foreach($subcategories as $subcategory)
                                <option value="{{ $subcategory->id }}">{{ $subcategory->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="border-b border-line py-4 mt-4">
                    <h3 class="text-lg font-bold text-titles mb-3">Localisation</h3>
                    <div class="row">
                        <div class="col-md-4 col-12">
                            <div class="flex flex-col  w-full mb-3">
                                <label for="" class="text-sm text-text block">Région</label>
                                <select required name='region' onchange="changerDepartement(this)"
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
                                <select required name='department' id="select_department"
                                    onchange="changerNumDepartement(this)"
                                    class="w-[100%] rounded-md border-line text-sm text-titles focus:border-primary-hover focus:ring-primary-hover">
                                    <option value="0" selected hidden>Choisir un département *</option>
                                    {{-- @foreach($departments as $department)
                                    <option value="{{ $department->id }}">{{ $department->name }}</option>
                                    @endforeach --}}
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4 col-12">
                            <div class="flex flex-col w-full">
                                <label for="" class="text-sm text-text block">N° département</label>
                                <input type="text" required
                                    class="focus:border-primary-color w-full rounded-md border-line text-sm text-titles  focus:ring-primary-hover"
                                    readonly id="num-departement" />
                            </div>
                        </div>
                        <div class="col-4"></div>
                    </div>
                </div>
                <div class="border-b border-line py-4 mt-4">
                    <h3 class="text-lg font-bold text-titles mb-3">Annonce</h3>
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="w-full">
                                <label for="title" class="text-sm text-text block">Titre</label>
                                <input id="title" name="title" placeholder="Titre d’annonce ici" type="text"
                                    class="w-full rounded-md border-line text-sm text-titles focus:border-primary-hover focus:ring-primary-hover"
                                    required autofocus />
                                <x-input-error class="mt-2" :messages="$errors->get('title')" />
                            </div>
                            <div class="py-3">
                                <label for="description" class="text-sm text-text">Description</label>
                                <textarea id="description" name="description" type="text"
                                    class="w-full min-h-[200px] rounded-md border-line text-sm text-titles focus:border-primary-hover focus:ring-primary-hover"
                                    required></textarea>
                                <x-input-error class="mt-2" :messages="$errors->get('description')" />
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="flex flex-col div-image ">
                                <span for="" class="text-sm text-text">
                                    {{ __('Parcourir l\'image par défaut depuis votre machine') }}</span>
                                <div class="flex items-center border-dashed border-2 border-line rounded-md px-3 ">
                                    <label for="default_image" class="cursor-pointer w-full" required>
                                        <input id="default_image" type="file" name="default_image"
                                            class="absolute inset-0 opacity-0 z-10 w-full focus:border-primary-color"
                                            style="width: 0; height: 0;">
                                        <div class="flex items-center justify-center gap-4 text-center w-full">
                                            <img src="/images/IconContainer.svg" alt="" srcset="">
                                            <p class="text-text text-sm mt-3">
                                                {{ __('Parcourir l\'image ') }}</span></p>
                                        </div>
                                    </label>
                                    <!-- Affiche le nom du fichier sélectionné (facultatif) -->
                                    <span id="selectedFileName" class="text-text text-sm mt-2">Aucun fichier
                                        sélectionné</span>
                                </div>
                                <x-input-error :messages="$errors->get('default_image')" class="mt-2" />
                                <span for="" class="text-sm text-text mt-4">
                                    {{ __('Parcourir d\'autres images') }}</span>
                                <div class="flex items-center border-dashed border-2 border-line rounded-md px-3 ">
                                    <label for="additional_images" class="cursor-pointer w-full" required>
                                        <input id="additional_images" type="file" name="additional_images[]" multiple
                                            class="absolute inset-0 opacity-0 z-10 w-full focus:border-primary-color"
                                            style="width: 0; height: 0;" />
                                        <div class="flex items-center justify-center gap-4 text-center w-full">
                                            <img src="/images/IconContainer.svg" alt="" srcset="">
                                            <p class="text-text text-sm mt-3">{{ __('Parcourir l\'image ') }}</p>
                                        </div>
                                    </label>
                                    <!-- Affiche le nom du fichier sélectionné (facultatif) -->
                                    <span id="selectedFileNameMultiple" class="text-text text-sm mt-2">Aucun fichier
                                        sélectionné</span>
                                </div>
                                <x-input-error :messages="$errors->get('additional_images')" class="mt-2" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex justify-end gap-2">
                    <button
                        class="text-white rounded-md w-48 h-12 flex justify-center items-center bg-primary-color hover:bg-primary-hover"
                        type="submit">
                        {{ __('Créer l\'annonce') }}
                    </button>
                    <button class="text-white rounded-md w-48 h-12 flex justify-center items-center bg-gray-900  hover:bg-black">
                        <a class="no-underline font-medium text-white " href="{{route('myaccount.offers')}}">Annuler</a>
                    </button>
                </div>
            </form>
        </div>
    </div>

</x-app-layout>
<script>
    const conditionDropdownElement = document.getElementById('condition-dropdown')
    const yearsOfExperienceDropdownElement = document.getElementById('experience-dropdown')

    const experienceOrLevel = (selectedValue) => {
        const hasCondition = [2,3,5, "2","3","5"]
        const hasExprience = 7
        if(hasCondition.includes(selectedValue)){
            // if bien, don, ... => show condition dropdown
            conditionDropdownElement.style.display = "inline-block"
            yearsOfExperienceDropdownElement.style.display = "none"

        } else if(selectedValue === 7 || selectedValue === "7") {
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

    inputElement.addEventListener("change", function () {
        const selectedFiles = inputElement.files;
        if (selectedFiles.length > 0) {
        spanElement.textContent = selectedFiles.length + " fichier(s) sélectionné(s)";
        } else {
        spanElement.textContent = "Aucun fichier sélectionné";
        }
    });

    const inputElement1 = document.getElementById("additional_images");
    const spanElement1 = document.getElementById("selectedFileNameMultiple");

    inputElement1.addEventListener("change", function () {
        const selectedFiles = inputElement1.files;
        if (selectedFiles.length > 0) {
        spanElement1.textContent = selectedFiles.length + " fichier(s) sélectionné(s)";
        } else {
        spanElement1.textContent = "Aucun fichier sélectionné";
        }
    });
    const additional_images = document.getElementById("additional_images");
    const spanElementMultiple = document.getElementById("selectedFileNameMultiple");
    additional_images.addEventListener("change", function () {
    const selectedFilesMultiple = additional_images.files;
    if (selectedFilesMultiple.length > 0) {
    spanElementMultiple.textContent = selectedFilesMultiple.length + " fichier(s) sélectionné(s)";
    } else {
    spanElementMultiple.textContent = "Aucun fichier sélectionné";
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
        option.value = item.id; // Use item.id instead of item.parent_id
        option.innerHTML = item.name;
        selectCategory.append(option);
    });
};

    

const changerDepartement = (e) => {
    const departments = @json($departments);
    console.log(e.value);
    const departmentOptions = departments.filter(item => item.region_id == e.value);
    const selectDepartment = document.getElementById('select_department');

    // Clear existing options
    while (selectDepartment.options.length > 1) {
        selectDepartment.remove(1);
    }

    // Add new options
    departmentOptions.forEach(item => {
        const option = document.createElement("option");
        option.value = item.id; // Use item.id instead of item.region_id
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




</script>
