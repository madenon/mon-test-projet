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
    <h1 class="my-6">Mes transactions</h1>
        <div class="flex space-x-4 mt-4 mx-2">
            <div class="pe-4" style="{{ !(request()->has('in_progress')) || request()->input('in_progress')==1 ?  'border-bottom: 2px solid #24a19c' : ''}}">
                <a href="{{route('transactions.index', ['in_progress'=>1])}}" class="text-gray-600 hover:text-gray-800 no-underline focus:outline-none focus:text-gray-800 transition duration-300 ease-in-out">En cours</a>
            </div>
            <div class="pe-6" style="{{ !(request()->has('in_progress')) || request()->input('in_progress')==1 ? '' : 'border-bottom: 2px solid #24a19c' }}">
                <a href="{{route('transactions.index', ['in_progress'=>0])}}" class="text-gray-600 hover:text-gray-800 no-underline focus:outline-none focus:text-gray-800 transition duration-300 ease-in-out">Tous</a>
            </div>
        </div>  
        @if((request()->has('in_progress')) && request()->input('in_progress')==0 )
        <form action="{{ route('transactions.index', ['in_progress'=>0]) }}" method="GET">
            <input type="text" name="in_progress" id="in_progress" value="0" hidden />
            <div class="mx-1 my-4 grid md:grid-cols-4 grid-cols-1 md:gap-4 gap-1">
                <style>
                    @media (max-width: 768px) {
                        input, select{
                            font-size: 0.75rem !important;
                        }
                    }
                </style>
                <div class="" style="width: 300px;">
                    <select name="status" id="filterStatus" class="md:w-1/2 mt-1 p-2 border rounded-md"  onchange="this.form.submit()">
                        <option value="">Tous les status</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>
                        en attente
                        </option>
                        <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>
                        rejeté
                        </option>
                        <option value="accepted" {{ request('status') == 'accepted' ? 'selected' : '' }}>
                        accepté
                        </option>
                    </select>
                    
                </div>
                <div class=" border py-1 w-4/5">
                    <div class="px-1">
                        <input type="date" class="form-control" id="start_date" name="start_date" value="{{ request('start_date')?? \Carbon\Carbon::now()->subMonths(6)->toDateString() }}" onchange="this.form.submit()">
                    </div>
                    <div class="px-1">
                        <input type="date" class="form-control" id="end_date" name="end_date" value="{{ request('end_date')?? now()->toDateString() }}" onchange="this.form.submit()">
                    </div>
        
                </div>
                <div class="max-w-screen-lg">
                    <input type="text" name="number_trans" value="{{ request('number_trans')}}" class=" md:w-1/2 mt-1 p-2 border rounded-md" placeholder="N° transaction">
                    
                    <button type="submit" class="ml-2 text-blue-500 hover:text-blue-700">
                        <i class="fa fa-search" aria-hidden="true"></i>
                    </button>
                </div>
                <div class="">
                    <input type="text" name="name_offer" value="{{ request('name_offer') }}" class="md:w-1/2 mt-1 p-2 border rounded-md" placeholder = 'Offer name'>
                    
                    <button type="submit" class="ml-2 text-blue-500 hover:text-blue-700">
                        <i class="fa fa-search" aria-hidden="true"></i>
                    </button>
                </div>
            </div>
        </form>
        @endif
        <table class="table align-middle  mt-4 mb-0 bg-white mx-1">
            <thead class="bg-light">
                <tr>
                    <th><span class="text-xs md:text-base">Transaction</span></th>
                    <th><span class="text-xs md:text-base">Offre</span></th>
                    <th class="hidden md:block">Contrepartie</th>
                    <th><span class="text-xs md:text-base">Montant</span></th>
                    <th class="hidden md:block">Date</th>
                    <th><span class="text-xs md:text-base">Statut</span></th>
                    <th class="hidden md:block">Raison</th>
                    <th><span class="text-xs md:text-base">Action</span></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transactions as $transaction)
                @if ($transaction->proposition && $transaction->proposition->offer && $transaction->proposition->offer->user )
                    @php 
                    $isReceiveid= $transaction->proposition->offer->user==auth()->user();
                    if($isReceiveid) $counterparty = $transaction->proposition->user; 
                    else $counterparty = $transaction->proposition->offer->user;
                    @endphp
                    <tr>
                        <td class="whitespace-nowrap">
                            <a type="button" href="{{route('transactions.show', $transaction->id)}}" style="color: #24a19c;">
                                    <span class="text-xs hidden md:block" >{{$transaction->uuid}}</span>
                                    <span class="text-xs block md:hidden" >{{Str::limit($transaction->uuid,8)}}</span>
                                </a>
                                <i class="fa fa-copy" style="color: #24a19c;" data-transaction-uuid="{{ $transaction->uuid }}" data-bs-toggle="tooltip" data-bs-placement="left" title="Copy"></i>     

                        </td>
                        <td>
                            <a class="no-underline font-medium hidden md:block text-sm md:text-base" href="{{route('offer.offer', [$transaction->proposition->offer->id, $transaction->proposition->offer->slug])}}">{{ $transaction->proposition->offer->title }}</a>
                            <a class="no-underline font-medium block md:hidden text-sm md:text-base" href="{{route('offer.offer', [$transaction->proposition->offer->id, $transaction->proposition->offer->slug])}}">{{ Str::limit($transaction->proposition->offer->title, 8)}}</a>
                        </td>
                        <td class="hidden md:table-cell">{{ $counterparty->name }}</td>
                        <td class="text-xs md:text-base">{{ $transaction->amount }}</td>
                        <td class="hidden md:table-cell">{{ $transaction->date }}</td>
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
                       
                        <td class="hidden md:table-cell"> {{ $transaction->reason }}</td>
                
                        @if(auth()->check() && ( (auth()->user()->id ===$applicant->id && $transaction->applicant_status==='En cours') || (auth()->user()->id !=$applicant->id && $transaction->offeror_status==='En cours')))
                        <td>
                            <div class="flex justify-center space-x-1 md:space-x-2">
                                <button type="button" class="reject p-1 md:p-3"  data-toggle="modal" data-target="#statusModal" data-id="{{ $transaction->id }}" data-status="Échouée">
                                    <i class="fa-solid fa-ban" style="color: red;" ></i>    </button>
                                <button type="button" class="button-filter p-1 md:p-3" data-toggle="modalCompleted" data-target="#statusModal" data-id="{{ $transaction->id }}" data-status="Réussi">
                                    <i class="fa-solid fa-check" style="color: white;"></i>
                                </button>
                            </div>
                        </td>
                        @elseif( !($transaction->applicant_status==='Réussi' && $transaction->offeror_status==='Réussi')   )
                        <td>
                            En attente de validation 
                        </td>
                        @endif
                    </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
        @foreach ($transactions as $transaction)
            <script type="module">
                window.Echo.private('transactions.' + {{$transaction->id}})
                .listen('TransactionStatusUpdated', (e) => {
                    console.log(e.transaction);
                    location.reload();
                });
            </script>   
        @endforeach
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