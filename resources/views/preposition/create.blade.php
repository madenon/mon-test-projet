<x-app-layout>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header  bg-primary-color hover:bg-primary-hover" >
                        <h4 class="mb-0">Create Proposition for Offer: {{ $offer->title }}</h4>
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
                                <input type="text" class="form-control" id="name" name="name" readonly required value="{{ auth()->user()->name }}">
                            </div>

                            <div class="form-group">
                                <label for="message">Your Proposition</label>
                                <textarea class="form-control" id="message" name="negotiation" rows="4" required></textarea>
                            </div>

                            <div class="form-group">
                                <label for="price">Price</label>
                                <input type="text" class="form-control" id="price" name="price" value="{{ old('price') }}">
                            </div>

                            <div class="form-group">
                                <label for="images">Images</label>
                                <input type="file" class="form-control" id="images" name="image">
                            </div>
                            <div class="flex justify-center my-2">
                                <button type="submit" class="text-white rounded-md w-48 h-12 flex 
                                    justify-center items-center bg-primary-color hover:bg-primary-hover" >Submit Proposition</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>