<x-app-layout>
    <x-slot name="header">
        <h3 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Déposer une offre') }}
        </h3>
    </x-slot>


    <section class="w-[80%] mx-auto">
        <header>
            <h1 class="text-xl font-bold text-gray-900 my-8">
                {{ __('Add new offer') }}
            </h1>
        </header>
        <form method="POST" action="{{ route('offer.store') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
            @csrf
            @method('POST')

            <div class="flex gap-8  border-b pb-6 ">
                <div class="">
                    <label for="">Type</label>
                    <select required name='type_id' class="">
                        <option value="">Choisir le type de troc *</option>
                        @foreach($type as $type)
                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="">
                    <label for="">Expérience du service</label>
                    <select required name='' class="w-[100%] s">
                        <option value="0">Choisir l’expérience *</option>
                        {{-- @foreach($type as $type) --}}
                        <option value="
                        {{--  {{ $type->id }}  --}}
                        ">
                            test
                            {{-- {{ $type->name }} --}}
                        </option>
                        {{-- @endforeach --}}
                    </select>
                </div>
                <div>
                    <label for="">Catégorie du troc</label>
                    <select required name='category_id' class="w-[100%]">
                        <option value="0">Choisir la Catégorie *</option>
                        @foreach($category as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="">Sous catégorie du troc</label>
                    <select required name='' class="">
                        <option value="0">Choisir la sous catégorie *</option>
                        {{-- @foreach($category as $category) --}}
                        <option {{-- value="{{ $category->id }}" --}}>
                            {{-- {{ $category->name }} --}}
                        </option>
                        {{-- @endforeach --}}
                    </select>
                </div>

            </div>

            <h3 class="text-lg font-bold text-gray-900 mb-10">Localisation</h3>
            <div class="flex gap-8  border-b  pb-6">
                <div class="flex flex-col">
                    <label for="">Région</label>
                    <select required name='region_id'>
                        <option value="">Choisir une région *</option>
                        @foreach($region as $region)
                        <option value="{{ $region->id }}">{{ $region->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex flex-col">
                    <label for="">Département</label>
                    <select required name='department_id'>
                        <option value="0">Choisir un département *</option>
                        @foreach($department as $department)
                        <option value="{{ $department->id }}">{{ $department->name }}</option>
                        @endforeach
                    </select>

                </div>
                <div class="flex flex-col">
                    <label for="">N° département</label>
                    <x-text-input type="number" required class="border-focus"/>
                </div>
            </div>
            <h3 class="text-lg font-bold text-gray-900 mb-10">Annonce</h3>
            <div class="border-b pb-6">
                <div class="flex gap-4">
                    <div class="flex flex-col w-[60%]">
                        <label for="">Titre</label>
                        <x-text-input id="name" name="name" placeholder="Titre d’annonce ici" type="text"
                            class="mt-1  w-full border-focus" required autofocus />
                        <x-input-error class="mt-2" :messages="$errors->get('name')" />
                    </div>
                    <div class="flex flex-col w-[50%]">
                        <label for="">Upload default image</label>
                        <div class="flex items-center border-dashed border-2 border-gray-300 rounded-md px-3 ">
                            <label for="offer_default_photo" class="cursor-pointer w-full" required>
                                <input id="offer_default_photo" type="file" name="offer_default_photo"
                                    class="absolute inset-0 opacity-0 z-10 w-full border-focus"
                                    style="width: 0; height: 0;">
                                <div class="flex items-center justify-center gap-4 text-center w-full">
                                    <img src="/images/IconContainer.svg" alt="" srcset="">
                                    <p class="text-gray-600 mt-3">Photo de profil</p>
                                </div>
                            </label>
                            <!-- Affiche le nom du fichier sélectionné (facultatif) -->
                            <span id="selectedFileName" class="text-gray-600 mt-2">Aucun fichier sélectionné</span>
                            <x-input-error :messages="$errors->get('offer_default_photo')" class="mt-2" />
                        </div>
                    </div>
                </div>
                <div class="w-[53%] py-3">
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
    const fileInput = document.getElementById('offer_default_photo');
    const selectedFileName = document.getElementById('selectedFileName');

    fileInput.addEventListener('change', (event) => {
    selectedFileName.textContent = event.target.files[0] ? event.target.files[0].name : 'Aucun fichier sélectionné';
    });
</script>
