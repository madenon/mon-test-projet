<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Index') }}
        </h2>
    </x-slot>

    {{-- New design --}}

    

    <div class=" w-full">
        <div class="container m-auto">
            <!-- links -->
            <nav style="--bs-breadcrumb-divider: '>'" aria-label="breadcrumb">
                <ol class="breadcrumb bg-slate-400">
                  <li class="breadcrumb-item active" aria-current="page">{{ Breadcrumbs::render('category', $type, $category) }}</li>
                </ol>
            </nav>
            

            <!-- -->
            <div class="">
                <div class="grid-container grid xl:grid-cols-5 grid-cols-2 container">
                    <!-- Left Section -->
                    <div class="col-span-3 p-4 space-y-4  sm:px-12 max-sm:mx-12">
                        <div class="">
                            <img src="{{ asset("{$offer->offer_default_photo}") }}" alt="" srcset="" class="rounded-md">
                        </div>
                        <!-- Description-->
                        <div class="">
                            <h1 class=" mt-16 mb-11 text-2xl color" style="color: var(--titles-color);">Description</h1>
                            <p class="leading-8">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Molestias
                                facere maiores odit eos dolores explicabo optio modi, architecto 
                                dolor quia placeat nulla vitae error est, 
                                ipsa quibusdam voluptatibus in. Impedit!
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nulla, recusandae ut quidem quae pariatur 
                                ipsum eveniet ipsam eos tenetur ratione assumenda mollitia incidunt harum doloremque, quo omnis atque, corrupti sed.</p>
                        </div>
                        <!-- map section-->
                        <div id="map" style="height: 400px; width: 700px; border-radius: 10px;">
                            
                        </div>
                    </div>
                     <!-- Right Section -->
                     <div class="col-span-2 p-2 space-y-11">

                        <h1 class=" xl:text-2xl lg::text-2xl font-semibold text-xl" style="color: var(--titles-color);">{{$offer->name}}</h1>

                        <button class="w-full py-6 rounded-md text-white text-lg font-bold" style="background-color: var(--primary-color); font-size: 30px;"> Troquez Maintenant</button>

                        <!-- border -->
                        <div class="border-[1px] border-gray-300 rounded-md space-y-4">
                            <div class="space-y-2 text-sm p-4">
                                <div class="flex space-x-2">
                                    <p class=" text-gray-500" style=" color:var(--text-color); " >Type de troc :</p>
                                    <p class="font-semibold" style="color: var(--titles-color);">{{$offer->type->name}}</p>
                                </div>
                                <div class="flex space-x-2">
                                    <p class=" text-gray-500" style=" color:var(--text-color); ">Categorie :</p>
                                    <div class="">
                                        <ul class="flex">
                                            <li>
                                                <a class="font-semibold text-decoration-none" href="" style="color: var(--titles-color);">{{$offer->category->name}}</a>
                                            </li>
                                            <li>
                                                >
                                            </li>
                                            <li>
                                                <a class="font-semibold text-decoration-none" href="" style="color: var(--titles-color);">{{$offer->category->name}}</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="flex space-x-2">
                                    <p class=" text-gray-500  ">Mis en ligne le  : </p>
                                    <p class="font-semibold" style="color: var(--titles-color);"> {{$offer->created_at->format('d M Y | H:i:s')}}</p>
                                </div>
                            </div>

                            <hr class="w-full">

                            <div class="flex space-x-2 p-4">
                                <p class=" text-gray-500  ">L'etat : </p>
                                <p class="font-semibold" style="color: var(--titles-color);"><span></span> Tres Bon etat</p>
                            </div>
                            <hr class="w-full">
                
                            <div class=" p-4">

                                <h4 class="flex" style="color: var(--titles-color);"><span><img width="24" height="24" src="{{asset('images/location-21.svg')}}" alt="Localisation"/></span>{{$offer->region->name . ", " . $offer->department->name}}</h4>
                            </div>
                            <hr class="w-full">
                            <div class=" flex justify-between m-4">
                                <h1 class="font-semibold text-lg" style="color: var(--titles-color);">{{$offer->price . "€" }}</h1>
                                <button class="text-sm bg-orange-200 rounded-xl px-2 text-orange-600"><span class=" bg-orange-700 text-white rounded-full px-[4px] py-[1px] mx-2">$</span>Vente autorise</button>
                            </div>
                            <hr>
                            <div class="uppercase p-4 bg-gray-100">
                                <h2 class="text-base">A Echanger contre :</h2>
                                <p class="mx-4"><span></span> Etudue tout propostion</p>
                            </div>

                        </div>

                        <!-- Signaiez ce troc-->
                        <div class="d-flex gap-2 bg-gray-100 px-6 py-2 rounded-xl border-b-2 border-gray-600 w-52">
                            <img src="{{asset('images/flag-svgrepo-com.svg')}}" alt="">
                            <button class=" text-gray-500 text-lg font-light"><span></span> Signaiez ce troc</button>
                        </div>
                        
                        <!--  -->
                     <div class="border-[1px] border-gray-300 rounded-md space-y-4">
                        <!-- Profile and Reviews -->
                    <div class=" flex align-items-center justify-between p-4">
                        <div class="space-x-4 flex flex-row align-items-center">
                            <div class="rounded-full bg-gray-500 overflow-hidden w-16 h-16 text-center flex justify-center">
                                <img src="{{ asset($offer->user->profile_photo_path) }}" alt="" class=" object-cover" width="100%" >
                            </div>
                            <div class="">
                                <h1 class="text-lg">{{$offer->user->first_name . " " . $offer->user->last_name}}</h1>
                                <span class="text-green-600">En ligne</span>
                            </div>
                            <div class="px-4 h-8 leading-10 border-[2px] space-x-2 rounded-full flex justify-center align-items-center" style="background-color: var(--primary-color-hover);">
                                <!-- add star icon-->
                                <h3 class=" text-base font-bold justify-content-center">Pro</h3>
                            </div>
                        </div>
                        <!-- Reviews -->
                        <div class="">
                            <h3 class="text-lg">4/5 <span class="text-sm font-semibold">(6 avis)</span></h3>
                            <div class="">
                                <div class="">
                                    <i class="fa-solid fa-star text-yellow-500"></i>
                                    <i class="fa-solid fa-star text-yellow-500"></i>
                                    <i class="fa-solid fa-star text-yellow-500"></i>
                                    <i class="fa-solid fa-star text-yellow-500"></i>
                                    <i class="fa-solid fa-star text-gray-200"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class=" flex justify-between p-4">
                        <h3 class="text-lg"><span class="text-sm font-semibold px-2 py-1 bg-gray-200 rounded-full" style="color: var(--text-color)" >0</span> Trocs</h3>
                        <h3 class="text-lg"><span class="text-sm font-semibold px-2 py-1 bg-gray-200 rounded-full" style="color: var(--text-color)">1</span> Offres</h3>
                        <h3 class="text-lg"><span class="text-sm font-semibold px-2 py-1 bg-gray-200 rounded-full" style="color: var(--text-color)">0</span> Avis</h3>
                    </div>
                    <div class="flex space-x-4 p-4">
                        <button class=" w-full py-6 rounded-md text-white text-lg font-medium" style="background-color: var(--primary-color-hover);"> Voir profile</button>
                        <button class=" w-full py-6 rounded-md text-white text-lg font-medium" style="background-color: var(--titles-color);"> Contact</button>
                    </div>
                    <div class="text-center">
                        <h4>Pargtagez cette annonce a vos amis</h4>
                        <ul class="flex space-x-2 p-4 justify-center ">
                            <li>
                                <a href="#"><i class="fa-brands fa-facebook text-gray-900 p-2 bg-gray-200 rounded-full hover:bg-emerald-600 hover:text-white"></i>
                            </li>
                            <li>
                                <a href="#"><i class="fa-brands fa-twitter text-gray-900 p-2 bg-gray-200 rounded-full hover:bg-emerald-600 hover:text-white"></i>
                            </li>
                            <li>
                                <a href="#"><i class="fa-brands fa-youtube text-gray-900 p-2 bg-gray-200 rounded-full hover:bg-emerald-600 hover:text-white"></i>
                            </li>
                            <li>
                                <a href="#"><i class="fa-brands fa-facebook text-gray-900 p-2 bg-gray-200 rounded-full hover:bg-emerald-600 hover:text-white"></i>
                            </li>
                            <li>
                                <a href="#"><i class="fa-brands fa-whatsapp text-gray-900 p-2 bg-gray-200 rounded-full hover:bg-emerald-600 hover:text-white"></i>
                            </li>
                        </ul>
                    </div>

                    
                    
                </div>
                
                </div>


                @foreach ($similarOffers as $similarOffer)
                <div class="bg-white rounded-lg overflow-hidden shadow-lg ring-4 ring-red-500 ring-opacity-40 max-w-dm w-96">
                    <div class="relative">
                        <img class="w-full" src="{{asset($similarOffer->offer_default_photo)}}" alt="Product Image">
                        
                    </div>
                    <div class="p-4 text-decoration-none">
                        <div class="d-flex align-items-center text-decoration-none">
                            <img width="18" height="18" src="{{asset('images/category-8.svg')}}" alt="">
                            <p class="text-gray-600 text-sm mb-4 text-decoration-none">{{$similarOffer->category->name}}</p>
                        </div>
                        
                        
                        <h3 class="text-lg font-medium mb-2 text-decoration-none">{{$similarOffer->name}}</h3>

                        <hr>
                        <div class="flex items-center justify-between text-decoration-none">
                            <p class="font-bold text-lg text-decoration-none">{{$similarOffer->region->name .', ' . $similarOffer->department->name}}</p>
                            <p class="justify-center align-items-center text-decoration-none ">
                            {{$similarOffer->price . ' €'}}
                            </p>
                        </div>
                    </div>
                </div>
                @endforeach
                

                </div>
            </div>

        </div>
    </div>


    <script>
        tailwind.config = {
          theme: {
            screen:{
                'sm': '640px',
      // => @media (min-width: 640px) { ... }

      'md': '768px',
      // => @media (min-width: 768px) { ... }

      'lg': '1024px',
      // => @media (min-width: 1024px) { ... }

      'xl': '1280px',
      // => @media (min-width: 1280px) { ... }

      '2xl': '1536px',
      // => @media (min-width: 1536px) { ... }
            },

            extend: {
              colors: {
                clifford: '#da373d',
              }
            }
          }
        }

        $(document).ready(function () {
        $('#similar-offers-carousel').slick({
            slidesToShow: 3,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 2000,
        });
    });
      </script>

      <script>
        
        function initMap(){
            // map options
            var options = {
                zoom:8,
                center:{lat:34.6820, lng:-1.9002}
            }
            
            // New map 
            var map = new google.maps.Map(document.getElementById('map'), options);

            // map marker
            
            addMarker({lat:34.6820, lng:-1.9002});

            function addMarker(coords){
                var marker = new google.maps.Marker({
                position:coords,
                map:map
            });
            }


        }

      </script>
      <script async
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBB19IBnomMnlfb3EYBf7G16-zcZGkd6IE&callback=initMap">
      </script>
    
</body>




    {{-- End new design --}}

{{-- <div class="offer_list_card">
    <div class="offer_image" style="background-image:url('')"></div>
    <div class="offer_details">
        
        <div class="offer_title">
            <h2></h2>
        </div>

        <div class="offer_category">
            <div class="offer_category_item">
                <img src="images/category-8.svg" alt="Category"/>
                <p></p>
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
                
                <p></p>
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
</div> --}}

</x-app-layout>