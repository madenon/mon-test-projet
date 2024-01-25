<div class="modal fade" id="propositionValidationModal-{{$preposition->id}}" tabindex="-1" aria-labelledby="propositionValidationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg"> <!-- Set modal-lg class for larger width -->
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="propositionValidationModalLabel">Valider la proposition {{$preposition->name}}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
            </div>
            <div class="modal-body">
                <div id="modalbox"></div>
                <div class="w-full text-xs text-red-600">(*) Si vous acceptez cette proposition, vous ne pourrez plus accepter d'autres propositions liées a cette offre, à moins ce que la contrepartie ne confirme pas la proposition</div>
                <table class="table align-middle mb-0 bg-white">
                    <thead class="bg-light">
                        <tr>
                            <th>Nom</th>
                            <th>Statut</th>
                            <th>Image</th>
                            <th>Utilisateur</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td id="modalName"></td>
                            <td id="modalStatus"></td>
                            <td> <img id="modalImage" src="" class="modalzoomD" style="max-width:200px;" alt="Image"> </td>
                            <td id="modalUser"></td>
                            <td>
                                <button type="button" class="btn btn-success" id="acceptButton" data-bs-dismiss="modal" aria-label="Fermer" data-proposition-id="{{$preposition->id}}">
                                    Accepter
                                </button>
                                <button type="button" class="btn btn-danger" id="declineButton" data-bs-dismiss="modal" aria-label="Fermer" data-proposition-id="{{$preposition->id}}">
                                    Refuser
                                </button>
                                <button type="button" class="btn btn-primary m-1" id="meetButton">
                                    <i class="fa fa-calendar"></i> Ajouter un rendez-vous
                                </button>

                                <a href="{{route('propositions.chat-sender',['prepositionId' => $preposition->id] )}}" type="button" class="btn btn-primary m-1" id="chatButton">
                                    <i class="fas fa-comment"></i> Chat
                                </a>

                            </td>
                        </tr>
                    </tbody>
                </table>
                <h2 id="meetHeader">Rendez-vous</h2>
                <table id="meetTable" class="table align-middle">
                    <thead class="bg-light">
                        <tr>
                            <th>Date</th>
                            <th>Heure</th>
                            <th>Description</th>
                            <th>Statut</th>
                        </tr>
                    </thead>
                    <tbody id="meetupsTableBody">
                        <td id="meetDate"></td>
                        <td id="meetTime"></td>
                        <td id="meetDescription"></td>
                        <td id="meetStatus"></td>
                    </tbody>
                </table>
                <form id="meetupForm">
                    @csrf
                    <input type="hidden" id="prepositionId" name="prepositionId" value="">
                    <div class="mb-3">
                        <label for="meetupDate" class="form-label">Date du rendez-vous</label>
                        <input type="date" class="form-control" id="meetupDate" name="meetupDate" required>
                    </div>
                    <div class="mb-3">
                        <label for="meetupTime" class="form-label">Heure du rendez-vous</label>
                        <input type="time" class="form-control" id="meetupTime" name="meetupTime" required>
                    </div>
                    <div class="mb-3">
                        <label for="meetupDescription" class="form-label">Description du rendez-vous</label>
                        <textarea class="form-control" id="meetupDescription" name="meetupDescription" rows="3" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Planifier le rendez-vous</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function () {
        
        $('#propositionValidationModal-{{$preposition->id}}').on('hidden.bs.modal', function () {
            $("#meetupForm").hide();
            $("#meetHeader").hide();
            $("#meetTable").hide();
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
            //chatbutton
            var chatButton = document.getElementById('chatButton');
            chatButton.href = chatButton.href.replace('PROPOSITION_ID_PLACEHOLDER', propositionId);
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

            if(propositionStatus=="Acceptée" || propositionStatus=="Rejetée" ){
                $('#acceptButton').hide();
                $('#declineButton').hide();
            }
            else{
                $('#acceptButton').show();
                $('#declineButton').show();
            }
           
        });
        // Handle Accept button click
        $('#propositionValidationModal-{{$preposition->id}} #acceptButton').click(function () {
            var propositionId = $(this).data('proposition-id');
            updatePropositionStatus(propositionId, 'Acceptée');
        });

        // Handle Decline button click
        $('#propositionValidationModal-{{$preposition->id}} #declineButton').click(function () {
            var propositionId = $(this).data('proposition-id');
            updatePropositionStatus(propositionId, 'Rejetée');
        });
        // Handle Meet button click
        $("#meetupForm").hide();
        $('#meetButton').click(function () {
            $("#meetupForm").show();
        });
        
        function updatePropositionStatus(propositionId, newStatus) {
            $.ajax({
                type: 'POST',
                url: '/update-proposition-status',
                data: {
                    propositionId: propositionId,
                    newStatus: newStatus,
                },
                success: function (response) {
                    console.log({response});
                    if(newStatus=="Rejetée"){
                        Swal.fire({
                            title: 'Success',
                            icon: 'success',
                            text: 'Vous avez refusé la proposition.',
                        }).then(function () {
                            location.reload();
                        });
                    }
                    
                    else if(newStatus=="Acceptée"){
                        Swal.fire({
                            title: 'Success',
                            icon: 'success',
                            text: 'Vous avez accepté la proposition. Veuillez attendre que la contrepartie confirme la proposition',
                        }).then(function () {
                            location.reload();
                        });
                    }
                    
                    else {
                        Swal.fire({
                            title: 'Error',
                            icon: 'error',
                            text: `Le status ${newStatus} n'est pas valide.`,
                        }).then(function () {
                            location.reload();
                        });
                    }
                },
                error: function (error) {
                    console.log({error});
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

                    Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: 'Rencontre ajoutée.',
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
                text: 'Erreur',
            });
               
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


    $(document).on('click', '.report-button', function () {
        // Retrieve the prepositionId from the data attribute
        var offerId = $(this).data('offer-id');
        var offerName = $(this).data('offer-name');
        
        // Call the updateProposition function with the prepositionId
        reportOffer(offerId,offerName);
    });
    
    function reportOffer(offerId,offerName) {
        Swal.fire({
            title: 'offer '+offerName,
            html: '<div class="flex justify-start">' +
            '<input id="report-title" name="title" class="swal2-input ms-auto w-full"  placeholder="Title">' +
            '</div>' +
                '<div id="flex justify-start description-container">' +
                '<textarea id="report-description" name="description" class="swal2-textarea ms-auto w-full" rows="4"  placeholder="Give description"></textarea>' +
                '</div>',
            showCancelButton: true,
            confirmButtonText: 'Report',
            cancelButtonText: 'Cancel',
            showLoaderOnConfirm: true,
            preConfirm: (result) => {
            const titleValue = document.getElementById('report-title').value;
            const descriptionValue = document.getElementById('report-description').value;
            return fetch('/offer/report/'+offerId, {
                method: 'POST',
                headers: {
                'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    title: titleValue,
                    description: descriptionValue,
                    _token: '{{csrf_token()}}'
                }),
            })
                .then((response) => {
                if (!response.ok) {
                    throw new Error('Failed to submit report');
                }
                return response.json();
                })
                .catch((error) => {
                Swal.showValidationMessage(`Request failed: ${error}`);
                });
            },
            
        }).then(function () {
                        location.reload();
                    });

                
    }
    </script>
        

 <script>window.onload = () => {
  // (A) GET LIGHTBOX & ALL .ZOOMD IMAGES
  let all = document.getElementsByClassName("zoomD");
  let modalall = document.getElementsByClassName("modalzoomD"),

      lightbox = document.getElementById("lightbox");
      modalbox = document.getElementById("modalbox");
 
  // (B) CLICK TO SHOW IMAGE IN LIGHTBOX
  // * SIMPLY CLONE INTO LIGHTBOX & SHOW
  if (all.length>0) { for (let i of all) {
    i.onclick = () => {
      let clone = i.cloneNode();
      clone.className = "";
      lightbox.innerHTML = "";
      lightbox.appendChild(clone);
      lightbox.className = "show";
    };
  }}
  if (modalall.length>0) { for (let i of modalall) {
    i.onclick = () => {
      let clone = i.cloneNode();
      clone.className = "";
      clone.style.maxWidth="";
      modalbox.innerHTML = "";
      modalbox.appendChild(clone);
      modalbox.className = "show";
    };
  }}
 
  // (C) CLICK TO CLOSE LIGHTBOX
  lightbox.onclick = () => lightbox.className = "";
  modalbox.onclick = () => modalbox.className = "";
};</script>