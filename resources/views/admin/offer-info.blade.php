@extends('admin.template')

@section('admin-content')

<div class="grid grid-cols-3 justify-content center my-4 mx-32">
    <a class="no-underline text-black block " href="{{route('admin.transactions')}}">
        <div class="flex flex-col justify-center items-center border shadow py-2 mx-2 mb-4">
            <div class="font-semibold text-2xl  my-3">Transaction</div>
            <div class="flex justify-around w-full">
                <div class="text-sm">
                    <div class="inline-block w-4 h-4 rounded-full bg-gray-500"></div> 
                    {{count(App\Models\Transaction::get())}}
                </div>
                <div class="text-sm">
                    <div class="inline-block w-4 h-4 rounded-full bg-red-500"></div> 
                    {{count(App\Models\Transaction::get())}}
                </div>
                <div class="text-sm">
                    <div class="inline-block w-4 h-4 rounded-full bg-yellow-500"></div> 
                    {{count(App\Models\Transaction::get())}}
                </div>
            </div>
        </div>
    </a>
    
    <a class="no-underline text-black block " href="{{route('admin.propositions')}}">
        <div class="flex flex-col justify-center items-center border shadow py-2 mx-2 mb-4">
            <div class="font-semibold text-2xl  my-3">Propositions</div>
            <div class="flex justify-around w-full">
                <div class="text-sm">
                    <div class="inline-block w-4 h-4 rounded-full bg-gray-500"></div> 
                    {{count(App\Models\Preposition::get())}}
                </div>
                <div class="text-sm">
                    <div class="inline-block w-4 h-4 rounded-full bg-red-500"></div> 
                    {{count(App\Models\Preposition::where('status','!=' ,'En cours')->get())}}
                </div>
                <div class="text-sm">
                    <div class="inline-block w-4 h-4 rounded-full bg-yellow-500"></div> 
                    {{count(App\Models\Preposition::where('status', 'En cours')->get())}}
                </div>
            </div>
        </div>
    </a>
    
    <a class="no-underline text-black block " href="{{route('admin.offers')}}">
        <div class="flex flex-col justify-center items-center border shadow py-2 mx-2 mb-4">
            <div class="font-semibold text-2xl  my-3">Offers</div>
            <div class="flex justify-around w-full">
                <div class="text-sm">
                    <div class="inline-block w-4 h-4 rounded-full bg-gray-500"></div> 
                    {{count(App\Models\Offer::get())}}
                </div>

                <div class="text-sm">
                    <div class="inline-block w-4 h-4 rounded-full bg-yellow-500"></div> 
                    {{count(App\Models\Offer::whereDate('created_at',Carbon\Carbon::now()->toDateString())->get())}}
                </div>
            </div>
        </div>
    </a>

        

    </div>

@endsection

