@extends('admin.template')

@section('admin-content')

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 justify-items-center my-4 mx-4 sm:mx-8 lg:mx-32">
    <a class="no-underline text-black block w-full" href="{{route('admin.transactions')}}">
        <div class="flex flex-col justify-center items-center border shadow py-4 px-2 sm:py-6 mb-4 bg-white">
            <div class="font-semibold text-xl sm:text-2xl my-2 sm:my-3">Transaction</div>
            <div class="flex justify-around w-full text-sm">
                <div class="flex items-center">
                    <div class="inline-block w-4 h-4 rounded-full bg-gray-500 mr-2"></div> 
                    {{count(App\Models\Transaction::get())}}
                </div>
                <div class="flex items-center">
                    <div class="inline-block w-4 h-4 rounded-full bg-red-500 mr-2"></div> 
                    {{count(App\Models\Transaction::get())}}
                </div>
                <div class="flex items-center">
                    <div class="inline-block w-4 h-4 rounded-full bg-yellow-500 mr-2"></div> 
                    {{count(App\Models\Transaction::get())}}
                </div>
            </div>
        </div>
    </a>
    
    <a class="no-underline text-black block w-full" href="{{route('admin.propositions')}}">
        <div class="flex flex-col justify-center items-center border shadow py-4 px-2 sm:py-6 mb-4 bg-white">
            <div class="font-semibold text-xl sm:text-2xl my-2 sm:my-3">Propositions</div>
            <div class="flex justify-around w-full text-sm">
                <div class="flex items-center">
                    <div class="inline-block w-4 h-4 rounded-full bg-gray-500 mr-2"></div> 
                    {{count(App\Models\Preposition::get())}}
                </div>
                <div class="flex items-center">
                    <div class="inline-block w-4 h-4 rounded-full bg-red-500 mr-2"></div> 
                    {{count(App\Models\Preposition::where('status','!=' ,'En cours')->get())}}
                </div>
                <div class="flex items-center">
                    <div class="inline-block w-4 h-4 rounded-full bg-yellow-500 mr-2"></div> 
                    {{count(App\Models\Preposition::where('status', 'En cours')->get())}}
                </div>
            </div>
        </div>
    </a>
    
    <a class="no-underline text-black block w-full" href="{{route('admin.offers')}}">
        <div class="flex flex-col justify-center items-center border shadow py-4 px-2 sm:py-6 mb-4 bg-white">
            <div class="font-semibold text-xl sm:text-2xl my-2 sm:my-3">Offers</div>
            <div class="flex justify-around w-full text-sm">
                <div class="flex items-center">
                    <div class="inline-block w-4 h-4 rounded-full bg-gray-500 mr-2"></div> 
                    {{count(App\Models\Offer::get())}}
                </div>
                <div class="flex items-center">
                    <div class="inline-block w-4 h-4 rounded-full bg-yellow-500 mr-2"></div> 
                    {{count(App\Models\Offer::whereDate('created_at',Carbon\Carbon::now()->toDateString())->get())}}
                </div>
            </div>
        </div>
    </a>
</div>

@endsection
