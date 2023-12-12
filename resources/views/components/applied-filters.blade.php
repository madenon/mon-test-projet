<div class="flex">
    <ul class="flex flex-wrap items-center text-gray-900 dark:text-white m">
        <li class="me-2 my-1">
            <div class="border-2 rounded p-1">
                <img src="{{asset('images/filter-icon.svg')}}" alt="" style="display:inline" />
                Filtre
            </div>
        </li>
        @foreach ($filters as $filter) 
        <li class="mx-1 my-1">
            @if($filter['type'])
            <div class="border-2 rounded p-1">
                @if(isset($filter['icon']))
                <i class="fa {{$filter['icon']}}"></i>
                @endif
                {{$filter['name']}}
                <a onclick="">
                    <i class="fa fa-close inline-block border-2 rounded-full"></i>
                </a>
            </div>
            @endif
        </li>
        @endforeach


    </ul>
    <div class="ps-2 ml-auto">
        <div class="flex items-center">
            <div class="me-3">
                {{$offersCount}} items
            </div>
            <div class="ms-3">
                <select name="sort_by" id="sort_by">
                    <option value="latest" {{ request('sort_by') == 'latest' ? 'selected' : '' }}>Plus récents</option>
                    <option value="oldest" {{ request('sort_by') == 'oldest' ? 'selected' : '' }}>Plus anciens</option>
                    <option value="price_desc" {{ request('sort_by') == 'price_desc' ? 'selected' : '' }}>Prix décroissant</option>
                    <option value="price_asc" {{ request('sort_by') == 'price_asc' ? 'selected' : '' }}>Prix croissant</option>
                </select>
            </div>
        </div>
    </div>
</div>