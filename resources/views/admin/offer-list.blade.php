@extends('admin.index')

@section('admin-content')

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Space') }}
        </h2>
    </x-slot>
    
    <h1>My Offers Space</h1>

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
                                catégorie
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
                            {{$offer->category->name}}
                        </td>
                        <td class="px-6 py-4">
                            {{$offer->price}}
                        </td>
                        <td class="flex gap-1 px-6 py-4">
                            <button class=" bg-blue-700 hover:bg-blue-800 text-white font-bold h-12 w-24 rounded-full"><a class="no-underline font-medium text-white " href="{{route('offer.offer', [$offer->id, $offer->slug])}}">Voir offre</a></button>
                            <button class="bg-green-700 hover:bg-green-800 text-white font-bold h-12 w-20 rounded-full"><a class="no-underline font-medium text-white" href="{{route('myaccount.editOffer', [$offer->id])}}">Modifier</a></button>
                            <form class="" action="{{route('myaccount.deleteOffer', [$offer->id])}}" method="post">
                                @method('DELETE')
                                @csrf
                                <button class="bg-red-700 hover:bg-red-800 text-white font-bold h-12 w-24 rounded-full">Supprimer offre</button>
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
