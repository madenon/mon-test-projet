<div class="modal fade" id="meetModal-{{$preposition->id}}" tabindex="-1" aria-labelledby="meetModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg"> <!-- Set modal-lg class for larger width -->
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="meetModalLabel">Rendez-vous pour la proposition {{$preposition->name}}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
            </div>
            <div class="modal-body">
                <div id="modalbox"></div>
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
                <form id="meetupForm-{{$preposition->id}}">
                    @csrf
                    <input type="hidden" id="prepositionId" name="prepositionId" value="{{$preposition->id}}">
                    <input type="hidden" id="userId-{{$preposition->id}}" name="userId" value="{{auth()->id()}}">
                    <div class="mb-3">
                        <label for="meetupDate" class="form-label">Date du rendez-vous</label>
                        <input type="date" class="form-control" id="meetupDate-{{$preposition->id}}" name="meetupDate" required>
                    </div>
                    <div class="mb-3">
                        <label for="meetupTime" class="form-label">Heure du rendez-vous</label>
                        <input type="time" class="form-control" id="meetupTime-{{$preposition->id}}" name="meetupTime" required>
                    </div>
                    <div class="mb-3">
                        <label for="meetupDescription" class="form-label">Description du rendez-vous</label>
                        <textarea class="form-control" id="meetupDescription-{{$preposition->id}}" name="meetupDescription" rows="3" required></textarea>
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
        
        $('.meetup-link').click(function () {
            var propositionName = $(this).text();
            var propositionStatus = $(this).data('status'); // Adjust based on your data attributes
            var propositionUser = $(this).data('user'); // Adjust based on your data attributes
            var propositionId=$(this).data('id');
            var propositionImage=$(this).data('image');
            var user=propositionUser.first_name+" "+propositionUser.last_name;
            var descriptionData=$(this).data('meet');
            console.log({descriptionData});
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




    });
    // for meetup form
    $(document).ready(function () {
        var prepositionId={{$preposition->id}}
        // Handle form submission
        $('#meetupForm-'+prepositionId).submit(function (e) {
            e.preventDefault();
            $('#meetupForm-'+prepositionId).prop('disabled', true);
            // Get form data
            var formData = {
                prepositionId: prepositionId,
                meetupDate: $('#meetupDate-'+prepositionId).val(),
                meetupTime: $('#meetupTime-'+ prepositionId).val(),
                meetupDescription: $('#meetupDescription-'+prepositionId).val(),
                userId: $('#userId-'+prepositionId).val(), 
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