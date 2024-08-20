<div>
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <ul class="navbar-nav">
            <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button" onclick="toggleSidebar()"><i class="fas fa-bars md:hidden"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="{{route('admin.index')}}" class="nav-link">Home</a>
            </li>
        </ul>

        <div id="header-authenticated-user" class="ml-auto">
                <div class="navbar-search-block" id="navbar-search">
                    <form class="form-inline" method="GET" action="{{route('admin.offers')}}" >
                        <div class="input-group input-group-sm">
                        <input class="form-control form-control-navbar" type="search" name="search" placeholder="Rechercher Offre" aria-label="Rechercher">
                        <div class="input-group-append">
                        <button class="btn btn-navbar" type="submit">
                        <i class="fas fa-search"></i>
                        </button>
                        </div>
                        </div>
                    </form>
                </div>

            <div class="dropdown" class="header-authenticated-user-content">
                <div id="header-user-notification-icon" class="" data-bs-toggle="dropdown" aria-expanded="false">
                    <div>
                        @if(count($notifications)==0)
                        <div class="header-user-notification-icon"></div>
                        @else
                        <div class="header-user-notification-icon-notified"></div>
                        @endif
                    </div>

                </div>
                <ul class="dropdown-menu notification-dropdown overflow-auto" style="max-height:60vh;left:-30vh">
                    @if(count($notifications)==0)
                    <li>
                        <div class="notification-dropdown-item">
                            <div class="notification-dropdown-item-content">
                                    <b>You have no new notification</b>
                            </div>
                        </div>
                    </li>
                    @else
                    @foreach ($notifications as $notification)
                    <li>
                        <div class="notification-dropdown-item @if($notification->read_at==NULL) bg-gray-800 hover:bg-gray-600 @endif">
                            <div class="notification-dropdown-item-image">
                                <img src="{{asset('images/circle-user-icon.svg')}}" alt="" />
                            </div>
                            <div class="notification-dropdown-item-content" wire:click="read('{{$notification->id}}')">
                                <a >
                                    <b>{{$notification->data["name"] ?? null}}</b>
                                    <span>{{$notification->data["content"] ?? null}}</span>
                                    <strong>{{$notification->data["title"] ?? null}}</strong>
                                </a>
                                <button class="notification-delete-icon" data-notification-id="{{$notification->id}}">🗑️</button>
                            </div>
                        </div>
                    </li>
                    @endforeach
                    @endif
                </ul>
                
            </div>
            <div class="dropdown" class="header-authenticated-user-content">
                <div id="header-user-messages-icon" class="" data-bs-toggle="dropdown" aria-expanded="false">
                    <div wire:click="read(1)">
                        @if(count($messages->where('read_at',NULL))==0)
                        <div class="header-user-messages-icon"></div>
                        @else
                        <div class="header-user-messages-icon-newmessages"></div>
                        @endif
                    </div>
                </div>
                <ul class="dropdown-menu notification-dropdown overflow-auto" style="max-height:60vh;left:-30vh">
                    @if(count($messages)==0)
                    <li>
                        <div class="notification-dropdown-item">
                            <div class="notification-dropdown-item-content">
                                    <b>You have no new message</b>
                            </div>
                        </div>
                    </li>
                    @else
                    @foreach ($messages as $notification)
                    <li>
                        <div class="notification-dropdown-item @if($notification->read_at==NULL) bg-gray-800 hover:bg-gray-600 @endif">
                            <div class="notification-dropdown-item-image">
                                <img src="{{asset('images/circle-user-icon.svg')}}" alt="" />
                            </div>
                            <div class="notification-dropdown-item-content" wire:click="read('{{$notification->id}}')">
                                <a >
                                    <b>{{$notification->data["name"]}}</b>
                                    <span>{{$notification->data["content"]}}</span>
                                    <strong>{{$notification->data["from_id"]}}</strong>
                                </a>
                                <div wire:click="delete('{{$notification->id}}')">
                                    <button class="notification-delete-icon">🗑️</button>
                                </div>
                            </div>
                        </div>
                    </li>
                    @endforeach
                    @endif
                </ul>
            </div>
        </div>
    </nav>
</div>
<script>
        function toggleSidebar() {
            var sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('hidden');
            var search = document.getElementById('navbar-search');
            search.classList.toggle('hidden');
        }
    </script>