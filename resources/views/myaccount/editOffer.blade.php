<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Offer') }}
        </h2>
    </x-slot>

    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900">
                {{ __('Modifier une annonce') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                {{ __("Mettre à jours les informations pour poster une annonce.") }}
            </p>
        </header>
        <form method="POST" action="{{ route('myaccount.editOffer', ['offerId' => $offer->id]) }}" class="mt-6 space-y-6" enctype="multipart/form-data">
            @csrf
            @method('POST')

            <div>
                <select name='type_id'>
                    @foreach($types as $type)
                        <option value="{{ $type->id }}" {{ $type->id == $offer->type_id ? 'selected' : '' }}>{{ $type->name}} </option>
                    @endforeach
                </select>
            </div> 


            <div>
                <select name='category_id'>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <select name='region_id'>
                    @foreach($regions as $region)
                        <option value="{{ $region->id }}">{{ $region->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <select name='department_id'>
                    @foreach($departments as $department)
                        <option value="{{ $department->id }}">{{ $department->name }}</option>
                    @endforeach
                </select>
            </div>
            
                
            
            

        
        <div>
            <x-input-label for="name" :value="__('Nom de l\'annonce')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" required autofocus />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="description" :value="__('Description')" />
            <x-text-input id="description" name="description" type="text" class="mt-1 block w-full" required />
            <x-input-error class="mt-2" :messages="$errors->get('description')" />
        </div>

        <div>
            <x-input-label for="price" :value="__('Prix')" />
            <x-text-input id="price" name="price" type="text" class="mt-1 block w-full"/>
            <x-input-error class="mt-2" :messages="$errors->get('price')" />
        </div>

        <div>
            <x-input-label for="perimeter" :value="__('Perimetere')" />
            <x-text-input id="perimeter" name="perimeter" type="text" class="mt-1 block w-full" required />
            <x-input-error class="mt-2" :messages="$errors->get('perimeter')" />
        </div>

        <div
                    class="flex items-center w-full relative border-dashed border-2 border-gray-300 rounded-md px-3 py-2">
                    <label for="offer_default_photo" class="cursor-pointer w-full">
                        <input id="offer_default_photo" type="file" name="offer_default_photo"
                            class="absolute inset-0 opacity-0 z-10 w-full border-focus" style="width: 0; height: 0;">
                        <div class="flex items-center justify-center gap-4 text-center w-full">
                            <img src="" alt="" srcset="">
                            <p class="text-gray-600 mt-2">Photo de profil</p>
                        </div>
                    </label>

                    <!-- Affiche le nom du fichier sélectionné (facultatif) -->
                    <span id="selectedFileName" class="text-gray-600 mt-2">Aucun fichier sélectionné</span>
                    <x-input-error :messages="$errors->get('offer_default_photo')" class="mt-2" />
                </div>

        {{-- <div>
            <input type="file" name="offer_photo" multiple>
            <img src="" alt="">
        </div> --}}

    



            <div class="flex items-center gap-4">
                <x-primary-button>{{ __('Créer') }}</x-primary-button>
            </div>
        </form>
    </section>

</x-app-layout>