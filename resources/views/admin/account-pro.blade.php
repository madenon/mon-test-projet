@extends('admin.template')

@section('admin-content')
    <div class="bg-white p-4 rounded shadow">
        <h1>Pro</h1>
        <form action="{{ route('admin.pro') }}" method="GET">
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
                            <option value="{{ $role }}" {{ request('role') == $role ? 'selected' : '' }}>
                                {{ $role }}
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
                <div class="mt-8">
                {{count($users)}} items
            </div>
            </div>
           
        </form>
       
        <table class="min-w-full">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b">E-mail</th>
                    <th class="py-2 px-4 border-b">Statut</th>
                    <th class="py-2 px-4 border-b">Validation</th>
                    <th class="py-2 px-4 border-b">Actions</th>
                </tr>
            </thead>
            <tbody id="userTableBody">
                @foreach ($users as $user)
                    <tr class="user-row" data-role="{{ $user->statusPro }}" data-created="{{ $user->created_at ? $user->created_at->format('Y-m-d') : '' }}">
                        <td class="py-2 px-4 border-b">{{ $user->email }}</td>
                        <td class="py-2 px-4 border-b">
                            <span class="badge 
                                @if ($user->statusPro == 'pending')
                                bg-warning
                                @elseif ($user->statusPro == 'accepted')
                                bg-success
                                @elseif ($user->statusPro == 'rejected')
                                bg-danger
                                @else
                                bg-secondary
                                @endif
                            ">{{$user->statusPro}}</span>
                        </td> 
                        <td class="py-2 px-4 border-b">
                        <div class="flex justify-between space-x-1 md:space-x-2">
                            <button type="button" class="reject p-1 md:p-3" onclick="rejectUser({{ $user->id }},'{{ $user->email }}')">
                                <i class="fa-solid fa-ban" style="color: red;"></i> 
                            </button>
                            <button type="button" class="button-filter p-1 md:p-3" onclick="completeUser({{ $user->id }}, '{{ $user->email }}')">
                                <i class="fa-solid fa-check" style="color: white;"></i> 
                            </button>
                        </div>

                        </td>
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
        
    
    // Function to reject user using Swal
    function rejectUser(userId,userMail) {
        Swal.fire({
            title: 'Rejecter l\'utilisateur '+ userMail,
            text: 'Etes vous sur de rejecter l\'utilisateur comme pro?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Oui, rejecter!'
        }).then((result) => {
            if (result.isConfirmed) {
                updateStatus(userId,"rejected");
                console.log('User with ID ' + userId + ' rejected');
            }
        });
    }
    
    function updateStatus(userId, status){
        $.ajax({
            url: '/admin/becomePro',
            type: 'POST', // or 'GET', 'PUT', 'DELETE', etc.
            dataType: 'json',// Change the datatype as needed
            data: {
                "userId" : userId,
                "status" : status,
            },
            success: function(response) {
                // Request was successful, handle response here
                console.log('Request successful');
                location.reload();
            },
            error: function(xhr, status, error) {
                // Request failed, handle error here
                console.error('Request failed:', error);
            }
        });
    }
    // Function to complete user using Swal
    function completeUser(userId, userMail) {
        Swal.fire({
            title: 'Accepter l\'utilisateur '+ userMail,
            text: 'Etes vous sur d\'accepter l\'utilisateur comme pro?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Oui, accepter!'
        }).then((result) => {
            if (result.isConfirmed) {
                updateStatus(userId,"accepted");
                console.log('User with ID ' + userId + ' completed');
            }
        });
    }
    
    
    </script>

@endsection

