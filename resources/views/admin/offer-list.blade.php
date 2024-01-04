@extends('admin.index')

@section('admin-content')

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mon Espace') }}
        </h2>
    </x-slot>
    
    <h1>Offres</h1>
    <form action="{{ route('admin.offers') }}" method="GET">
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Recherche :</label>
            <input type="text" name="search" value="{{ request('search') }}" class="mt-1 p-2 border rounded-md">
            
            <!-- Utilisez une icône (par exemple, de FontAwesome ou une autre bibliothèque d'icônes) comme lien pour soumettre le formulaire -->
            <button type="submit" class="ml-2 text-blue-500 hover:text-blue-700">
                <!-- Remplacez le contenu à l'intérieur de la balise span par votre icône de recherche préférée -->
                <i class="fa fa-search" aria-hidden="true"></i>
            </button>
        </div>
        <div class="flex space-x-4 ">
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Filtrer par :</label>

            <!-- Catégorie/Sous-catégorie -->
            <select name="category" class="mt-1 p-2 border rounded-md" onchange="this.form.submit()">
                <option value="">Toutes les catégories</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>

            <!-- Type -->
            <select name="type" class="mt-1 p-2 border rounded-md" style="width: 150px;" onchange="this.form.submit()">
                <option value="">Tous les types</option>
                @foreach ($types as $type)
                    <option value="{{ $type->id }}" {{ request('type') == $type->id ? 'selected' : '' }}>
                        {{ $type->name }}
                    </option>
                @endforeach
            </select>

            <!-- Région/Département (En supposant que cela soit lié aux offres) -->
            <select name="region" class="mt-1 p-2 border rounded-md" style="width: 180px;" onchange="this.form.submit()">
                <option value="">Toutes les régions</option>
                @foreach ($regions as $region)
                    <option value="{{ $region->id }}" {{ request('region') == $region->id ? 'selected' : '' }}>
                        {{ $region->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mt-8">
                {{count($offers)}} items
            </div> </div>
    </form>

    <div class="container">
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            @if(count($offers) > 0 && !$offers->every('deleted_at'))
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Nom de l'annonce
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Image
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Date de création
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Type
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Catégorie
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Prix
                            </th>
                            <th scope="col" class="px-6 py-3 text-center">
                                Action
                            </th>
                        </tr>
                    </thead>
                    @foreach ($offers as $offer)
                        <tbody>
                            <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white flex gap-2">
                                    {{$offer->title}}
                                    @if($offer->active_offer)
                                        <form method="post" action="{{route('myaccount.deactivate', $offer)}}">
                                            @csrf
                                            @method('POST')
                                            <button class="text-white rounded-full h-8 w-8 bg-red-700 hover:bg-red-800" type="submit">P</button>
                                        </form>
                                    @else
                                        <form method="post" action="{{route('myaccount.activate', $offer)}}">
                                            @csrf
                                            @method('POST')
                                            <button class="text-white rounded-full h-8 w-8 bg-primary-color hover:bg-primary-hover" type="submit">M</button>
                                        </form>
                                    @endif
                                </th>
                                <td class="px-6 py-4">
                                    <img class="h-16 w-16 rounded-full" src="{{ route('offer-pictures-file-path',$offer->offer_default_photo) }}" alt="Annonce Image">
                                </td>
                                <td class="px-6 py-4">
                                    @if (!$offer->updated_at)
                                        {{$offer->created_at}}
                                    @else
                                        {{$offer->updated_at}}
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    {{$offer->type->name}}
                                </td>
                                <td class="px-6 py-4">
                                    {{$offer->subcategory->parent->name}}
                                </td>
                                <td class="px-6 py-4">
                                    {{$offer->price}}
                                </td>
                                <td class="flex gap-1 px-6 py-4">
                                    <button class=" bg-blue-700 hover:bg-blue-800 text-white font-bold h-12 w-24 rounded-full"><a class="no-underline font-medium text-white " href="{{route('offer.offer', [$offer->id, $offer->slug])}}">Voir l'offre</a></button>
                                    <button class="bg-green-700 hover:bg-green-800 text-white font-bold h-12 w-20 rounded-full"><a class="no-underline font-medium text-white" href="{{route('myaccount.editOffer', [$offer->id])}}">Modifier</a></button>
                                    <form class="" action="{{route('myaccount.deleteOffer', [$offer->id])}}" method="post">
                                        @method('DELETE')
                                        @csrf
                                        <button class="bg-red-700 hover:bg-red-800 text-white font-bold h-12 w-24 rounded-full">Supprimer l'offre</button>
                                    </form>
                                </td>
                            </tr>
                        </tbody>
                    @endforeach
                </table>
            @else
                <p>Vous n'avez aucune annonce.</p>
            @endif
        </div>
        <div class="py-4">
            {{ $offers->appends(request()->query())->links() }}
        </div>
    </div>

@endsection

