@extends('admin.template')

@section('admin-content')
    <div class="bg-white p-4 rounded shadow">
        <h3 class="text-lg font-semibold mb-2">View List of All Reports</h3>

        <form action="{{ route('admin.reports') }}" method="GET">
        <div class="mb-4 ">
                <label class="block text-sm font-medium text-gray-700">Rechercher:</label>
                <input type="text" name="search" value="{{ request('search') }}" class="mt-1 p-2 border rounded-md">
                
                <!-- Use an icon (e.g., from FontAwesome or another icon library) as a link to submit the form -->
                <button type="submit" class="ml-2 text-blue-500 hover:text-blue-700">
                    <!-- Replace the content inside the span with your preferred search icon -->
                    <i class="fa fa-search" aria-hidden="true"></i>

                </button>
            </div>
            <div class="flex space-x-4 ">
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Filter by Status:</label>
                <select name="isOpen" id="filterRole" class="mt-1 p-2 border rounded-md" onchange="this.form.submit()">
                    <option value=""> All satus</option>
                    <option value="1" {{ $request->has('isOpen') && $request('isOpen') == 1? 'selected':'' }}>Open</option>
                    <option value="0" {{ $request->has('isOpen') && $request('isOpen') == 0? 'selected':'' }}>Solved</option>
                </select>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Sort by Created Date:</label>
                <select name="sort_created_at" id="sortCreatedAt" class="mt-1 p-2 border rounded-md" onchange="this.form.submit()">
                    <option value="asc">Default</option>
                    <option value="asc" {{ request('sort_created_at') == 'asc' ? 'selected' : '' }}>Oldest First</option>
                    <option value="desc" {{ request('sort_created_at') == 'desc' ? 'selected' : '' }}>Newest First</option>
                </select>
            </div>
            </div>
        </form>
        
        <livewire:admin.report-list/>

    </div>



@endsection

