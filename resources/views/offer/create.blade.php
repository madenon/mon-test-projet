<x-app-layout>
    <x-slot name="header">
        <h3 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Déposer une offre') }}
        </h3>
    </x-slot>


    <section class="w-[80%] mx-auto add-offre-section">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form method="POST" action="{{ route('offer.store') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
            @csrf
            @method('POST')

            <div class="flex gap-8  border-b pb-6 add-offre">
                <div class="add-offer-select">
                    <label for="">Type</label>
                    <select required name='type' class="" id="type-dropdown">
                        <option value="0" selected hidden>Choisir le type de troc *</option>
                        @foreach($types as $type)
                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="add-offer-select hidden" id="experience-dropdown">
                    <label for="">Expérience du service</label>
                    <select name='experience' class="w-[100%] service-div">
                        <option value="0" selected>Choisir l’expérience</option>

                        @foreach ($experienceLevels as $key => $value)
                        <option value="{{ $value }}">{{ $key }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="add-offer-select hidden" id="condition-dropdown">
                    <label for="">Etat</label>
                    <select name='condition' class="w-[100%] service-div">
                        <option value="0" selected>Choisir l'état</option>

                        @foreach ($conditions as $key => $value)
                        <option value="{{ $value }}">{{ $key }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="add-offer-select">
                    <label for="">Catégorie du troc</label>
                    <select required name='category' class="w-[100%] service-div" onchange="changerCategory(this)">
                        <option value="0" selected hidden>Choisir la Catégorie *</option>
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="add-offer-select">
                    <label for="">Sous catégorie du troc</label>
                    <select required name='subcategory' id="select_category">
                        <option value="0" selected hidden>Choisir la sous catégorie *</option>
                        @foreach($subcategories as $subcategory)
                        <option value="{{ $subcategory->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

            </div>

            <h3 class="text-lg font-bold text-gray-900 mb-10">Localisation</h3>
            <div class="flex gap-8 border-b pb-6 add-offre-location">
                <div class="flex flex-col add-offer-select">
                    <label for="">Région</label>
                    <select required name='region' onchange="changerDepartement(this)">
                        <option value="" selected hidden>Choisir une région *</option>
                        @foreach($regions as $region)
                        <option value="{{ $region->id }}">{{ $region->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex flex-col add-offer-select">
                    <label for="">Département</label>
                    <select required name='department' id="select_department" onchange="changerNumDepartement(this)">
                        <option value="0" selected hidden>Choisir un département *</option>
                        {{-- @foreach($departments as $department)
                        <option value="{{ $department->id }}">{{ $department->name }}</option>
                        @endforeach --}}
                    </select>
                </div>
                <div class="flex flex-col add-offer-select">
                    <label for="">N° département</label>
                    <x-text-input type="text" required class="border-focus" readonly id="num-departement" />
                </div>
            </div>
            <h3 class="text-lg font-bold text-gray-900 mb-10">Annonce</h3>
            <div class="border-b pb-6 add-offre-annonce">
                <div class="flex gap-4 add-offre-image">
                    <div class="flex flex-col w-[60%] input-div-nom">
                        <label for="">Titre</label>
                        <x-text-input id="title" name="title" placeholder="Titre d’annonce ici" type="text"
                            class="mt-1  w-full border-focus" required autofocus />
                        <x-input-error class="mt-2" :messages="$errors->get('title')" />
                    </div>
                    <div class="flex flex-col w-[50%] div-image ">
                        <label for="">Parcourir l'image par défaut depuis votre machine</label>
                        <div class="flex items-center border-dashed border-2 border-gray-300 rounded-md px-3 ">
                            <label for="offer_default_photo" class="cursor-pointer w-full" required>
                                <input 
                                    id="offer_default_photo" 
                                    type="file" 
                                    name="default_image"
                                    class="absolute inset-0 opacity-0 z-10 w-full border-focus"
                                    style="width: 0; height: 0;">
                                <div class="flex items-center justify-center gap-4 text-center w-full">
                                    <img src="/images/IconContainer.svg" alt="" srcset="">
                                    <p class="text-gray-600 mt-3">Photo de profil</p>
                                </div>
                            </label>
                            <!-- Affiche le nom du fichier sélectionné (facultatif) -->
                            <span id="selectedFileName" class="text-gray-600 mt-2">Aucun fichier sélectionné</span>
                        </div>
                        <x-input-error :messages="$errors->get('offer_photo')" class="mt-2" />

                        <label for="">Parcourir d'autres images</label>
                        <div class="flex items-center border-dashed border-2 border-gray-300 rounded-md px-3 ">
                            <label for="offer_default_photo" class="cursor-pointer w-full" required>
                                <input 
                                    id="offer_default_photo" 
                                    type="file" 
                                    name="additional_images[]" multiple
                                    class="absolute inset-0 opacity-0 z-10 w-full border-focus"
                                    style="width: 0; height: 0;" />
                                <div class="flex items-center justify-center gap-4 text-center w-full">
                                    <img src="/images/IconContainer.svg" alt="" srcset="">
                                    <p class="text-gray-600 mt-3"></p>
                                </div>
                            </label>
                            <!-- Affiche le nom du fichier sélectionné (facultatif) -->
                            <span id="selectedFileName" class="text-gray-600 mt-2">Aucun fichier sélectionné</span>
                        </div>
                        <x-input-error :messages="$errors->get('offer_photo')" class="mt-2" />
                    </div>
                </div>
                <div class="w-[53%] py-3 input-div">
                    <x-input-label for="description" :value="__('Description')" />
                    <textarea id="description" name="description" type="text" class="border-focus mt-1 block w-full"
                        required></textarea>
                    <x-input-error class="mt-2" :messages="$errors->get('description')" />
                </div>
            </div>


            <div class="flex justify-end gap-4 ">
                <button class="btn-add-offre text-white p-2 rounded-md px-4 " type="submit">{{ __('Créer l\'annonce')
                    }}</button>

            </div>
        </form>
    </section>

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


    const inputElement = document.getElementById("offer_default_photo");
    const spanElement = document.getElementById("selectedFileName");

    inputElement.addEventListener("change", function () {
        const selectedFiles = inputElement.files;
        if (selectedFiles.length > 0) {
        spanElement.textContent = selectedFiles.length + " fichier(s) sélectionné(s)";
        } else {
        spanElement.textContent = "Aucun fichier sélectionné";
        }
    });

    const changerCategory=(e)=>{
        const subcategories= @json($subcategories);
        const subcategory= subcategories.filter(item=>item.parent_id==e.value);
        const select_category=document.getElementById('select_category');
        while (select_category.options.length > 1) {
            select_category.remove(1);
        }
        subcategory.map((item)=>{
                const option=document.createElement("option");
                option.setAttribute("value",item.parent_id);
                option.innerHTML=item.name;
                select_category.append(option);
        });
    }

    const changerDepartement=(e)=>{
        const departments=@json($departments);
        console.log(e.value);
        const department=departments.filter(item=>item.region_id==e.value);
        const select_department=document.getElementById('select_department');
        while (select_department.options.length > 1) {
            select_department.remove(1);
        }
        department.map((item)=>{
            const option=document.createElement("option");
            option.setAttribute("value",item.region_id);
            option.innerHTML=item.name;
            select_department.append(option);
        });
    }
    const changerNumDepartement=(e)=>{
        const departmentsList=@json($departments);
        console.log(departmentsList)
        const numDepartment=document.getElementById('num-departement');
        const department= departmentsList.find(item=>item.id==e.value)
        console.log(e.value)
        console.log(department)
        numDepartment.value= department.department_number
    }


</script>
