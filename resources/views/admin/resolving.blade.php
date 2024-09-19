@extends('admin.template')

@section('admin-content')

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 justify-items-center my-4 mx-4 sm:mx-8 lg:mx-32">
    <a class="no-underline text-black block w-full" href="{{route('admin.reports')}}">
        <div class="flex flex-col justify-center items-center border shadow py-4 px-2 sm:py-6 mb-4 bg-white">
            <div class="font-semibold text-xl sm:text-2xl my-2 sm:my-3">Reports</div>
            <div class="flex justify-around w-full text-sm">
                <div class="flex items-center">
                    <div class="inline-block w-4 h-4 rounded-full bg-gray-500 mr-2"></div> 
                    {{count(App\Models\Report::get())}}
                </div>
                <div class="flex items-center">
                    <div class="inline-block w-4 h-4 rounded-full bg-red-500 mr-2"></div> 
                    {{count(App\Models\Report::where('isOpen',true)->get())}}
                </div>
                <div class="flex items-center">
                    <div class="inline-block w-4 h-4 rounded-full bg-yellow-500 mr-2"></div> 
                    {{count(App\Models\Report::where('isOpen',false)->get())}}
                </div>
            </div>
        </div>
    </a>

    <a class="no-underline text-black block w-full" href="{{route('admin.disputes')}}">
        <div class="flex flex-col justify-center items-center border shadow py-4 px-2 sm:py-6 mb-4 bg-white">
            <div class="font-semibold text-xl sm:text-2xl my-2 sm:my-3">Disputes</div>
            <div class="flex justify-around w-full text-sm">
                <div class="flex items-center">
                    <div class="inline-block w-4 h-4 rounded-full bg-gray-500 mr-2"></div> 
                    {{count(App\Models\Dispute::get())}}
                </div>
                <div class="flex items-center">
                    <div class="inline-block w-4 h-4 rounded-full bg-red-500 mr-2"></div> 
                    {{count(App\Models\Dispute::where('isOpen',true)->get())}}
                </div>
                <div class="flex items-center">
                    <div class="inline-block w-4 h-4 rounded-full bg-yellow-500 mr-2"></div> 
                    {{count(App\Models\Dispute::where('isOpen',false)->get())}}
                </div>
            </div>
        </div>
    </a>

    <a class="no-underline text-black block w-full" href="{{route('admin.newsletters')}}">
        <div class="flex flex-col justify-center items-center border shadow py-4 px-2 sm:py-6 mb-4 bg-white">
            <div class="font-semibold text-xl sm:text-2xl my-2 sm:my-3">Newsletters</div>
            <div class="flex justify-around w-full text-sm">
                <div class="flex items-center">
                    <div class="inline-block w-4 h-4 rounded-full bg-gray-500 mr-2"></div> 
                    {{Illuminate\Support\Facades\DB::table('newsletters')->count()}}
                </div>
            </div>
        </div>
    </a>
</div>

@endsection
