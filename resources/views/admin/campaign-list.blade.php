@extends('admin.index')

@section('admin-content')
<div class="container">
    <table class="table align-middle mb-0 bg-white">
        <thead class="bg-light">
            <tr>
                <th>Nom de la Campagne</th>
                <th>Description</th>
                <th>Date de Début</th>
                <th>Date de Fin</th>
                <th>Pourcentage de Réduction</th>
                <th>Produits Inclus</th>
                <th>Sponsor</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($campaigns as $campaign)
            <tr>
                <td>{{ $campaign->name }}</td>
                <td>{{ $campaign->description }}</td>
                <td>{{ $campaign->start_date }}</td>
                <td>{{ $campaign->end_date }}</td>
                <td>{{ $campaign->discount_percentage }}</td>
                <td>{{ $campaign->products_included }}</td>
                <td>{{ $campaign->sponsor ? $campaign->sponsor->name : '' }}</td>
                <td>
                    <a href="{{ route('admin.edit-campaign', ['id' => $campaign->id]) }}" class="btn btn-sm btn-primary">Éditer</a>
                    <form action="{{ route('admin.delete-campaign', ['id' => $campaign->id]) }}" method="post" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette campagne ?')">Supprimer</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
