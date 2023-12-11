@extends('admin.index')

@section('admin-content')
    <div class="bg-white p-4 rounded shadow">
        <h3 class="text-lg font-semibold mb-2">View List of All Users</h3>

        <form action="{{ route('admin.users') }}" method="GET">
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Filter by Role:</label>
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
                <label class="block text-sm font-medium text-gray-700">Filter by Recent Added:</label>
                <select name="recent_added" id="filterRecentAdded" class="mt-1 p-2 border rounded-md" onchange="this.form.submit()">
                    <option value="0">All Users</option>
                    <option value="1" {{ request('recent_added') == '1' ? 'selected' : '' }}>Recent Added</option>
                </select>
            </div>
        </form>

        <table class="min-w-full">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b">Name</th>
                    <th class="py-2 px-4 border-b">Email</th>
                    <th class="py-2 px-4 border-b">Role</th>
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
