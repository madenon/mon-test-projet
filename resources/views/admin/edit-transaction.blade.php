
@extends('admin.template')

@section('admin-content')
<div class="container">
    <h1 class="m-4">Edit Transaction</h1>
    <form action="{{ route('admin.update-transaction', ['id' => $transaction->id]) }}" method="post">
        @csrf
        @method('PUT')

        <!-- Your form fields go here -->
        <div class="mb-3">
            <label for="name" class="form-label">Transaction Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $transaction->name }}">
        </div>

        <div class="mb-3">
            <label for="amount" class="form-label">Transaction Amount</label>
            <input type="text" class="form-control" id="amount" name="amount" value="{{ $transaction->amount }}">
        </div>

        <div class="mb-3">
    <label for="status" class="form-label">Transaction Status</label>
    <select class="form-control" id="status" name="status">
        <option value="En cours" {{ $transaction->status === 'En cours' ? 'selected' : '' }}>En cours</option>
        <option value="Réussi" {{ $transaction->status === 'Réussi' ? 'selected' : '' }}>Réussi</option>
        <option value="Échoué" {{ $transaction->status === 'Échoué' ? 'selected' : '' }}>Échoué</option>
    </select>
</div>

<div class="mb-3" id="reasonInput" style="{{ $transaction->status === 'Échoué' ? '' : 'display: none;' }}">
    <label for="reason" class="form-label">Reason for Failure</label>
    <input type="text" class="form-control" id="reason" name="reason" value="{{ $transaction->reason }}">
</div>

<div class="flex justify-end mt-2">
        <button type="submit" class="btn text-white " style="background:var(--primary-color);">Update </button></div>    </form>
</div>
@endsection
