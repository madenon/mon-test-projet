<x-app-layout>
    <!-- (A) LIGHTBOX CONTAINER -->
    <div id="lightbox"></div>
    @php
        $leftBannerShown = false;
        $rightBannerShown = false;
    @endphp

    @foreach ($banners as $banner)
        @if ($banner->is_active && ($banner->page === 'offers' || $banner->page ==='all') && $banner->position === 'top')
            <a href="{{$banner->description}}" target="_blank" >
                <img src="{{ asset('storage/'. $banner->banner ) }}" alt="Banner" style="width:100%;max-height:260px;">
                </a>
                @endif
        @if ($banner->is_active && ($banner->page === 'offers' || $banner->page === 'all') && $banner->position === 'left')
            @php
                $leftBannerShown = true;
            @endphp
            <a href="{{ $banner->description }}" target="_blank" >
            <img src="{{ asset('storage/'. $banner->banner ) }}" id="left" alt="Banner" class="responsive-image">


            </a>
        @endif

        @if ($banner->is_active && ($banner->page === 'offers' || $banner->page === 'all') && $banner->position === 'right')
            @php
                $rightBannerShown = true;
            @endphp
            <a href="{{ $banner->description }}" target="_blank" >
                <img src="{{ asset('storage/'. $banner->banner ) }}" id="right" alt="Banner" class="responsive-image" style=" margin-top:260px; right:0;">
            </a>
        @endif
    @endforeach
    <style>
        .responsive-image {
            max-width: 300px;      height: auto;
            position: fixed;
        }

        @media (max-width: 900px) {
            .responsive-image {
            display:none;
            }
            .con{
                margin:20px !important;
                max-width: 100% !important;
            }
        }
    </style>

    @php
        $bothBannersShown = $leftBannerShown && $rightBannerShown;
        $onlyLeftBannerShown = $leftBannerShown && !$rightBannerShown;
        $onlyRightBannerShown = !$leftBannerShown && $rightBannerShown;
        $noBannersShown = !$leftBannerShown && !$rightBannerShown;
    @endphp
        
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Offres') }}
        </h2>
    </x-slot>


    <div class="container my-2">
        <nav style="--bs-breadcrumb-divider: '>'" aria-label="breadcrumb">
            <ol class="breadcrumb" class="no-underline bg-green-500 ">
                <li class="breadcrumb-item active" aria-current="page">{{ Diglactic\Breadcrumbs\Breadcrumbs::render('offers') }}</li>
            </ol>
        </nav>
    </div>
    @if ($bothBannersShown)
        <div class="con" style="margin-left:300px; margin-right:300px; max-width:55%;">
    @elseif ($onlyLeftBannerShown)
    <div class="con" style="margin-right:20px; margin-left: 310px;">
    @elseif ($onlyRightBannerShown)
    <div class="con" style="margin-left:20px; margin-right:310px;">
    @else
    <div class="container-fluid px-4">
    @endif
    
    <style>
        #offCanvas{
            transform: translateX(100%);
        }
    </style>
    <div id="offCanvas" class="fixed inset-y-0 right-0 w-64 bg-gray-800 text-white z-50 p-4 ease-in-out duration-300 mt-5">
        <button id="closeFilterButton" class="text-white">&times; Close</button>
        <x-filter-some></x-filter-some>      
    </div>

        <div class="row">
                <div class="col">
                    @livewire('applied-filter',["offersCount" =>$offersCount ])
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-3 hidden sm:block">
                    <x-filters></x-filters>      
                </div>
                <div class="col-12 col-sm-9 ps-2">
                @foreach ($banners as $banner)
            @if ($banner->is_active && ($banner->page === 'offers' || $banner->page ==='all') && $banner->position === 'content')
            <div class="offer_list_card mt-0 mb-4">
            <a href="{{$banner->link}}" target="_blank" > 
            <img src="{{ asset('storage/'. $banner->banner ) }}" alt="Banner" style="width:100%;max-height:250px;">
            </a>        
        </div>
            @endif
        @endforeach
           
                @foreach ($offers as $offer)
                <div class="offer_list_card mt-0 mb-4">
                    <div class="mt-auto mb-auto w-1/2 relative">
                        <img src="{{ route('offer-pictures-file-path',$offer->defaultImage->offer_photo) }}" alt="Responsive image"
                            class="zoomD img-fluid" />


                     </div>
                    <div class="offer_details md:ml-8 md:mr-4 md:mt-4 mr-2 ml-2 mt-2">
                        <div class="">
                            <a href="{{route('offer.offer', [$offer, urlencode($offer->slug)])}}" class="no-underline">
                                <h1 class="text-titles text-lg md:text-2xl">
                                    {{ Str::limit($offer->title, 35) }}</h1>
                            </a>
                            
                        </div>
                        <div class="flex  items-center   ">
                            <span >
                                Type de troc:
                            </span>
                        </div>
                    <div class="flex  items-center   ">
                        <span class="text-titles text-lg "style="color : #24A19C;font-weight: 700;" >
                            {{$offer->type->name }}
                        </span>
                        
                    </div>

                    <div class="flex    items-center   ">
                        <span >
                            Catégorie:
                        </span>
                    </div>
                    <div class="flex    items-center   ">
                        <span class="text-titles text-lg flex items-center div-categorie"style="color : #24A19C;font-weight: 700;" >
                            <img src="/images/Stack.svg" alt="" class="mr-2">
                            {{$offer->subcategory->parent->name}}
                            <img src="/images/chevron-right.svg" alt="" class="px-2">
                            {{$offer->subcategory->name}}
                        </span>
                    </div>
                       @if($offer->type->name=='Don')
                       @elseif($offer->type->name!='Moment')
                        
                        @if($offer->specify_proposition)
                        <div class="flex  items-center  hidden md:block">
                                <span >
                                    À ÉCHANGER CONTRE:
                                </span>
                            </div>
                            <div class=" text-titles text-xs hidden md:block">
                                <h6 class=" font-normal ">  Etudie toute proposition</h6>
                            </div>
                            
                            @endif
                        @else
                            @if($offer->dynamic_inputs)
                            <div class=" text-titles text-xs mt-3 hidden md:block">
                                <h6 class=" font-normal ">À PARTAGER AVEC:</h6>
                                    @foreach (json_decode($offer->dynamic_inputs, true)?? [] as $prop )
                                    @if($prop!=null && is_numeric($prop))
                                    <span>
                                        {{$prop}} partenaire(s).
                                    </span>
                                    @endif
                                    @endforeach

                            </div>
                            @endif
                        @endif
                        <div class=" mt-3 flex w-full md:mb-3 ">
                            <div class=" w-[40%] flex gap-1 items-center">
                                <img src="/images/map-pin.svg" alt="">
                                <span class="text-xs md:text-base">
                                    {{Str::limit($offer->department->region->name . ", " .
                                    $offer->department->name,20)}}
                                </span>
                                
                            </div>
                            <div class="w-[60%] text-end">
                                @if (!$offer->price)
                                    {{$offer->type->name}}
                                </span>
                                @else
                                <div class="flex items-center justify-end gap-1 ">
                                    <span class="text-titles text-lg md:text-2xl font-semibold">
                                        {{$offer->price}} €
                                    </span>
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class=" mt-3 flex flex-center gap-2 mb-3 ">
                            @if ($offer->buy_authorized)
                            <style>
                                .bg-with-primary{
                                    background-color : #24A19C;
                                }
                            </style>

                            <span class="flex bg-with-primary  rounded-full px-1 py-1 gap-1 text-white">
                                <span class="text-center text-xs md:text-base">€ Vente autorisé</span>
                            </span>
                            @endif
                            @if ($offer->send_authorized)
                            <style>
                                .bg-with-primary{
                                    background-color : #24A19C;
                                }
                            </style>

                            <span class="flex bg-with-primary  rounded-full px-1 py-1 gap-1 text-white">
                                <span class="text-center text-xs md:text-base"> <i class="fa-solid fa-dolly"></i> Envoi autorisé</span>
                            </span>
                            @endif
                        </div>
                        @if($offer->expiration_date!=NULL)
                        <div class="pb-7 md:pb-12 md:mt-2 offer-container" data-expiration="{{ $offer->expiration_date }}">
                            <div class="flex gap-2 pr-3">
                                <div class="w-1/4">
                                    <span class="flex text-center justify-center">Jours</span>
                                    <div class="days-countdown flex items-center justify-center rounded-lg bg-primary-hover w-full h-full text-white text-sm md:text-sm md:text-3xl font-bold">
                                        00
                                    </div>
                                </div>
                                <div class="w-1/4">
                                    <span class="flex text-center justify-center">Heurs</span>
                                    <div class="hours-countdown flex items-center justify-center rounded-lg bg-primary-hover w-full h-full text-white text-sm md:text-sm md:text-3xl font-bold">
                                        00
                                    </div>
                                </div>
                                <div class="w-1/4">
                                    <span class="flex text-center justify-center">Minutes</span>
                                    <div class="minutes-countdown flex items-center justify-center rounded-lg bg-primary-hover w-full h-full text-white text-sm md:text-sm md:text-3xl font-bold">
                                        00
                                    </div>
                                </div>
                                <div class="w-1/4">
                                    <span class="flex text-center justify-center">Secs</span>
                                    <div class="seconds-countdown flex items-center justify-center rounded-lg bg-primary-hover w-full h-full text-white text-sm md:text-sm md:text-3xl font-bold">
                                        00
                                    </div>
                                </div>
                            </div>
                        </div>
                         @endif
                        <div class="offer_owner md:mb-10" >
                            <div class="flex gap-3 ">
                                <div class="relative">
                                    @if (!$offer->user->profile_photo_path)
                                    <img src="/images/user-avatar-icon.svg" alt="Avatar">
                                    @else
                                    <img class="w-12 h-12 rounded-full" src="{{ route('profile_pictures-file-path',$offer->user->profile_photo_path) }}" alt=""
                                    class="rounded-full">
                                    @endif
                                    <span class="status-indicator absolute top-0 right-0 transform translate-x-[-50%] translate-y-[-50%] 
                                    @if ($offer->user->is_online == 1) bg-green-600 @else bg-red-600 @endif">
                                    </span>
                                </div>
                            <div class="flex space-x-2 md:space-x-4">
                                <span class="flex flex-col w-full relative">
                                    <span class="text-titles font-medium text-xs md:text-base break-words">
                                            {{$offer->user->name}}
                                        </span>
                                        <style>
                                            .status-indicator {
                                                width: 10px;
                                                height: 10px;
                                                border-radius: 50%;
                                                display: inline-block;
                                            }
                                        </style>

                                        
                                    </span>
                                    @if($offer->user->statusPro=='accepted')
                                    <img src="/images/Badge-pro.svg" alt="" class="pb-3 ">
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                
            </div>
        </div>
        {{ $offers->links() }}
       
    </div>
    @foreach ($banners as $banner)
        @if ($banner->is_active && ($banner->page === 'offers' || $banner->page ==='all')  && $banner->position === 'bottom')
        <div class="flex justify-center mt-4">
        <a href="{{$banner->description}}" target="_blank" >
            <img src="{{ asset('storage/'. $banner->banner ) }}" alt="Banner" style="width:80%;max-height:150px;">
        </a>
        </div>
            @endif
    @endforeach
  
</x-app-layout>
<script> 
 $(document).ready(function () {
// (A) GET LIGHTBOX & ALL .ZOOMD IMAGES
let all = document.getElementsByClassName("zoomD"),
      lightbox = document.getElementById("lightbox");
 
  // (B) CLICK TO SHOW IMAGE IN LIGHTBOX
  // * SIMPLY CLONE INTO LIGHTBOX & SHOW
  if (all.length>0) { for (let i of all) {
    i.onclick = () => {
      let clone = i.cloneNode();
      clone.className = "";
      lightbox.innerHTML = "";
      lightbox.appendChild(clone);
      lightbox.className = "show";
    };
  }}
 
  // (C) CLICK TO CLOSE LIGHTBOX
  lightbox.onclick = () => lightbox.className = "";
$(window).scroll(function() {
    var scrollPosition = $(window).scrollTop();
    var left = $('#left');
    var right = $('#right');

if (scrollPosition > 250) {
    left.css('top', '80px');
    right.css('top', '80px');
    right.css('margin-top','0')
} else {
  left.css('top', '');
  right.css('top', '');
  right.css('margin-top','260px');

}}); 
//
 var departmentValue = "{{ request('department') }}";
        var typeValue = "{{ request('type') }}";
        // Set the selected attribute for the department dropdown
        $("#departmentSelect").val(departmentValue).prop('selected', true);

        // Set the selected attribute for the type dropdown
        $("#typeSelect").val(typeValue).prop('selected', true);

        $("#sort_by").change(function(){
            var selectedValue = $(this).val();

            var currentUrl = window.location.href;
            var urlWithSortOption = updateQueryStringParameter(currentUrl, "sort_by", selectedValue);

            // Redirect to the updated URL
            window.location.href = urlWithSortOption;

        } )

        function updateQueryStringParameter(uri, key, value) {
                var re = new RegExp("([?&])" + key + "=.*?(&|$)", "i");
                var separator = uri.indexOf('?') !== -1 ? "&" : "?";
                if (uri.match(re)) {
                    return uri.replace(re, '$1' + key + "=" + value + '$2');
                } else {
                    return uri + separator + key + "=" + value;
                }
            }
            //countdown 
            function formatTime(milliseconds) {
        var seconds = Math.floor(milliseconds / 1000);
        var minutes = Math.floor(seconds / 60);
        var hours = Math.floor(minutes / 60);
        var days = Math.floor(hours / 24);

        hours %= 24;
        minutes %= 60;
        seconds %= 60;

        return {
            days: days,
            hours: hours,
            minutes: minutes,
            seconds: seconds
        };
    }

    // Function to update the countdown for each offer
    function updateCountdown(offerContainer) {
        var expirationDate = offerContainer.dataset.expiration;
var now = new Date();
var expirationTime = new Date(expirationDate + "Z").getTime(); // Append "Z" to indicate UTC
var timeRemaining = expirationTime - now.getTime();
var time = formatTime(timeRemaining);
        // Display the countdown in the specified offer container
        function show(time){
    offerContainer.querySelector('.days-countdown').innerText= time.days.toString().padStart(2, '0') ;
        offerContainer.querySelector('.hours-countdown').innerText= time.hours.toString().padStart(2, '0');
        offerContainer.querySelector('.minutes-countdown').innerText= time.minutes.toString().padStart(2, '0');
        offerContainer.querySelector('.seconds-countdown').innerText= time.seconds.toString().padStart(2, '0');
}
        show(time);


        // Update the time remaining every second
        if (timeRemaining > 0) {
            timeRemaining -= 1000;
            setTimeout(function () {
                updateCountdown(offerContainer);
            }, 1000);
        } else {
            // Display a message when the countdown reaches zero
show({days:'00',hours:'00',minutes:'00',seconds:'00'})        }
    }

    // Start the countdown for each offer
    document.querySelectorAll('.offer-container').forEach(function (offerContainer) {
        updateCountdown(offerContainer);
    });

 });

</script>
