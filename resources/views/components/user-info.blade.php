<div class="relative max-w-md mx-auto md:max-w-2xl mt-16 min-w-0 break-words bg-white w-full mb-6 shadow-lg rounded-xl">
    <div class="px-6">
        <div class="flex flex-wrap justify-center">
            <div class="w-full flex flex-col md:flex-row justify-between pt-2">
                <div class="flex flex-col justify-center">
                    <img src="{{ route('profile_pictures-file-path',$user->avatar) }}" class="rounded-full w-20 h-20 border-slate-900 mx-auto"/>
                    <div class="text-center mt-2">
                        <h3 class="text-lg text-slate-700 font-bold leading-normal mb-1">{{$user->name}}</h3>
                        <div class="text-xs mt-0 mb-2 text-slate-400 font-bold uppercase">
                            <i class="fas fa-map-marker-alt mr-2 text-slate-400 opacity-75"></i>Paris, France
                        </div>
                    </div>
                </div>
                <div class="flex justify-center content-start items-end lg:pt-4 pt-0">
                    <div class="p-3 text-center">
                        <span class="text-md md:text-lg font-bold block tracking-wide text-slate-700">Trocs en cours</span>
                        <img src="{{asset('images/in-progress.svg')}}" class="w-14 h-14 mx-auto block" alt="" />
                        <span class=" text-slate-400 font-bold">{{$offersInProgress}}</span>
                    </div>
                    <div class="p-3 text-center">
                        <span class="text-md md:text-lg font-bold block tracking-wide text-slate-700">Propositions</span>
                        <img src="{{asset('images/proposition.svg')}}" class="w-14 h-14 mx-auto block" alt="" />
                        <span class=" text-slate-400 font-bold">{{$offerPrepostion}}</span>
                    </div>

                    <div class="p-3 text-center">
                        <span class="text-md md:text-lg font-bold block tracking-wide text-slate-700">Trocs realisés</span>
                        <img src="{{asset('images/success.svg')}}" class="w-14 h-14 mx-auto block" alt="" />
                        <span class=" text-slate-400 font-bold">{{$finishedOffers}}</span>
                    </div>
                </div>
            </div>

            <div class="w-full text-center mt-2">
                <div class="flex flex-wrap justify-center items-center">
                    <div >
                        @if($user->id != auth()->id())
                            @php 
                                $following=App\Models\Following::where('followed_id',$user->id)
                                ->where('follower_id',auth()->id())->first();
                            @endphp 
                            @if(!$following)
                            <a href="{{route('followings.follow',$user->id)}}" class="no-underline inline-block px-4 py-2 font-normal text-slate-700 bg-gray-200 hover:bg-gray-300 rounded-md transition duration-300 ease-in-out">
                                Follow Account
                            </a>
                            @else
                            <a href="{{route('followings.unfollow',$user->id)}}" class="no-underline inline-block px-4 py-2 font-normal text-slate-700 bg-gray-200 hover:bg-gray-300 rounded-md transition duration-300 ease-in-out">
                                Unfollow Account
                            </a>
                            
                            @endif
                        @else
                        <a href="javascript:;" class="no-underline font-normal text-slate-700 hover:text-slate-400">
                                {{$followersCount}} Follower
                        </a>
                        @endif
                    </div>
                    <div class="mx-2">&#124;</div>
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
                        <a href="{{route('ratings.index',$user->id)}}" class="text-sm font-medium text-gray-900 underline hover:no-underline dark:text-white">{{$ratingsCount}} reviews</a>
                    </div>

                </div>                         
            </div>
        </div>

        <div class="mt-6 py-6 border-t border-slate-200 text-center">
            <div class="flex flex-wrap justify-center">
                <div class="w-full px-4">
                    <p class="font-light leading-relaxed text-slate-600 mb-4">{{$userInfo->bio}}</p>
                </div>
            </div>
        </div>

        <div class="mt-6 py-6 border-t border-slate-200 text-center">
            <span class="text-xl font-bold block tracking-wide text-slate-700">Crédibilité</span>
            <!-- silver, bronze, gold -->
            @foreach($user->badges as $badge)
            <div class="p-3 text-center ml-4 flex flex-wrap justify-center ">
                <img src="{{asset('images/medal-bronze.svg')}}" class="w-20 h-20 mx-auto block" alt="" />
            </div>
            @endforeach
        </div>
            
    </div>
</div>