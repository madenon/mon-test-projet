<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Offer') }}
        </h2>
    </x-slot>

    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900">
                {{ __('Ajouter une annonce') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                {{ __("Remplir les informations pour poster une annonce.") }}
            </p>
        </header>
        <form method="POST" action="{{ route('offer.store') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
            @csrf
            @method('POST')

            <div>
                <select name='type_id'>
                    @foreach($type as $type)
                
                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                    @endforeach
                </select>
            </div> 


            <div>
                <select name='category_id'>
                    @foreach($category as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <select name='region_id'>
                    @foreach($region as $region)
                        <option value="{{ $region->id }}">{{ $region->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <select name='department_id'>
                    @foreach($department as $department)
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

            <div class="row mb-3">
                <input type="file" name="offer_default_photo">
                <img src="" name="offer_default_photo" alt="" />
            </div>

            <div>
                <input type="file" name="offer_photo" multiple>
                <img src="" alt="">
            </div>

        
            <div class="flex items-center gap-4">
                <x-primary-button>{{ __('Créer') }}</x-primary-button>
            </div>
        </form>
    </section>

</x-app-layout>