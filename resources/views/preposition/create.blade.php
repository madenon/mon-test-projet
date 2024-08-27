<x-app-layout>
<div class="container my-2 top-first">
        <nav style="--bs-breadcrumb-divider: '>'" aria-label="breadcrumb">
            <ol class="breadcrumb" class="no-underline bg-green-500 ">
                <li class="breadcrumb-item active" aria-current="page">{{ Diglactic\Breadcrumbs\Breadcrumbs::render('createprop', $offer->id, $offer->user->id,$offer->slug) }}
                </li>
            </ol>
        </nav>
    </div> 
    <div class="flex justify-center top-second">
        <div class="flex space-x-4 mt-4 mx-2">
            <div class="pe-4 tab" data-type="troc" id="trocTab">
                <a href="#" class="text-gray-600 hover:text-gray-800 no-underline focus:outline-none focus:text-gray-800 transition duration-300 ease-in-out">Propositions de trocs</a>
            </div>
            <div class="pe-6 tab" data-type="achat" id="achatTab">
                <a href="#" class="text-gray-600 hover:text-gray-800 no-underline focus:outline-none focus:text-gray-800 transition duration-300 ease-in-out">Propositions d'achats</a>
            </div>
        </div>
    </div>
    <style>
    @media (max-width: 768px) {
  .top-second{
    margin-top: 20px !important;
  }
  .top-first{
    margin-top: 100px !important;
  }
}</style>
    <div class="container mx-auto mt-8">
        <div class="max-w-lg mx-auto bg-white rounded p-8 pt-2 shadow-md">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form id="myForm" method="POST" action="{{ route('propositions.store') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="offer_id" value="{{ $offer->id }}">
                <input type="hidden" name="user_id" value="{{ $userid }}">

                <div id="offerSelect" class="mb-4 pt-8">
                    <label for="offerToggle" class="block text-sm font-medium text-gray-600 pb-4">Utiliser une offre existante?</label>
                    <button id="offerToggle" type="button" class="border border-gray-300 rounded-md px-4 py-2 transition duration-200"
                            style="background-color: var(--primary-color); color: white;">
                        Sélectionner une offre existante
                    </button>
                </div>

                <div id="offerSelectContainer" class="mb-4 hidden">
                    <label for="offerSelect" class="block text-sm font-medium text-gray-600">Sélectionnez une offre</label>
                    <select id="offerSelected" class="form-input mt-1 block w-full" onchange="fillOfferDetails()">
                        <option value="" disabled selected>Choisissez une offre</option>
                        @foreach ($offers as $myOffer)
                            <option value="{{ $myOffer->id }}" 
                                    data-title="{{ $myOffer->title }}" 
                                    data-description="{{ $myOffer->description }}" 
                                    data-price="{{ $myOffer->price }}"
                                    data-images="{{ json_encode($images) }}">
                                {{ $myOffer->title }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div id="descriptionContainer" class="mb-4">
                    <label for="description" class="block text-sm font-medium text-gray-600">Description</label>
                    <textarea class="form-input mt-1 block w-full" id="description" name="name" rows="4" required></textarea>
                </div>

                <div class="mb-4">
                    <span id="insertImage" class="text-sm text-gray-600">Insérer des photos</span>
                    <div id="photos" class="border-dashed border-2 border-gray-400 rounded-md px-3 py-2 bg-neutral-100">
                        <label for="additional_images" class="cursor-pointer flex items-center justify-center gap-4">
                            <input id="additional_images" type="file" name="additional_images[]" accept="image/*" multiple class="hidden" />
                            <img src="/images/IconContainer.svg" alt="">
                            <p class="text-sm text-gray-600">Parcourir l'image</p>
                        </label>
                        <span id="selectedFileNameMultiple" class="text-sm text-gray-600 mt-2">Aucun fichier sélectionné</span>
                    </div>
                    <x-input-error :messages="$errors->get('additional_images')" class="mt-2" />
                </div>

                <div id="additionalImageSelected" class="my-2 flex justify-start flex-wrap"></div>

                <div id="buySection" class="mb-4">
                        <div class="mb-4 text-base font-bold text-black">Équilibrez cet échange en proposant une soulte (en €) ?</div>
                </div>
                <div id="buyAuth" class="mb-4">
                @if($offer->buy_authorized)
                        <div class="mb-4 text-base font-bold text-orange-600">Cet utilisateur n'autorise pas la vente</div>
                        @endif
                    </div>
                <div id="priceSection" class="mb-4">
                    <label for="offerPrice" class="block text-sm font-medium text-gray-600">Prix de l'offre:</label>
                    <div class="relative">
                        <input type="number" class="form-input mt-1 block w-full" id="offerPrice" readonly>
                        <div class="absolute inset-y-0 right-0 flex items-center px-3 text-gray-600">€</div>
                    </div>
                </div>

                <div class="mb-4">
                    <label id="propPrice" for="propositionPrice" class="block text-sm font-medium text-gray-600">Votre proposition de prix:</label>
                    <label id="soulte" for="soulte" class="block text-sm font-medium text-gray-600">Votre soulte:</label>
                    <div class="relative">
                        <input type="number" step="0.01" min="0" class="form-input mt-1 block w-full" id="propositionPrice" name="price">
                        <div class="absolute inset-y-0 right-0 flex items-center px-3 text-gray-600">€</div>
                    </div>
                </div>

                <div class="flex justify-center mt-4">
                    <button type="submit" class="btn text-white px-4 py-2" style="background: var(--primary-color);">
                        Ajouter la proposition
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
         function switchViews(type){
                    if (type === 'troc') {
                        document.getElementById('buySection').style.display = 'block';
                        document.getElementById('buyAuth').style.display = 'none';
                        document.getElementById('priceSection').style.display = 'none';
                        document.getElementById('propPrice').style.display = 'none';
                        document.getElementById('description').value = '';
                        document.getElementById('offerPrice').value = '';
                        document.getElementById('photos').style.display = 'block';
                        document.getElementById('soulte').style.display = 'block';
                        document.getElementById('insertImage').style.display = 'block';
                        document.getElementById('offerSelect').style.display = 'block';
                        document.getElementById('descriptionContainer').style.display = 'block';
                       // document.getElementById('offerSelectContainer').style.display = 'block';
                        document.getElementById('additionalImageSelected').style.display = 'block';
                    } else if (type === 'achat') {
    document.getElementById('buySection').style.display = 'none';
    document.getElementById('priceSection').style.display = 'block';
    document.getElementById('buyAuth').style.display = 'block';
    document.getElementById('description').value = 'Proposition d\'achat';
    document.getElementById('offerPrice').value = '{{ $offer->price }}';
    
    // Hide and disable fields
    document.getElementById('photos').style.display = 'none';
    document.getElementById('photos').disabled = true;
    
    document.getElementById('insertImage').style.display = 'none';
    document.getElementById('insertImage').disabled = true;
    
    document.getElementById('offerSelect').style.display = 'none';
    document.getElementById('offerSelect').disabled = true;
    
    document.getElementById('descriptionContainer').style.display = 'none';
    document.getElementById('descriptionContainer').disabled = true;
    
    document.getElementById('soulte').style.display = 'none';
    document.getElementById('soulte').disabled = true;
    
    document.getElementById('offerSelectContainer').disabled = true;
    
    document.getElementById('additionalImageSelected').style.display = 'none';
    document.getElementById('additionalImageSelected').disabled = true;
    // offer selection 
    var offerSelectContainer = document.getElementById('offerSelectContainer');
    var text = document.getElementById('offerToggle');
            if (!offerSelectContainer.classList.contains('hidden')) {
                offerSelectContainer.classList.add('hidden');
                text.textContent = 'Sélectionner une offre existante';
            } 
   // Get all elements by name 'existing_images[]'
var elements = Array.from(document.getElementsByName('existing_images[]'));

// Iterate over the array and remove each element
elements.forEach(function(element) {
    element.remove();
});
var images = Array.from(document.getElementsByName('additional_images[]'));

// Iterate over the array and remove each element
images.forEach(function(element) {
    element.remove();
});


}
}
        // Toggle the visibility of the offer select container
        document.getElementById('offerToggle').addEventListener('click', function() {
            var offerSelectContainer = document.getElementById('offerSelectContainer');
            console.log(offerSelectContainer);
            if (offerSelectContainer.classList.contains('hidden')) {
                offerSelectContainer.classList.remove('hidden');
                this.textContent = 'Cacher la sélection des offres';
            } else {
                offerSelectContainer.classList.add('hidden');
                this.textContent = 'Sélectionner une offre existante';
            }
        });

        document.addEventListener('DOMContentLoaded', function () {
            // Set default active tab based on initial conditions if needed
            var defaultActiveTab = document.querySelector('#trocTab'); // Example default tab
            if (defaultActiveTab) {
                defaultActiveTab.classList.add('active');
            }
           switchViews('troc');
            // Add click event listeners to tabs
            document.querySelectorAll('.tab').forEach(function (tab) {
                tab.addEventListener('click', function () {
                    // Remove 'active' class from all tabs
                    document.querySelectorAll('.tab').forEach(function (t) {
                        t.classList.remove('active');
                    });

                    // Add 'active' class to the clicked tab
                    tab.classList.add('active');

                    // Toggle content based on selected tab
                    var type = tab.getAttribute('data-type');
                    if (type==='troc') switchViews('troc') ;
                    else switchViews('achat') ;
                   
                });
            });
        });

        function fillOfferDetails() {
            var offerSelect = document.getElementById('offerSelected');
            var selectedOption = offerSelect.options[offerSelect.selectedIndex];
            if (selectedOption.value) {
                document.getElementById('description').value = selectedOption.getAttribute('data-description');
              //  document.getElementById('offerPrice').value = selectedOption.getAttribute('data-price');
//console.log(selectedOption.getAttribute('data-description'));
                var additionalImageSelected = document.getElementById('additionalImageSelected');

                var additionalImages = JSON.parse(selectedOption.getAttribute('data-images'));
                additionalImages.forEach(function(img) {
                    // Create a hidden input for each image URL or ID
                    var inputElement = document.createElement('input');
                    inputElement.type = 'hidden';
                    inputElement.name = 'existing_images[]';
                    inputElement.value = img.offer_photo;  // Assuming this is a unique identifier or path

                    // Append hidden input to the form
                    document.querySelector('#myForm').appendChild(inputElement);

                    // Create an image preview element with delete button
                    var imgWrapper = document.createElement('div');
                    imgWrapper.classList.add('relative', 'mr-2', 'mb-2');

                    var imgElement = document.createElement('img');
                    imgElement.src = `{{ route('offer-pictures-file-path', '') }}/${img.offer_photo}`;
                    imgElement.classList.add('w-24', 'h-auto');

                    var deleteButton = document.createElement('button');
                    deleteButton.type = 'button';
                    deleteButton.classList.add('absolute', 'top-0', 'right-0');
                    deleteButton.innerHTML = `<img src="{{ asset('/images/close-icon2.png') }}" alt="Delete" class="w-6 h-6">`;

                    // Delete action
                    deleteButton.addEventListener('click', function() {
                        imgWrapper.remove();
                        inputElement.remove();
                    });

                    imgWrapper.appendChild(imgElement);
                    imgWrapper.appendChild(deleteButton);
                    additionalImageSelected.appendChild(imgWrapper);
                });
            }
        }

        // Update the selected file name display and preview images
        document.getElementById('additional_images').addEventListener('change', function(event) {
            var files = event.target.files;
            var fileName = files.length ? Array.from(files).map(file => file.name).join(', ') : 'Aucun fichier sélectionné';
            document.getElementById('selectedFileNameMultiple').textContent = fileName;

            var additionalImageSelected = document.getElementById('additionalImageSelected');

            Array.from(files).forEach(function(file, index) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    var imgWrapper = document.createElement('div');
                    imgWrapper.classList.add('relative', 'mr-2', 'mb-2');

                    var imgElement = document.createElement('img');
                    imgElement.src = e.target.result;
                    imgElement.classList.add('w-24', 'h-auto');

                    var deleteButton = document.createElement('button');
                    deleteButton.type = 'button';
                    deleteButton.classList.add('absolute', 'top-0', 'right-0');
                    deleteButton.innerHTML = `<img src="{{ asset('/images/close-icon2.png') }}" alt="Delete" class="w-6 h-6">`;

                    // Remove preview and file input
                    deleteButton.addEventListener('click', function() {
                        imgWrapper.remove();
                        document.getElementById('additional_images').files[index] = null;
                    });

                    imgWrapper.appendChild(imgElement);
                    imgWrapper.appendChild(deleteButton);
                    additionalImageSelected.appendChild(imgWrapper);
                };
                reader.readAsDataURL(file);
            });
        });
    </script>
</x-app-layout>
<style>
    .tab {
        padding-bottom: 2px;
    }
    .tab.active {
        border-bottom: 2px solid #24a19c;
    }
</style>