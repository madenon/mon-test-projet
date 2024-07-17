<div>
    <div class="flex flex-wrap sm:flex-nowrap">
        <ul class="flex flex-wrap items-center text-gray-900 dark:text-white m">
            <li class="me-2 my-1">
                <div class="border-2 rounded p-1 flex">
                    <img src="{{asset('images/filter-icon.svg')}}" alt="" style="display:inline" />
                    <span class="hidden sm:block">Filtre</span>
                    <span class="block sm:hidden" id="toggleFilterButton">Filtre</span>
                </div>
            </li>
            
            @foreach ($filters as $filter)
            @if(!in_array($filter['type'],$hiddenFilters))
            <li class="mx-1 my-1">
                @if($filter['type'])
                <div class="border-2 rounded p-1">
                    @if(isset($filter['icon']))
                    <i class="fa {{$filter['icon']}}"></i>
                    @endif
                    {{$filter['name']}}
                    @php $type = $filter['type']; $key = $filter['key'] @endphp
                    <a wire:click="remove('{{$type}}', '{{$key}}')" onclick="removeFilter('{{$type}}', this)">
                        <i class="fa fa-close inline-block border-2 rounded-full"></i>
                    </a>
                </div>
                @endif
            </li>
            @endif
            @endforeach
            
            @if($filterChanged)
            <form id="appliedFilter" method="GET" action="{{route('alloffers.index')}}">
                @if(request()->input('query'))
                    <input type="text" name="query" value="{{ old('query', request()->input('query')) }}" class="hidden">
                @endif

                @if(request()->input('category'))
                    <input type="text" name="category" value="{{ old('category', request()->input('category')) }}" class="hidden">
                @endif

                @if(request()->input('department'))
                    <input type="text" name="department" value="{{ old('department', request()->input('department')) }}" class="hidden">
                @endif

                @if(request()->input('region'))
                    <input type="text" name="region" value="{{ old('region', request()->input('region')) }}" class="hidden">
                @endif

                @if(request()->input('type'))
                    <input type="text" name="type" value="{{ old('type', request()->input('type')) }}" class="hidden">
                @endif

                @if(request()->input('min_price'))
                    <input type="text" name="min_price" value="{{ old('min_price', request()->input('min_price')) }}" class="hidden">
                @endif

                @if(request()->input('max_price'))
                    <input type="text" name="max_price" value="{{ old('max_price', request()->input('max_price')) }}" class="hidden">
                @endif

                @if(request()->input('sort_by'))
                    <input type="text" name="sort_by" value="{{ old('sort_by', request()->input('sort_by') ?? 'latest') }}" class="hidden">
                @endif

                @if(request()->input('online'))
                    <input type="text" name="online" value="{{ old('online', request()->input('online')) }}" class="hidden">
                @endif

                @if(request()->input('departments'))
                    <input type="text" name="departments[]" value="{{ old('departments', request()->input('departments')) }}" class="hidden">
                @endif

                @if(request()->input('subcategories'))
                    <input type="text" name="subcategories[]" value="{{ old('subcategories', request()->input('subcategories')) }}" class="hidden">
                @endif                <button type="submit" class="mt-1 button-filter">Appliquer</button>             
            </form>
            @endif
            


        </ul>
        <div class="ps-2 ml-auto">
            <div class="flex items-center">
                <div class="me-3 whitespace-nowrap">
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

    <script>
        function removeFilter(type, filter){
            filter.parentElement.parentElement.classList.add("hidden");
            const el = document.querySelector(`#appliedFilter input[name='${type}']`);
            if(el)el.remove();
        }
        document.addEventListener('DOMContentLoaded', function () {
            const toggleFilterButton = document.getElementById('toggleFilterButton');
            const offCanvas = document.getElementById('offCanvas');
            const closeFilterButton = document.getElementById('closeFilterButton');

            toggleFilterButton.addEventListener('click', function () {
                offCanvas.style.transform = 'translateX(0)';
            });
            
            closeFilterButton.addEventListener('click', function () {
                console.log({closeFilterButton});
                offCanvas.style.transform = 'translateX(100%)';
            });
            
            
        });
    </script>
</div>
