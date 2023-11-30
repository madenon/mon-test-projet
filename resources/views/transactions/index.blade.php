<x-app-layout>
    <div class="container">
        <h1 class="m-4">Transactions List</h1>
        <table class="table align-middle mb-0 bg-white">
            <thead class="bg-light">
                <tr>
                    <th>Name</th>
                    <th>Amount</th>
                    <th>Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transactions as $transaction)
                    <tr>
                        <td>{{ $transaction->name }}</td>
                        <td>{{ $transaction->amount }}</td>
                        <td>{{ $transaction->date }}</td>
                        <td>
                            <span class="badge {{ getStatusBadgeClass($transaction->status) }} rounded-pill d-inline">
                                {{ $transaction->status }}
                            </span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
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