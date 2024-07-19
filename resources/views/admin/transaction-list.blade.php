@extends('admin.template')

@section('admin-content')    
<div class="container">
        <h1 class="m-4">Transactions</h1>
        <form action="{{ route('admin.transactions') }}" method="GET">
        <div class="mb-4 ">
                <label class="block text-sm font-medium text-gray-700">Rechercher:</label>
                <input type="text" name="search" value="{{ request('search') }}" class="mt-1 p-2 border rounded-md">
                
                <!-- Use an icon (e.g., from FontAwesome or another icon library) as a link to submit the form -->
                <button type="submit" class="ml-2 text-blue-500 hover:text-blue-700">
                    <!-- Replace the content inside the span with your preferred search icon -->
                    <i class="fa fa-search" aria-hidden="true"></i>

                </button>
            </div>
            <div class="flex space-x-4 ">
            <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Filtrer par statut :</label>
            <select name="status" class="mt-1 p-2 border rounded-md" onchange="this.form.submit()">
                <option value="">Statut</option>
                <option value="accepted" {{ request('status') == 'accepted' ? 'selected' : '' }}>Réussie</option>
                <option value="in_progress" {{ request('status') == 'in_progress' ? 'selected' : '' }}>En cours</option>
                <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Échouée</option>
            </select>
        </div>
        <div class="mt-8">
                {{count($transactions)}} items
            </div>
        </div>
        </form>
        <table class="table align-middle mb-0 bg-white">
            <thead class="bg-light">
                <tr>
                    <th>Name</th>
                    <th>Utilisateur</th>
                    <th>Amount</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Raison</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transactions as $transaction)
                    <tr>
                        <td>{{ $transaction->name }}</td>
                        <td>{{ $transaction->proposition->user->name }}</td>
                        <td>{{ $transaction->amount }}</td>
                        <td>{{ $transaction->date }}</td>
                        <td>
                        @php
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
                    
                       
                         <td>
                    <a href="{{ route('admin.edit-transaction', ['id' => $transaction->id]) }}" class="btn btn-primary btn-sm">Edit</a>
                    <button class="btn btn-danger btn-sm" onclick="openDeleteTransactionModal({{ $transaction->id }})">Delete</button>
                </td>

                    </tr>
                
                @endforeach
               
            </tbody>
        </table>
    </div>
     <!-- Delete Transaction Modal -->
     <div class="modal fade" id="deleteTransactionModal" tabindex="-1" role="dialog" aria-labelledby="deleteTransactionModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteTransactionModalLabel">Confirmation de suppression</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Êtes-vous sûr de vouloir supprimer cette transaction?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                    <button type="button" class="btn btn-danger" onclick="deleteTransaction()">Supprimer</button>
                </div>
            </div>
        </div>
    </div>

@endsection
@php
    function getStatusBadgeClass($status) {
        switch ($status) {
            case 'Échoué':
                return 'bg-danger';
            case 'En cours':
                return 'bg-warning';
            case 'Réussi':
                return 'bg-success';
           
        }
    }
    @endphp
    <script>
    function openDeleteTransactionModal(transactionId) {
            $('#deleteTransactionModal').modal('show');
            // Pass the transaction ID to deleteTransaction function
            $('#deleteTransactionModal').data('transaction-id', transactionId);
        }

        function deleteTransaction() {
            const transactionId = $('#deleteTransactionModal').data('transaction-id');
            
            // Perform AJAX request to delete the transaction
            $.ajax({
                url: `transactions/delete-transaction/${transactionId}`,
                method: 'DELETE',
                success: function () {
                    location.reload();
                    $('#deleteTransactionModal').modal('hide');
                },
                error: function (error) {
                    alert("An error occurred while deleting the transaction.");
                    $('#deleteTransactionModal').modal('hide');
                }
            });
        }
       
</script>
