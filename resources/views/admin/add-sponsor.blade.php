@extends('admin.template')

@section('admin-content')
<div class="container">
    <h1 class="m-4">Ajouter un Sponsor</h1>
    <form action="{{ route('admin.storeSponsor') }}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Nom du Sponsor</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" class="form-control" required></textarea>
        </div>

        <div class="mb-3">
            <label for="logo" class="form-label">Logo</label>
            <input type="file" name="logo" class="form-control">
        </div>

        <!-- Ajoutez plus de champs au besoin -->

        <div class="flex justify-end mt-2">
            <button type="submit" class="btn text-white" style="background: var(--primary-color);">Ajouter le sponsor</button>
        </div>
    </form>
</div>
@endsection
