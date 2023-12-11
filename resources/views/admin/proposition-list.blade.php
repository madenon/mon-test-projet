@extends('admin.index')

@section('admin-content') 
<div class="container">
        <h1 class="m-4">Prepositions List</h1>
        <table class="table align-middle mb-0 bg-white">
            <thead class="bg-light">
                <tr>
                    <th>Name</th>
                    <th>Image</th>
                    <th>Price</th>
                    <th>Status</th>
                    <th>Maker</th>
                    <th>Offer</th>
                    <th>Meet</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($prepositions as $preposition)
                    <tr>
                        <td>{{ $preposition->name }}</td>
                        <td> <img src="{{ route('proposition-pictures-file-path',$preposition->images ?$preposition->images :'' ) }}" alt=""
                             /></td>
                             <td>{{ $preposition->price }}</td>
                        <td ><span class="badge {{ getStatusBadgeClass($preposition->status) }} rounded-pill d-inline">
                            {{ $preposition->status }}
                        </span></td>
           
                        <td>{{ $preposition->offer? $preposition->offer->user->name :'' }}</td>
                        <td>{{ $preposition->offer_name }}</td>
                        <td>@if($preposition->meetup)
                            <button type="button" data-meet="{{ $preposition->meetup }}" id="meet" class="btn meet-button " data-bs-toggle="modal" data-bs-target="#meetModal">
<i class="fas fa-calendar" style="color: #24a19c;"></i></button>@endif</td>
                        <td>
                            <!-- Chat button with icon -->
                            <a type="button" class="btn  chat-button" href="">
                                <i class="fas fa-comment-dots" style="color: #24a19c;"></i>
                            </a>
                            <!-- Edit button with icon --> @if($preposition->status!='accepted')
                            <button type="button" class="btn edit-button" data-bs-toggle="modal" data-bs-target="#editModal{{ $preposition->id }}">
                                <i class="fas fa-edit" style="color: #ffc107;"></i>
                            </button>@endif
                            <!-- Delete button with icon -->
                            <button type="button" class="btn  delete-button" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $preposition->id }}" data-preposition-id="{{ $preposition->id }}">
                                <i class="fas fa-trash-alt" style="color: red"></i>
                            </button>

      </td>
                    </tr>
                    <div class="modal fade" id="editModal{{ $preposition->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $preposition->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel{{ $preposition->id }}">Edit Proposition</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Your edit form goes here -->
                        <!-- Use {{ $preposition->id }} to identify the proposition being edited -->
                        <form id="editForm{{ $preposition->id }}">
                            @csrf
                            <div class="mb-3">
                                <label for="editName" class="form-label">Name</label>
                                <input type="text" class="form-control" id="editName" name="name" value="{{ $preposition->name }}">
                            </div>
                            <div class="mb-3">
                                <label for="editNegotiation" class="form-label">Negotiation</label>
                                <textarea class="form-control" id="editNegotiation" name="negotiation">{{ $preposition->negotiation }}</textarea>
                            </div>
                            <!-- Add other form fields as needed -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary edit-button" data-preposition-id="{{ $preposition->id }}">
    Save changes
</button>
                    </div></form>
                </div>
            </div>
        </div>
</div>

                @endforeach
            </tbody>
        </table>
    </div>
    
    <div class="modal fade" id="meetModal" tabindex="-1" aria-labelledby="meetModalLabel" aria-hidden="true">
<div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h2 id="meetHeader">Meetups</h2>

                    </div>
                    <div class="modal-body">
            <table id="meetTable" class="table align-middle">
                <thead class="bg-light">
                    <tr>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="meetupsTableBody">
                    <td id="meetDate"></td>
                    <td id="meetTime"></td>
                    <td id="meetDescription"></td>
                   <td id="meetStatus"></td>
<td id="meetActions">
    <button class="btn btn-success accept-button" >Accept</button>
    <button class="btn btn-danger decline-button" >Decline</button>
</td>

                </tbody>
            </table>
                </div>
            </div>
        
</div>
</div>
@php
    function getStatusBadgeClass($status) {
        switch ($status) {
            case 'refused':
                return 'bg-danger';
            case 'pending':
                return 'bg-warning';
            case 'completed':
                return 'bg-success';
           
        }
    }
    @endphp
    <script>
    // Attach a click event handler to a common parent element using event delegation
    $(document).on('click', '.edit-button', function () {
        // Retrieve the prepositionId from the data attribute
        var prepositionId = $(this).data('preposition-id');
        
        // Call the updateProposition function with the prepositionId
        updateProposition(prepositionId);
    });

    function updateProposition(prepositionId) {
        // Assuming you have a function to fetch form data and send an AJAX request
        var formData = getFormData('editForm' + prepositionId);

        // Perform an AJAX request to update the proposition
        $.ajax({
            url: '/update-proposition/' + prepositionId,
            method: 'POST',
            data: formData,
            success: function (response) {
                // Handle success response

                // Optionally, close the modal after a successful update
                $('#editModal' + prepositionId).modal('hide');
                location.reload();
            },
            error: function (error) {
                // Handle error response
                console.error(error);
            }
        });
    }

    function getFormData(formId) {
        var formData = $('#' + formId).serializeArray();
        var result = {};

        formData.forEach(function (item) {
            result[item.name] = item.value;
        });

        return result;
    }

    $(document).on('click', '.delete-button', function () {
        // Retrieve the prepositionId from the data attribute
        var prepositionId = $(this).data('preposition-id');

        // Call the deleteProposition function with the prepositionId
        deleteProposition(prepositionId);
    });

    function deleteProposition(prepositionId) {
        // Perform an AJAX request to delete the proposition
        $.ajax({
            url: '/delete-proposition/' + prepositionId,
            method: 'DELETE',
            success: function (response) {
                // Handle success response
                location.reload();

                // Optionally, perform additional actions after a successful delete
            },
            error: function (error) {
                // Handle error response
                console.error(error);
            }
        });
    }
    var descriptionData;
    $(document).on('click', '.meet-button', function () {
        descriptionData=$(this).data('meet');
            console.log(descriptionData);
            var meetDescription=descriptionData.description;
            var meetDate=descriptionData.date;
            var meetTime=descriptionData.time;
            var meetStatus=descriptionData.status;
            // add data to table meet 
            $('#meetDescription').text(meetDescription);
            $('#meetDate').text(meetDate);
            $('#meetTime').text(meetTime);
            $('#meetStatus').text(meetStatus);
            if(descriptionData.status=="accepted"){
                $('#meetActions').hide();
            }
            if(!descriptionData){
            $('#meetDescription').empty();
            $('#meetDate').empty();
            $('#meetTime').empty();
            $('#meetStatus').empty();
            }
    });
    //meet accept/decline 
$(document).on('click', '.accept-button', function () {
    var meetId = descriptionData.id;
    updateMeetStatus(meetId, 'accepted');
});

$(document).on('click', '.decline-button', function () {
    var meetId = descriptionData.id;
    updateMeetStatus(meetId, 'refused');
});

function updateMeetStatus(meetId, status) {
    // Perform an AJAX request to update the meet status
    $.ajax({
        url: '/update-meet-status/' + meetId,
        method: 'POST',
        data: { status: status },
        success: function (response) {
            // Handle success response

            // Optionally, reload the page or update the UI
            location.reload();
        },
        error: function (error) {
            // Handle error response
            console.error(error);
        }
    });
}

</script>

@endsection