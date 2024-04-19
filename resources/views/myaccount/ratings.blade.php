<style>
    .back-route {
    color: var(--primary-color);
    }
</style>
<x-app-layout>
    <div class="container">
        <div class="flex w-full h-screen mt-4">
            
            <div id="articles" data-count="{{$ratingsCount}}" class="w-1/2 overflow-auto">
                <a href="javascript:history.back()" class="back-route no-underline inline-flex items-center space-x-2 transition duration-300">
                    <i class="fas fa-arrow-left"></i>
                </a>
                @for ($i=0; $i < $ratingsCount; $i++)       
                <article id="article-{{$i}}" data-number="{{$i}}">
                    <div class="flex items-center mt-2">
                        <img class="w-10 h-10 me-4 rounded-full" src="{{ route('profile_pictures-file-path', $ratings[(string)$i]->rater->avatar) }}" alt="">
                        <div class="font-medium dark:text-white">
                            <p>{{$ratings[(string)$i]->rater->name}} <time datetime="2014-08-16 19:00" class="block text-sm text-gray-500 dark:text-gray-400">Joined on August 2014</time></p>
                        </div>
                    </div>
                    <div class="flex flex-wrap justify-start items-center">
                        <div class="flex items-center">
                                @for ($j =1; $j <= 5; $j++)
                                    <input type="radio" id="star{{$i}}" name="rating" value="{{$i}}" class="hidden" />
                                    <label for="star{{$i}}" title="{{$i}} star" class="cursor-pointer text-xl text-yellow-500">
                                        @if($ratings[(string)$i]->stars>=$j)
                                        &#9733;
                                        @else
                                        &#9734;
                                        @endif
                                    </label>
                                @endfor                                         
                            </div>
                            <div class="mx-2">&#8226; </div>
                            <div class="ms-1">
                            <span class="text-sm text-gray-500 dark:text-gray-400">
                                {{$ratings[(string)$i]->created_at}}
                            </span> 
                        </div>
                        
                    </div> 
                    <p class="feedback-content text-gray-500 dark:text-gray-400">{{$ratings[(string)$i]->feedback}}</span>
                    <p class="hidden extra-feedback text-gray-500 dark:text-gray-400">{{$ratings[(string)$i]->feedback}}</span>
                    @if (strlen($ratings[(string)$i]->feedback) > 40)
                        <a href="#" class="block mb-5 text-sm font-medium text-blue-600 hover:underline dark:text-blue-500 read-more">Read more</a>
                    @endif
                </article>
                @endfor                                        
            </div>
            <div class="ranking-global w-1/2">
                @for ($i =5; $i > 0; $i--)       
                <div class="flex items-center mt-4">
                    <span  class="text-sm font-medium text-blue-600 dark:text-blue-500 hover:underline">{{$i}} star</span>
                    <div class="w-3/4 h-5 mx-4 bg-gray-200 rounded dark:bg-gray-700">
                        <div class="h-5 bg-yellow-300 rounded" style="width: {{$ratingsGroupCount[(string)$i]}}%"></div>
                    </div>
                    <span class="text-sm font-medium text-gray-500 dark:text-gray-400">{{$ratingsGroupCount[(string)$i]}}%</span>
                </div>
                @endfor                                         
                <div class="w-full text-center mt-2">
                    <div class="flex flex-wrap justify-center items-center">
                        <div class="flex items-center">
                                @for ($i =1; $i <= 5; $i++)
                                    <input type="radio" id="star{{$i}}" name="rating" value="{{$i}}" class="hidden" />
                                    <label for="star{{$i}}" title="{{$i}} star" class="cursor-pointer text-xl text-yellow-500">
                                        @if($ratingsAvg>=$i)
                                        &#9733;
                                        @else
                                        &#9734;
                                        @endif
                                    </label>
                                @endfor                                         
                            </div>
                            <div class="ms-1">
                            <span class="text-sm text-gray-500 dark:text-gray-400">
                                {{number_format($ratingsAvg,2)}}
                            </span> 
                        </div>
                        <div class="mx-2">&#8226; </div>
                        <div>
                            <span class="text-sm font-medium text-gray-500 dark:text-gray-400">{{$ratingsCount}} global ratings</a>
                        </div>
                        
                    </div>                         
                </div>
            </div>
        </div>
        
    </div>
</x-app-layout>

<script>


    $(document).ready(function () {
        var ratingsCount = $('#articles').data('count');
        console.log({ratingsCount});
        for (var i = 0; i < ratingsCount; i++) {

            var feedbackContent = document.querySelector(`#article-${i} .feedback-content`);
            var extraFeedback = document.querySelector(`#article-${i} .extra-feedback`);
            var readMoreLink = document.querySelector(`#article-${i} .read-more`);

            if (feedbackContent.innerText.length > 40) {
                var truncatedContent = feedbackContent.innerText.slice(0, 40);
                truncatedContent += '...';
                feedbackContent.innerText = truncatedContent;
            }

            readMoreLink.addEventListener('click', function (e) {
                e.preventDefault();

                feedbackContent.classList.toggle('hidden');
                extraFeedback.classList.toggle('hidden');

                if (readMoreLink.innerText === 'Read more') {
                    readMoreLink.innerText = 'Read less';
                } else {
                    readMoreLink.innerText = 'Read more';
                }
            });
        }
     });


</script>
