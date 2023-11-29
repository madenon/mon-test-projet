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
            <label for="sort_by">Trier par :</label>
        </div>
        <div class="mt-1">
            <select name="sort_by">
                <option value="latest" {{ request('sort_by') == 'latest' ? 'selected' : '' }}>Plus récents</option>
                <option value="oldest" {{ request('sort_by') == 'oldest' ? 'selected' : '' }}>Plus anciens</option>
                <option value="price_desc" {{ request('sort_by') == 'price_desc' ? 'selected' : '' }}>Prix décroissant</option>
                <option value="price_asc" {{ request('sort_by') == 'price_asc' ? 'selected' : '' }}>Prix croissant</option>
            </select>
        </div>
        <div>
            <label for="department">Department:</label>
        </div>
        <div class="mt-1">
            <select name="department" id="departmentSelect">
            <option value="" selected>Sélectionnez le département</option>
                @foreach($departments as $department)
                    <option value="{{ $department->id }}">{{ $department->name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="type">Type:</label>
        </div>
        <div class="mt-1">
            <select name="type" id="typeSelect">
            <option value="" selected>Sélectionnez le type</option>
                @foreach($types as $type)
                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                @endforeach
            </select>
        </div>

        {{-- Check if the 'category' query parameter is present --}}
        @if(request()->has('category'))
            <input type="hidden" name="category" value="{{ request('category') }}">
        @endif
        @if(request()->has('region'))
            <input type="hidden" name="region" value="{{ request('region') }}">
        @endif
        <button class="mt-1" id="button-filter">Appliquer les filtres</button>
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
      data-id="{{ $proposition->id }}" data-image="{{route('proposition-pictures-file-path',$proposition->images ?$proposition->images :'' )}}"  data-status="{{ $proposition->status }}" data-user="{{ $proposition->user }}" data-offer="{{ $proposition->offer }}" data-meet="{{ $proposition->meetup }}">
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
                <h1 class="modal-title fs-5" id="exampleModalLabel">Offer</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table align-middle mb-0 bg-white">
                    <thead class="bg-light">
                        <tr>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Image</th>
                            <th>User</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td id="modalName"></td>
                            <td id="modalStatus"></td>
                            <td>  <img id="modalImage" src="" alt="Image"> </td>
                            <td id="modalUser"></td>
                            <td>
                             <button type="button"  class="btn btn-success" id="acceptButton">
                                  Accept
                             </button>
                             <button type="button" class="btn btn-danger" id="declineButton">
                                 Decline
                             </button>
                             <button type="button" class="btn" id="meetButton">
                                 Add Meetup
                             </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <!-- show meetups -->
                <h2 id="meetHeader">Meetups</h2>
            <table id="meetTable" class="table align-middle">
                <thead class="bg-light">
                    <tr>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Description</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody id="meetupsTableBody">
                    <td id="meetDate"></td>
                    <td id="meetTime"></td>
                    <td id="meetDescription"></td>
                   <td id="meetStatus"></td>
                </tbody>
            </table>
                 <!-- Meetup Schedule Form -->
                 <form id="meetupForm">
                @csrf
                <input type="hidden" id="prepositionId" name="prepositionId" value="">
                <div class="mb-3">
                    <label for="meetupDate" class="form-label">Meetup Date</label>
                    <input type="date" class="form-control" id="meetupDate" name="meetupDate" required>
                </div>
                <div class="mb-3">
                    <label for="meetupTime" class="form-label">Meetup Time</label>
                    <input type="time" class="form-control" id="meetupTime" name="meetupTime" required>
                </div>
                <div class="mb-3">
                    <label for="meetupDescription" class="form-label">Meetup Description</label>
                    <textarea class="form-control" id="meetupDescription" name="meetupDescription" rows="3" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Schedule Meetup</button>
            </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script>
   
    $(document).ready(function () {
        var departmentValue = "{{ request('department') }}";
        var typeValue = "{{ request('type') }}";
        // Set the selected attribute for the department dropdown
        $("#departmentSelect").val(departmentValue).prop('selected', true);

        // Set the selected attribute for the type dropdown
        $("#typeSelect").val(typeValue).prop('selected', true);
        $('#exampleModal').on('hidden.bs.modal', function () {
            $("#meetupForm").hide();
    });
        $('.proposition-link').click(function () {
            // Get data from the clicked link
            var propositionName = $(this).text();
            var propositionStatus = $(this).data('status'); // Adjust based on your data attributes
            var propositionUser = $(this).data('user'); // Adjust based on your data attributes
            var propositionId=$(this).data('id');
            var propositionImage=$(this).data('image');
            var user=propositionUser.first_name+" "+propositionUser.last_name;
            var descriptionData=$(this).data('meet');
            console.log(descriptionData);
            var meetDescription=descriptionData.description;
            var meetDate=descriptionData.date;
            var meetTime=descriptionData.time;
            var meetStatus=descriptionData.status;
// Set the value of the hidden input in meetup form
            $('#prepositionId').val(propositionId);
            // Update modal content
            $('#modalName').text(propositionName);
            $('#modalStatus').text(propositionStatus);
            $('#modalUser').text(user);
            $('#modalImage').attr('src',propositionImage);
            // Update propositionId in button data attributes
            $('#acceptButton').data('proposition-id', propositionId);
            $('#acceptButton').data('proposition-id', propositionId);
            $('#declineButton').data('proposition-id', propositionId);
            // add meetup in table 
            if(descriptionData){
            $('#meetDescription').text(meetDescription);
            $('#meetDate').text(meetDate);
            $('#meetTime').text(meetTime);
            $('#meetStatus').text(meetStatus);
            $('#meetButton').hide();
            $('#meetHeader').show();
            $('#meetTable').show();
        } 
            else {
                $('#meetDescription').empty();
            $('#meetDate').empty();
            $('#meetTime').empty();
            $('#meetStatus').empty();
            $('#meetButton').show();
            $('#meetHeader').hide();
            $('#meetTable').hide();
            }

            if(propositionStatus=="accepted" || propositionStatus=="refused" ){
                $('#acceptButton').hide();
                $('#declineButton').hide();
            }
            else{
                $('#acceptButton').show();
                $('#declineButton').show();
            }
           
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
 // Handle Meet button click
 $("#meetupForm").hide();
 $('#meetButton').click(function () {
    $("#meetupForm").show();

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
    // for meetup form
    $(document).ready(function () {
        // Handle form submission
        $('#meetupForm').submit(function (e) {
            e.preventDefault();

            // Get form data
            var formData = {
                prepositionId: $('#prepositionId').val(),
                meetupDate: $('#meetupDate').val(),
                meetupTime: $('#meetupTime').val(),
                meetupDescription: $('#meetupDescription').val(),
            };
            console.log(formData);

            // Perform AJAX request to save meetup schedule
            $.ajax({
                url: '/schedule-meetup',
                method: 'POST',
                data: formData,
                success: function (response) {
                    // Handle success response
                    console.log(response);

                    // Optionally, close the modal after a successful update
                    $('#meetupModal').modal('hide');
                },
                error: function (error) {
                    // Handle error response
                    console.error(error);
                }
            });
        });

        // Open the modal and set the prepositionId
        $('#meetupModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var prepositionId = button.data('preposition-id'); // Extract info from data-* attributes
            $('#prepositionId').val(prepositionId); // Set the prepositionId in the form
        });
    });

var meetups = {};

// Function to populate the meetups table
function populateMeetupsTable() {
    var meetupsTableBody = document.getElementById('meetupsTableBody');

    // Clear existing rows
    meetupsTableBody.innerHTML = '';

    // Loop through meetups and add rows to the table
    
        var row = meetupsTableBody.insertRow();
        var dateCell = row.insertCell(0);
        var timeCell = row.insertCell(1);
        var descriptionCell = row.insertCell(2);
        var statusCell = row.insertCell(3);

        // Set cell values based on meetup data
        dateCell.innerHTML = meetup.date;
        timeCell.innerHTML = meetup.time;
        descriptionCell.innerHTML = meetup.description;
        statusCell.innerHTML = meetup.status;
    
}

// Event listener for modal show event
$('#yourModalId').on('show.bs.modal', function (event) {
   
    document.getElementById('modalName').innerHTML = preposition.name;
    document.getElementById('modalStatus').innerHTML = preposition.status;
    document.getElementById('modalUser').innerHTML = preposition.user_name;

    // Populate meetups table
    populateMeetupsTable();
});

</script>
