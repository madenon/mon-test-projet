<x-app-layout>
<div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">
                        Create Proposition for Offer: {{ $offer->title }}
                    </div>

                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('propositions.store') }}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="offer_id" value="{{ $offer->id }}">
                            <input type="hidden" name="user_id" value="{{ $userid }}">

                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>

                            <div class="form-group">
                                <label for="message">Your Proposition</label>
                                <textarea class="form-control" id="message" name="negotiation" rows="4" required></textarea>
                            </div>
                            <!-- Add these fields inside your form in the preposition.create view -->
<div class="form-group">
    <label for="price">Price</label>
    <input type="text" class="form-control" id="price" name="price" value="{{ old('price') }}">
</div>

<div class="form-group">
    <label for="images">Images</label>
    <input type="file" class="form-control" id="images" name="image" >
</div>


                            <button type="submit" class="btn btn-primary">Submit Proposition</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>