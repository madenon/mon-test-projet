<div>
    <table class="min-w-full">
        <thead>
            <tr>
                <th class="py-2 px-4 border-b">Title</th>
                <th class="py-2 px-4 border-b">Description</th>
                <th class="py-2 px-4 border-b">Disputer</th>
                <th class="py-2 px-4 border-b">Change status</th>
                <th class="py-2 px-4 border-b">Actions on transaction</th>
                <th class="py-2 px-4 border-b">Actions on countreparty</th>
            </tr>
        </thead>
        <tbody id="userTableBody">
            @foreach ($disputes as $dispute)
            <tr class="user-row" data-status="{{ $dispute->isOpen }}" data-created="{{ $dispute->created_at ? $dispute->created_at->format('Y-m-d') : '' }}">
                <td class="py-2 px-4 border-b">{{ $dispute->title }}</td>
                <td class="py-2 px-4 border-b" id="dispute-{{$dispute->id}}">
                    @livewire('split-long-text ', [
                            'text' => $dispute->description,
                            'parentClass' => '#dispute-'.$dispute->id,
                            'len' => 12
                            ])
                </td>
                <td class="py-2 px-4 border-b">{{ $dispute->disputer->name }}</td>
                <td class="py-2 px-4 border-b" >
                    <a href="#" class="no-underline badge {{ $dispute->isOpen?'bg-danger' : 'bg-warning'}} rounded-pill d-inline"
                        wire:click.prevent="changeState({{$dispute->id}})">
                        {{ $dispute->isOpen ? 'Close' : 'Reopen'}}
                    </a>
                </td>
                <td class="py-2 px-4 border-b">
                    
                    <a type="button" href="{{route('admin.freezeProposition', [$dispute->transaction->id])}}" class="btn delete-button">
                        <i class="fas fa-lock" style="color: #24a19c"></i>
                    </a>
                </td>
                <td class="py-2 px-4 border-b flex justify-around">
                    <a type="button" href="{{ route('admin.showOffer', [$dispute->transaction->id ??0, $dispute->transaction->slug??'']) }}" class="btn view-button">
                        <i class="fas fa-eye" style="color: #24a19c;"></i>
                    </a>
                    <a type="button" href="{{route('admin.editOffer', [$dispute->transaction->id])}}" class="btn edit-button">
                        <i class="fas fa-edit" style="color: #ffc107;"></i>
                    </a>
                    <a type="button" href="{{route('admin.deleteOffer', [$dispute->transaction->id])}}" class="btn delete-button">
                        <i class="fas fa-trash-alt" style="color: red"></i>
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
    <!-- Pagination Links -->
    <div class="mt-4">
        {{ $disputes->appends(request()->query())->links() }}
    </div>

</div>