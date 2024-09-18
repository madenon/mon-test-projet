<x-app-layout>
    @php 
        $counterparty = Auth::user()->id == $transaction->proposition->user->id ? 
        $transaction->proposition->offer->user :
        $transaction->proposition->user;
    @endphp
    <div class="container">
        <h5 class="mt-4">Infos sur la transactions</h5>
        <div class="grid grid-cols-3 md:grid-cols-4 gap-4">
            <div class=""> 
                <p class="text-sm text-slate-300 space-y-0 p-0 m-0">No</p>
                <p class="text-lg p-0 m-0">
                    <a type="button" href="#" style="color: #24a19c;">
                        <span class="text-xs" >{{$transaction->uuid}}</span>
                    </a>
                    <i class="fa fa-copy" style="color: #24a19c;" data-transaction-uuid="{{ $transaction->uuid }}" data-bs-toggle="tooltip" data-bs-placement="left" title="Copy"></i>     
                </p>
            </div>
            <div class=""> 
                <p class="text-sm text-slate-300 space-y-0 p-0 m-0">Offre</p>
                <p class="text-lg p-0 m-0">
                    <a class="no-underline font-medium text-lg" href="{{route('offer.offer', [$transaction->offer->id, $transaction->offer->slug])}}">{{ $transaction->offer->title }}</a>
                </p>
            </div>
            <div class=""> 
                <p class="text-sm text-slate-300 space-y-0 p-0 m-0">Prix</p>
                <p class="text-lg p-0 m-0">
                    {{ $transaction->amount }}
                </p>
            </div>
            <div class=""> 
                <p class="text-sm text-slate-300 space-y-0 p-0 m-0">Status</p>
                <p class="text-lg p-0 m-0">
                    @php
                    $applicant = $transaction->proposition->user;
                    $statusToShow = '';
                    
                    if ($transaction->offeror_status == 'Réussi' && $transaction->applicant_status == 'Réussi') {
                        $statusToShow = 'Réussi';
                    } elseif ($transaction->offeror_status == 'Échouée' || $transaction->applicant_status == 'Échouée') {
                        $statusToShow = 'Échouée';
                    } else {
                        $statusToShow = 'En cours';
                    }
                    @endphp
                    <span class="badge {{ getStatusBadgeClass($statusToShow) }} rounded-pill d-inline">
                        {{ $statusToShow }}
                    </span>
                </p>
            </div>
            
            <div class=""> 
                <p class="text-sm text-slate-300 space-y-0 p-0 m-0">Contrepartie</p>
                <p class="text-lg p-0 m-0">
                    <a type="button" class="btn  chat-button" href="{{route('profile.showProfile',$counterparty->id)}}">
                        <span style="color: #24a19c;">
                        {{ $counterparty->name }}
                        </span>
                    </a>               
                </p>
            </div>
            <div class=""> 
                <p class="text-sm text-slate-300 space-y-0 p-0 m-0">Date</p>
                <p class="text-lg p-0 m-0">
                    {{ $transaction->date }}
                </p>
            </div>
            <div class=""> 
                <p class="text-sm text-slate-300 space-y-0 p-0 m-0">Raison</p>
                <p class="text-lg p-0 m-0">
                    {{ $transaction->reason?? 'Non definie' }}
                </p>
                
            </div>
            
        </div>
        <div class="text-lg p-0 mt-12">
            @if(auth()->check() && ( (auth()->user()->id ===$applicant->id && $transaction->applicant_status==='En cours') || (auth()->user()->id !=$applicant->id && $transaction->offeror_status==='En cours')))
                <div class="flex justify-center space-x-1 md:space-x-2">
                    <button type="button" class="reject p-1 md:p-3"  data-toggle="modal" data-target="#statusModal" data-id="{{ $transaction->id }}" data-status="Échouée">
                        <i class="fa-solid fa-ban mr-2" style="color: red;" ></i> Échouée   
                    </button>
                    <button type="button" class="button-filter p-1 md:p-3" data-toggle="modalCompleted" data-target="#statusModal" data-id="{{ $transaction->id }}" data-status="Réussi">
                        <i class="fa-solid fa-check mr-2 " style="color: white;"></i> Réussi
                    </button>
                </div>
            @elseif( !($transaction->applicant_status==='Réussi' && $transaction->offeror_status==='Réussi')   )
            En attente de validation 
            @endif
        </div>

        <div class="w-full h-12"></div>
        @if($transaction->offeror_status == 'Réussi' || $transaction->applicant_status == 'Réussi')
        <div class="flex mt-4">
            <div class="w-1/2"> 
                <p class="text-xl space-y-0 p-0 m-0">Commentraire</p>
                <p class="text-lg p-0 m-0">
                    
                    @php
                    
                    $counterpartyRating=App\Models\Rating::where('user_id', Auth::user()->id)
                    ->where('rated_by_user_id',$counterparty->id)
                    ->where('transaction_id',$transaction->id)->first();
                    
                    $myRating=App\Models\Rating::where('user_id', $counterparty->id)
                    ->where('rated_by_user_id', Auth::user()->id )
                    ->where('transaction_id',$transaction->id)->first();
                    @endphp
                    <p class="text-sm text-slate-300 space-y-0 p-0 m-0">Mes commentaires : <span class="text-xs">{{ Carbon\Carbon::parse($myRating?->created_at)->format('Y-m-d H:i:s') }}

                    </span></p>
                    <button id="myRating" type="button" class="btn rating-button text-center" data-transaction-id="{{ $transaction->id }}" data-transaction-uuid="{{ $transaction->uuid }}">
                        @if(!$myRating || $myRating->stars==0)
                        <span  class="badge bg-warning rounded-pill" data-transaction-id="{{ $transaction->id }}" data-transaction-uuid="{{ $transaction->uuid }}">Notez</span>
                        @else
                            @for ($i =1; $i <= 5; $i++)
                            <input type="radio" id="myStar{{$i}}" name="rating" value="{{$i}}" class="hidden" />
                            <label for="myStar{{$i}}" title="{{$i}} star" class="cursor-pointer text-2xl text-yellow-500" data-transaction-id="{{ $transaction->id }}" data-transaction-uuid="{{ $transaction->uuid }}">
                                @if($myRating->stars>=$i)
                                &#9733;
                                @else
                                    &#9734;
                                    @endif
                                </label>
                            @endfor               
                            @livewire('split-long-text ', [
                                'text' => $myRating->feedback,
                                'parentClass' => '#myRating',
                                ])             

                        @endif
                    </button>
                    <p class="text-sm text-slate-300 space-y-0 p-0 m-0">Commentaires de la contrepartie : <span class="text-xs">{{ Carbon\Carbon::parse($myRating?->created_at)->format('Y-m-d H:i:s') }}
                    </span></p>
                    <button id="counterpartyRating" type="button" class="btn text-center">
                        @if(!$counterpartyRating || $counterpartyRating->stars==0)
                        <span>Pas de commentaires</span>
                        @else
                            @for ($i =1; $i <= 5; $i++)
                            <input type="radio" id="counterStar{{$i}}" name="rating" value="{{$i}}" class="hidden" data-transaction-id="{{ $transaction->id }}" data-transaction-uuid="{{ $transaction->uuid }}"/>
                            <label for="counterStar{{$i}}" title="{{$i}} star" class="cursor-pointer text-2xl text-yellow-500" data-transaction-id="{{ $transaction->id }}" data-transaction-uuid="{{ $transaction->uuid }}">
                                @if($counterpartyRating->stars>=$i)
                                &#9733;
                                @else
                                &#9734;
                                @endif
                            </label>
                            @endfor               
                            @livewire('split-long-text ', [
                                'text' => $counterpartyRating->feedback,
                                'parentClass' => '#counterpartyRating',
                                ])
                        @endif
                    </button>


                </p>
            </div>
            <div class="w-1/2"> 
                <p class="text-xl space-y-0 p-0 m-0">Dispute</p>
                <p class="text-lg p-0 m-0">
                    <button type="button" class="btn appeal-button text-center">
                        @php 
                        $appealed = count(App\Models\Transaction::find($transaction->id)->whereHas('disputes', function ($query) {
                            $query->where('isOpen', true);
                        })->get());
                        @endphp
                        @if(!$appealed)
                        <span class="appeal badge bg-secondary rounded-pill" data-transaction-id="{{ $transaction->id }}" data-transaction-uuid="{{ $transaction->uuid }}">Faire Appel</span>
                        @else
                        <span class="appealing badge bg-danger rounded-pill" data-transaction-id="{{ $transaction->id }}" data-transaction-uuid="{{ $transaction->uuid }}">Appel en cours</span>
                        @endif
                    </button>               
                </p>
            </div>
        </div>
        @endif
    </div>
</x-app-layout>
<!-- modal -->
<div class="modal fade" id="statusModal" tabindex="-1" role="dialog" aria-labelledby="reasonModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="reasonModalLabel">Confirmation de statut</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h1 id="modalMessage"></h1>
                <input type="text" id="failureReason" class="form-control" placeholder="Raison">
                <input type="text" id="transactionId" class="form-control" hidden>
                <input type="text" id="statusToUpdate" class="form-control" hidden>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                <button type="button" class="btn btn-primary" id="updateStatus">Sauvegarder</button>
            </div>
        </div>
    </div>
</div>

@php
    function getStatusBadgeClass($status) {
        switch ($status) {
            case 'Échouée':
                return 'bg-danger';
            case 'En cours':
                return 'bg-warning';
            case 'Réussi':
                return 'bg-success';
           
        }
    }
    @endphp
    <script>
    $(document).ready(function () {
        // hide reason if not rejected transactions
        $('#reason').hide();
        // Handle button click to set current offer and status
        $('[data-toggle="modal"]').click(function () {
            const transactionId = $(this).data('id');
            const statusToUpdate = $(this).data('status');
            $('#modalMessage').text("Confirmez-vous l\'échec de la transaction ?");
                        $('#failureReason').show();
            // Set modal inputs
            $('#transactionId').val(transactionId);
            $('#statusToUpdate').val(statusToUpdate);
            $('#failureReason').val('');
            // Show the modal
            $('#statusModal').modal('show');
        });
        $('[data-toggle="modalCompleted"]').click(function () {
            const transactionId = $(this).data('id');
            const statusToUpdate = $(this).data('status');
            // Set modal inputs
            $('#transactionId').val(transactionId);
            $('#statusToUpdate').val(statusToUpdate);
            $('#modalMessage').text("Voulez-vous confirmer la réussite de la transaction ?");
            $('#failureReason').hide();
            $('#statusModal').modal('show');
        });

        // Handle save button in modal
        $('#updateStatus').click(function () {
            const transactionId = $('#transactionId').val();
            const statusToUpdate = $('#statusToUpdate').val();
            const failureReason = $('#failureReason').val();

            // Perform AJAX request to update status with or without reason
            $.ajax({
                url: `/update-transaction-status/${transactionId}/${statusToUpdate}`,
                method: 'POST',
                data: { failure_reason: failureReason, _token: '{{ csrf_token() }}' },
                success: function () {
                    location.reload();
                    $('#statusModal').modal('hide');
                },
                error: function (error) {
                    alert("An error occurred");
                }
            });
        });
    });
    
    $(document).on('click', '.transaction-uuid i', function () {
        var transactionUuid = $(this).data('transaction-uuid');
        navigator.clipboard.writeText(transactionUuid);
        $(this).attr('title', 'Copied');
        setTimeout(function() {
            $('.transaction-uuid i').attr('title', 'Copy');
        }, 3000);

    });
    
    
    function rateTransactionCounterparty(transactionId,transactionUuid) {
        Swal.fire({
            title: 'Transaction '+transactionUuid,
            html: '<div class="flex items-center justify-center space-x-2">' +
                '<input type="radio" id="rateStar1" name="rating" value="1" class="rateStar hidden"/><label for="rateStar1" title="1 star" class="cursor-pointer text-2xl text-yellow-500">&#9734;</label>' +
                '<input type="radio" id="rateStar2" name="rating" value="2" class="rateStar hidden"/><label for="rateStar2" title="2 stars" class="cursor-pointer text-2xl text-yellow-500">&#9734;</label>' +
                '<input type="radio" id="rateStar3" name="rating" value="3" class="rateStar hidden"/><label for="rateStar3" title="3 stars" class="cursor-pointer text-2xl text-yellow-500">&#9734;</label>' +
                '<input type="radio" id="rateStar4" name="rating" value="4" class="rateStar hidden"/><label for="rateStar4" title="4 stars" class="cursor-pointer text-2xl text-yellow-500">&#9734;</label>' +
                '<input type="radio" id="rateStar5" name="rating" value="5" class="rateStar hidden"/><label for="rateStar5" title="5 stars" class="cursor-pointer text-2xl text-yellow-500">&#9734;</label>' +
                '</div>' +
                '<div id="feedback-container" style="display:none">' +
                '<textarea id="feedback" name="feedback" class="swal2-textarea" rows="4" cols="35" placeholder="Give Feedback"></textarea>' +
                '</div>',
            showCancelButton: true,
            confirmButtonText: 'Rate',
            cancelButtonText: 'Cancel',
            showLoaderOnConfirm: true,
            preConfirm: (result) => {
                console.log({result});
                const rating=document.querySelector('input[name="rating"]:checked');
                const ratingValue = rating? rating.value:0;
                const feedbackValue = document.getElementById('feedback').value;
                return fetch('/ratings/rateOfferCounterParty', {
                    method: 'POST',
                    headers: {
                    'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        transactionId: transactionId,
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
                for(var i = 1; i <= 5; i++ ){
                    $(`#rateStar${i}`).change(function(){
                        if($(this).is(':checked') ) {
                            $('#feedback-container').css('display', 'block');
                            checkedVal = $(this).val();
                            $('.rateStar').each(function(index){
                                if ($(this).val() <= checkedVal) {
                                    $(this).next().html('&#9733;'); // Filled star
                                }else{
                                    $(this).next().html('&#9734;'); // Empty star
                                }
                            });
                        }
                    });
                }
            }
        }).then((result) => {
            if (result.isConfirmed) {
                location.reload();
            }
        });

                
}
function appealTransaction(transactionId,transactionUuid) {
    Swal.fire({
        title: 'Transaction '+transactionUuid,
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
        return fetch('/transactions/dispute/'+transactionId, {
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

    $(document).on('click', '#myRating', function () {
        // Retrieve the transactionId from the data attribute
        var transactionId = $(this).data('transaction-id');
        var transactionUuid = $(this).data('transaction-uuid');
        console.log({transactionId});
        console.log({transactionUuid});
        
        
        rateTransactionCounterparty(transactionId,transactionUuid);
    });
    
    $(document).on('click', '.appeal-button .appeal', function () {
        // Retrieve the transactionId from the data attribute
        var transactionId = $(this).data('transaction-id');
        var transactionUuid = $(this).data('transaction-uuid');
        
        appealTransaction(transactionId,transactionUuid);
    });
</script>