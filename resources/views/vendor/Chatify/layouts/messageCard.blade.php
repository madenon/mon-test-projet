<?php
$seenIcon = (!!$seen ? 'check-double' : 'check');
$SeenShow = "<span data-time='<$created_at' class='message-time'>
".($isSender ? "<span class='fas fa-$seenIcon' seen'></span>" : '' )."</span>";
$user=App\Models\User::find($from_id);
$created_at=new DateTime($created_at);
$mes=App\Models\ChMessage::where('id',$id)->first();
if($mes->preposition_id){
    $offer=App\Models\Preposition::find($mes->preposition_id)->offer;
}
?>

<div class="flex item-start ms-3 mb-3" data-id="{{ $id }}">
    <div class="media mx-2 ">
        <img src="{{ route('profile_pictures-file-path', $user->avatar) }}" class="rounded-full max-w-15 max-h-8" alt="{{ $user->name }} Avatar">
    </div>
    {{-- Card --}}
    <div class="w-full">
        <div class="mb-2">
            <span class="font-bold">{{$user->name}} </span>&#8226; 
            <span class="text-slate-300">{{$created_at->format('H:i A')}}</span> 
            {!! $SeenShow !!}

        </div>
        @if (@$attachment->type != 'image' || $message)
        <div class="message">
            {!! ($message == null && $attachment != null && @$attachment->type != 'file') ? $attachment->title : nl2br($message) !!} 
            {{-- If attachment is a file --}}
            @if(@$attachment->type == 'file')
            <a href="{{ route(config('chatify.attachments.download_route_name'), ['fileName'=>$attachment->file]) }}" class="file-download">
                <span class="fas fa-file"></span> {{$attachment->title}}</a>
            @endif
        </div>
        @endif
        @if(@$attachment->type == 'image')
        <div class="image-wrapper" style="text-align: {{$isSender ? 'end' : 'start'}}">
            <div class="image-file chat-image" style="background-image: url('{{ Chatify::getAttachmentUrl($attachment->file) }}')">
                <div>{{ $attachment->title }}</div>
            </div>
            
        </div>
        @endif

        @if ($mes->preposition_id)
        <div class="text-slate-300 text-sm">This message relate to:</div>
        <div class="offer_list_card me-5 mt-0">
                    <div class="offer_image w-1/4">
                        <img src="{{ route('offer-pictures-file-path',$offer->offer_default_photo) }}" alt=""
                            class="object-cover h-full w-full rounded-tl-lg rounded-bl-lg " />
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
                            {{$offer->category->name}}
                            <img src="/images/chevron-right.svg" alt="" class="">
                            <img src="/images/Stack.svg" alt="" class="">
                            {{-- {{$subcategory->name}} --}}
                        </div>
                        <div class=" mt-3 flex w-full mb-3">
                            <div class=" w-[40%] flex gap-2 items-center">
                                <img src="/images/map-pin.svg" alt="">
                                <span class="">
                                    {{$offer->region->name . ", " .
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
                    </div>
                </div>        @endif


        
    </div>
</div>
