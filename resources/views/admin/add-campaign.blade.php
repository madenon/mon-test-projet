@extends('admin.index')

@section('admin-content')
<div class="container">
    <h1 class="m-4">Ajouter une campagne</h1>
    <form action="{{ route('admin.storeCampaign') }}" method="post">
        @csrf
        @method('POST')

        <div class="form-group">
            <label for="name">Nom de la campagne</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" class="form-control" required></textarea>
        </div>

        <div class="form-group">
            <label for="start_date">Date de début</label>
            <input type="date" name="start_date" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="end_date">Date de fin</label>
            <input type="date" name="end_date" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="discount_percentage">Pourcentage de réduction</label>
            <input type="number" name="discount_percentage" class="form-control" min="0" max="100">
        </div>

        <div class="form-group">
            <label for="products_included">Produits inclus</label>
            <input type="text" name="products_included" class="form-control">
        </div>

        <div class="form-group">
            <label for="sponsor_id">Sponsor</label>
            <select name="sponsor_id" class="form-control">
                @foreach ($sponsors as $sponsor)
                    <option value="{{ $sponsor->id }}">{{ $sponsor->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Ajouter la campagne</button>
    </form>
</div>
@endsection
