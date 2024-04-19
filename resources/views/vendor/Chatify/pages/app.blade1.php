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
                            {{-- Rechercher input --}}
                            <input type="text" class="messenger-search" placeholder="Rechercher" />
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
                            {{-- ---------------- [ Rechercher Tab ] ---------------- --}}
                            <div class="messenger-tab search-tab app-scroll" data-view="search">
                                {{-- items --}}
                                <p class="messenger-title"><span>Rechercher</span></p>
                                <div class="search-records">
                                    <p class="message-hint center-el"><span>Saisissez pour rechercher..</span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    {{-- ----------------------Messaging side---------------------- --}}
                    <div class="messenger-messagingView">
                        
                        {{-- Messaging area --}}
                        <div class="m-body messages-container app-scroll">
                            <div class="messages">
                                <p class="message-hint center-el"><span>Veuillez selectionner un chat pour commencer par discuter</span></p>
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