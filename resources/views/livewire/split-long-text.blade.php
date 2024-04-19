<div>
    <span class="description-content text-gray-500 dark:text-gray-400">{{ $text}}</span>
    <span class="hidden extra-description text-gray-500 dark:text-gray-400">{{ $text}}</span>
    @if (strlen($text) > $len)
    <a href="#" data-len="{{$len}}" class="mb-5 text-xs font-medium text-blue-600 hover:underline dark:text-blue-500 read-more">Read more</a>
    @endif
</div>


<script>
$(document).ready(function () {

    var descriptionContent = document.querySelector(`{{$parentClass}} .description-content`);
    var extradescription = document.querySelector(`{{$parentClass}} .extra-description`);
    var len=$(`{{$parentClass}} .read-more`).data("len");
    if (descriptionContent.innerText.length > len) {
        var truncatedContent = descriptionContent.innerText.slice(0, len );
        truncatedContent += '...';
        descriptionContent.innerText = truncatedContent;
        
        var readMoreLink = document.querySelector(`{{$parentClass}} .read-more`);
        readMoreLink.addEventListener('click', function (e) {
            e.preventDefault();
    
            descriptionContent.classList.toggle('hidden');
            extradescription.classList.toggle('hidden');
    
            if (readMoreLink.innerText === 'Read more') {
                readMoreLink.innerText = 'Read less';
            } else {
                readMoreLink.innerText = 'Read more';
            }
        });
    }

});
</script>