<x-app-layout>
    <div class="container mx-auto mt-8">
        <div class="max-w-md mx-auto bg-white rounded p-8">
            <h2 class="text-2xl text-black font-semibold mb-4">Créer une proposition pour l'offre: {{ $offer->title }}</h2>
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

                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-600">Name</label>
                    <input type="text" class="form-input mt-1 block w-full" id="name" name="name" required value="">
                </div>

                <div class="mb-4">
                    <label for="message" class="block text-sm font-medium text-gray-600">Your Proposition</label>
                    <textarea class="form-input mt-1 block w-full" id="message" name="negotiation" rows="4" required></textarea>
                </div>

                <div class="mb-4">
                    <label for="images" class="block text-sm font-medium text-gray-600">Images</label>
                    <input type="file" class="form-input mt-1 block w-full" id="images" name="image">
                </div>
                @if ($offer->buy_authorized)
<div class=" mb-4 block text-base font-bold text-black">Voulez vous acheter ?</div>
@else
<div class=" mb-4 block text-base font-bold text-orange-600">Cet utilisateur n'autorise pas la vente</div>
<div class=" mb-4 block text-base font-bold text-black">Equilibrez cet échange en proposant une soulte (en €) ?</div>
@endif
                <div class="mb-4">
                    <label for="offerPrice" class="block text-sm font-medium text-gray-600">Prix de l'offre:</label>
                    <div class="relative">
                    <input type="text" class="form-input mt-1 block w-full" id="offerPrice" value="{{ $offer->price }}" readonly>
                    <div class="absolute inset-y-0 right-0 flex items-center px-3 text-gray-600">
                            €
                        </div>
                    </div>
</div>
                <div class="mb-4 relative">
                    @if ($offer->buy_authorized)
                    <label for="propositionPrice" class="block text-sm font-medium text-gray-600">Votre proposition de prix:</label>
                    @else
                    <label for="propositionPrice" class="block text-sm font-medium text-gray-600">Votre soulte:</label>

                    @endif
                    <div class="relative">
                        <input type="text" class="form-input mt-1 block w-full pr-10" id="propositionPrice" name="price">
                        <div class="absolute inset-y-0 right-0 flex items-center px-3 text-gray-600">
                            €
                        </div>
                    </div>
                </div>

                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Submit Proposition</button>
            </form>
        </div>
    </div>
</x-app-layout>
