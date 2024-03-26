<div>
    <div class="flex">
        <ul class="flex flex-wrap items-center text-gray-900 dark:text-white m">
            <li class="me-2 my-1">
                <div class="border-2 rounded p-1 flex">
                    <img src="{{asset('images/filter-icon.svg')}}" alt="" style="display:inline" />
                    <span class="hidden sm:block">Filtre</span>
                    <span class="block sm:hidden" id="toggleFilterButton">Filtre</span>
                </div>
            </li>
            
            @php $filterChanged = false @endphp
            @foreach ($filters as $filter) 
            <li class="mx-1 my-1">
                @if($filter['type'])
                <div class="border-2 rounded p-1">
                    @if(isset($filter['icon']))
                    <i class="fa {{$filter['icon']}}"></i>
                    @endif
                    {{$filter['name']}}
                    @php $type = $filter['type']; $key = $filter['key'] @endphp
                    <a wire:click="remove('{{$type}}', '{{$key}}'); @php $filterChanged = true @endphp">
                        <i class="fa fa-close inline-block border-2 rounded-full" onclick="removeFilter(this)"></i>
                    </a>
                </div>
                @endif
            </li>
            @endforeach
            
            @if($filterChanged)
            <form wire:submit="applyFrom" method="GET">
             <button class="mt-1 button-filter">Appliquer</button>             
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
        function removeFilter(el){
            const parent = el.parentElement.parentElement;
            parent.classList.add("hidden");
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
