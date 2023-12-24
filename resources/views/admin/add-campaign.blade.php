@extends('admin.index')

@section('admin-content')
<div class="container">
@if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
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
            <input type="date" name="start_date" class="form-control" >
        </div>

        <div class="form-group">
            <label for="end_date">Date de fin</label>
            <input type="date" name="end_date" class="form-control" >
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
            <option ></option>
                @foreach ($sponsors as $sponsor)
                    <option value="{{ $sponsor->id }}">{{ $sponsor->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="flex justify-end mt-2">
        <button type="submit" class="btn text-white " style="background:var(--primary-color);">Ajouter la campagne</button></div>
    </form>
</div>
@endsection
