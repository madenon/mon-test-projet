@extends('admin.template')

@section('admin-content')
    <div>
        <h3 class="text-lg font-semibold mb-2">Voir la Liste de Tous les Rapports</h3>

        <form action="{{ route('admin.reports') }}" method="GET">
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Rechercher :</label>
                <input type="text" name="search" value="{{ request('search') }}" class="mt-1 p-2 border rounded-md">
                
                <!-- Utiliser une icône (par exemple, de FontAwesome ou une autre bibliothèque d'icônes) comme lien pour soumettre le formulaire -->
                <button type="submit" class="ml-2 text-blue-500 hover:text-blue-700">
                    <!-- Remplacez le contenu à l'intérieur du span par l'icône de recherche de votre choix -->
                    <i class="fa fa-search" aria-hidden="true"></i>
                </button>
            </div>
            <div class="flex space-x-4">
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Filtrer par Statut :</label>
                    <select name="isOpen" id="filterRole" class="mt-1 p-2 border rounded-md" onchange="this.form.submit()">
                        <option value="">Tous les statuts</option>
                        <option value="1" {{ request()->has('isOpen') && request()->isOpen == 1 ? 'selected' : '' }}>Ouvert</option>
                        <option value="0" {{ request()->has('isOpen') && request()->isOpen == 0 ? 'selected' : '' }}>Résolu</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Trier par Date de Création :</label>
                    <select name="sort_created_at" id="sortCreatedAt" class="mt-1 p-2 border rounded-md" onchange="this.form.submit()">
                        <option value="asc">Par Défaut</option>
                        <option value="asc" {{ request('sort_created_at') == 'asc' ? 'selected' : '' }}>Les Plus Anciens d'Abord</option>
                        <option value="desc" {{ request('sort_created_at') == 'desc' ? 'selected' : '' }}>Les Plus Récents d'Abord</option>
                    </select>
                </div>
            </div>
        </form>
        
        <livewire:admin.report-list/>

    </div>
@endsection
