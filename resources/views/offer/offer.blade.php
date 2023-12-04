<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $offer->title }}
        </h2>
    </x-slot>
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <div class="offre-page mx-9">
        <nav style="--bs-breadcrumb-divider: '>'" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">{{ Diglactic\Breadcrumbs\Breadcrumbs::render('offers') }}</li>
            </ol>
        </nav>
    </div>
    @php
    $conditionMapping = [
    'NEW' => 'Neuf',
    'VERY_GOOD' => 'Très bon état',
    'GOOD' => 'Bon état',
    'MEDIUM' => 'Etat moyen',
    'BAD' => 'Mauvais état',
    'BROKEN' => 'En panne',
    ];
    @endphp
    <div class="flex gap-5 offre-page">
        <div class="w-[50%] ml-12 partie-slide">
            <div class=" flex flex-col gap-6">
                <div class="">
                    <img src="{{ route('offer-pictures-file-path',$offer->offer_default_photo) }}"
                        alt="Image principale" id="mainImage" class=" h-[450px] w-[750px] rounded-lg " />
                </div>
                <div class="flex scrollBar  gap-3 overflow-x-auto p-2 h-">
                    @foreach ($images as $img)
                        <img src="{{ route('offer-pictures-file-path',$img->offer_photo) }}" alt="Image produit"
                            class=" h-[80px] hover:cursor-pointer hover:scale-110 rounded-lg hover:transition-transform hover:transform-gpu "
                            onmouseover="changeMainImage('{{ $img->offer_photo }}')"
                            onmouseout="changeMainImage('{{ $offer->offer_default_photo }}')" />
                    @endforeach
                </div>
            </div>
            <div class="my-5">
                <div class="my-3">
                    <h2 class="text-titles ">Description</h2>
                    <p>{{ $offer->description }}</p>
                </div>
                <div id="map" class=" mt-5">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5916333.136450014!2d-1.3992720794176445!3d43.60998660794066!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x12b6af0725dd9db1%3A0xad8756742894e802!2sMontpellier%2C%20France!5e0!3m2!1sfr!2sma!4v1697796341376!5m2!1sfr!2sma"
                        class="h-[400px] w-[100%]" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
        <div class="w-[38%] partie-detail">
            <h2 class="text-titles  font-semibold">{{ $offer->title }}</h2>
            @auth
    <form action="{{ route('propositions.create', ['offerid' => $offer->id,'userid'=>auth()->id()]) }}" method="get">
        <button class="my-2 w-full text-white  font-semibold py-3 rounded-md bg-primary-color hover:bg-primary-hover " type="submit">
            {{ __('Troquez Maintenant ') }}
        </button>
    </form>
@else
<form action="{{ route('login') }}" method="get">
        <button class="my-2 w-full text-white  font-semibold py-3 rounded-md bg-primary-color hover:bg-primary-hover " type="submit">
            {{ __('Troquez Maintenant ') }}
        </button>
    </form>
@endauth

            <div class="border pt-4 flex rounded-lg flex-col ">
                <div class="flex pb-3 px-12 gap-2 flex-col ">
                    <div class="flex  items-center   ">
                        <span class="w-[35%]">
                            Type de troc:
                        </span>
                        <span class="text-titles text-lg ">
                            {{$offer->type->name }}
                        </span>
                    </div>
                    <div class="flex    items-center   ">
                        <span class="w-[35%]">
                            Categorie:
                        </span>
                        <span class="text-titles text-lg flex items-center div-categorie">
                            <img src="/images/Stack.svg" alt="" class="mr-2">
                            {{$offer->category->name}}
                            <img src="/images/chevron-right.svg" alt="" class="px-2">
                            {{$subcategory->name}}
                        </span>
                    </div>
                    <div class="flex    items-center   ">
                        <span class="w-[35%]">
                            Mis en ligne le:
                        </span>
                        <span class="text-titles text-lg flex ">
                            {{ $offer->user->created_at->format('d M Y | H:i:s') }}
                        </span>
                    </div>
                </div>
                @if($offer->condition)
                <div class=" border-y py-3 ">
                    <div class=" px-12 flex    items-center">
                        <span class="w-[35%]">
                            L’etat:
                        </span>
                        <span class="text-titles text-lg flex gap-2 ">
                            &#128578;
                            <p>{{ $conditionMapping[$offer->condition] }}</p>
                        </span>
                    </div>
                </div>
                @endif
                <div class="border-b py-3">
                    <div class="px-12 flex   gap-2 items-center">
                        <img src="/images/map-pin.svg" alt="">
                        <span class="">
                            {{$offer->region->name . ", " .
                            $offer->department->name}}
                        </span>
                    </div>
                    @if(auth()->check() && $offer->user_id === auth()->user()->id)
                            </div>
                <div class="flex flex-col items-center pt-3">
    <h2 class="text-center text-black">Propositions sur cette offre</h2>

   
        @foreach ($offer->preposition as $proposition)
            <a href="#" style="background-color: #24a19c; color:white;" class="ml-5 w-50 mt-2 btn proposition-link" data-bs-toggle="modal" data-bs-target="#exampleModal" 
            data-id="{{ $proposition->id }}" data-image="{{ route('proposition-pictures-file-path', $proposition->images ? $proposition->images : '') }}"  
            data-status="{{ $proposition->status }}" data-user="{{ $proposition->user }}" data-offer="{{ $proposition->offer }}" data-meet="{{ $proposition->meetup }}">
                {{ $proposition->name }}
            </a>
        @endforeach
    @endif
</div>

                <div class=" pt-3">
                    <div class="px-12 flex justify-content-between  gap-2 items-center">
                        @if($offer->price)
                        <span class="text-titles text-2xl font-semibold">
                            {{$offer->price}} €
                        </span>
                        @endif
                        @if ($offer->buy_authorized)
                        <span class="flex bg-red-100  rounded-full px-3 py-1 gap-2 text-red-500">
                            <span class="bg-red-500 px-2 rounded-full text-white">$</span>
                            <span>Vente autorisé</span> 
                            
                           
                        </span>@endif
                    </div>
                    <div class="m-4 bg-gray-100 p-4 rounded-lg">
                        <h5>À ÉCHANGER CONTRE :</h5>
                        <span class="flex gap-2 px-5">
                        @if($offer->specify_proposition)
                            <img src="/images/Icon.svg" alt="">
                            <span>
                                Etudie toute proposition
                            </span>
                            @endif
                        </span>
                        @if($offer->dynamic_inputs)
                        @foreach (json_decode($offer->dynamic_inputs, true) as $prop )
                        @if($prop!=null)
                        <span class="flex gap-2 px-5">
                            <img src="/images/Icon.svg" alt="">  {{$prop}} </span>
                            @endif
                                @endforeach
                                @endif
                    </div>
                </div>
            </div>
            <div class=" my-4  justify-center border-black py-2 border-b rounded-lg flex gap-2 w-52">
                <img src="/images/flag_FILL0_wght200_GRAD-25_opsz20 1.svg" alt="">
                <span>
                    Signalez ce troc
                </span>
            </div>
            <div class="border rounded-lg pb-4">
                <h4 class="text-titles border-b px-5 py-4">Vendeur</h4>
                <div>
                    <div class="flex justify-between px-4 py-2">
                        <div class="flex gap-3  ">
                            @if (!$offer->user->profile_photo_path)
                            <img src="/images/user-avatar-icon.svg" alt="Avatar">
                            @else
                            <img class="w-12 h-12 rounded-full" src="{{ route('profile_pictures-file-path',$offer->user->profile_photo_path) }}" alt=""
                                class="rounded-full">
                            @endif
                            <span class="flex flex-col">
                                <span class="text-titles font-medium">
                                    {{$offer->user->first_name . " " .
                                    $offer->user->last_name}}
                                </span>
                                @if ($offer->user->is_online=="Offline")
                                <span class="text-red-500">Hors ligne</span>
                                @else
                                <span class="text-green-500">En ligne</span>
                                @endif
                            </span>
                            <img src="/images/Badge-pro.svg" alt="" class="pb-3 ">
                        </div>
                        <div class="flex flex-col ">
                            <span>
                                4/5 (6 avis)
                            </span>
                            <span class="flex">
                                <i class="fa-solid fa-star text-orange-600"></i>
                                <i class="fa-solid fa-star text-orange-600"></i>
                                <i class="fa-solid fa-star text-orange-600"></i>
                                <i class="fa-solid fa-star text-orange-600"></i>
                                <i class="fa-solid fa-star text-gray-200"></i>
                            </span>
                        </div>
                    </div>
                    <div class="m-4 flex gap-4 justify-content-between">
                        <div>
                            <span class="bg-gray-200 rounded-full px-2">1</span>
                            Trocs
                        </div>
                        <div>
                            <span class="bg-gray-200 rounded-full px-2">1</span>
                            Offres
                        </div>
                        <div>
                            <span class="bg-gray-200 rounded-full px-2">1</span>
                            Avis
                        </div>
                    </div>
                    <div class=" flex px-3 gap-4">
                        <button
                            class="my-2 w-full text-white  font-semibold py-3 rounded-md bg-primary-color hover:bg-primary-hover">
                            Voir Profil
                        </button>
                        <button class="my-2 w-full text-white  font-semibold py-3 rounded-md bg-black ">
                            Contact
                        </button>
                    </div>
                </div>
            </div>
            <div class="m-auto mt-5 w-[60%]  ">
                <h5 class="mb-4">
                    Partager cette annonce à vos amis
                </h5>
                <div class=" flex justify-content-between social-button">
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ route('offer.offer', ['offerId'=>$offer->id,'slug' => $offer->slug]) }}">
                        <i id="facebookBtn" class="fa-brands fa-facebook text-gray-900 p-2 bg-gray-200 rounded-full hover:bg-primary-color hover:text-white"></i>
                    </a>
                    <a href="https://twitter.com/share?url={{ route('offer.offer', ['offerId'=>$offer->id,'slug' => $offer->slug]) }}&text={{ rawurlencode($offer->name) }}">
                        <i id="twitterBtn" class="fa-brands fa-twitter text-gray-900 p-2 bg-gray-200 rounded-full hover:bg-primary-color hover:text-white"></i>
                    </a>
                    <a href="instagram://share?text={{ rawurlencode('Check out this offer on Faitroquez.fr: ' . route('offer.offer', ['offerId' => $offer->id, 'slug' => $offer->slug])) }}">
                        <i id="instagramBtn" class="fa-brands fa-instagram text-gray-900 p-2 bg-gray-200 rounded-full hover:bg-primary-color hover:text-white"></i>
                    </a>
                    <a href="https://www.linkedin.com/shareArticle?url={{ route('offer.offer', ['offerId'=>$offer->id,'slug' => $offer->slug]) }}&title={{ rawurlencode($offer->name) }}">
                        <i id="linkedinBtn" class="fa-brands fa-linkedin text-gray-900 p-2 bg-gray-200 rounded-full hover:bg-primary-color hover:text-white"></i>
                    </a>
                    <a href="https://api.whatsapp.com/send?text={{ route('offer.offer', ['offerId'=>$offer->id,'slug' => $offer->slug]) }}">
                        <i id="whatsappBtn" class="fa-brands fa-whatsapp text-gray-900 p-2 bg-gray-200 rounded-full hover:bg-primary-color hover:text-white"></i>
                    </a>
                        
                </div>
            </div>
        </div>
    </div>
    <section class="similarOffers mt-4">
        <div class="flex justify-between px-24">
            <h1 class="mb-6 ml-12 font-sans text-2xl font-bold text-gray-900">Offres similaire</h1>
            <button class="bg-primary-color hover:bg-primary-hover mr-12 text-white font-bold py-2 px-4 rounded-2"><a class="no-underline font-medium text-white" href="{{ route('category.showSimilarOffers', ['offer'=>$offer->id ,'category_id' => $offer->category_id, 'category_name' => $category->name])}}">Voir plus</a></button>
        </div>
        <div class="mx-auto grid max-w-screen-xl grid-cols-1 gap-6 p-6 md:grid-cols-2 lg:grid-cols-3">
                @foreach ($similaroffers as $similar)
                        <article class="rounded-xl bg-white p-3 shadow-lg hover:shadow-xl " >
                            <a class="no-underline" href="{{route('offer.offer', [$similar->id, $similar->slug])}}">
                                <div class="relative flex items-end overflow-hidden rounded-xl">
                                    <img class="w-full h-96" src="{{ route('offer-pictures-file-path',$similar->offer_default_photo)}}" alt="Offer Photo" />
                                </div>
                                <div class="mt-1 p-2">
                                    <span class="text-gray-500 text-lg flex items-center div-categorie pb-2">
                                        <img src="/images/Stack.svg" alt="" class="mr-2 ">
                                        {{$similar->category->name}}
                                    </span>
                                    <span class="text-titles font-bold text-3xl overflow-hidden">
                                        {{$similar->title }}
                                    </span>
                                    <hr class="w-full text-titles">
                                    <div class="mt-3 flex items-end justify-between">
                                        <div class="flex gap-2 items-center">
                                            <img src="/images/map-pin.svg" alt="">
                                            <span class="text-gray-500">
                                                {{$similar->region->name . ", " .
                                                $similar->department->name}}
                                            </span>
                                        </div>
                                        <div class="group inline-flex rounded-xl">
                                            <span class="text-red-500 text-lg">
                                                {{$similar->type->name }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </article>
                @endforeach
        </div>
    </section>

        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <!-- Modal content remains the same -->
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Offer</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table align-middle mb-0 bg-white">
                    <thead class="bg-light">
                        <tr>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Image</th>
                            <th>User</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td id="modalName"></td>
                            <td id="modalStatus"></td>
                            <td>  <img id="modalImage" src="" alt="Image"> </td>
                            <td id="modalUser"></td>
                            <td>
                             <button type="button"  class="btn btn-success" id="acceptButton">
                                  Accept
                             </button>
                             <button type="button" class="btn btn-danger" id="declineButton">
                                 Decline
                             </button>
                             <button type="button" class="btn" id="meetButton">
                                 Add Meetup
                             </button>
                             <button type="button" class="btn" id="meetButton">
                                 Chat
                             </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <!-- show meetups -->
                <h2 id="meetHeader">Meetups</h2>
            <table id="meetTable" class="table align-middle">
                <thead class="bg-light">
                    <tr>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Description</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody id="meetupsTableBody">
                    <td id="meetDate"></td>
                    <td id="meetTime"></td>
                    <td id="meetDescription"></td>
                   <td id="meetStatus"></td>
                </tbody>
            </table>
                 <!-- Meetup Schedule Form -->
                 <form id="meetupForm">
                @csrf
                <input type="hidden" id="prepositionId" name="prepositionId" value="">
                <div class="mb-3">
                    <label for="meetupDate" class="form-label">Meetup Date</label>
                    <input type="date" class="form-control" id="meetupDate" name="meetupDate" required>
                </div>
                <div class="mb-3">
                    <label for="meetupTime" class="form-label">Meetup Time</label>
                    <input type="time" class="form-control" id="meetupTime" name="meetupTime" required>
                </div>
                <div class="mb-3">
                    <label for="meetupDescription" class="form-label">Meetup Description</label>
                    <textarea class="form-control" id="meetupDescription" name="meetupDescription" rows="3" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Schedule Meetup</button>
            </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script>
        function changeMainImage(newImage) {
            const mainImage = document.getElementById('mainImage');
                mainImage.src = window.location.origin +'/file/offer-pictures/'+newImage;
        }
   
    $(document).ready(function () {
        var departmentValue = "{{ request('department') }}";
        var typeValue = "{{ request('type') }}";
        // Set the selected attribute for the department dropdown
        $("#departmentSelect").val(departmentValue).prop('selected', true);

        // Set the selected attribute for the type dropdown
        $("#typeSelect").val(typeValue).prop('selected', true);
        $('#exampleModal').on('hidden.bs.modal', function () {
            $("#meetupForm").hide();
    });
        $('.proposition-link').click(function () {
            // Get data from the clicked link
            var propositionName = $(this).text();
            var propositionStatus = $(this).data('status'); // Adjust based on your data attributes
            var propositionUser = $(this).data('user'); // Adjust based on your data attributes
            var propositionId=$(this).data('id');
            var propositionImage=$(this).data('image');
            var user=propositionUser.first_name+" "+propositionUser.last_name;
            var descriptionData=$(this).data('meet');
            console.log(descriptionData);
            var meetDescription=descriptionData.description;
            var meetDate=descriptionData.date;
            var meetTime=descriptionData.time;
            var meetStatus=descriptionData.status;
// Set the value of the hidden input in meetup form
            $('#prepositionId').val(propositionId);
            // Update modal content
            $('#modalName').text(propositionName);
            $('#modalStatus').text(propositionStatus);
            $('#modalUser').text(user);
            $('#modalImage').attr('src',propositionImage);
            // Update propositionId in button data attributes
            $('#acceptButton').data('proposition-id', propositionId);
            $('#acceptButton').data('proposition-id', propositionId);
            $('#declineButton').data('proposition-id', propositionId);
            // add meetup in table 
            if(descriptionData){
            $('#meetDescription').text(meetDescription);
            $('#meetDate').text(meetDate);
            $('#meetTime').text(meetTime);
            $('#meetStatus').text(meetStatus);
            $('#meetButton').hide();
            $('#meetHeader').show();
            $('#meetTable').show();
        } 
            else {
                $('#meetDescription').empty();
            $('#meetDate').empty();
            $('#meetTime').empty();
            $('#meetStatus').empty();
            $('#meetButton').show();
            $('#meetHeader').hide();
            $('#meetTable').hide();
            }

            if(propositionStatus=="accepted" || propositionStatus=="refused" ){
                $('#acceptButton').hide();
                $('#declineButton').hide();
            }
            else{
                $('#acceptButton').show();
                $('#declineButton').show();
            }
           
        });
          // Handle Accept button click
          $('#acceptButton').click(function () {
            var propositionId = $(this).data('proposition-id');
            updatePropositionStatus(propositionId, 'accepted');
        });

        // Handle Decline button click
        $('#declineButton').click(function () {
            var propositionId = $(this).data('proposition-id');
            updatePropositionStatus(propositionId, 'declined');
        });
 // Handle Meet button click
 $("#meetupForm").hide();
 $('#meetButton').click(function () {
    $("#meetupForm").show();

        });
        // Function to update proposition status via AJAX
        function updatePropositionStatus(propositionId, newStatus) {
            // Send an AJAX request to update the status
            $.ajax({
                type: 'POST',
                url: '/update-proposition-status', // Replace with your actual route
                data: {
                    propositionId: propositionId,
                    newStatus: newStatus,
                },
                success: function (response) {
            // Handle success response

            // Show success message
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: 'The proposition status has been updated.',
            }).then(function () {
                // Reload the page after showing the success message
                location.reload();
            });
        },
        error: function (error) {
            
            // Show error message
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: 'Failed to update proposition status.',
            });
        }
            });
        }
    
    });
    // for meetup form
    $(document).ready(function () {
        // Handle form submission
        $('#meetupForm').submit(function (e) {
            e.preventDefault();

            // Get form data
            var formData = {
                prepositionId: $('#prepositionId').val(),
                meetupDate: $('#meetupDate').val(),
                meetupTime: $('#meetupTime').val(),
                meetupDescription: $('#meetupDescription').val(),
            };
            console.log(formData);

            // Perform AJAX request to save meetup schedule
            $.ajax({
                url: '/schedule-meetup',
                method: 'POST',
                data: formData,
                success: function (response) {
                    // Handle success response
                    console.log(response);

                    // Optionally, close the modal after a successful update
                    $('#meetupModal').modal('hide');
                },
                error: function (error) {
                    // Handle error response
                    console.error(error);
                }
            });
        });

        // Open the modal and set the prepositionId
        $('#meetupModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var prepositionId = button.data('preposition-id'); // Extract info from data-* attributes
            $('#prepositionId').val(prepositionId); // Set the prepositionId in the form
        });
    });

var meetups = {};

// Function to populate the meetups table
function populateMeetupsTable() {
    var meetupsTableBody = document.getElementById('meetupsTableBody');

    // Clear existing rows
    meetupsTableBody.innerHTML = '';

    // Loop through meetups and add rows to the table
    
        var row = meetupsTableBody.insertRow();
        var dateCell = row.insertCell(0);
        var timeCell = row.insertCell(1);
        var descriptionCell = row.insertCell(2);
        var statusCell = row.insertCell(3);

        // Set cell values based on meetup data
        dateCell.innerHTML = meetup.date;
        timeCell.innerHTML = meetup.time;
        descriptionCell.innerHTML = meetup.description;
        statusCell.innerHTML = meetup.status;
    
}

// Event listener for modal show event
$('#yourModalId').on('show.bs.modal', function (event) {
   
    document.getElementById('modalName').innerHTML = preposition.name;
    document.getElementById('modalStatus').innerHTML = preposition.status;
    document.getElementById('modalUser').innerHTML = preposition.user_name;

    // Populate meetups table
    populateMeetupsTable();
});




    </script>
        
</x-app-layout>
