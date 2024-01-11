@extends('admin.template')

@section('admin-content')
    <div class="bg-white p-4 rounded shadow">
        <h3 class="text-lg font-semibold mb-2">Voir la liste de tous les litiges</h3>

        <form action="{{ route('admin.disputes') }}" method="GET">
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Recherche :</label>
                <input type="text" name="search" value="{{ request('search') }}" class="mt-1 p-2 border rounded-md">
                
                <!-- Utiliser une icône (par exemple, de FontAwesome ou une autre bibliothèque d'icônes) comme lien pour soumettre le formulaire -->
                <button type="submit" class="ml-2 text-blue-500 hover:text-blue-700">
                    <!-- Remplacez le contenu à l'intérieur de la balise span par votre icône de recherche préférée -->
                    <i class="fa fa-search" aria-hidden="true"></i>
                </button>
            </div>
            <div class="flex space-x-4">
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Filtrer par statut :</label>
                    <select name="isOpen" id="filterRole" class="mt-1 p-2 border rounded-md" onchange="this.form.submit()">
                        <option value="">Tous les statuts</option>
                        <option value="1" {{ request('isOpen') == 1 ? 'selected' : '' }}>Ouvert</option>
                        <option value="0" {{ request('isOpen') == 0 ? 'selected' : '' }}>Résolu</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Trier par date de création :</label>
                    <select name="sort_created_at" id="sortCreatedAt" class="mt-1 p-2 border rounded-md" onchange="this.form.submit()">
                        <option value="asc">Par défaut</option>
                        <option value="asc" {{ request('sort_created_at') == 'asc' ? 'selected' : '' }}>Les plus anciens d'abord</option>
                        <option value="desc" {{ request('sort_created_at') == 'desc' ? 'selected' : '' }}>Les plus récents d'abord</option>
                    </select>
                </div>
            </div>
        </form>
        
        <livewire:admin.dispute-list/>

    </div>
@endsection
