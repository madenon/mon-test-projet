@extends('admin.index')

@section('admin-content')
    <div class="container">
          
                <div class="relative max-w-md mx-auto md:max-w-2xl mt-16 min-w-0 break-words bg-white w-full mb-6 shadow-lg rounded-xl">
                    <div class="px-6">
                        <div class="flex flex-wrap justify-center">
                            <div class="w-full flex justify-center">
                                <div class="relative mt-4">
                                    <img src="{{ route('profile_pictures-file-path',$user->avatar) }}" class="rounded-full w-36 h-36"/>
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
                                <a href="{{ route('admin.offers', ['userId' => $user->id]) }}" class="p-3 text-center mr-4">
                                        <span class="text-xl font-bold block tracking-wide text-slate-700">Trocs en cours</span>
                                        <img src="{{asset('images/in-progress.svg')}}" class="w-20 h-20 mx-auto block" alt="" />
                                        <span class=" text-slate-400 font-bold">{{$offersInProgress}}</span>
</a>
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
                       
                       
                </div>
            
        </div>
        
   
        
@endsection
