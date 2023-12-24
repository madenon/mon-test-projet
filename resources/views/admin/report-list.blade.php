@extends('admin.index')

@section('admin-content')
    <div class="bg-white p-4 rounded shadow">
        <h3 class="text-lg font-semibold mb-2">View List of All Users</h3>

        <form action="{{ route('admin.users') }}" method="GET">
        <div class="mb-4 ">
                <label class="block text-sm font-medium text-gray-700">Search:</label>
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
                <select name="role" id="filterRole" class="mt-1 p-2 border rounded-md" onchange="this.form.submit()">
                    <option value="">All satus</option>
                        <option value="open" {{ request('isOpen') == 1 }}>Open</option>
                        <option value="solved" {{ request('isOpen') == 0 }}>Solved</option>
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

        <table class="min-w-full">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b">Title</th>
                    <th class="py-2 px-4 border-b">Description</th>
                    <th class="py-2 px-4 border-b">Reporter</th>
                    <th class="py-2 px-4 border-b">Offer</th>
                </tr>
            </thead>
            <tbody id="userTableBody">
                @foreach ($reports as $report)
                    <tr class="user-row" data-status="{{ $report->isOpen }}" data-created="{{ $report->created_at ? $report->created_at->format('Y-m-d') : '' }}">
                        <td class="py-2 px-4 border-b">{{ $report->title }}</td>
                        <td class="py-2 px-4 border-b">
                            <span class="description-content text-gray-500 dark:text-gray-400">{{$report->description}}
                                @if (strlen($report->description) > 12)
                                <a href="#" class="block mb-5 text-sm font-medium text-blue-600 hover:underline dark:text-blue-500 read-more">Read more</a>
                                @endif
                            </span>
                            <span class="hidden extra-description text-gray-500 dark:text-gray-400">{{$report->description}}
                                @if (strlen($report->description) > 12)
                                <a href="#" class="block mb-5 text-sm font-medium text-blue-600 hover:underline dark:text-blue-500 read-more">Read more</a>
                                @endif
                            </span>
                        </td>
                        <td class="py-2 px-4 border-b">{{ $report->reporter->name }}</td>
                        <td class="py-2 px-4 border-b">
                            <a href="{{ route('offer.offer', [$report->offer->id ??0, $report->offer->slug??'']) }}" class="text-blue-500 hover:underline">View Order</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Pagination Links -->
        <div class="mt-4">
            {{ $reports->appends(request()->query())->links() }}
        </div>
    </div>

    <script>


$(document).ready(function () {

    var descriptionContent = document.querySelector(`.description-content`);
    var extradescription = document.querySelector(`.extra-description`);
    var readMoreLink = document.querySelector(`.read-more`);

    if (descriptionContent.innerText.length > 12) {
        var truncatedContent = descriptionContent.innerText.slice(0, 12 );
        truncatedContent += '...';
        descriptionContent.innerText = truncatedContent;
    }

    readMoreLink.addEventListener('click', function (e) {
        e.preventDefault();

        descriptionContent.classList.toggle('hidden');
        extradescription.classList.toggle('hidden');

        if (readMoreLink.innerText === 'Read more') {
            readMoreLink.innerText = 'Read less';
        } else {
            readMoreLink.innerText = 'Read more';
        }
    });
 });


</script>


@endsection

