<x-app-layout>
    @if($categoryName)
<div class="container">
    <h2>{{$categoryName }} Page</h2>
</div>
@endif
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Offres') }}
        </h2>
    </x-slot>


    <div class="container">
        <nav style="--bs-breadcrumb-divider: '>'" aria-label="breadcrumb">
            <ol class="breadcrumb" class="no-underline bg-green-500 ">
                <li class="breadcrumb-item active" aria-current="page">{{ Breadcrumbs::render('offers') }}</li>
            </ol>
        </nav>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-3 col-md-3">
            <h3>Filters</h3>
            <form action="{{ route('offer.index') }}" method="GET">
    <div class="form-group">
        <div>
            <label for="min_price">Department :</label>
        </div>
        <div class="mt-1">
            <select name="department">
                @foreach($departments as $department)
                    <option value="{{ $department->id }}">{{ $department->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="min_price">Type :</label>
        </div>
        <div class="mt-1">
            <select name="type">
                @foreach($types as $type)
                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                @endforeach
            </select>
        </div>
        {{-- Check if the 'category' query parameter is present --}}
        @if(request()->has('category'))
            <input type="hidden" name="category" value="{{ request('category') }}">
        @endif
        <button class="mt-1"  id="button-filter">Apply Filters</button>
    </div>
</form>

            </div>
            <div class="col-12 col-md-9">
                @foreach ($offers as $offer)
                <div class="offer_list_card">
                    <div class="offer_image relative">
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
                        <div class=" text-titles text-xs mt-3">
                            <h6 class=" font-normal ">A ECHANGER CONTRE</h6>
                            @foreach ($offer->preposition as $proposition)
    <a href="#" style="background-color: #24a19c; color:white;" class="ml-5 w-50 mt-2 btn proposition-link" data-bs-toggle="modal" data-bs-target="#exampleModal" 
      data-id="{{ $proposition->id }}"  data-status="{{ $proposition->status }}" data-user="{{ $proposition->user }}" data-offer="{{ $proposition->offer }}">
        {{ $proposition->name }}
    </a>
@endforeach

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
                        <div class=" pb-12 mt-2" >
                            <div class="flex gap-2 pr-3 ">
                               <div class="w-1/4">
                                <span class="flex text-center justify-center">Jours</span>
                                <div
                                    class="flex items-center justify-center rounded-lg bg-primary-hover w-full h-full text-white text-3xl font-bold">
                                    00
                                </div>
                            </div>
                                <div class="w-1/4">
                                    <span class="flex text-center justify-center">Heurs</span>
                                     <div
                                    class="flex items-center justify-center rounded-lg bg-primary-hover w-full h-full text-white text-3xl font-bold">
                                    00
                                </div>
                                </div>
                                <div class="w-1/4">
                                    <span class="flex text-center justify-center">Minutes</span>
                                     <div
                                    class="flex items-center justify-center rounded-lg bg-primary-hover w-full h-full text-white text-3xl font-bold">
                                    00
                                </div>
                                </div>
                                <div class="w-1/4">
                                    <span class="flex text-center justify-center">Secs</span>
                                     <div
                                    class="flex items-center justify-center rounded-lg bg-primary-hover w-full h-full text-white text-3xl font-bold">
                                    00
                                </div>
                                </div>
                            </div>
                        </div>
                        <div class="offer_owner mb-3" >
                            <div class="flex gap-3 ">
                                @if (!$offer->user->profile_photo_path)
                            <img src="/images/user-avatar-icon.svg" alt="Avatar">
                            @else
                            <img class="w-12 h-12 rounded-full" src="{{ route('profile_pictures-file-path',$offer->user->profile_photo_path) }}" alt=""
                                class="rounded-full">
                            @endif
                                <span class="flex flex-col">
                                    <span class="text-titles font-medium">
                                        {{$offer->user->first_name . " " .
                                        $offer->user->last_name}}
                                    </span>
                                    @if ($offer->user->is_online=="Offline")
                                    <span class="text-red-500">Hors ligne</span>
                                    @else
                                    <span class="text-green-500">En ligne</span>
                                    @endif
                                </span>
                                <img src="/images/Badge-pro.svg" alt="" class="pb-3 ">
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        {{ $offers->links() }}
    </div>
    
</x-app-layout>
@php
    function getStatusBadgeClass($status) {
        switch ($status) {
            case 'validated':
                return 'bg-success';
            case 'pending':
                return 'bg-warning';
            case 'accepted':
                return 'bg-primary';
           
        }
    }
    @endphp
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <!-- Modal content remains the same -->
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table align-middle mb-0 bg-white">
                    <thead class="bg-light">
                        <tr>
                            <th>Name</th>
                            <th>Status</th>
                            <th>User</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td id="modalName"></td>
                            <td id="modalStatus"></td>
                            <td id="modalUser"></td>
                            <td>
                             <button type="button"  class="btn btn-info" id="acceptButton">
                                  Accept
                             </button>
                             <button type="button" class="btn btn-danger" id="declineButton">
                                 Decline
                             </button>

                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
<script>
   
    $(document).ready(function () {
        $('.proposition-link').click(function () {
            // Get data from the clicked link
            var propositionName = $(this).text();
            var propositionStatus = $(this).data('status'); // Adjust based on your data attributes
            var propositionUser = $(this).data('user'); // Adjust based on your data attributes
            var propositionId=$(this).data('id');
            var user=propositionUser.first_name+" "+propositionUser.last_name
            // Update modal content
            $('#modalName').text(propositionName);
            $('#modalStatus').text(propositionStatus);
            $('#modalUser').text(user);
            // Update propositionId in button data attributes
            $('#acceptButton').data('proposition-id', propositionId);
            $('#declineButton').data('proposition-id', propositionId);
           
        });
          // Handle Accept button click
          $('#acceptButton').click(function () {
            var propositionId = $(this).data('proposition-id');
            updatePropositionStatus(propositionId, 'accepted');
        });

        // Handle Decline button click
        $('#declineButton').click(function () {
            var propositionId = $(this).data('proposition-id');
            updatePropositionStatus(propositionId, 'declined');
        });

        // Function to update proposition status via AJAX
        function updatePropositionStatus(propositionId, newStatus) {
            // Send an AJAX request to update the status
            $.ajax({
                type: 'POST',
                url: '/update-proposition-status', // Replace with your actual route
                data: {
                    propositionId: propositionId,
                    newStatus: newStatus,
                },
                success: function (response) {
            // Handle success response

            // Show success message
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: 'The proposition status has been updated.',
            }).then(function () {
                // Reload the page after showing the success message
                location.reload();
            });
        },
        error: function (error) {
            
            // Show error message
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: 'Failed to update proposition status.',
            });
        }
            });
        }
    
    });
</script>
