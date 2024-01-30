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

       
    @if($categoryName)
<div class="container my-2">
    <h2> Catégorie : {{$categoryName }}</h2>
</div>
@endif
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
<div class="container">
@endif
    <div class="row">
            <div class="col">
                <x-applied-filters></x-applied-filters>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-3 col-md-3">
                <x-filters></x-filters>      
            </div>
            <div class="col-9 col-md-9 ps-2">
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
                    <div class="offer_image relative">
                        <img src="{{ route('offer-pictures-file-path',$offer->offer_default_photo) }}" alt=""
                            class="zoomD object-cover h-full w-full rounded-tl-lg rounded-bl-lg " />
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
                            {{-- {{$subcategory->name}} --}}
                        </div>
                        <div class=" text-titles text-xs mt-3">
                            <h6 class=" font-normal ">A ECHANGER CONTRE</h6>
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
                        <div class="pb-12 mt-2 offer-container" data-expiration="{{ $offer->expiration_date }}">
        <div class="flex gap-2 pr-3">
            <div class="w-1/4">
                <span class="flex text-center justify-center">Jours</span>
                <div class="days-countdown flex items-center justify-center rounded-lg bg-primary-hover w-full h-full text-white text-3xl font-bold">
                    00
                </div>
            </div>
            <div class="w-1/4">
                <span class="flex text-center justify-center">Heurs</span>
                <div class="hours-countdown flex items-center justify-center rounded-lg bg-primary-hover w-full h-full text-white text-3xl font-bold">
                    00
                </div>
            </div>
            <div class="w-1/4">
                <span class="flex text-center justify-center">Minutes</span>
                <div class="minutes-countdown flex items-center justify-center rounded-lg bg-primary-hover w-full h-full text-white text-3xl font-bold">
                    00
                </div>
            </div>
            <div class="w-1/4">
                <span class="flex text-center justify-center">Secs</span>
                <div class="seconds-countdown flex items-center justify-center rounded-lg bg-primary-hover w-full h-full text-white text-3xl font-bold">
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
                                        {{$offer->user->first_name . " " .
                                        $offer->user->last_name}}
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

