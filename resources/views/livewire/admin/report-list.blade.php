<div>
    <table class="min-w-full">
        <thead>
            <tr>
                <th class="py-2 px-4 border-b">Title</th>
                <th class="py-2 px-4 border-b">Description</th>
                <th class="py-2 px-4 border-b">Reporter</th>
                <th class="py-2 px-4 border-b">Change status</th>
                <th class="py-2 px-4 border-b">Actions on offer</th>
            </tr>
        </thead>
        <tbody id="userTableBody">
            @foreach ($reports as $report)
            <tr class="user-row" data-status="{{ $report->isOpen }}" data-created="{{ $report->created_at ? $report->created_at->format('Y-m-d') : '' }}">
                <td class="py-2 px-4 border-b">{{ $report->title }}</td>
                <td class="py-2 px-4 border-b" id="report-{{$report->id}}">
                    @livewire('split-long-text ', [
                            'text' => $report->description,
                            'parentClass' => '#report-'.$report->id,
                            'len' => 12
                            ])
                </td>
                <td class="py-2 px-4 border-b">{{ $report->reporter->name }}</td>
                <td class="py-2 px-4 border-b" >
                    <a href="#" class="no-underline badge {{ $report->isOpen?'bg-danger' : 'bg-warning'}} rounded-pill d-inline"
                        wire:click.prevent="changeState({{$report->id}})">
                        {{ $report->isOpen ? 'Close' : 'Reopen'}}
                    </a>
                </td>
                <td class="py-2 px-4 border-b flex justify-around">
                    <a type="button" href="{{ route('admin.showOffer', [$report->offer->id ??0, $report->offer->slug??'']) }}" class="btn view-button">
                        <i class="fas fa-eye" style="color: #24a19c;"></i>
                    </a>
                    <a type="button" href="{{route('admin.editOffer', [$report->offer->id])}}" class="btn edit-button">
                        <i class="fas fa-edit" style="color: #ffc107;"></i>
                    </a>
                    <a type="button" href="{{route('admin.deleteOffer', [$report->offer->id])}}" class="btn delete-button">
                        <i class="fas fa-trash-alt" style="color: red"></i>
                    </a>
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
    