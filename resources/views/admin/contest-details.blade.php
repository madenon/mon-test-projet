<div class="row">
    <h2>{{ $contest->title }}</h2>
    
    <p><strong>Type:</strong> {{ $contest->type }}</p>
    <p><strong>Value:</strong> {{ $contest->value }}</p>
    <p><strong>Start Date and Time:</strong> {{ \Carbon\Carbon::parse($contest->start_datetime)->format('Y-m-d H:i') }}</p>
    <p><strong>End Date and Time:</strong> {{ \Carbon\Carbon::parse($contest->end_datetime)->format('Y-m-d H:i') }}</p>

    <p><strong>Description:</strong> {{ $contest->description }}</p>

    {{-- Add more details as needed --}}

    <a href="{{ route('admin.contests')}}" class="btn btn-primary">Back to Contests</a>

</div>
