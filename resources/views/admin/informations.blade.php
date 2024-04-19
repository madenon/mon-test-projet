<!-- resources/views/admin/information/edit.blade.php -->

@extends('admin.template')

@section('admin-content')

<div class="container mx-auto mt-8">

    <div class="bg-white rounded-lg p-6 shadow-md">
        <form action="{{ route('admin.update-information') }}" method="post">
            @csrf
            @method('PUT')

            <!-- Facebook Input -->
            <div class="mb-4">
                <label for="facebook" class="block text-sm font-medium text-gray-600">Facebook</label>
                <input type="text" name="facebook" id="facebook" value="{{ $information->facebook }}" class="mt-1 p-2 border rounded-md w-full">
            </div>

            <!-- Instagram Input -->
            <div class="mb-4">
                <label for="instagram" class="block text-sm font-medium text-gray-600">Instagram</label>
                <input type="text" name="instagram" id="instagram" value="{{ $information->instagram }}" class="mt-1 p-2 border rounded-md w-full">
            </div>

            <!-- YouTube Input -->
            <div class="mb-4">
                <label for="youtube" class="block text-sm font-medium text-gray-600">YouTube</label>
                <input type="text" name="youtube" id="youtube" value="{{ $information->youtube }}" class="mt-1 p-2 border rounded-md w-full">
            </div>

            <!-- Email Input -->
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-600">Email</label>
                <input type="email" name="email" id="email" value="{{ $information->email }}" class="mt-1 p-2 border rounded-md w-full">
            </div>

            <!-- Phone Input -->
            <div class="mb-4">
                <label for="phone" class="block text-sm font-medium text-gray-600">Phone</label>
                <input type="text" name="phone" id="phone" value="{{ $information->phone }}" class="mt-1 p-2 border rounded-md w-full">
            </div>

            <!-- Contrat Input -->
            <div class="mb-4">
                <label for="contrat" class="block text-sm font-medium text-gray-600">Contrat</label>
                <input type="text" name="contrat" id="contrat" value="{{ $information->contrat }}" class="mt-1 p-2 border rounded-md w-full">
            </div>

           
            <div class="flex justify-center ">
        <button type="submit" class="btn text-white w-60 " style="background:var(--primary-color);">Mettre à jour</button></div>
        </form>
    </div>

</div>

@endsection
