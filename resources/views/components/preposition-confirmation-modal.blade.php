<div class="modal fade" id="propositionConfirmationModal-{{$preposition->id}}" tabindex="-1" aria-labelledby="propositionConfirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg"> <!-- Set modal-lg class for larger width -->
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="propositionConfirmationModalLabel">Confirmer la proposition {{$preposition->name}}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
            </div>
            <div class="modal-body">
                <div id="modalbox"></div>
                <div class="w-full text-xs text-red-600">(*) Si vous acceptez cette proposition, vous ne pourrez plus accepter d'autres propositions liées a cette offre, à moins ce que la contrepartie ne confirme pas la proposition</div>
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
                                <button type="button" class="btn btn-primary m-1" id="meetConfirmationButton" data-meet="{{ $preposition->meetup }}" data-proposition-id="{{$preposition->id}}" data-bs-toggle="modal" data-bs-target="#meetModal-{{$preposition->id}}">
                                    <i class="fa fa-calendar"></i> Ajouter un rendez-vous
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

        $('#meetConfirmationButton').click(function () {
            descriptionData=$(this).data('meet');
            console.log({descriptionData});
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
        $('#propositionConfirmationModal-{{$preposition->id}} #acceptButton').click(function () {
            var propositionId = $(this).data('proposition-id');
            confirmProposition(propositionId, 'Yes');
        });

        // Handle Decline button click
        $('#propositionConfirmationModal-{{$preposition->id}} #declineButton').click(function () {
            var propositionId = $(this).data('proposition-id');
            confirmProposition(propositionId, 'No');
        });

        function confirmProposition(propositionId, confirm) {
            $.ajax({
                type: 'POST',
                url: '/confirm-proposition',
                data: {
                    propositionId: propositionId,
                    confirm: confirm,
                },
                success: function (response) {
                    console.log({response});
                    if(confirm == "No"){
                        Swal.fire({
                            title: 'Success',
                            icon: 'success',
                            text: 'Vous avez refusé la proposition.',
                        }).then(function () {
                            location.reload();
                        });
                    }
                    
                    else if(confirm == "Yes"){
                        Swal.fire({
                            title: 'Success',
                            icon: 'success',
                            text: 'Vous avez confirmer la proposition.',
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
                        text: 'Failed to update proposition confirmation.',
                    });
                }
            });
        }

    });


window.onload = () => {
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