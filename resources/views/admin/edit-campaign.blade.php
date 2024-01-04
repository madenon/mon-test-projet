@extends('admin.template')

@section('admin-content')
<div class="container">
    <h1>Edit Campaign</h1>
    <form action="{{ route('admin.edit-campaign', ['id' => $campaign->id]) }}" method="post">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Campaign Name</label>
            <input type="text" name="name" class="form-control" value="{{ $campaign->name }}" required>
        </div>

<!-- Link for campaign -->
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
            <option value="left">gauche</option>
            <option value="right">droite</option>
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
        <button type="submit" class="btn text-white " style="background:var(--primary-color);">Update Campaign</button></div>
    </form>
</div>
@endsection
<script>
document.addEventListener('DOMContentLoaded', function() {
    var currentDate = new Date();

// Get timezone offset in minutes
var offset = currentDate.getTimezoneOffset();


// Adjust the date by subtracting the offset in minutes
var adjustedDate = new Date(currentDate.getTime() - (offset * 60 * 1000));

// Format the adjusted date to be compatible with datetime-local input
var formattedDate = adjustedDate.toISOString().slice(0, 16);

// Set the initial values for the datetime-local inputs
document.getElementById("start_date_input").value = formattedDate;
var userTimeZone = Intl.DateTimeFormat().resolvedOptions().timeZone;
document.getElementById("timezone").value = userTimeZone;



});
</script>