@php
$user=App\Models\User::find(request()->id);
if ($user){
    $last_login=Carbon\Carbon::parse($user->last_login);
    $last_login=$last_login->diffForHumans();
}


@endphp
<x-app-layout class="w-screen">
    @include('Chatify::layouts.headLinks')
    <div class="container my-5 mx-4 h-screen">
        <div class="flex content-start justify-around">
            <div class=" col-3 col-md-3 bg-white w-full shadow-lg rounded-xl">
                <x-mini-menu></x-mini-menu>
            </div>
            <div class="col-12 col-md-8 ">
                <div class="messenger">
                    {{-- ----------------------Users/Groups lists side---------------------- --}}
                    <div class="messenger-listView {{ !!$id ? 'conversation-active' : '' }}">
                        {{-- Header and search bar --}}
                        <div class="m-header">
                            <nav>
                                <a href="#"><i class="fas fa-inbox"></i> <span class="messenger-headTitle">MESSAGES</span> </a>
                                {{-- header buttons --}}
                                <nav class="m-header-right">
                                    <a href="#"><i class="fas fa-cog settings-btn"></i></a>
                                    <a href="#" class="listView-x"><i class="fas fa-times"></i></a>
                                </nav>
                            </nav>
                            {{-- Search input --}}
                            <input type="text" class="messenger-search" placeholder="Search" />
                            {{-- Tabs --}}
                            {{-- <div class="messenger-listView-tabs">
                                <a href="#" class="active-tab" data-view="users">
                                    <span class="far fa-user"></span> Contacts</a>
                            </div> --}}
                        </div>
            
                            {{-- tabs and lists --}}
                            <div class="m-body contacts-container">
                            {{-- Lists [Users/Group] --}}
                            {{-- ---------------- [ User Tab ] ---------------- --}}
                            <div class="show messenger-tab users-tab app-scroll" data-view="users">
    
                                {!! view('Chatify::layouts.listItem', ['get' => 'saved']) !!}
                                {{-- Contact --}}
                                <div class="listOfContacts" style="width: 100%;height: calc(100% - 272px);position: relative;"></div>
                            </div>
                            {{-- ---------------- [ Search Tab ] ---------------- --}}
                            <div class="messenger-tab search-tab app-scroll" data-view="search">
                                {{-- items --}}
                                <p class="messenger-title"><span>Search</span></p>
                                <div class="search-records">
                                    <p class="message-hint center-el"><span>Type to search..</span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    {{-- ----------------------Messaging side---------------------- --}}
                    <div class="messenger-messagingView">
                        {{-- header title [conversation name] amd buttons --}}
                        <div class="m-header m-header-messaging">
                            <nav class="chatify-d-flex chatify-justify-content-between chatify-align-items-center">
                                {{-- header back button, avatar and user name --}}
                                <div class="chatify-d-flex chatify-justify-content-between chatify-align-items-center">
                                    <a href="#" class="show-listView"><i class="fas fa-arrow-left"></i></a>
                                    <div class="avatar av-s header-avatar" style="margin: 0px 10px; margin-top: -5px; margin-bottom: -5px;">
                                    </div>
                                    <div class="flex flex-column justify-start content-start" >
                                        <a href="#" class="user-name">{{ config('chatify.name') }}</a>
                                        <div style="position:relative">
                                            @if($user)
                                                <span class="activeStatus @if(!$user->activeStatus) !bg-gray-400 @endif" style="left:0;bottom:30%"></span>
                                                <span class="me-2" style="position:relative;left:12px" >
                                                Online
                                                @if($user->activeStatus)
                                                now
                                                @else
                                                {{$last_login}}
                                                @endif
                                            </span>                                            
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                {{-- header buttons --}}
                                <nav class="m-header-right">
                                    <a href="#" class="show-infoSide"><i class="fas fa-info-circle"></i></a>
                                    <a href="#" class="danger delete-conversation red-600"><i class="fas fa-trash-alt"></i></a>
                                </nav>
                            </nav>
                            {{-- Internet connection --}}
                            <div class="internet-connection">
                                <span class="ic-connected">Connected</span>
                                <span class="ic-connecting">Connecting...</span>
                                <span class="ic-noInternet">No internet access</span>
                            </div>
                        </div>
                        
                        {{-- Messaging area --}}
                        <div class="m-body messages-container app-scroll">
                            <div class="messages">
                                <p class="message-hint center-el"><span>Please select a chat to start messaging</span></p>
                            </div>
                            {{-- Typing indicator --}}
                            <div class="typing-indicator">
                                <div class="message-card typing">
                                    <div class="message">
                                        <span class="typing-dots">
                                            <span class="dot dot-1"></span>
                                            <span class="dot dot-2"></span>
                                            <span class="dot dot-3"></span>
                                        </span>
                                    </div>
                                </div>P
                            </div>
                            
                        </div>
                        {{-- Send Message Form --}}
                        @include('Chatify::layouts.sendForm')
                    </div>
                    {{-- ---------------------- Info side ---------------------- --}}
                    <div class="messenger-infoView app-scroll">
                        {{-- nav actions --}}
                        <nav>
                            <p>User Details</p>
                            <a href="#"><i class="fas fa-times"></i></a>
                        </nav>
                        {!! view('Chatify::layouts.info')->render() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    @include('Chatify::layouts.modals')
    @include('Chatify::layouts.footerLinks')
    
</x-app-layout>