<x-app-layout>
<div class="container">
        <h1>Prepositions List</h1>
        <table class="table align-middle mb-0 bg-white">
            <thead class="bg-light">
                <tr>
                    <th>Name</th>
                    <th>Status</th>
                    <th>User</th>
                    <th>Offer</th>
                    <th>Actions</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($prepositions as $preposition)
                    <tr>
                        <td>{{ $preposition->name }}</td>
                        <td ><span class="badge {{ getStatusBadgeClass($preposition->status) }} rounded-pill d-inline">
                {{ $preposition->status }}
            </span></td>
                        <td>{{ $preposition->user_name }}</td>
                        <td>{{ $preposition->offer_name }}</td>
                        <td>
        <button type="button" class="btn btn-info">
          Edit
        </button>
        <button type="button" class="btn btn-danger">
          Delete
        </button>
      </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
 <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
</x-app-layout>
@php
    function getStatusBadgeClass($status) {
        switch ($status) {
            case 'validated':
                return 'bg-success';
            case 'pending':
                return 'bg-warning';
            case 'accepted':
                return 'bg-primary';
           
        }
    }
    @endphp