@extends('admin.template')

@section('admin-content')
<table class="table align-middle mb-0 bg-white">
            <thead class="bg-light">
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Description</th>
                <th>Logo</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($sponsors as $sponsor)
                <tr>
                    <td>{{ $sponsor->id }}</td>
                    <td>{{ $sponsor->name }}</td>
                    <td>{{ $sponsor->description }}</td>
                    <td>
                        @if($sponsor->logo_path)
                            <img src="{{ asset('storage/' . $sponsor->logo_path) }}" alt="Logo du Sponsor" width="50">
                        @else
                            Pas de logo
                        @endif
                    </td>
                    <td>
                        <form action="{{ route('admin.delete-sponsor', $sponsor->id) }}" method="post" style="display: inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce sponsor ?')">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
