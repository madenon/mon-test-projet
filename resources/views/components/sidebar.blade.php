<div class="sidebar border w-[20%] rounded-lg mx-12 my-6 ">
    <div class="flex items-center w-full  justify-center border-b gap-3 py-4">
        @if (auth()->check())
        <div class="  ">
            <img src="/images/user-avatar-icon.svg" alt="" class="rounded-full" />
            {{--  <img src="{{ auth()->user()->profile_photo_path }} " alt="" />  --}}
        </div>
        <div class="flex flex-col ">
            <span class="mb-0 text-black font-medium text-lg">{{ auth()->user()->name }}</span>
            <span>{{ auth()->user()->role }}</span>
        </div>
        @endif
    </div>
    <div class="my-3  w-full ">
        <a href="#" class="sidebar-link flex  p-2 gap-2    text-gray-500 text-lg font-medium no-underline">
            <img alt="" src="{{ asset('/images/UserCircle.svg') }}">

            <span>Information Personnelle</span>
        </a>
        <a href="#" class=" sidebar-link flex p-2 gap-2    text-gray-500 text-lg font-medium no-underline">
            <img alt="" src="{{ asset('/images/PlusCircle.svg') }}">
            <span>Annonces</span>
        </a>
        <a href="#" class="sidebar-link flex p-2 gap-2    text-gray-500 text-lg font-medium no-underline">
            <img alt="" src="{{ asset('/images/ClipboardText.svg') }}">
            <span>Trocs</span>
        </a>
        <a href="#" class="sidebar-link flex p-2 gap-2    text-gray-500 text-lg font-medium no-underline">
            <img alt="" src="{{ asset('/images/ChatCircleDots.svg') }}">
            <span>Messages</span>
        </a>
        <a href="#" class="sidebar-link flex p-2 gap-2    text-gray-500 text-lg font-medium no-underline">
            <img alt="" src="{{ asset('/images/CreditCard.svg') }}">
            <span>Crédibilité</span>
        </a>
        <a href="#" class="sidebar-link flex p-2 gap-2    text-gray-500 text-lg font-medium no-underline">
            <img alt="" src="{{ asset('/images/log-out-icon-16.svg') }}">
            <span>Se déconnecter</span>
        </a>
    </div>

</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const sidebarLinks = document.querySelectorAll('.sidebar-link');

        sidebarLinks.forEach(function(link) {
            link.addEventListener('click', function() {
                sidebarLinks.forEach(function(sidebarLink) {
                    sidebarLink.classList.remove('text-black', 'font-semibold', 'border-l-4', 'border-black');
                });
                this.classList.add('text-black', 'font-semibold', 'border-l-4', 'border-black');
            });
        });
    });
</script>
