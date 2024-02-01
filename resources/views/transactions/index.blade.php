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
                <a href="{{route('transactions.index', ['in_progress'=>1])}}" class="text-gray-600 hover:text-gray-800 no-underline focus:outline-none focus:text-gray-800 transition duration-300 ease-in-out">In Progress</a>
            </div>
            <div class="pe-6" style="{{ !(request()->has('in_progress')) || request()->input('in_progress')==1 ? '' : 'border-bottom: 2px solid #24a19c' }}">
                <a href="{{route('transactions.index', ['in_progress'=>0])}}" class="text-gray-600 hover:text-gray-800 no-underline focus:outline-none focus:text-gray-800 transition duration-300 ease-in-out">All</a>
            </div>
        </div>       
        <table class="table align-middle  mt-4 mb-0 bg-white">
            <thead class="bg-light">
                <tr>
                <th>Transaction</th>
                <th>Offre</th>
                 <th>Contrepartie</th>
                <th>Montant</th>
                <th>Date</th>
                <th>Statut</th>
                <th>Raison</th>
                <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transactions as $transaction)
                    @php 
                    $isReceiveid= $transaction->proposition->offer->user==auth()->user();
                    if($isReceiveid) $counterparty = $transaction->proposition->user; 
                    else $counterparty = $transaction->proposition->offer->user;
                    @endphp
                    <tr>
                        <td nowrap>
                        <a type="button" href="{{route('transactions.show', $transaction->id)}}" style="color: #24a19c;">
                                <span class="text-xs" >{{$transaction->uuid}}</span>
                            </a>
                            <i class="fa fa-copy" style="color: #24a19c;" data-transaction-uuid="{{ $transaction->uuid }}" data-bs-toggle="tooltip" data-bs-placement="left" title="Copy"></i>     

                        </td>
                        <td>
                            <a class="no-underline font-medium" href="{{route('offer.offer', [$transaction->proposition->offer->id, $transaction->proposition->offer->slug])}}">{{ $transaction->proposition->offer->title }}</a>
                        </td>
                        <td>{{ $counterparty->first_name }} {{$counterparty->last_name }}</td>
                        <td>{{ $transaction->amount }}</td>
                        <td>{{ $transaction->date }}</td>
                        <td>
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

                        </td>
                       
                        <td> {{ $transaction->reason }}</td>
                
                        @if(auth()->check() && ( (auth()->user()->id ===$applicant->id && $transaction->applicant_status==='En cours') || (auth()->user()->id !=$applicant->id && $transaction->offeror_status==='En cours')))
                        <td> 
                            <button type="button" class="reject"  data-toggle="modal" data-target="#statusModal" data-id="{{ $transaction->id }}" data-status="Échouée">
                                Échouée
                                <i class="fa-solid fa-ban ml-2" style="color: red;" ></i>    </button>
                            <button type="button" class="button-filter" data-toggle="modalCompleted" data-target="#statusModal" data-id="{{ $transaction->id }}" data-status="Réussi">
                                Terminé
                                <i class="fa-solid fa-check ml-2" style="color: white;"></i>
                            </button>
                        </td>
                        @elseif( !($transaction->applicant_status==='Réussi' && $transaction->offeror_status==='Réussi')   )
                        <td>
                            En attente de validation 
                        </td>
                        @endif
                    </tr>
                    <script type="module">
                        window.Echo.private('transactions.' + {{$transaction->id}})
                        .listen('TransactionStatusUpdated', (e) => {
                            console.log(e.transaction);
                            location.reload();
                        });
                    </script>

                    
                @endforeach
            </tbody>
        </table>
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
</script>