<div class="modal fade" id="propositionValidationModal-{{$preposition->id}}" tabindex="-1" aria-labelledby="propositionValidationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg"> <!-- Set modal-lg class for larger width -->
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="propositionValidationModalLabel">Valider la proposition {{$preposition->name}}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
            </div>
            <div class="modal-body">
                <div id="modalbox"></div>
                <div class="w-full text-xs text-red-600">(*) Si vous acceptez cette proposition, vous ne pourrez plus accepter d'autres propositions liées a cette offre, à moins ce que la contre partie ne confirme pas la proposition</div>
                <table class="table align-middle mb-0 bg-white">
                    <thead class="bg-light">
                        <tr>
                            <th>Statut</th>
                            <th>Utilisateur</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td id="modalStatus">
                                <span class="badge {{ getStatusBadgeClass($preposition->status) }} rounded-pill d-inline">
                                    {{ $preposition->status }}
                                </span>
                            </td>
                            <td id="modalUser">{{$preposition->user->name}}</td>
                            <td>
                                <button type="button" class="btn btn-success" id="acceptButton" data-bs-dismiss="modal" aria-label="Fermer" data-proposition-id="{{$preposition->id}}">
                                    Accepter
                                </button>
                                <button type="button" class="btn btn-danger" id="declineButton" data-bs-dismiss="modal" aria-label="Fermer" data-proposition-id="{{$preposition->id}}">
                                    Refuser
                                </button>
                                <button type="button" class="btn btn-primary m-1" id="meetButton" data-meet="{{ $preposition->meetup }}" data-proposition-id="{{$preposition->id}}" data-bs-toggle="modal" data-bs-target="#meetModal-{{$preposition->id}}">
                                    <i class="fa fa-calendar"></i> <span class="hidden md:inline">Ajouter un rendez-vous</span>
                                </button>

                                <a href="{{route('propositions.chat-sender',['prepositionId' => $preposition->id] )}}" type="button" class="btn btn-primary m-1" id="chatButton">
                                    <i class="fas fa-comment"></i> Chat
                                </a>

                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function () {
        

        $('#meetButton').click(function () {
            descriptionData=$(this).data('meet');
            console.log(descriptionData);
            var meetDescription=descriptionData.description;
            var meetDate=descriptionData.date;
            var meetTime=descriptionData.time;
            var meetStatus=descriptionData.status;
            // add data to table meet 
            $('#meetModal-{{$preposition->id}} #meetDescription').text(meetDescription);
            $('#meetModal-{{$preposition->id}} #meetDate').text(meetDate);
            $('#meetModal-{{$preposition->id}} #meetTime').text(meetTime);
            $('#meetModal-{{$preposition->id}} #meetStatus').text(meetStatus);
            if(descriptionData.status=="Confirmé"){
                $('#meetModal-{{$preposition->id}} #meetActions').hide();
            }
            if(!descriptionData){
                $('#meetModal-{{$preposition->id}} #meetDescription').empty();
                $('#meetModal-{{$preposition->id}} #meetDate').empty();
                $('#meetModal-{{$preposition->id}} #meetTime').empty();
                $('#meetModal-{{$preposition->id}} #meetStatus').empty();
            }
            //chatbutton
            var propositionId = $(this).data('proposition-id');
            var chatButton = document.getElementById('chatButton');
            chatButton.href = chatButton.href.replace('PROPOSITION_ID_PLACEHOLDER', propositionId);
 
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



    // Event listener for modal show event
    $('#yourModalId').on('show.bs.modal', function (event) {
    
        document.getElementById('modalName').innerHTML = preposition.name;
        document.getElementById('modalStatus').innerHTML = preposition.status;
        document.getElementById('modalUser').innerHTML = preposition.user_name;

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