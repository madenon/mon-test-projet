<x-app-layout>
    <!-- (A) LIGHTBOX CONTAINER -->
    <div id="lightbox"></div>

    @php
        $leftBannerShown = false;
        $rightBannerShown = false;
    @endphp

    @foreach ($banners as $banner)
        @if ($banner->is_active && ($banner->page === 'offers' || $banner->page === 'all') && $banner->position === 'top')
            <a href="{{$banner->description}}" target="_blank">
                <img src="{{ asset('storage/'. $banner->banner ) }}" alt="Banner" style="width:100%;max-height:260px;">
            </a>
        @endif
        @if ($banner->is_active && ($banner->page === 'offers' || $banner->page === 'all') && $banner->position === 'left')
            @php
                    $leftBannerShown = true;
                @endphp
                <a href="{{ $banner->description }}" target="_blank">
                <img src="{{ asset('storage/'. $banner->banner ) }}" id="left" alt="Banner" class="responsive-image">
            </a>
        @endif

        @if ($banner->is_active && ($banner->page === 'offers' || $banner->page === 'all') && $banner->position === 'right')
            @php
                $rightBannerShown = true;
            @endphp
            <a href="{{ $banner->description }}" target="_blank">
                <img src="{{ asset('storage/'. $banner->banner ) }}" id="right" alt="Banner" class="responsive-image" style="margin-top:260px; right:0;">
            </a>
        @endif
    @endforeach

    <style>
        .responsive-image {
            max-width: 300px;
            height: auto;
            position: fixed;
        }

        @media (max-width: 900px) {
            .responsive-image {
                display: none;
            }
            .con {
                margin: 20px !important;
                max-width: 100% !important;
            }
        }

        .offer_list_card {
            display: flex;
            flex-direction: row;
            align-items: center;
            border: 1px solid #e5e7eb; /* Light grey border */
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 10px;
            background-color: #ffffff;
        }

        .offer_list_card img {
            max-width: 150px; /* Fixed width for images */
            height: auto;
            border-radius: 8px;
        }

        .offer_details {
            flex-grow: 1;
            padding-left: 20px;
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
            <ol class="breadcrumb" class="no-underline bg-green-500">
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

   

    <div class="row">
        <div class="col">
            @livewire('applied-filter', ["offersCount" => $offersCount])
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-3 hidden sm:block">
            <x-filters></x-filters>      
        </div>
        <div class="col-12 col-sm-9 ps-2">
            @foreach ($banners as $banner)
                @if ($banner->is_active && ($banner->page === 'offers' || $banner->page === 'all') && $banner->position === 'content')
                    <div class="offer_list_card mt-0 mb-4">
                        <a href="{{ $banner->link }}" target="_blank">
                            <img src="{{ asset('storage/'. $banner->banner ) }}" alt="Banner" style="width:100%;max-height:250px;">
                        </a>        
                    </div>
                @endif
            @endforeach

            @foreach ($offers as $offer)
                <div class="offer_list_card mt-0 mb-4">
                    <img src="{{ route('offer-pictures-file-path', $offer->defaultImage->offer_photo) }}" alt="Responsive image" class="zoomD img-fluid"/>

                    <div class="offer_details md:ml-8 md:mr-4 md:mt-4 mr-2 ml-2 mt-2">
                        <a href="{{ route('offer.offer', [$offer, urlencode($offer->slug)]) }}" class="no-underline">
                            <h1 class="text-titles text-lg md:text-2xl">
                                {{ Str::limit($offer->title, 35) }}
                            </h1>
                        </a>

                        <div class="flex items-center">
                            <span>Type de troc:</span>
                        </div>
                        <div class="flex items-center">
                            <span class="text-titles text-lg" style="color: #24A19C; font-weight: 700;">
                                {{ $offer->type->name }}
                            </span>
                        </div>

                        <div class="flex items-center">
                            <span style="font-size: 0.75rem; color: #888;">À ÉCHANGER CONTRE</span>
                        </div>

                        
                        <div class="flex justify-between mt-3">
                            <div class="flex items-center">
                                <img src="/images/map-pin.svg" alt="">
                                <span class="text-xs md:text-base">{{ Str::limit($offer->department->region->name . ", " . $offer->department->name, 20) }}</span>
                            </div>
                            <div class="text-end">
                                @if (!$offer->price)
                                    {{ $offer->type->name }}
                                @else
                                    <div class="flex items-center justify-end gap-1">
                                        <span class="text-titles text-lg md:text-2xl font-semibold">{{ $offer->price }} €</span>
                                    </div>
                                @endif
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
        @if ($banner->is_active && ($banner->page === 'offers' || $banner->page === 'all') && $banner->position === 'bottom')
            <div class="flex justify-center mt-4">
                <a href="{{ $banner->description }}" target="_blank">
                    <img src="{{ asset('storage/'. $banner->banner ) }}" alt="Banner" style="width:80%;max-height:150px;">
                </a>
            </div>
        @endif
    @endforeach

    <div id="footer-create-add-button">
        <a class="" href="{{ route('offer.create') }}">
            <div class="footer-create-add-button-img">
                <img src="{{ asset('images/plus-icon-white.svg') }}" alt=""/>
            </div>
            <span class="footer-create-add-button-span">Déposer une annonce</span>
        </a>
    </div>
</x-app-layout>

<script>
    $(document).ready(function() {
        $('img.zoomD').hover(function() {
            $(this).css("cursor", "pointer");
        });

        $('#filterButton').on('click', function () {
            $('#offCanvas').toggleClass('transform translate-x-0');
        });

        $('#closeFilterButton').on('click', function () {
            $('#offCanvas').removeClass('transform translate-x-0');
        });

        $(document).mouseup(function(e) {
            var container = $('#offCanvas');
            if (!container.is(e.target) && container.has(e.target).length === 0) {
                container.removeClass('transform translate-x-0');
            }
        });

        // Lightbox functionality
        $('img.zoomD').click(function() {
            var imgSrc = $(this).attr('src');
            $('#lightbox').html('<img src="' + imgSrc + '" class="lightbox-img"/>');
            $('#lightbox').fadeIn();
        });

        $('#lightbox').click(function() {
            $('#lightbox').fadeOut();
        });
    });
</script>
