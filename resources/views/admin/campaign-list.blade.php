@extends('admin.template')

@section('admin-content')
<div class="container">
    <table class="table align-middle mb-0 bg-white">
        <thead class="bg-light">
            <tr>
                <th>Nom de la Campagne</th>
                <th>Date de Début</th>
                <th>Date de Fin</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($campaigns as $campaign)
            <tr>
                <td>{{ $campaign->name }}</td>
                <td>{{ $campaign->start_date }}</td>
                <td>{{ $campaign->end_date }}</td>
                <td>
  @if ($campaign->is_active)
    <div class="flex items-center">
      <span class="ml-2 text-green-500 border border-green-500 px-2 py-1 rounded">Actif</span>
    </div>
  @else
    <div class="flex items-center">
      <span class="ml-2 text-red-500 border border-red-500 px-2 py-1 rounded">Inactif</span>
    </div>
  @endif
</td>
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
