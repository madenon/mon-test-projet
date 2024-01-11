@extends('admin.template')

@section('admin-content')
<div class="container">
    <h1>Modifier la campagne</h1>
    <form action="{{ route('admin.edit-campaign', ['id' => $campaign->id]) }}" method="post">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Nom de la campagne</label>
            <input type="text" name="name" class="form-control" value="{{ $campaign->name }}" required>
        </div>

        <!-- Lien pour la campagne -->
        <div class="form-group">
            <label for="description">Lien</label>
            <textarea name="description" class="form-control" required>{{ $campaign->description }}</textarea>
        </div>

        <div class="form-group">
            <label for="page">Page</label>
            <select name="page" class="form-control">
                <option value="home">Page d'accueil</option>
                <option value="alloffers">Page des offres</option>
                <option value="all">Toutes les pages</option>
            </select>
        </div>

        <div class="form-group">
            <label for="position">Position</label>
            <select name="position" class="form-control">
                <option value="top">Haut de page</option>
                <option value="content">Dans le contenu</option>
                <option value="left">Gauche</option>
                <option value="right">Droite</option>
                <option value="bottom">Bas de page</option>
            </select>
        </div>

        <div class="form-group">
            <label for="start_date">Date de début</label>
            <input type="datetime-local" name="start_date" class="form-control" id="start_date_input">
        </div>

        <div class="form-group">
            <label for="end_date">Date de fin</label>
            <input type="datetime-local" name="end_date" class="form-control" id="end_date_input">
        </div>

        <input type="text" id="timezone" name="timezone" class="form-control" hidden>

        <div class="flex justify-end mt-2">
            <button type="submit" class="btn text-white " style="background:var(--primary-color);">Mettre à jour la campagne</button>
        </div>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var currentDate = new Date();

        // Obtenez le décalage horaire en minutes
        var offset = currentDate.getTimezoneOffset();

        // Ajustez la date en soustrayant le décalage en minutes
        var adjustedDate = new Date(currentDate.getTime() - (offset * 60 * 1000));

        // Formatez la date ajustée pour qu'elle soit compatible avec l'entrée datetime-local
        var formattedDate = adjustedDate.toISOString().slice(0, 16);

        // Définissez les valeurs initiales pour les entrées datetime-local
        document.getElementById("start_date_input").value = formattedDate;
        var userTimeZone = Intl.DateTimeFormat().resolvedOptions().timeZone;
        document.getElementById("timezone").value = userTimeZone;
    });
</script>
@endsection
