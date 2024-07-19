
<x-app-layout>
<div class="container">
        <table class="table align-middle mb-0 bg-white mt-4">
            <thead class="bg-light">
                <tr>
                <th>Type</th>
                <th>Proposition</th>
                <th>Prix</th>
                <th>Statut</th>
                <th>Contrepartie</th>
                <th>Offre</th>
                <th>Rencontre</th>
                <th>Actions</th>
                <th>Dispute</th>
                </tr>
            </thead>
            <tbody>
                    @php 
                        $isReceiveid= $preposition->offer->user==auth()->user();
                    @endphp
                    <tr >
                        <td><span class="text-{{ $isReceiveid? 'red' : 'green'}}-600 font-bold">{{ $isReceiveid? 'Réçu' : 'Envoyé'}}</span></td>
                        <td id="prepositioName-{{$preposition->id}}">
                            <img src="{{ route('proposition-pictures-file-path',$preposition->images ?$preposition->images :'' ) }}" alt=""/>
                            @livewire('split-long-text ', [
                                'text' => $preposition->name,
                                'parentClass' => '#prepositioName-'.$preposition->id,
                                ])
                        </td>
                        <td>{{ $preposition->price }}</td>
                        <td ><span class="badge {{ getStatusBadgeClass($preposition->status) }} rounded-pill d-inline">
                            {{ $preposition->status }}
                        </span></td>
           
                        <td>
                        {{ $isReceiveid? $preposition->user->name  : $preposition->offer->user->name}}
                        </td>
                        <td id="prepositionOfferName-{{$preposition->id}}">
                            @livewire('split-long-text ', [
                                'text' => $preposition->offer_name,
                                'parentClass' => '#prepositionOfferName-'.$preposition->id,
                                ])


                        </td>
                        <td>@if($preposition->meetup)
                            <a type="button" data-meet="{{ $preposition->meetup }}" id="meet" class="btn meet-button " data-bs-toggle="modal" data-bs-target="#meetModal">
                            <i class="fas fa-calendar" style="color: #24a19c;"></i>
                            </a>
                            @endif
                        </td>
                        <td>
                            <div class="flex">
                                <!-- Chat button with icon -->
                                <a type="button" class="btn  chat-button" href="{{route('propositions.chat',$preposition->id)}}">
                                    <i class="fas fa-comment-dots" style="color: #24a19c;"></i>
                                </a>
                                <!-- Edit button with icon --> @if($preposition->status!='Acceptée')
                                <a type="button" class="btn edit-button" data-bs-toggle="modal" data-bs-target="#editModal{{ $preposition->id }}">
                                    <i class="fas fa-edit" style="color: #ffc107;"></i>
                                </a>@endif
                            </div>
                            
                        </td>
                        <td>
                            <button type="button" class="btn appeal-button text-center">
                                @if($preposition->status!='Acceptée')
                                <span>Pas encore acceptée</span>
                                @elseif(!$preposition->appealed)
                                <span class="appeal badge bg-secondary rounded-pill" data-preposition-id="{{ $preposition->id }}" data-preposition-name="{{ $preposition->name }}">Faire Appel</span>
                                @else
                                <span class="appealing badge bg-danger rounded-pill" data-preposition-id="{{ $preposition->id }}" data-preposition-name="{{ $preposition->name }}">Appel en cours</span>
                                @endif
                            </button>                            
                        </td>
                    </tr>
                    <div class="modal fade" id="editModal{{ $preposition->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $preposition->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel{{ $preposition->id }}">Modifier la proposition</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Your edit form goes here -->
                        <!-- Use {{ $preposition->id }} to identify the proposition being edited -->
                        <form id="editForm{{ $preposition->id }}">
                            @csrf
                            <div class="mb-3">
                                <label for="editName" class="form-label">Nom de la proposition</label>
                                <input type="text" class="form-control" id="editName" name="name" value="{{ $preposition->name }}">
                            </div>
                            <div class="mb-3">
                                <label for="editNegotiation" class="form-label">Negotiation</label>
                                <textarea class="form-control" id="editNegotiation" name="negotiation">{{ $preposition->negotiation }}</textarea>
                            </div>
                            <!-- Add other form fields as needed -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                        <button type="button" class="btn btn-primary edit-button" data-preposition-id="{{ $preposition->id }}">
    Save changes
</button>
                    </div></form>
                </div>
            </div>
        </div>
</div>

            </tbody>
        </table>
    </div>
    
    <div class="modal fade" id="meetModal" tabindex="-1" aria-labelledby="meetModalLabel" aria-hidden="true">
        <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h2 id="meetHeader">Rencontres</h2>

                            </div>
                            <div class="modal-body">
                    <table id="meetTable" class="table align-middle">
                        <thead class="bg-light">
                            <tr>
                            <th>Date</th>
        <th>Heure</th>
        <th>Description</th>
        <th>Statut</th>
        <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="meetupsTableBody">
                            <td id="meetDate"></td>
                            <td id="meetTime"></td>
                            <td id="meetDescription"></td>
                            <td id="meetStatus"></td>
                            <td id="meetActions">
                                <button class="btn btn-success accept-button" >Accepter</button>
                                <button class="btn btn-danger decline-button" >Refuser</button>
                            </td>

                </tbody>
            </table>
                </div>
            </div>
        
</div>
</div>
    <h3>Commentaires</h3>
    <h6>Mes commentaires</h6>
    <h6>Commentaire de la contrepartie</h6>
    @php 
    $rating=App\Models\Rating::where('user_id', Auth::user()->id)
    ->where('rated_by_user_id',$preposition->user_id)->first();
    @endphp 
    <button type="button" class="btn rating-button text-center">
        @if($preposition->status!='Acceptée')
        <span>Indisponible car la proposition n'a pas encore été confirmée</span>
        @elseif(!$rating || $rating->stars==0 || $rating->preposition_id!=$preposition->id)
        <span class="rate badge bg-secondary rounded-pill" data-preposition-id="{{ $preposition->id }}" data-preposition-name="{{ $preposition->name }}">Notez</span>
        @else
        @for ($i =1; $i <= 5; $i++)
            <input type="radio" id="star{{$i}}" name="rating" value="{{$i}}" class="hidden rate" data-preposition-id="{{ $preposition->id }}" data-preposition-name="{{ $preposition->name }}"/>
            <label for="star{{$i}}" title="{{$i}} star" class="cursor-pointer text-2xl text-yellow-500 rate" data-preposition-id="{{ $preposition->id }}" data-preposition-name="{{ $preposition->name }}">
                @if($rating->stars>=$i)
                &#9733;
                @else
                &#9734;
                @endif
            </label>
        @endfor               

        @endif
    </button>
</x-app-layout>
@php
    function getStatusBadgeClass($status) {
        switch ($status) {
            case 'Rejetée':
                return 'bg-danger';
            case 'En cours':
                return 'bg-warning';
            case 'Acceptée':
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
            if(descriptionData.status=="Confirmé"){
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
    updateMeetStatus(meetId, 'Confirmé');
});

$(document).on('click', '.decline-button', function () {
    var meetId = descriptionData.id;
    updateMeetStatus(meetId, 'Annulé');
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
function ratePropositionCounterparty(propositionId,propositionName) {
    Swal.fire({
        title: 'Proposition '+propositionName,
        html: '<div class="flex items-center justify-center space-x-2">' +
        '<input type="radio" id="star1" name="rating" value="1" class="hidden" /><label for="star1" title="1 star" class="cursor-pointer text-2xl text-yellow-500">&#9734;</label>' +
        '<input type="radio" id="star2" name="rating" value="2" class="hidden" /><label for="star2" title="2 stars" class="cursor-pointer text-2xl text-yellow-500">&#9734;</label>' +
        '<input type="radio" id="star3" name="rating" value="3" class="hidden" /><label for="star3" title="3 stars" class="cursor-pointer text-2xl text-yellow-500">&#9734;</label>' +
        '<input type="radio" id="star4" name="rating" value="4" class="hidden" /><label for="star4" title="4 stars" class="cursor-pointer text-2xl text-yellow-500">&#9734;</label>' +
        '<input type="radio" id="star5" name="rating" value="5" class="hidden" /><label for="star5" title="5 stars" class="cursor-pointer text-2xl text-yellow-500">&#9734;</label>' +
        '</div>' +
            '<div id="feedback-container" style="display:none">' +
            '<textarea id="feedback" name="feedback" class="swal2-textarea" rows="4" cols="35" placeholder="Give Feedback"></textarea>' +
            '</div>',
        showCancelButton: true,
        confirmButtonText: 'Rate',
        cancelButtonText: 'Cancel',
        showLoaderOnConfirm: true,
        preConfirm: (result) => {
        const rating=document.querySelector('input[name="rating"]:checked');
        const ratingValue = rating? rating.value:0;
        const feedbackValue = document.getElementById('feedback').value;
        return fetch('/ratings/rateOfferCounterParty', {
            method: 'POST',
            headers: {
            'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                propositionId: propositionId,
                stars: ratingValue,
                feedback: feedbackValue,
                _token: '{{csrf_token()}}'
            }),
        })
            .then((response) => {
            if (!response.ok) {
                throw new Error('Failed to submit rating');
            }
            return response.json();
            })
            .catch((error) => {
            Swal.showValidationMessage(`Request failed: ${error}`);
            });
        },
        didOpen: () => {
        const stars = document.querySelectorAll('input[name="rating"]');
        stars.forEach((star) => {
            star.addEventListener('click', () => {
                stars.forEach((starAll) => {
                    starAll.nextElementSibling.innerHTML = '&#9734;'; // Empty star
                });
                stars.forEach((starInf) => {
                    if (starInf.value <= star.value) {
                        starInf.nextElementSibling.innerHTML = '&#9733;'; // Filled star
                    }
                });

                const feedback=document.getElementById('feedback-container');
                feedback.style.display="block";

            });

        });
        },
    }).then(function () {
                    location.reload();
                });

                
}
function appealProposition(propositionId,propositionName) {
    Swal.fire({
        title: 'Proposition '+propositionName,
        html: '<div class="flex justify-start">' +
        '<input id="dispute-title" name="title" class="swal2-input ms-auto w-full"  placeholder="Title">' +
        '</div>' +
            '<div id="flex justify-start description-container">' +
            '<textarea id="dispute-description" name="description" class="swal2-textarea ms-auto w-full" rows="4"  placeholder="Give description"></textarea>' +
            '</div>',
        showCancelButton: true,
        confirmButtonText: 'Appeal',
        cancelButtonText: 'Cancel',
        showLoaderOnConfirm: true,
        preConfirm: (result) => {
        const titleValue = document.getElementById('dispute-title').value;
        const descriptionValue = document.getElementById('dispute-description').value;
        return fetch('/proposition/dispute/'+propositionId, {
            method: 'POST',
            headers: {
            'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                title: titleValue,
                description: descriptionValue,
                _token: '{{csrf_token()}}'
            }),
        })
            .then((response) => {
            if (!response.ok) {
                throw new Error('Failed to submit dispute');
            }
            return response.json();
            })
            .catch((error) => {
            Swal.showValidationMessage(`Request failed: ${error}`);
            });
        },
    }).then(function () {
                    location.reload();
                });

                
}
    $(document).on('click', '.rating-button .rate', function () {
        // Retrieve the prepositionId from the data attribute
        var prepositionId = $(this).data('preposition-id');
        var prepositionName = $(this).data('preposition-name');
        
        // Call the updateProposition function with the prepositionId
        ratePropositionCounterparty(prepositionId,prepositionName);
    });
    
    $(document).on('click', '.appeal-button .appeal', function () {
        // Retrieve the prepositionId from the data attribute
        var prepositionId = $(this).data('preposition-id');
        var prepositionName = $(this).data('preposition-name');
        
        // Call the updateProposition function with the prepositionId
        appealProposition(prepositionId,prepositionName);
    });





</script>
