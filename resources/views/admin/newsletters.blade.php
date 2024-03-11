@extends('admin.template')

@section('admin-content')
    <div class="bg-white p-4 rounded shadow">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">
                Compose New Message
                <button type="submit" class="btn btn-primary"><i class="far fa-envelope"></i></button>
                </h3>
            </div>

            <div class="card-body">
                <div class="form-group">
                    <input class="form-control" placeholder="Subject:">
                </div>
                <div class="form-group">
                    <textarea id="compose-textarea" class="form-control" style="height: 300px; display: none;">                    
                    </textarea>
                    <div class="note-editor note-frame card">
                        <div class="note-editable card-block" contenteditable="true" role="textbox" aria-multiline="true" spellcheck="true" autocorrect="true">
                                <p>Thank you,</p>
                                <p>John Doe</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <h3 class="text-lg font-semibold mb-2">View List of All Email</h3>

        <form action="{{ route('admin.users') }}" method="GET">
        <div class="mb-4 flex  justify-between">
            <div>
                <label class="block text-sm font-medium text-gray-700">Rechercher:</label>
                <input type="text" name="search" value="{{ request('search') }}" class="mt-1 p-2 border rounded-md">
                
                <!-- Use an icon (e.g., from FontAwesome or another icon library) as a link to submit the form -->
                <button type="submit" class="ml-2 text-blue-500 hover:text-blue-700">
                    <!-- Replace the content inside the span with your preferred search icon -->
                    <i class="fa fa-search" aria-hidden="true"></i>
    
                </button>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Sort by Created Date:</label>
                <select name="sort_created_at" id="sortCreatedAt" class="mt-1 p-2 border rounded-md" onchange="this.form.submit()">
                    <option value="asc">Default</option>
                    <option value="asc" {{ request('sort_created_at') == 'asc' ? 'selected' : '' }}>Oldest First</option>
                    <option value="desc" {{ request('sort_created_at') == 'desc' ? 'selected' : '' }}>Newest First</option>
                </select>
            </div>
        </div>
        </form>

        <table class="min-w-full">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b">Email</th>
                </tr>
            </thead>
            <tbody id="userTableBody">
                @foreach ($newletters as $newletter)
                    <tr class="user-row" data-created="{{ $newletter->select('created_at')->get() ? $newletter->select('created_at')->get()->format('Y-m-d') : '' }}">
                        <td class="py-2 px-4 border-b">{{ $newletter->select('email')->get() }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Pagination Links -->
        <div class="mt-4">
            {{ $newletters->appends(request()->query())->links() }}
        </div>
    </div>

    <!-- ... Your previous HTML code ... -->



@endsection

