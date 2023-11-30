<x-app-layout>
    <div class="container">
        <div class="flex">
            <div class="mt-16 col-3 col-md-3 bg-white w-full mb-6 shadow-lg rounded-xl">
                <ul class="space-y-2 font-medium mt-16">
                    <li>
                        <a href="{{route('profile.edit')}}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 hover:w-56 group no-underline">
                        <img src="{{asset('images/user-icon-16.svg')}}" class="header-user-avatar-dropdown-item-img" alt="" />
                        <span class="ms-3">Informations personel</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('myaccount.offers')}}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 hover:w-56 group no-underline">
                            <img src="{{asset('images/speech-bubble.svg')}}" class="header-user-avatar-dropdown-item-img w-4 h-4" alt="" />
                        <span class="flex-1 ms-3 whitespace-nowrap">Mes trocs</span>
                        <span class="inline-flex items-center justify-center px-2 ms-3 text-sm font-medium text-gray-800 bg-gray-100 rounded-full dark:bg-gray-700 dark:text-gray-300"></span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('moncompte/mesmessages')}}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 hover:w-56 group no-underline">
                            <img src="{{asset('images/exchange-44.svg')}}" class="header-user-avatar-dropdown-item-img w-4 h-4" alt="" />
                        <span class="flex-1 ms-3 whitespace-nowrap">Mes messages</span>
                        
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 hover:w-56 group no-underline">
                        <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                            <path d="M14 2a3.963 3.963 0 0 0-1.4.267 6.439 6.439 0 0 1-1.331 6.638A4 4 0 1 0 14 2Zm1 9h-1.264A6.957 6.957 0 0 1 15 15v2a2.97 2.97 0 0 1-.184 1H19a1 1 0 0 0 1-1v-1a5.006 5.006 0 0 0-5-5ZM6.5 9a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9ZM8 10H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5Z"/>
                        </svg>
                        <span class="flex-1 ms-3 whitespace-nowrap">Amis</span>
                        </a>
                    </li>
                    
                </ul>
            </div>
            <div class="col-12 col-md-9">
                <div class="relative max-w-md mx-auto md:max-w-2xl mt-16 min-w-0 break-words bg-white w-full mb-6 shadow-lg rounded-xl">
                    <div class="px-6">
                        <div class="flex flex-wrap justify-center">
                            <div class="w-full flex justify-center">
                                <div class="relative mt-4">
                                    <img src="{{ route('profile_pictures-file-path',$user->profile_photo_path) }}" class="rounded-full w-36 h-36"/>
                                </div>
                            </div>
                            <div class="text-center mt-2">
                                <h3 class="text-2xl text-slate-700 font-bold leading-normal mb-1">{{$user->first_name. " ". $user->last_name}}</h3>
                                <div class="text-xs mt-0 mb-2 text-slate-400 font-bold uppercase">
                                    <i class="fas fa-map-marker-alt mr-2 text-slate-400 opacity-75"></i>Paris, France
                                </div>
                            </div>
                            <div class="w-full text-center mt-2">
                                <div class="flex justify-center lg:pt-4 pt-8">
                                    <div class="p-3 text-center mr-4">
                                        <span class="text-xl font-bold block tracking-wide text-slate-700">Trocs en cours</span>
                                        <img src="{{asset('images/in-progress.svg')}}" class="w-20 h-20 mx-auto block" alt="" />
                                        <span class=" text-slate-400 font-bold">{{$offersInProgress}}</span>
                                    </div>
                                    <div class="p-3 text-center mr-4 ml-4">
                                        <span class="text-xl font-bold block tracking-wide text-slate-700">Propositions</span>
                                        <img src="{{asset('images/proposition.svg')}}" class="w-20 h-20 mx-auto block" alt="" />
                                        <span class=" text-slate-400 font-bold">{{$offerPrepostion}}</span>
                                    </div>

                                    <div class="p-3 text-center ml-4">
                                        <span class="text-xl font-bold block tracking-wide text-slate-700">Trocs realisés</span>
                                        <img src="{{asset('images/success.svg')}}" class="w-20 h-20 mx-auto block" alt="" />
                                        <span class=" text-slate-400 font-bold">{{$finishedOffers}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-6 py-6 border-t border-slate-200 text-center">
                            <span class="text-xl font-bold block tracking-wide text-slate-700">Crédibilité</span>
                            <div class="p-3 text-center ml-4 flex flex-wrap justify-center ">
                                @switch(true)
                                    @case($finishedOffers >= 0 && $finishedOffers <= 30)
                                    <img src="{{asset('images/medal-bronze.svg')}}" class="w-20 h-20 mx-auto block" alt="" />
                                    @break
                                    @case($finishedOffers >= 31 && $finishedOffers <= 60)
                                        <img src="{{asset('images/medal-silver.svg')}}" class="w-20 h-20 mx-auto block" alt="" />
                                        @break
                                    @case($finishedOffers >= 61)
                                        <img src="{{asset('images/medal-gold.svg')}}" class="w-20 h-20 mx-auto block" alt="" />
                                        @break
                                    @default
                                        
                                @endswitch
                            </div>
                        </div>                      
                        <div class="mt-6 py-6 border-t border-slate-200 text-center">
                            <div class="flex flex-wrap justify-center">
                                <div class="w-full px-4">
                                    <p class="font-light leading-relaxed text-slate-600 mb-4">{{$userInfo->bio}}</p>
                                    <a href="javascript:;" class="font-normal text-slate-700 hover:text-slate-400">Follow Account</a>
                                </div>
                            </div>
                        </div>
                        <div class="flex col-12 col-md-9 max-w-md mx-auto md:max-w-2xl mt-16 min-w-0 break-words bg-white w-full mb-6 shadow-lg rounded-xl">
                            <form action="{{ route('user.rate', ['user_id'=>$user->id,'rated_by_user_id'=>$user->id]) }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="stars">Select Stars:</label>
                                    <select name="stars" id="stars" class="form-control">
                                        <option value="1">1 Star</option>
                                        <option value="2">2 Stars</option>
                                        <option value="3">3 Stars</option>
                                        <option value="4">4 Stars</option>
                                        <option value="5">5 Stars</option>
                                    </select>
                                </div>
                                <button type="submit" class="bg-primary-color hover:bg-primary-hover text-white font-bold justify-center align-items-center w-30 h-16 rounded-xl">Submit Rating</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
        
   
        
</x-app-layout>