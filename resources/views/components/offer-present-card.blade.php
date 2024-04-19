<article class="rounded-xl bg-white shadow-lg hover:shadow-xl">
<div class="relative flex items-end overflow-hidden rounded-xl">
            <img class="zoomD w-full h-96" src="{{ route('offer-pictures-file-path',$offer->offer_default_photo)}}" alt="Offer Photo" />
        </div>
    <a class="no-underline" href="{{route('offer.offer', [$offer->id, $offer->slug])}}">
        <div class="mt-1 p-2">
            <span class="text-gray-500 text-lg flex items-center div-categorie pb-2">
                <img src="/images/Stack.svg" alt="" class="mr-2 ">
                {{$offer->subcategory->parent->name}}
            </span>
            <span class="text-titles font-bold text-3xl overflow-hidden">
                    {{Str::limit($offer->title,20) }}
            </span>
            <hr class="w-full text-titles">
            <div class="mt-3 flex items-end justify-between">
                <div class="flex gap-2 items-center">
                    <img src="/images/map-pin.svg" alt="">
                    <span class="text-gray-500">
                    {{Str::limit($offer->department->region->name . ", " .
                        $offer->department->name,15) }}
                    </span>
                </div>
                <div class="group inline-flex rounded-xl">
                    <span class="text-red-500 text-lg">
                        {{$offer->type->name }}
                    </span>
                </div>
            </div>
        </div>
    </a>
</article>