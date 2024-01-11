@extends('admin.template')

@section('admin-content')
    <div class="bg-white p-4 rounded shadow">
        <h3 class="text-lg font-semibold mb-2">Tous les utilisateurs</h3>

        <form action="{{ route('admin.users') }}" method="GET">
        <div class="mb-4 ">
                <label class="block text-sm font-medium text-gray-700">Recherche :</label>
                <input type="text" name="search" value="{{ request('search') }}" class="mt-1 p-2 border rounded-md">
                
                <!-- Use an icon (e.g., from FontAwesome or another icon library) as a link to submit the form -->
                <button type="submit" class="ml-2 text-blue-500 hover:text-blue-700">
                    <!-- Replace the content inside the span with your preferred search icon -->
                    <i class="fa fa-search" aria-hidden="true"></i>

                </button>
            </div>
            <div class="flex space-x-4 ">
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Filtrer par rôle :</label>
                <select name="role" id="filterRole" class="mt-1 p-2 border rounded-md" onchange="this.form.submit()">
                    <option value="">All Roles</option>
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
                    <option value="asc">Default</option>
                    <option value="asc" {{ request('sort_created_at') == 'asc' ? 'selected' : '' }}>Les plus anciens d'abord</option>
                    <option value="desc" {{ request('sort_created_at') == 'desc' ? 'selected' : '' }}>Les plus récents d'abord</option>
                </select>
            </div>
            </div>
        </form>

        <table class="min-w-full">
            <thead>
                <tr>
                <th class="py-2 px-4 border-b">Nom</th>
                    <th class="py-2 px-4 border-b">E-mail</th>
                    <th class="py-2 px-4 border-b">Rôle</th>
                    <th class="py-2 px-4 border-b">Actions</th>
                </tr>
            </thead>
            <tbody id="userTableBody">
                @foreach ($users as $user)
                    <tr class="user-row" data-role="{{ $user->role }}" data-created="{{ $user->created_at ? $user->created_at->format('Y-m-d') : '' }}">
                        <td class="py-2 px-4 border-b">{{ $user->name }}</td>
                        <td class="py-2 px-4 border-b">{{ $user->email }}</td>
                        <td class="py-2 px-4 border-b">{{ $user->role }}</td>
                        <td class="py-2 px-4 border-b">
                            <a href="{{ route('admin.user-details', ['id' => $user->id]) }}" class="text-blue-500 hover:underline">View Details</a>
                            <!-- Add more actions as needed, e.g., edit, delete, etc. -->
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Pagination Links -->
        <div class="mt-4">
            {{ $users->appends(request()->query())->links() }}
        </div>
    </div>

    <!-- ... Your previous HTML code ... -->



@endsection
