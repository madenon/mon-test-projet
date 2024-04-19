<div>
    <!-- Walk as if you are kissing the Earth with your feet. - Thich Nhat Hanh -->
</div>

<script>
    Swal.fire({
        title: 'Success',
        icon: 'success',
        html: '<div class="flex items-center justify-center space-x-2">' +
        '<input type="radio" id="star1" name="rating" value="1" class="hidden" /><label for="star1" title="1 star" class="cursor-pointer text-2xl text-yellow-500">&#9734;</label>' +
        '<input type="radio" id="star2" name="rating" value="2" class="hidden" /><label for="star2" title="2 stars" class="cursor-pointer text-2xl text-yellow-500">&#9734;</label>' +
        '<input type="radio" id="star3" name="rating" value="3" class="hidden" /><label for="star3" title="3 stars" class="cursor-pointer text-2xl text-yellow-500">&#9734;</label>' +
        '<input type="radio" id="star4" name="rating" value="4" class="hidden" /><label for="star4" title="4 stars" class="cursor-pointer text-2xl text-yellow-500">&#9734;</label>' +
        '<input type="radio" id="star5" name="rating" value="5" class="hidden" /><label for="star5" title="5 stars" class="cursor-pointer text-2xl text-yellow-500">&#9734;</label>' +
        '</div>' +
            '<div id="feedback-container" style="display:none">' +
            '<textarea id="feedback" name="feedback" class="swal2-textarea" rows="4" cols="35" placeholder="Give Feedback"></textarea>' +
            '</div>',
        showCancelButton: true,
        confirmButtonText: 'Rate',
        cancelButtonText: 'Cancel',
        showLoaderOnConfirm: true,
        preConfirm: (result) => {
        const rating=document.querySelector('input[name="rating"]:checked');
        const ratingValue = rating? rating.value:0;
        const feedbackValue = document.getElementById('feedback').value;

        return fetch('/ratings/rateOfferCounterParty', {
            method: 'POST',
            headers: {
            'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                propositionId: propositionId,
                stars: ratingValue,
                feedback: feedbackValue,
                _token: '{{csrf_token()}}'
            }),
        })
            .then((response) => {
            if (!response.ok) {
                throw new Error('Failed to submit rating');
            }
            return response.json();
            })
            .catch((error) => {
            Swal.showValidationMessage(`Request failed: ${error}`);
        });
        },
        didOpen: () => {
        const stars = document.querySelectorAll('input[name="rating"]');
        stars.forEach((star) => {
            star.addEventListener('click', () => {
                stars.forEach((starAll) => {
                    starAll.nextElementSibling.innerHTML = '&#9734;'; // Empty star
                });
                stars.forEach((starInf) => {
                    if (starInf.value <= star.value) {
                        starInf.nextElementSibling.innerHTML = '&#9733;'; // Filled star
                    }
                });

                const feedback=document.getElementById('feedback-container');
                feedback.style.display="block";

            });

        });
        },
    }).then(function () {
        location.reload();
    });
</script>