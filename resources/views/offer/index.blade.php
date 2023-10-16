<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Index') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>

    
    
    
    <h1>Offres</h1>
    <div class="container">
        <nav style="--bs-breadcrumb-divider: '>'" aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item active" aria-current="page">{{ Breadcrumbs::render('offers') }}</li>
            </ol>
        </nav>
        <div class="row">
          <div class="col-3 col-xl-3">
            Filters part
          </div>

          <div class="col-12 col-xl-9">

            
            @foreach ($offers as $offer)
            
              
            
            <div class="offer_list_card">
                <div class="offer_image" style="background-image:url('{{ asset("{$offer->offer_default_photo}") }}')"></div>
                <div class="offer_details">
                    
                    <div class="offer_title">
                        <a href="{{route('offer.offer', [$offer, urlencode($offer->slug)])}}"><h2>{{$offer->name}}</h2></a>
                    </div>

                    <div class="offer_category">
                        <div class="offer_category_item">
                            <img src="images/category-8.svg" alt="Category"/>
                            <p>{{$offer->category->name}}</p>
                        </div>
                        <div class="offer_category_item">
                            <img width="18" height="18" src="images/category-8.svg" alt="Category"/>
                            <p>Subcategory</p>
                        </div>
                    </div>

                    <div class="offer_preposition">
                        <h4>A ECHANGER CONTRE</h4>
                        <p>Etudie toute preposition</p>
                    </div>

                    <div class="offer_localisation_price">
                        <div class="offer_localisation">
                            <img width="18" height="18" src="images/location-21.svg" alt="Localisation"/>
                            <p>{{$offer->region->name . ", " . $offer->department->name}}</p>
                        </div>

                        <div class="offer_price">

                            @if (!$offer->price)
                            <h2>{{$offer->type->name }}</h2>
                            @else
                                <div class="offer_autorisation">
                                    <img width="18" height="18" src="images/euro-46.svg" alt="Buy-autorisation"/>
                                    <p>Vente autorisé</p>
                                </div>
                                <h2>{{$offer->price . "€" }}</h2>
                            @endif
                            
                        </div>
                    </div>

                    <div class="offer_countdown" style="display: none;">
                        <div class="offer_countdown_container">
                            <div class="offer_countdown_containers">
                                <span>Jours</span>
                                <div class="offer_countdown_containers_counter">
                                    00
                                </div>
                            </div>
                            <div class="offer_countdown_containers">
                                <span>Heurs</span>
                                <div class="offer_countdown_containers_counter">
                                    00
                                </div>
                            </div>
                            <div class="offer_countdown_containers">
                                <span>Minutes</span>
                                <div class="offer_countdown_containers_counter">
                                    00
                                </div>
                            </div>
                            <div class="offer_countdown_containers">
                                <span>Secs</span>
                                <div class="offer_countdown_containers_counter">
                                    00
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="offer_owner">
                        <div class="offer_owner_content">
                            <div class="offer_owner_content_avatar">

                                @if (!$offer->user->profile_photo_path)
                                <img src="images/user-avatar-icon.svg" alt="Avatar">
                                @else
                                <img src="{{ asset($offer->user->profile_photo_path) }}" alt="Profile photo">
                                @endif
                            
                            </div>
                            <div class="offer_owner_content_infos">
                                <div class="offer_owner_content_infos_name">
                                    <h3>{{$offer->user->first_name . " " . $offer->user->last_name}}</h3>
                                    <div class="offer_owner_content_infos_pro_badge">
                                        <img width="94" height="94" src="images/star-circle-blue.svg" alt="Pro"/>
                                        <p>Pro</p>
                                    </div>
                                </div>
                                
                                    <div class="offer_owner_content_infos_status
                                        @if ($onlineStatus == 'Online')
                                            text-green-500
                                        @else
                                            text-red-500
                                        @endif">
                                        {{$offer->user->is_online}}</div>
                                    </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
          </div>
         
        </div>
      </div>
      {{ $offers->links() }}
</x-app-layout>


