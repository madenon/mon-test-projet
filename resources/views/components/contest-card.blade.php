@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="flex w-full bg-white shadow rounded border-2 overflow-hidden my-2">
    <div class="p-4 w-full row">
        <div class="col-6">
            <h3 class="text-xl font-semibold text-gray-800">{{ $contest->title }}</h3>
            <p class="text-gray-600">{{ $contest->description }}</p>
            @php
            // Calculate the progress percentage
            $startDate = \Carbon\Carbon::parse($contest->start_datetime);
            $endDate = \Carbon\Carbon::parse($contest->end_datetime);
            $currentDate = \Carbon\Carbon::now();
            $progressDate = ($startDate->diffInMinutes($endDate) > 0) 
                ? min(100, max(0, ($currentDate->diffInMinutes($startDate) / $startDate->diffInMinutes($endDate)) * 100)) 
                : 100;                
            $ended =  ($endDate > $currentDate) 
                ? $endDate->diffForhumans(null,true). ' to end'
                : "Ended";       
            @endphp
            <div class="w-full bg-gray-300 rounded-full h-2 mt-3">
                <div class="bg-primary-color rounded-full h-2" style="width: {{  $progressDate }}%;">
                </div>
            </div>
            <div class="flex justify-between">

                <div class="flex items-center">
                    <svg class="w-5 h-5 fill-current text-gray-500 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 2C5.76 2 2 5.76 2 10s3.76 8 8 8 8-3.76 8-8-3.76-8-8-8zm0 14c-3.31 0-6-2.69-6-6s2.69-6 6-6 6 2.69 6 6-2.69 6-6 6zm-1-8h2v4h-2zm0-6h2v2h-2z"/></svg>
                    <p class="text-gray-700">{{ \Carbon\Carbon::parse($contest->start_datetime)->format('Y-m-d H:i') }}</p>
                </div>
                <div class="flex items-center">
                        <svg class="w-5 h-5 fill-current text-green-500 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 18L1 10h3V2h12v8h3l-9 8zm0-2.2l4.6-4.6-1.4-1.4L10 14V5H8v9l-3.2-3.2-1.4 1.4L10 15.8z"/></svg>
                        <p class="text-green-500">{{ $ended }}</p>
                </div>
            </div>
        </div>
        <div class="col-2">
            <h2>{{ $contest->price }} EUR</h3>
            <p>To Win<p>
    </div>
    @php
    $progress = Illuminate\Support\Facades\DB::table('contest_user')
    ->where('contest_id', $contest->id)
    ->where('user_id', auth()->id())
    ->value('progress');
    @endphp
    @if( $contest->users->contains('id', auth()->id()))
    <div class="col-4">
        <div class="w-full bg-gray-300 rounded-full h-2 mt-3">
            <div class="bg-primary-color rounded-full h-2" style="width: {{  $progress * 100 / $contest->value }}%;">
            </div>
        </div>
        <div class="flex justify-between">

            <div class="flex items-center">
                <p class="text-gray-700">Completed:</p>
            </div>
            <div class="flex items-center">
                <p > <span class="text-green-500">{{ $progress }}</span> / {{ $contest->value }}</p>
            </div>
        </div>
        <div class="flex justify-center items-center">
            <div class="col-span-full d-flex items-center justify-end">
                <a class="inline-block  px-4 bg-primary-color text-white text-lg no-underline rounded transition duration-300 ease-in-out hover:bg-primary-color-hover" style="font-size:14px;margin:0" href="{{route('contests.compete', $contest->id)}}">Compete</a>
            </div>
        </div>
        </div>
        @else
        <div class="col-4 flex justify-center items-center">
            <div class="col-span-full d-flex items-center justify-end">
                <a class="inline-block  px-4 bg-primary-color text-white text-lg no-underline rounded transition duration-300 ease-in-out hover:bg-primary-color-hover" style="font-size:14px;margin:0" href="{{route('contests.registration', $contest->id)}}">Register</a>
            </div>
        </div>
        @endif
    </div>
</div>
