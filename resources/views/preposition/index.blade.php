<script type="module" >

    import Echo from '../../../laravel-echo';

    import Pusher from '../../../pusher-js';
    window.Pusher = Pusher;
    const csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;
    const userId = document.head.querySelector('meta[name="userId"]').content;

    window.Echo = new Echo({
        broadcaster: 'pusher',
        key: import.meta.env.VITE_PUSHER_APP_KEY,
        cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER ?? 'mt1',
        forceTLS: true,
        encrypted: true,
        auth: {
            headers: {
                Authorization: 'Bearer ' + csrfToken
            },
        },

    });
</script>
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
        <table class="table align-middle mt-4 mb-0 bg-white">
            <thead class="bg-light">
                <tr>
                <th>Proposition</th>
                <th>Offre</th>
                <th>Valeur</th>
                <th>Prix </th>
                <th>Contrepartie</th>
                <th>Statut</th>
                <th>Rencontre</th>
                <th>Chat</th>
                <th>Validation</th>
                </tr>
            </thead>
            <tbody>
                @php 
                    if(count($prepositions)) $prep = $prepositions[0];
                    else  $prep = null;
                @endphp
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
                        <td  style="background-color : WhiteSmoke; border-bottom : 0"></td>
                        <td nowrap  style="background-color : WhiteSmoke; border-bottom : 0" class="preposition-uuid">
                            <a type="button" href="#" style="color: #24a19c;">
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
                            @if($preposition->meetup)
                            <a type="button" data-meet="{{ $preposition->meetup }}" id="meet" class="btn meet-button " data-bs-toggle="modal" data-bs-target="#meetModal">
                            <i class="fas fa-calendar" style="color: #24a19c;"></i>
                            </a>
                            @else 
                            <span>Aucune rencontre</span>
                            @endif
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
                              $isButton=null;
                              $validation_text=null;
                                if($preposition->validation == 'none'){
                                    if($preposition->status != 'Rejetée'){
                                        $validation_text = $isReceiveid ? 'Valider la proposition' : 'En attente de validation';
                                        $isButton = $isReceiveid ? true : false; 
                                    }else{
                                        $validation_text =  'La proposition a été rejetée';
                                        $isButton = false; 
                                    }
                                }
                                else if($preposition->validation == 'validated'){
                                    $validation_text = $isReceiveid ? 'En attente de confirmation' : 'Confirmer la proposition';
                                    $isButton = $isReceiveid ? false : true; 
                                }
                                else if($preposition->validation == 'confirmed'){
                                    $transaction = $preposition->transaction;
                                    if(auth()->id() == $preposition->user->id){
                                        if($transaction->applicant_status == 'En cours'){
                                            $validation_text = 'Valider la transaction' ;
                                            $isButton = true ; 
                                        }else{
                                            $validation_text = 'En attente de validation' ;
                                            $isButton = false ;  
                                        }
                                    } else {
                                        if($transaction?->offeror_status == 'En cours'){
                                            $validation_text = 'Valider la transaction' ;
                                            $isButton = true ; 
                                        }else{
                                            $validation_text = 'En attente de validation' ;
                                            $isButton = false ;  
                                        }
                                    } 
                                }else{// confirmedTransaction
                                    $isButton = false ;  
                                    $validation_text = 'Transaction completée' ;
                                    $transaction = $preposition->transaction;
                                    if($transaction?->offeror_status == 'Réussi' && $transaction->applicant_status == 'Réussi'){
                                        $validation_text = 'Transaction completée' ;
                                    }else{
                                        $validation_text = 'Transaction rejetée' ;
                                    }
                                }
                              @endphp 
                              
                              @if($isButton)
                              <div class="col-span-full d-flex items-center justify-center">
                                @if($preposition->validation == 'none')
                                <a class="inline-block px-4 py-2 text-black text-decoration-none rounded transition duration-300 ease-in-out" style="background-color: #24a19c;" href="#" 
                                    data-bs-toggle="modal" data-bs-target="#propositionValidationModal-{{$preposition->id}}">{{$validation_text}}</a>
                                @elseif($preposition->validation == 'validated')
                                <a class="inline-block px-4 py-2 text-black text-decoration-none rounded transition duration-300 ease-in-out" style="background-color: #24a19c;" href="#" 
                                    data-bs-toggle="modal" data-bs-target="#propositionConfirmationModal-{{$preposition->id}}">{{$validation_text}}</a>
                                @elseif($preposition->validation == 'confirmed')
                                <a class="inline-block px-4 py-2 text-black text-decoration-none rounded transition duration-300 ease-in-out" style="background-color: #24a19c;" 
                                    href="{{route('transactions.index')}}" >{{$validation_text}}</a>
                                @endif
                              </div>                              
                              @else
                                <span>{{$validation_text}}</span>
                              @endif
                               <div>
                                   <x-preposition-validation-modal :preposition=$preposition></x-preposition-validation-modal>
                                   <x-preposition-confirmation-modal :preposition=$preposition></x-preposition-confirmation-modal>
                               </div> 
                        </td>
                    </tr>
                    <script type="module">
                        window.Echo.private('propositions.'+{{$preposition->id}})
                        .listen('PropositionStatusUpdate', (e) => {
                            console.log(e.proposition);
                            location.reload();
                        });
                    </script>
                @endforeach
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
