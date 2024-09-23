<x-app-layout>
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
    <div class="container px-0">    
    <div class="container my-2 top-first">
        <nav style="--bs-breadcrumb-divider: '>'" aria-label="breadcrumb">
            <ol class="breadcrumb" class="no-underline bg-green-500 ">
                <li class="breadcrumb-item active" aria-current="page">{{ Diglactic\Breadcrumbs\Breadcrumbs::render('propositionsall') }}</li>
            </ol>
        </nav>
    </div>   
    <style>
    @media (max-width: 768px) {
  .top-first{
    margin-top: 100px !important;
  }
}</style>
    <div class="flex justify-center">
   </div>
        <div class="flex space-x-4 mt-4 mx-2">
    <div class="pe-4" style="{{ !(request()->has('in_progress')) || request()->input('in_progress')==1 ?  'border-bottom: 2px solid #24a19c' : ''}}">
        <a href="{{ route('propositions.index', array_merge(request()->query(), ['in_progress' => 1])) }}" class="text-gray-600 hover:text-gray-800 no-underline focus:outline-none focus:text-gray-800 transition duration-300 ease-in-out">En cours</a>
    </div>
    <div class="pe-6" style="{{ !(request()->has('in_progress')) || request()->input('in_progress')==1 ? '' : 'border-bottom: 2px solid #24a19c' }}">
        <a href="{{ route('propositions.index', array_merge(request()->query(), ['in_progress' => 0])) }}" class="text-gray-600 hover:text-gray-800 no-underline focus:outline-none focus:text-gray-800 transition duration-300 ease-in-out">Tous</a>
    </div>
</div>

        @if((request()->has('in_progress')) && request()->input('in_progress')==0 )
        <form action="{{ route('propositions.index', ['in_progress'=>0]) }}" method="GET">
            <input type="text" name="in_progress" id="in_progress" value="0" hidden />
            <div class="mx-1 my-4 grid md:grid-cols-4 grid-cols-1 md:gap-4 gap-1">
                <style>
                    @media (max-width: 768px) {
                        input, select{
                            font-size: 0.75rem !important;
                        }
                    }
                </style>
                <div class="">
                    <select name="status" id="filterStatus" class="md:w-1/2 mt-1 p-2 border rounded-md" style="width: 200px;" onchange="this.form.submit()">
                        <option value="">Tous les status</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>
                            pending
                        </option>
                        <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>
                            rejected
                        </option>
                        <option value="accepted" {{ request('status') == 'accepted' ? 'selected' : '' }}>
                            accepted
                        </option>
                    </select>
                    
                </div>
                <div class=" border py-1 w-4/5">
                    <div class="px-2">
                        <input type="date" class="form-control" id="start_date" name="start_date" value="{{ request('start_date')?? \Carbon\Carbon::now()->subMonths(6)->toDateString() }}" onchange="this.form.submit()">
                    </div>
                    <div class="px-2">
                        <input type="date" class="form-control" id="end_date" name="end_date" value="{{ request('end_date')?? now()->toDateString() }}" onchange="this.form.submit()">
                    </div>
        
                </div>
                <div class="">
                    <input type="text" name="number_prop" value="{{ request('number_prop')}}" class=" mt-1 p-2 border rounded-md" placeholder="N° proposition">
                    
                    <button type="submit" class="ml-2 text-blue-500 hover:text-blue-700">
                        <i class="fa fa-search" aria-hidden="true"></i>
                    </button>
                </div>
                <div class="">
                    <input type="text" name="name_offer" value="{{ request('name_offer') }}" class="mt-1 p-2 border rounded-md" placeholder = "Nom de l'offre">
                    
                    <button type="submit" class="ml-2 text-blue-500 hover:text-blue-700">
                        <i class="fa fa-search" aria-hidden="true"></i>
                    </button>
                </div>
            </div>
        </form>
        @endif
        <div class="overflow-x-auto">
    <table class="table-auto w-full bg-white mt-4 mb-0">
        <thead class="bg-gray-800 text-white">
            <tr>
            <th class="px-4 py-2 text-left">Proposition</th>
                <th class="px-4 py-2 text-left">Image</th>
                <th class="px-4 py-2 text-left">Action</th>
                <th class="px-4 py-2 text-left">Validation</th>
            </tr>
        </thead>
        <tbody>
            @php 
                if(count($prepositions)) $prep = $prepositions[0];
                else $prep = null;
            @endphp
            @foreach ($prepositions as $preposition)
            @if ($preposition->offer && $preposition->offer->user)
                @php 
                $isReceiveid = $preposition->offer->user == auth()->user();
                if ($isReceiveid) $counterparty = $preposition->user; 
                else $counterparty = $preposition->offer->user;
                $images = $preposition->propositionImages;
                @endphp
                <tr class="odd:bg-gray-100 even:bg-white">
                  
                <td class="px-4 py-2" id=" prepositioName-{{$preposition->id}}">
                <span class="font-semibold">Nom :</span>  {{$preposition->name}} 

                        <a class="no-underline font-medium hidden md:block text-sm md:text-base" style="color:#14B6A8"
                           href="{{ route('offer.offer', [$preposition->offer->id, $preposition->offer->slug]) }}">
                           <span class="font-semibold" style="color:#717171">Offre :</span> {{ $preposition->offer_name }}
                        </a>
                        <div> <span class="font-semibold">Prix :</span> {{ $preposition->offer->price }}</div>
                        <div> <span class="font-semibold">Valeur :</span> {{ $preposition->price }}</div>
                        <div> <span class="font-semibold">Contrepartie :</span>
                            <a type="button" class="btn chat-button"
                               href="{{ route('profile.showProfile', $counterparty->id) }}">
                                <span class="text-teal-500">{{ $counterparty->name }}</span>
                            </a>
                        </div>
                        <span class="badge {{ getStatusBadgeClass($preposition->status) }} rounded-pill d-inline">
                            {{ $preposition->status }}
                        </span>
                    </td>
                    <td class="p-2">
                        <div class="flex space-x-2 overflow-x-auto scrollbar-thin">
                            @foreach ($images as $img)
                                <img src="{{ $img->photo_path_type == 'proposition' ? route('proposition-pictures-file-path', $img->proposition_photo) : route('offer-pictures-file-path', $img->proposition_photo) }}"
                                     alt="Image produit" class="h-20 w-24 object-cover rounded-lg" />
                            @endforeach

                        </div>
                    </td>
                    <td class="px-4 py-2">
                        @if($preposition->meetup)
                            <a type="button" data-meet="{{ $preposition->meetup }}" id="meet" class="btn meet-button">
                                <i class="fas fa-calendar text-teal-500"></i>
                            </a>
                            @if($preposition->status != "pending")
                                <a class="inline-block btn btn-primary" href="#" style="background-color:var(--primary-color);border-color:var(--primary-color)"
                                   data-bs-toggle="modal" data-bs-target="#meetModal-{{$preposition->id}}">Modifier</a>
                            @endif
                        @else 
                            <a class="inline-block btn btn-primary" href="#" style="background-color:var(--primary-color);border-color:var(--primary-color)"
                               data-bs-toggle="modal" data-bs-target="#meetModal-{{$preposition->id}}">Planifier</a>
                        @endif
                        <a type="button" class="btn chat-button" href="{{ route('propositions.chat', $preposition->id) }}">
                            <span class="text-teal-500">Contact</span>
                        </a>
                    </td>
                    <td class="px-4 py-2">
                        @php
                        $isReceiveid = $preposition->offer->user == auth()->user();
                        $validation_text = null;
                        $isButton = null;
                        if (!$preposition->validation || $preposition->validation == 'none') {
                            if ($preposition->status != 'Rejetée') {
                                $validation_text = $isReceiveid ? 'Valider la proposition' : 'En attente de validation';
                                $isButton = $isReceiveid ? true : false; 
                            } else {
                                $validation_text = 'La proposition a été rejetée';
                                $isButton = false; 
                            }
                        } else if ($preposition->validation == 'validated') {
                            $validation_text = $isReceiveid ? 'En attente de confirmation' : 'Confirmer la proposition';
                            $isButton = $isReceiveid ? false : true; 
                        } else if ($preposition->validation == 'confirmed') {
                            $transaction = $preposition->transaction;
                            if (auth()->id() == $preposition->user->id) {
                                if ($transaction->applicant_status == 'En cours') {
                                    $validation_text = 'Valider la transaction';
                                    $isButton = true; 
                                } else {
                                    $validation_text = 'En attente de validation';
                                    $isButton = false;  
                                }
                            } else {
                                if ($transaction?->offeror_status == 'En cours') {
                                    $validation_text = 'Valider la transaction';
                                    $isButton = true; 
                                } else {
                                    $validation_text = 'En attente de validation';
                                    $isButton = false;  
                                }
                            } 
                        } else { // confirmedTransaction
                            $isButton = false;  
                            $validation_text = 'Transaction complétée';
                            $transaction = $preposition->transaction;
                            if ($transaction?->offeror_status == 'Réussi' && $transaction->applicant_status == 'Réussi') {
                                $validation_text = 'Transaction complétée';
                            } else {
                                $validation_text = 'Transaction rejetée';
                            }
                        }
                        @endphp 
                        @if($isButton)
                            <div class="col-span-full d-flex items-center justify-center">
                                @if(!$preposition->validation || $preposition->validation == 'none')
                                    <a class="inline-block px-3 py-2 text-black no-underline text-center bg-teal-500 rounded transition duration-300 ease-in-out"
                                       href="#" data-bs-toggle="modal" data-bs-target="#propositionValidationModal-{{$preposition->id}}">{{ $validation_text }}</a>
                                @elseif($preposition->validation == 'validated')
                                    <a class="inline-block px-3 py-2 text-black no-underline text-center bg-teal-500 rounded transition duration-300 ease-in-out"
                                       href="#" data-bs-toggle="modal" data-bs-target="#propositionConfirmationModal-{{$preposition->id}}">{{ $validation_text }}</a>
                                @elseif($preposition->validation == 'confirmed')
                                    <a class="inline-block px-3 py-2 text-black no-underline text-center bg-teal-500 rounded transition duration-300 ease-in-out"
                                       href="{{ route('transactions.index') }}">{{ $validation_text }}</a>
                                @endif
                            </div>                              
                        @else
                            <span>{{ $validation_text }}</span>
                        @endif
                    </td>
                </tr>
                @endif
            @endforeach
        </tbody>
    </table>
</div>
{{$prepositions->links()}}
<style>/* Custom Scrollbar Styles */
.scrollbar-thin {
    scrollbar-width: thin; /* For Firefox */
    scrollbar-color: #24a19c #e2e8f0; /* For Firefox */
}

.scrollbar-thin::-webkit-scrollbar {
    height: 8px; /* Scrollbar height */
}

.scrollbar-thin::-webkit-scrollbar-track {
    background: #e2e8f0; /* Track background color */
}

.scrollbar-thin::-webkit-scrollbar-thumb {
    background-color: #24a19c; /* Scrollbar color */
    border-radius: 10px; /* Round scrollbar edges */
    border: 2px solid #e2e8f0; /* Space around the scrollbar */
}
</style>
        @foreach ($prepositions as $preposition)
        <div>
            <x-preposition-validation-modal :preposition=$preposition></x-preposition-validation-modal>
            <x-preposition-confirmation-modal :preposition=$preposition></x-preposition-confirmation-modal>
            <x-meet-modal :preposition=$preposition></x-meet-modal> 
        </div> 
        
        <script type="module">
            window.Echo.private('propositions.'+{{$preposition->id}})
            .listen('PropositionStatusUpdate', (e) => {
                console.log(e.proposition);
                location.reload();
            });
        </script>
        @endforeach
        
        
        
        
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
        var meetStatus=descriptionData.status == "pending" ? "En cours" : (descriptionData.status == "accepted" ? "Acceptée" : "Refusée");
        // add data to table meet 
        $('#meetModal #meetDescription').text(meetDescription);
        $('#meetModal #meetDate').text(meetDate);
        $('#meetModal #meetTime').text(meetTime);
        $('#meetModal #meetStatus').text(meetStatus);
       
        var actions = $('#meetModal #meetActions');
        if (descriptionData.user_id != {{ auth()->id() }} && descriptionData.status == "pending") {
            actions.html('<button class="btn btn-success accept-button">Accepter</button> <button class="btn btn-danger decline-button">Refuser</button>');
        } else {
            actions.empty(); // Clear actions if conditions are not met
        }
        $('#meetModal').modal('show');
        if(!descriptionData){
            $('#meetModal #meetDescription').empty();
            $('#meetModal #meetDate').empty();
            $('#meetModal #meetTime').empty();
            $('#meetModal #meetStatus').empty();
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

    $(document).on('click', '.accept-button', function () {
        var meetId = descriptionData.id;
        updateMeetStatus(meetId, 'accepted');
    });

    $(document).on('click', '.decline-button', function () {
        var meetId = descriptionData.id;
        updateMeetStatus(meetId, 'rejected');
    });

    function updateMeetStatus(meetId, status) {
        // Perform an AJAX request to update the meet status
        $.ajax({
            url: '/update-meet-status/' + meetId,
            method: 'POST',
            data: { status: status },
            success: function (response) {
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: 'Le statut de la rencontre est modifié .',
                }).then(function () {
                    // Reload the page after showing the success message
                    location.reload();
                });
            },
            error: function (error) {
                // Handle error response
                console.error(error);
            }
        });
    }

</script>