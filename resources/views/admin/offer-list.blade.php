@extends('admin.template')

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
        @if(count($offers) > 0)
            <table class="w-full text-xs text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-2 py-2">Nom</th>
                        <th scope="col" class="px-2 py-2">Image</th>
                        <th scope="col" class="px-2 py-2">Création</th>
                        <th scope="col" class="px-2 py-2">Type</th>
                        <th scope="col" class="px-2 py-2">Catégorie</th>
                        <th scope="col" class="px-2 py-2">Prix</th>
                        <th scope="col" class="px-2 py-2">Validation</th>
                        <th scope="col" class="px-2 py-2 text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($offers as $offer)
                    <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                        <td class="px-2 py-2 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                            {{$offer->title}}
                        </td>
                        <td class="px-2 py-2">
                            <img class="h-10 w-10 rounded-full" src="{{ route('offer-pictures-file-path',$offer->offer_default_photo) }}" alt="Annonce Image">
                        </td>
                        <td class="px-2 py-2">
                            {{ $offer->created_at ? $offer->created_at->format('d-m-Y') : 'N/A' }}
                        </td>
                        <td class="px-2 py-2">
                            {{$offer->type->name}}
                        </td>
                        <td class="px-2 py-2">
                            {{$offer->subcategory->parent->name}}
                        </td>
                        <td class="px-2 py-2">
                            {{$offer->price}}
                        </td>
                        <td class="px-2 py-2 text-center">
                            <form action="{{ $offer->deleted_at ? route('admin.restoreOffer', $offer->id) : route('admin.deleteOffer', $offer->id) }}" method="post" class="inline">
                                @csrf
                                @if($offer->deleted_at)
                                    @method('POST')
                                    <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-2 py-1 rounded text-xs">Non</button>
                                @else
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-2 py-1 rounded text-xs">Oui</button>
                                @endif
                            </form>
                        </td>
                        <td class="px-2 py-2 text-center">
                            <div class="flex items-center justify-center space-x-1">
                                <a href="{{ route('admin.showOffer', [$offer->id, $offer->slug]) }}" class="bg-blue-600 hover:bg-blue-700 text-white px-2 py-1 rounded text-xs">Voir</a>
                                <a href="{{ route('admin.editOffer', [$offer->id]) }}" class="bg-green-600 hover:bg-green-700 text-white px-2 py-1 rounded text-xs">Modifier</a>
                              <!--  <form action="{{ route('admin.deleteOffer', [$offer->id]) }}" method="post" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-2 py-1 rounded text-xs">Supprimer</button>
                                </form>-->
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
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

