<x-app-layout>
    <x-slot name="header">
        <h3 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Déposer une offre') }}
        </h3>
    </x-slot>


    <section class="w-[80%] mx-auto add-offre-section">
        <header>
            <h1 class="text-xl font-bold text-gray-900 my-8">
                {{ __('Add new offer') }}
            </h1>
        </header>
        <form method="POST" action="{{ route('offer.store') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
            @csrf
            @method('POST')

            <div class="flex gap-8  border-b pb-6 add-offre">
                <div class="add-offer-select">
                    <label for="">Type</label>
                    <select required name='type_id' class="">
                        <option value="" selected hidden>Choisir le type de troc *</option>
                        @foreach($type as $type)
                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="add-offer-select">
                    <label for="">Expérience du service</label>
                    <select required name='experience_level' class="w-[100%] service-div">
                        <option value="0" selected hidden>Choisir l’expérience *</option>

                        @foreach ($experienceLevels as $key => $value)
                        <option value="{{ $value }}">{{ $key }}</option>
                        @endforeach
                    </select>

                </div>
                <div class="add-offer-select">
                    <label for="">Catégorie du troc</label>
                    <select required name='' class="w-[100%] service-div" onchange="changerCategory(this)">
                        <option value="0" selected hidden>Choisir la Catégorie *</option>
                        @foreach($category as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="add-offer-select">
                    <label for="">Sous catégorie du troc</label>
                    <select required name='category_id' id="select_categorie">
                        <option value="0" selected hidden>Choisir la sous catégorie *</option>
                    </select>
                </div>

            </div>

            <h3 class="text-lg font-bold text-gray-900 mb-10">Localisation</h3>
            <div class="flex gap-8  border-b pb-6 add-offre-location">
                <div class="flex flex-col add-offer-select">
                    <label for="">Région</label>
                    <select required name='region_id' onchange="changerDepartement(this)">
                        <option value="" selected hidden>Choisir une région *</option>
                        @foreach($region as $region)
                        <option value="{{ $region->id }}">{{ $region->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex flex-col add-offer-select">
                    <label for="">Département</label>
                    <select required name='department_id' id="select_department" onchange="changerNumDepartement(this)">
                        <option value="0" selected hidden>Choisir un département *</option>
                        {{-- @foreach($department as $department)
                        <option value="{{ $department->id }}">{{ $department->name }}</option>
                        @endforeach --}}
                    </select>

                </div>
                <div class="flex flex-col add-offer-select">
                    <label for="">N° département</label>
                    <x-text-input type="text" required class="border-focus" readonly id="numDepartement" />
                </div>
            </div>
            <h3 class="text-lg font-bold text-gray-900 mb-10">Annonce</h3>
            <div class="border-b pb-6 add-offre-annonce">
                <div class="flex gap-4 add-offre-image">
                    <div class="flex flex-col w-[60%] input-div-nom">
                        <label for="">Titre</label>
                        <x-text-input id="name" name="name" placeholder="Titre d’annonce ici" type="text"
                            class="mt-1  w-full border-focus" required autofocus />
                        <x-input-error class="mt-2" :messages="$errors->get('name')" />
                    </div>
                    <div class="flex flex-col w-[50%] div-image ">
                        <label for="">Upload default image</label>
                        <div class="flex items-center border-dashed border-2 border-gray-300 rounded-md px-3 ">
                            <label for="offer_default_photo" class="cursor-pointer w-full" required>
                                <input id="offer_default_photo" type="file" name="offer_photo[]"
                                    class="absolute inset-0 opacity-0 z-10 w-full border-focus"
                                    style="width: 0; height: 0;" multiple>
                                <div class="flex items-center justify-center gap-4 text-center w-full">
                                    <img src="/images/IconContainer.svg" alt="" srcset="">
                                    <p class="text-gray-600 mt-3">Photo de profil</p>
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

        const sous_categorys=@json($sous_category);
        const sous_category=sous_categorys.filter(item=>item.parent_id==e.value);
        const select_categorie=document.getElementById('select_categorie');
        while (select_categorie.options.length > 1) {
            select_categorie.remove(1);
        }
        sous_category.map((item)=>{
                const option=document.createElement("option");
                option.setAttribute("value",item.parent_id);
                option.innerHTML=item.name;
                select_categorie.append(option);
        })
        ;
    }
    const changerDepartement=(e)=>{
    const departments=@json($department);
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
    })
    ;
    }
    const changerNumDepartement=(e)=>{
        const departments=@json($department);
        const numDepartment=document.getElementById('numDepartement');
        const department= departments.find(item=>item.id==e.value)
        numDepartment.value=department.department_number
        }


</script>
