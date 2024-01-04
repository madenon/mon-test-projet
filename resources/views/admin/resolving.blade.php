@extends('admin.template')

@section('admin-content')

<div class="grid grid-cols-3 justify-content center my-4 mx-32">
    <a class="no-underline text-black block " href="{{route('admin.reports')}}">
        <div class="flex flex-col justify-center items-center border shadow py-2 mx-2 mb-4">
            <div class="font-semibold text-2xl  my-3">Reports</div>
            <div class="flex justify-around w-full">
                <div class="text-sm">
                    <div class="inline-block w-4 h-4 rounded-full bg-gray-500"></div> 
                    {{count(App\Models\Report::get())}}
                </div>
                <div class="text-sm">
                    <div class="inline-block w-4 h-4 rounded-full bg-red-500"></div> 
                    {{count(App\Models\Report::where('isOpen',true)->get())}}
                </div>
                <div class="text-sm">
                    <div class="inline-block w-4 h-4 rounded-full bg-yellow-500"></div> 
                    {{count(App\Models\Report::where('isOpen',false)->get())}}
                </div>
            </div>
        </div>
    </a>

    <a class="no-underline text-black block " href="{{route('admin.disputes')}}">
        <div class="flex flex-col justify-center items-center border shadow py-2 mx-2 mb-4">
            <div class="font-semibold text-2xl  my-3">Disputes</div>
            <div class="flex justify-around w-full">
                <div class="text-sm">
                    <div class="inline-block w-4 h-4 rounded-full bg-gray-500"></div> 
                    {{count(App\Models\Dispute::get())}}
                </div>
                <div class="text-sm">
                    <div class="inline-block w-4 h-4 rounded-full bg-red-500"></div> 
                    {{count(App\Models\Dispute::where('isOpen',true)->get())}}
                </div>
                <div class="text-sm">
                    <div class="inline-block w-4 h-4 rounded-full bg-yellow-500"></div> 
                    {{count(App\Models\Dispute::where('isOpen',false)->get())}}
                </div>
            </div>
        </div>
    </a>

    <a class="no-underline text-black block " href="{{route('admin.newsletters')}}">
        <div class="flex flex-col justify-center items-center border shadow py-2 mx-2 mb-4">
            <div class="font-semibold text-2xl  my-3">Newletters</div>
            <div class="flex justify-around w-full">
                <div class="text-sm">
                    <div class="inline-block w-4 h-4 rounded-full bg-gray-500"></div> 
                    {{Illuminate\Support\Facades\DB::table('newsletters')->count()}}
                </div>
            </div>
        </div>
    </a>

        

    </div>

@endsection

