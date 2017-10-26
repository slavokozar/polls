@extends('layouts.app')

@section('content')
<div class="container">
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    @foreach($polls as $pollObj)
            <div class="card mt-3 mb-5">
                <h4 class="card-header">{{ $pollObj->name }}</h4>
                <div class="card-body">
                    <h4 class="card-title">Options</h4>

                    <p class="card-text">
                        {{ $pollObj->description }}
                        <ul>
                            @foreach($pollObj->options as $optionObj)
                                <li>{{ $optionObj->name }}</li>
                            @endforeach
                        </ul>

                    </p>
                    <a href="{{ action('PollController@show', $pollObj->code) }}" class="btn btn-primary">Vote</a>
                </div>
            </div>
    @endforeach



</div>
@endsection
