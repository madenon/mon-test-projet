<x-app-layout>
<div class="container">
    <h2>{{$title->name }} Page</h2>
</div>
<div class="container">
    <div class="row">
        @if(count($offers) > 0)
            <div class="col-3 col-md-3">
                Filters part
            </div>
            <div class="col-12 col-md-9">
                @foreach ($offers as $offer)
                <div class="offer_list_card">
                    <div class="offer_image relative">
                        <img src="{{ route('offer-pictures-file-path',$offer->offer_default_photo) }}" alt=""
                            class="object-cover h-full w-full rounded-tl-lg rounded-bl-lg " />
                    </div>
                    <div class="offer_details ml-8 mt-4">
                        <div class="">
                            <a href="{{route('offer.offer', [$offer, urlencode($offer->slug)])}}" class="no-underline">
                                <h1 class="text-titles text-2xl">
                                    {{ Str::limit($offer->title, 35) }}</h1>
                            </a>
                        </div>
                        <div class="flex gap-2 items-center  ">
                            <img src="/images/Stack.svg" alt="" class="">
                            {{$offer->subcategory->parent->name}}
                            <img src="/images/chevron-right.svg" alt="" class="">
                            <img src="/images/Stack.svg" alt="" class="">
                            {{$subcategory->name}}
                        </div>
                        <div class=" text-titles text-xs mt-3">
                            <h6 class=" font-normal ">A ECHANGER CONTRE</h6>
                            <span class=" ml-5 flex items-center gap-1">
                                <div class="w-2 h-2 bg-black rounded-full"></div>
                                Etudie toute preposition
                            </span>
                        </div>
                        <div class=" mt-3 flex w-full mb-3">
                            <div class=" w-[40%] flex gap-2 items-center">
                                <img src="/images/map-pin.svg" alt="">
                                <span class="">
                                    {{$offer->department->region->name . ", " .
                                    $offer->department->name}}
                                </span>
                            </div>
                            <div class="  w-[60%] text-end">
                                @if (!$offer->price)
                                <span class="text-titles mr-5  text-2xl font-semibold">
                                    {{$offer->type->name}}
                                </span>
                                @else
                                <div class="flex items-center justify-end gap-2  ">
                                    <span class="flex bg-red-100  rounded-full px-3 py-1 gap-2 text-red-500">
                                        <span class="bg-red-500 px-2 rounded-full text-white">$</span>
                                        <span>Vente autorisé</span>
                                    </span>
                                    <span class="text-titles text-2xl font-semibold">
                                        {{$offer->price}} €
                                    </span>
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class=" pb-12 mt-2" >
                            <div class="flex gap-2 pr-3 ">
                                <div class="w-1/4">
                                <span class="flex text-center justify-center">Jours</span>
                                <div
                                    class="flex items-center justify-center rounded-lg bg-primary-hover w-full h-full text-white text-3xl font-bold">
                                    00
                                </div>
                            </div>
                                <div class="w-1/4">
                                    <span class="flex text-center justify-center">Heurs</span>
                                    <div
                                    class="flex items-center justify-center rounded-lg bg-primary-hover w-full h-full text-white text-3xl font-bold">
                                    00
                                </div>
                                </div>
                                <div class="w-1/4">
                                    <span class="flex text-center justify-center">Minutes</span>
                                    <div
                                    class="flex items-center justify-center rounded-lg bg-primary-hover w-full h-full text-white text-3xl font-bold">
                                    00
                                </div>
                                </div>
                                <div class="w-1/4">
                                    <span class="flex text-center justify-center">Secs</span>
                                    <div
                                    class="flex items-center justify-center rounded-lg bg-primary-hover w-full h-full text-white text-3xl font-bold">
                                    00
                                </div>
                                </div>
                            </div>
                        </div>
                        <div class="offer_owner mb-3" >
                            <div class="flex gap-3 ">
                                @if (!$offer->user->profile_photo_path)
                            <img src="/images/user-avatar-icon.svg" alt="Avatar">
                            @else
                            <img class="w-12 h-12 rounded-full" src="{{ route('profile_pictures-file-path',$offer->user->profile_photo_path) }}" alt=""
                                class="rounded-full">
                            @endif
                                <span class="flex flex-col">
                                    <span class="text-titles font-medium">
                                        {{$offer->user->name}}
                                    </span>
                                    @if ($offer->user->is_online=="Offline")
                                    <span class="text-red-500">Hors ligne</span>
                                    @else
                                    <span class="text-green-500">En ligne</span>
                                    @endif
                                </span>
                                <img src="/images/Badge-pro.svg" alt="" class="pb-3 ">
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        @else
            <p>Il n y a aucune annonce dans la catégorie {{$title->name }}.</p>
        @endif
    </div>
    {{ $offers->links() }}
</div>
<div id="footer-create-add-button" >
                <a class="" href="{{ route('offer.create') }}">
                    <div class="footer-create-add-button-img">
                        <img src="{{ asset('images/plus-icon-white.svg') }}" alt="" />
                    </div>
                    <span class="footer-create-add-button-span">
                        Déposer
                        une annonce
                    </span>
                </a>
            </div>
</x-app-layout>