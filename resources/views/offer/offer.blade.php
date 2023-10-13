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
            <div class="my-4">
                <ul class="flex space-x-4 sm:space-x-2 max-sm:space-x-2 text-gray-400 align-items-center font-light p-4 text-sm">
                    <li class="">
                        <a href=""><span> <i class="fa-solid fa-house"></i></span> Home</a>
                    </li>
                    <li class="text-sm text-gray-400">
                        <i class="fa-solid fa-chevron-right text-sm opacity-50"></i>
                    </li>
                    <li>
                        <a href=""> <span><i class="fa-solid fa-dumbbell"></i></span> Sports & Loisirs</a>
                    </li>
                    <li class="text-sm text-gray-400">
                        <i class="fa-solid fa-chevron-right text-sm opacity-50"></i>
                    </li>
                    <li>
                        <a href=""> <span><i class="fa-solid fa-dumbbell"></i></span> Sports</a>
                    </li>
                    <li class="text-sm text-gray-400">
                        <i class="fa-solid fa-chevron-right text-sm opacity-50"></i>
                    </li>
                    <li>
                        <a href=""> <span><i class="fa-solid fa-dumbbell"></i></span> Home Workout</a>
                    </li>
                </ul>
            </div>

            <!-- -->
            <div class="">
                <div class="grid-container grid xl:grid-cols-5 grid-cols-2 container">
                    <!-- Left Section -->
                    <div class="col-span-3 p-4 space-y-4  sm:px-12 max-sm:mx-12">
                        <div class="">
                            <img src="./images/image.jpeg" alt="" srcset="" class="rounded-md">
                        </div>
                        <!-- Description-->
                        <div class="">
                            <h1 class=" mt-16 mb-11 text-2xl">Description</h1>
                            <p class="leading-8">                            Lorem, ipsum dolor sit amet consectetur adipisicing elit. Molestias
                                facere maiores odit eos dolores explicabo optio modi, architecto 
                                dolor quia placeat nulla vitae error est, 
                                ipsa quibusdam voluptatibus in. Impedit!
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nulla, recusandae ut quidem quae pariatur 
                                ipsum eveniet ipsam eos tenetur ratione assumenda mollitia incidunt harum doloremque, quo omnis atque, corrupti sed.</p>
                        </div>
                        <!-- map section-->
                        <div class="">
                            <img src="./images/map.jpeg" alt="" srcset="">
                        </div>
                    </div>
                     <!-- Right Section -->
                     <div class="col-span-2 p-2 space-y-11">

                        <h1 class=" xl:text-2xl lg::text-2xl font-semibold text-xl">Cadre nu peugeot competition vintage 1980 reynolds</h1>

                        <button class=" bg-green-800 w-full py-6 rounded-md text-white text-lg font-medium"> Troquez Maintenant</button>

                        <!-- border -->
                        <div class="border-[1px] border-gray-300 rounded-md space-y-4">
                            <div class="space-y-2 text-sm p-4">
                                <div class="flex space-x-2">
                                    <p class=" text-gray-500  ">Type de troc :</p>
                                    <h3 class="">Bien</h3>
                                </div>
                                <div class="flex space-x-2">
                                    <p class=" text-gray-500">Categorie :</p>
                                    <div class="">
                                        <ul class="flex">
                                            <li>
                                                <a class="font-semibold" href="">Vehicules</a>
                                            </li>
                                            <li>
                                                >
                                            </li>
                                            <li>
                                                <a class="font-semibold" href=""> pieces auto neuves</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="flex space-x-2">
                                    <p class=" text-gray-500  ">Mis en ligne le  : </p>
                                    <p class="font-semibold"> 12 Sept 2023 <span>18:40:52</span></p>
                                </div>
                            </div>

                            <hr class="w-full">

                            <div class="flex space-x-2 p-4">
                                <p class=" text-gray-500  ">L'etat : </p>
                                <p class="font-semibold"><span></span> Tres Bon etat</p>
                            </div>
                            <hr class="w-full">
                
                            <div class=" p-4">
                                <h1><span></span> Longuedoc-Roussilion-Herault</h1>
                            </div>
                            <hr class="w-full">
                            <div class=" flex justify-between m-4">
                                <h1 class="font-semibold text-lg">70.00 $</h1>
                                <button class="text-sm bg-orange-200 rounded-xl px-2 text-orange-600"><span class=" bg-orange-700 text-white rounded-full px-[4px] py-[1px] mx-2">$</span>Vente autorise</button>
                            </div>
                            <hr>
                            <div class="uppercase p-4">
                                <h2 class="text-base">A Echanger contre :</h2>
                                <p class="mx-4"><span></span> Etudue tout propostion</p>
                            </div>

                        </div>

                        <!-- Signaiez ce troc-->
                        <button class="bg-gray-100 px-6 py-2 rounded-xl border-b-2 border-gray-600 text-gray-500 text-lg font-light"><span></span> Signaiez ce troc</button>

                        <!--  -->
                     <div class="border-[1px] border-gray-300 rounded-md space-y-4">
                        <!-- Profile and Reviews -->
                    <div class=" flex align-items-center justify-between p-4">
                        <div class="space-x-4 flex flex-row align-items-center">
                            <div class="rounded-full bg-gray-500 overflow-hidden w-16 h-16 text-center flex justify-center">
                                <img src="./images/profile.jpeg" alt="" class=" object-cover" width="100%" >
                            </div>
                            <div class="">
                                <h1 class="text-lg">Jacob Jones</h1>
                                <span class="text-green-600">En ligne</span>
                            </div>
                            <div class="px-4 h-8 leading-10 border-[2px] space-x-2 border-green-500 rounded-full flex justify-center align-items-center">
                                <!-- add star icon-->
                                <h3 class=" text-base font-bold">Pro</h3>
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
                                    <i class="fa-solid fa-star text-gray-200"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class=" flex justify-between p-4">
                        <h3 class="text-lg"><span class="text-sm font-semibold px-2 py-1 text-white bg-gray-500 rounded-full">0</span> Trocs</h3>
                        <h3 class="text-lg"><span class="text-sm font-semibold px-2 py-1 text-white bg-gray-500 rounded-full">1</span> Offres</h3>
                        <h3 class="text-lg"><span class="text-sm font-semibold px-2 py-1 text-white bg-gray-500 rounded-full">0</span> Avis</h3>
                    </div>
                    <div class="flex space-x-4 p-4">
                        <button class="bg-green-800 w-full py-6 rounded-md text-white text-lg font-medium"> Voir profile</button>
                        <button class="bg-gray-700 w-full py-6 rounded-md text-white text-lg font-medium"> Contact</button>
                    </div>
                    <div class="text-center">
                        <h3>Pargtagez cette annonce a vos amis</h3>
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
      </script>
    
</body>




    {{-- End new design --}}

<div class="offer_list_card">
    <div class="offer_image" style="background-image:url('{{ asset("{$offer->offer_default_photo}") }}')"></div>
    <div class="offer_details">
        
        <div class="offer_title">
            <h2>{{$offer->name}}</h2>
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
                    
                        {{-- <div class="offer_owner_content_infos_status
                            @if ($onlineStatus == 'Online')
                                text-green-500
                            @else
                                text-red-500
                            @endif">
                            {{$offer->user->is_online}}</div>
                        </div> --}}
            </div>
        </div>
    </div>
</div>

</x-app-layout>