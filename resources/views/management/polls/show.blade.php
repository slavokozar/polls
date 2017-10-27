@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Poll `{{ $pollObj->name }}` results</h1>

        <h2>Total {{ $totalVotes }} votes</h2>

        @if($totalVotes)
            @foreach($pollObj->options as $optionObj)
                <div>
                    {{ $optionObj->name }}
                    <div class="progress">
                        @php $percentage = round(($pollObj->votes()->where('option_id', $optionObj->id)->count() / $totalVotes ) * 100) @endphp
                        <div class="progress-bar" style="width: {{ $percentage }}%" role="progressbar"
                             aria-valuenow="{{ $percentage }}" aria-valuemin="0" aria-valuemax="100">
                            {{ $percentage }}%
                        </div>
                    </div>
                </div>
            @endforeach
        @endif


    </div>
@endsection
