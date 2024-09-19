@extends('admin.template')

@section('admin-content')
    <div >
        <h1>Utilisateurs</h1>
        <form action="{{ route('admin.users') }}" method="GET">
            <div class="mb-4 ">
                <label class="block text-sm font-medium text-gray-700">Rechercher :</label>
                <input type="text" name="search" value="{{ request('search') }}" class="mt-1 p-2 border rounded-md">
                
                <!-- Utiliser une icône (par exemple, de FontAwesome ou une autre bibliothèque d'icônes) comme lien pour soumettre le formulaire -->
                <button type="submit" class="ml-2 text-blue-500 hover:text-blue-700">
                    <!-- Remplacez le contenu à l'intérieur de la balise span par votre icône de recherche préférée -->
                    <i class="fa fa-search" aria-hidden="true"></i>
                </button>
            </div>
            <div class="flex space-x-4 ">
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Filtrer par rôle :</label>
                    <select name="role" id="filterRole" class="mt-1 p-2 border rounded-md" style="width: 200px;" onchange="this.form.submit()">
                        <option value="">Tous les rôles</option>
                        @foreach ($roles as $role)
                            <option value="{{ $role->name }}" {{ request('role') == $role->name ? 'selected' : '' }}>
                                {{ $role->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Trier par date de création :</label>
                    <select name="sort_created_at" id="sortCreatedAt" class="mt-1 p-2 border rounded-md" onchange="this.form.submit()">
                        <option value="asc">Par défaut</option>
                        <option value="asc" {{ request('sort_created_at') == 'asc' ? 'selected' : '' }}>Les plus anciens en premier</option>
                        <option value="desc" {{ request('sort_created_at') == 'desc' ? 'selected' : '' }}>Les plus récents en premier</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Filtrer par statut :</label>
                    <select name="status" id="filterStatus" class="mt-1 p-2 border rounded-md" style="width: 200px;" onchange="this.form.submit()">
                        <option value="">Tous les statuts</option>
                        <option value="actif" {{ request('status') == 'actif' ? 'selected' : '' }}>Actif</option>
                        <option value="inactif" {{ request('status') == 'inactif' ? 'selected' : '' }}>Inactif</option>
                    </select>
                </div>
                <div class="mt-8">
                {{count($users)}} items
            </div>
            </div>
           
        </form>
       
        <table class="min-w-full">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b">Nom</th>
                    <th class="py-2 px-4 border-b">Prénom</th>
                    <th class="py-2 px-4 border-b">E-mail</th>
                    <th class="py-2 px-4 border-b">Téléphone</th>
                    <th class="py-2 px-4 border-b">Statut</th>
                    <th class="py-2 px-4 border-b">Rôle</th>
                    <th class="py-2 px-4 border-b">Actions</th>
                </tr>
            </thead>
            <tbody id="userTableBody">
                @foreach ($users as $user)
                    <tr class="user-row" data-role="{{ $user->role }}" data-created="{{ $user->created_at ? $user->created_at->format('Y-m-d') : '' }}">
                        <td class="py-2 px-4 border-b">{{ $user->first_name }}</td>
                        <td class="py-2 px-4 border-b">{{ $user->last_name ?? '' }}</td>
                        <td class="py-2 px-4 border-b">{{ $user->email }}</td>
                        <td class="py-2 px-4 border-b">{{ $user->userInfo->phone ?? '' }}</td>
                        <td class="py-2 px-4 border-b">
                            @if ($user->hasVerifiedEmail())
                                <i class="fas fa-check text-green-500"></i>
                            @else
                                <i class="fas fa-times text-red-500"></i>
                            @endif
                        </td>                
                        <td class="py-2 px-4 border-b">{{ $user->role }}</td>
                        <td class="py-2 px-4 border-b">
                            <a href="{{ route('admin.user-details', ['id' => $user->id]) }}" class="text-blue-500 hover:underline">Voir les détails</a>
                            <!-- Add other actions as needed, e.g., edit, delete, etc. -->
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
                <!-- Liens de pagination -->
        <div class="mt-4">
            {{ $users->appends(request()->query())->links() }}
        </div>
    </div>
    </div>
    <script>
        
        // $("li span").toggle();
    $("#new-contest").click(function(){
        $(".new-contest-form").toggle();
        // $(".new-contest-form button").toggle();
    })
    </script>

@endsection

