
<x-app-layout>
<div class="container">
    <h1>Contests of The Week</h1>
    @if(count($contestsOfTheWeek)==0)
    <div>None contest this week</div>
    @else
        @foreach( $contestsOfTheWeek as $contest)
        <x-contest-card :contest=$contest></x-contest-card>
        @endforeach
    @endif
    @if(count($previousContests))
    <h1>Previous Contests</h1>
    @endif
    @foreach( $previousContests as $contest)
    <x-contest-card :contest=$contest></x-contest-card>
    @endforeach
</div>
    
   
</x-app-layout>