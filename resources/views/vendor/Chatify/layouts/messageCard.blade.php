<?php
$seenIcon = (!!$seen ? 'check-double' : 'check');
$SeenShow = "<span data-time='<$created_at' class='message-time'>
".($isSender ? "<span class='fas fa-$seenIcon' seen'></span>" : '' )."</span>";
$user=App\Models\User::find($from_id);
$created_at=new DateTime($created_at);
$mes=App\Models\ChMessage::where('id',$id)->first();
if($mes->preposition){
    $offer=$mes->preposition->offer;
}
if($mes->replies){
    
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
            <span class="text-slate-300">{{$created_at->format('H:i')}}</span> 
            {!! $SeenShow !!}

        </div>
        @if (@$attachment->type != 'image' || $message)
        <div class="message">
            <span>
                @if(!$mes->parent)
                <a class="no-underline text-gray-800" href="{{route('messages.viewMessage',['id'=>request()->id,'msgId'=>$id])}}"">
                {!! ($message == null && $attachment != null && @$attachment->type != 'file') ? $attachment->title : nl2br($message) !!} 
                </a>
                @else
                {!! ($message == null && $attachment != null && @$attachment->type != 'file') ? $attachment->title : nl2br($message) !!} 
                @endif
            </span>
            {{-- If attachment is a file --}}
            @if(@$attachment->type == 'file')
            <div class="me-4">
                <a href="{{ route(config('chatify.attachments.download_route_name'), ['fileName'=>$attachment->file]) }}" class="file-download text-black">
                    <span class="fas fa-file"></span> {{$attachment->title}}</a>
            </div>
                @endif
            </div>
            @endif
            @if(@$attachment->type == 'image')
            <div class="image-wrapper" >
                <!-- <div class="image-file chat-image" style="background-image: url('{{ Chatify::getAttachmentUrl($attachment->file) }}')">
                    <div>{{ $attachment->title }}</div>
                </div> -->
                
                <div class="me-4">
                    <img src="{{ Chatify::getAttachmentUrl($attachment->file) }}" alt="{{ $attachment->title }}">
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
                    {{$offer->subcategory->parent->name}}
                    <img src="/images/chevron-right.svg" alt="" class="">
                    <img src="/images/Stack.svg" alt="" class="">
                    {{-- {{$subcategory->name}} --}}
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
                            <style>
                                .bg-with-primary{
                                    background-color : #24A19C;
                                }
                            </style>
                            <span class="flex bg-with-primary  rounded-full px-3 py-1 gap-2 text-white">
                                <span class="text-xs md:text-base bg-with-primary px-2 rounded-full text-white ">$</span>
                                <span class="text-xs md:text-base">Vente autorisé</span>
                            </span>
                            <span class="text-titles text-2xl font-semibold">
                                {{$offer->price}} €
                            </span>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>        
        @endif 
        @if ($mes->replies && count($mes->replies)>0)
        <p class="messenger-title mx-5"><span>
            <a class="sg-btn no-underline" style="color: {{$user->messenger_color}}" href="{{route('messages.viewMessage',['id'=>request()->id,'msgId'=>$id])}}">{{count($mes->replies)}} replies</a>
        </span></p>
        @endif
    </div>
</div>
