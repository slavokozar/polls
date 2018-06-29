@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Poll `{{ $poll->name }}` results</h1>

        <h2>Total {{ $totalVotes }} votes</h2>

        @if($totalVotes)
            @foreach($poll->options as $option)
                <div>
                    {{ $option->name }}
                    <div class="progress">
                        @php $percentage = round(($poll->votes()->where('option_id', $option->id)->count() / $totalVotes ) * 100) @endphp
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
