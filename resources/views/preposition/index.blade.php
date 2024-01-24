
<x-app-layout>
<div class="container">    
    <div class="flex space-x-4 mt-4">
        <div class="pe-4" style="{{ !(request()->has('in_progress')) || request()->input('in_progress')==1 ?  'border-bottom: 2px solid #24a19c' : ''}}">
            <a href="{{route('propositions.index', ['in_progress'=>1])}}" class="text-gray-600 hover:text-gray-800 no-underline focus:outline-none focus:text-gray-800 transition duration-300 ease-in-out">In Progress</a>
        </div>
        <div class="pe-6" style="{{ !(request()->has('in_progress')) || request()->input('in_progress')==1 ? '' : 'border-bottom: 2px solid #24a19c' }}">
            <a href="{{route('propositions.index', ['in_progress'=>0])}}" class="text-gray-600 hover:text-gray-800 no-underline focus:outline-none focus:text-gray-800 transition duration-300 ease-in-out">All</a>
        </div>
    </div>
        <table class="table align-middle  mt-4 mb-0 bg-white">
            <thead class="bg-light">
                <tr>
                <th>Proposition</th>
                <th>Offre</th>
                <th>Valeur</th>
                <th>Prix </th>
                <th>Contrepartie</th>
                <th>Statut</th>
                <th>Chat</th>
                <th>Validation</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($prepositions as $preposition)
                    @php 
                    $isReceiveid= $preposition->offer->user==auth()->user();
                    if($isReceiveid) $counterparty = $preposition->user; 
                    else $counterparty = $preposition->offer->user;
                    @endphp
                    <tr  style="background-color : WhiteSmoke">
                        <td style="background-color : WhiteSmoke; border-bottom : 0"><span class="text-{{ $isReceiveid? 'red' : 'green'}}-600 font-bold text-xs">{{ $isReceiveid? 'Receiveid' : 'Sent'}}</span></td>
                        <td  style="background-color : WhiteSmoke; border-bottom : 0">
                            <span class="text-xs">{{ Carbon\Carbon::parse($preposition->created_at)->format('Y-m-d H:i:s'); }}</span>
                        </td>
                        <td  style="background-color : WhiteSmoke; border-bottom : 0"></td>
                        <td  style="background-color : WhiteSmoke; border-bottom : 0"></td>
                        <td  style="background-color : WhiteSmoke; border-bottom : 0"></td>
                        <td  style="background-color : WhiteSmoke; border-bottom : 0"></td>
                        <td  style="background-color : WhiteSmoke; border-bottom : 0"></td>
                        <td nowrap  style="background-color : WhiteSmoke; border-bottom : 0" class="preposition-uuid">
                            <a type="button" href="{{route('propositions.show',$preposition->id)}}" style="color: #24a19c;">
                                <span class="text-xs" >{{$preposition->uuid}}</span>
                            </a>
                            <i class="fa fa-copy" style="color: #24a19c;" data-preposition-uuid="{{ $preposition->uuid }}" data-bs-toggle="tooltip" data-bs-placement="left" title="Copy"></i>     
                        </td>
                    </tr>
                    <tr>
                        <td id="prepositioName-{{$preposition->id}}">
                            <img src="{{ route('proposition-pictures-file-path',$preposition->images ?$preposition->images :'' ) }}" alt=""/>
                            @livewire('split-long-text ', [
                                'text' => $preposition->name,
                                'parentClass' => '#prepositioName-'.$preposition->id,
                                ])
                        </td>
                        <td id="prepositionOfferName-{{$preposition->id}}">
                            @livewire('split-long-text ', [
                                'text' => $preposition->offer_name,
                                'parentClass' => '#prepositionOfferName-'.$preposition->id,
                                ])
                        </td>
                        <td>{{ $preposition->offer->price}}</td>
                        <td>{{ $preposition->price }}</td>
                        <td>
                            <a type="button" class="btn  chat-button" href="{{route('profile.showProfile',$counterparty->id)}}">
                                <span style="color: #24a19c;">
                                {{ $counterparty->first_name . ' ' . $counterparty->last_name }}
                                </span>
                            </a>
                        </td>
                        <td>
                            <span class="badge {{ getStatusBadgeClass($preposition->status) }} rounded-pill d-inline">
                                {{ $preposition->status }}
                            </span>
                        </td>
           
                        <td>
                            <div class="flex">
                                <!-- Chat button with icon -->
                                <a type="button" class="btn  chat-button" href="{{route('propositions.chat',$preposition->id)}}">
                                    <span style="color: #24a19c;">Contact</span>
                                </a>
                            </div>
                            
                        </td>
                        <td>
                              @php
                                if($preposition->validation == 'none'){
                                    $validation_text = $isReceiveid ? 'Valider la proposition' : 'En attente de validation';
                                    $isButton = $isReceiveid ? true : false; 
                                }
                                else if($preposition->validation == 'validated'){
                                    $validation_text = $isReceiveid ? 'En attente de confirmation' : 'Confirmer la proposition';
                                    $isButton = $isReceiveid ? false : false; 
                                }
                                else if($preposition->validation == 'confirmed'){
                                    $validation_text = $isReceiveid ? 'Valider la transaction' : 'Valider la transaction';
                                    $isButton = $isReceiveid ? true : true; 
                                }else{
                                    $validation_text = $isReceiveid ? 'Valider la proposition' : 'En attente de validation';
                                    $isButton = $isReceiveid ? true : false; 
                                }
                              @endphp 
                              
                              @if($isButton)
                              <div class="col-span-full d-flex items-center justify-center">
                                <a class="inline-block px-4 py-2 text-black text-decoration-none rounded transition duration-300 ease-in-out" style="background-color: #24a19c;" href="#" data-bs-toggle="modal" data-bs-target="#exampleModal">{{$validation_text}}</a>
                              </div>                              
                              @else
                                <span>{{$validation_text}}</span>
                              @endif
                                
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg"> <!-- Set modal-lg class for larger width -->
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Offre</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                    </div>
                    <div class="modal-body">
                        <div id="modalbox"></div>
                        <div class="w-full text-xs text-red-600">(*) Si vous acceptez cette proposition, vous ne pourrez plus accepter d'autres propositions liées a cette offre, à moins ce que la contrepartie ne confirme pas la proposition</div>

                        <table class="table align-middle mb-0 bg-white">
                            <thead class="bg-light">
                                <tr>
                                    <th>Nom</th>
                                    <th>Statut</th>
                                    <th>Image</th>
                                    <th>Utilisateur</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td id="modalName"></td>
                                    <td id="modalStatus"></td>
                                    <td> <img id="modalImage" src="" class="modalzoomD" style="max-width:200px;" alt="Image"> </td>
                                    <td id="modalUser"></td>
                                    <td>
                                        <button type="button" class="btn btn-success" id="acceptButton" data-bs-dismiss="modal" aria-label="Fermer">
                                            Accepter
                                        </button>
                                        <button type="button" class="btn btn-danger" id="declineButton" data-bs-dismiss="modal" aria-label="Fermer">
                                            Refuser
                                        </button>
                                        <button type="button" class="btn btn-primary m-1" id="meetButton">
                                            <i class="fa fa-calendar"></i> Ajouter un rendez-vous
                                        </button>

                                        <a href="{{route('propositions.chat-sender',['prepositionId' => 'PROPOSITION_ID_PLACEHOLDER'] )}}" type="button" class="btn btn-primary m-1" id="chatButton">
                                            <i class="fas fa-comment"></i> Chat
                                        </a>

                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <h2 id="meetHeader">Rendez-vous</h2>
                        <table id="meetTable" class="table align-middle">
                            <thead class="bg-light">
                                <tr>
                                    <th>Date</th>
                                    <th>Heure</th>
                                    <th>Description</th>
                                    <th>Statut</th>
                                </tr>
                            </thead>
                            <tbody id="meetupsTableBody">
                                <td id="meetDate"></td>
                                <td id="meetTime"></td>
                                <td id="meetDescription"></td>
                                <td id="meetStatus"></td>
                            </tbody>
                        </table>
                        <form id="meetupForm">
                            @csrf
                            <input type="hidden" id="prepositionId" name="prepositionId" value="">
                            <div class="mb-3">
                                <label for="meetupDate" class="form-label">Date du rendez-vous</label>
                                <input type="date" class="form-control" id="meetupDate" name="meetupDate" required>
                            </div>
                            <div class="mb-3">
                                <label for="meetupTime" class="form-label">Heure du rendez-vous</label>
                                <input type="time" class="form-control" id="meetupTime" name="meetupTime" required>
                            </div>
                            <div class="mb-3">
                                <label for="meetupDescription" class="form-label">Description du rendez-vous</label>
                                <textarea class="form-control" id="meetupDescription" name="meetupDescription" rows="3" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Planifier le rendez-vous</button>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                    </div>
                </div>
            </div>
        </div>
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
                $('#validModal' + prepositionId).modal('hide');
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

    
    $(document).on('click', '.preposition-uuid i', function () {
        var prepositionUuid = $(this).data('preposition-uuid');
        navigator.clipboard.writeText(prepositionUuid);
        $(this).attr('title', 'Copied');
        setTimeout(function() {
            $('.preposition-uuid i').attr('title', 'Copy');
        }, 3000);

    });




</script>
