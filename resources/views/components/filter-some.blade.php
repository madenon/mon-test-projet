<form action="{{ request()->is('offer.*') ? route('offer.index') : route('alloffers.index') }}" method="GET">
    <div class="form-group">
        <ul class="max-w-md divide-y p-0 divide-gray-200 dark:divide-gray-700 border-2	border-inherit rounded-md shadow-md">
            <li class="p-3" id="sm-filter-1">
                <div class="flex justify-between my-2">
                    <label for="type">CATEGORIES</label>
                    <i class="fa fa-angle-down toggle-arrow"></i>
                    <i class="fa fa-angle-up hidden toggle-arrow"></i>
                </div>
                <div class="mt-1 hidden elements">
                    <ul class="max-w-md divide-y p-0 divide-gray-200 dark:divide-gray-700">
                        @for($i=0; $i< count($parentcategories_sm);$i++ )
                        <li id="sm-filter-1-{{$i+1}}">
                            <div class="flex justify-between my-2">
                                <label for="type">
                                    <i class="fa {{$parentcategories_sm[$i]['icon']}}"></i>
                                    {{ $parentcategories_sm[$i]['name'] }}
                                </label>
                                <i class="fa fa-plus toggle-arrow"></i>
                                <i class="fa fa-minus hidden toggle-arrow"></i>
                            </div>
                            <div class="mt-1 hidden elements">
                                @foreach($parentcategories_sm[$i]->children as $subcategory)
                                <div class="my-1">
                                    <input type="checkbox" id="sm-{{$subcategory->name}}" name="subcategories[]" value="{{ $subcategory->id }}" {{ request()->input($subcategory->name) ? 'checked' : '' }}>
                                    <label for="{{ $subcategory->id }}"class="text-sm">{{ $subcategory->name }}</label><br>
                                </div>
                                @endforeach
                            </div>
                        </li>
                        @endfor
                    </ul>
                </div>
            </li>
            <li class="p-3" id="sm-filter-2">
                <div class="flex justify-between my-2">
                    <label for="type">TYPE D'ANNONCE</label>
                    <i class="fa fa-angle-down toggle-arrow"></i>
                    <i class="fa fa-angle-up hidden toggle-arrow"></i>
                </div>
                <div class="mt-1 hidden elements">
                    @foreach($types_sm as $type)
                    <div class="my-1">
                        <input type="radio" id="sm-name" name="type" value="{{ $type->id }}" {{ $type->id == request()->input('type') ? 'checked' : '' }}>
                        <label for="{{ $type->id }}"class="text-sm">{{ $type->name }}</label><br>
                    </div>
                    @endforeach
                </div>
            </li>
            <li class="p-3" id="sm-filter-3">
                <div class="flex justify-between my-2">
                    <label for="type">En ligne</label>
                    <i class="fa fa-angle-down toggle-arrow"></i>
                    <i class="fa fa-angle-up hidden toggle-arrow"></i>
                </div>
                <div class="mt-1 hidden elements">
                    <div class="my-1">
                        <input type="radio" id="sm-online" name="online" value="1" {{ request()->has('online') && request()->input('online') == 1? 'checked' : '' }}>
                        <label for="1" class="text-sm">En ligne</label><br>
                    </div>
                    <div class="my-1">
                        <input type="radio" id="sm-offline" name="online" value="0" {{ request()->has('online') && request()->input('online') == 0 ? 'checked' : '' }}>
                        <label for="0"class="text-sm">Hors ligne</label><br>
                    </div>
                </div>
            </li>
            <li class="p-3" id="sm-filter-4">
                <div class="flex justify-between my-2">
                    <label for="type">REGION</label>
                    <i class="fa fa-angle-down toggle-arrow"></i>
                    <i class="fa fa-angle-up hidden toggle-arrow"></i>
                </div>
                <div class="mt-1 hidden elements">   
                    <form class="my-1">   
                        <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Rechercher</label>
                        <div class="relative mb-3">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                <i class="fa fa-search"></i>
                            </div>
                            <input type="search" id="sm-default-search" class="block w-full ps-10 text-xs text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
                                placeholder="Cities, states, & Contry Names" >
                        </div>
                    </form>

                    @for($i=0; $i<count($departments_sm); $i++)
                    <div class="my-1 region-item flex flex-row" data-name="{{ $departments_sm[$i]->name.', '.$departments_sm[$i]->region->name.', France' }}">
                        <input type="checkbox" id="sm-name_{{ $departments_sm[$i]->id }}" name="departments[]" value="{{ $departments_sm[$i]->id }}" {{ request()->input($departments_sm[$i]->name) ? 'checked' : '' }}>
                        <label for="name_{{ $departments_sm[$i]->id }}" class="text-sm ps-1">{{ $departments_sm[$i]->name.', '.$departments_sm[$i]->region->name.', France' }}</label><br>
                    </div>
                    @endfor
                </div>
            </li>
            <li class="p-3" id="sm-filter-5">
                <div class="flex justify-between my-2">
                    <label for="type">LOCATION RADUIS</label>
                    <i class="fa fa-angle-down toggle-arrow"></i>
                    <i class="fa fa-angle-up hidden toggle-arrow"></i>
                </div>
                <div class="mt-1 hidden elements">
                    <div class="flex justify-between my-4">
                        <div class="relative px-2">
                            <input type="text" id="sm-location-raduis" name="location-raduis"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-2 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <div class="absolute inset-y-0 end-0 flex items-center pe-3.5 pointer-events-none">
                                <span>Km</span>
                            </div>
                        </div>

                    </div>
                    <div id="sm-location-range" class="mt-1 relative"></div>

                </div>
            </li>
            <li class="p-3" id="sm-filter-6">
                <div class="flex justify-between my-2">
                    <label for="type">PRICES</label>
                    <i class="fa fa-angle-down toggle-arrow"></i>
                    <i class="fa fa-angle-up hidden toggle-arrow"></i>
                </div>
                <div class="mt-1 hidden elements">
                    <div class="flex justify-between my-4">
                        @foreach(['min','max'] as $ext)
                        <div class="relative @if($ext=='min') pe-1 @else ps-1 @endif">
                            <input type="text" id="sm-{{$ext}}-price" name="{{$ext}}_price"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-2 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <div class="absolute inset-y-0 end-0 flex items-center pe-3.5 pointer-events-none">
                                <span>EUR</span>
                            </div>
                        </div>
                        @endforeach

                    </div>
                    <div id="sm-price-range" class="mt-1"></div>

                </div>
            </li>
        </ul>
        <button class="mt-1 button-filter">Appliquer</button>
    </div>
</form>
<script>

    $(document).ready(function () {
        //Filter dropdown
        for(let j=1;j<10;j++){
            $(`#sm-filter-${j} > .flex > .toggle-arrow`).click(function () {
                $(`#sm-filter-${j} > .elements`).toggle();
                $(`#sm-filter-${j} > .flex > .toggle-arrow`).toggle(); // Toggle the down and up arrow icons
            });
        }
        //Filter dropdown for subcategories
        for(let j=1;j<25;j++){
            $(`#sm-filter-1-${j} > .flex > .toggle-arrow`).click(function () {
                $(`#sm-filter-1-${j} > .elements`).toggle();
                $(`#sm-filter-1-${j} > .flex > .toggle-arrow`).toggle(); // Toggle the down and up arrow icons
            });
        }


        $('#sm-default-search').on('input', function () {
            filterRegions();
        });

        $('.region-item input[type="checkbox"]').on('change', function () {
            filterRegions();
        });

        function filterRegions() {
            var searchTerm = $('#sm-default-search').val().toLowerCase();
            $('.region-item').each(function () {
                var regionName = $(this).data('name').toLowerCase();
                console.log({regionName});
                // var isVisible = regionName.includes(searchTerm) && $(this).find('input[type="checkbox"]').prop('checked');
                var isVisible = regionName.includes(searchTerm) ;
                console.log({isVisible});
                $(this).toggle(isVisible);
            });
        }

        const urlParams = new URLSearchParams(window.location.search);
        var minPrice=urlParams.get('min_price')?urlParams.get('min_price'):0;
        var maxPrice=urlParams.get('max_price')?urlParams.get('max_price'):4000;
        $("#price-range").slider({
            range: true,
            min: 0,
            max: 4000,
            values: [minPrice, maxPrice],
            slide: function (event, ui) {
                $("#min-price").val(ui.values[0]);
                $("#max-price").val(ui.values[1]);
            }
        });

        // Set initial values
        $("#min-price").val(minPrice);
        $("#max-price").val(maxPrice);

        //Change range
        $('#sm-min-price').on('input', function () {
            $("#price-range").slider("values", 0,$("#min-price").val());
        });
        $('#sm-max-price').on('input', function () {
            $("#price-range").slider("values", 1,$("#max-price").val());
        });


        var locationRaduis=urlParams.get('location-raduis');
        $("#location-range").slider({
            range: "min",
            min: 0,
            max: 1000,
            value: locationRaduis,
            slide: function (event, ui) {
                $("#location-rad*uis").val(ui.value);
            }
        });

        // Set initial values
        $("#location-raduis").val( $("#location-range").slider("value"));

        //Change range
        $('#sm-location-raduis').on('input', function () {
            $("#location-range").slider("value",$("#location-raduis").val());
        });


    });
</script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
