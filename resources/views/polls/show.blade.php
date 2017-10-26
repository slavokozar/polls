@extends('layouts.app')

@section('content')
    <div class="container">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <div class="card mt-3 mb-5">
            <h4 class="card-header">{{ $pollObj->name }}</h4>
            <div class="card-body">
                <h4 class="card-title">Options</h4>

                <p class="card-text">{{ $pollObj->description }}</p>
                @if($userVotes > 0)
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
                @else
                    <form method="post" action="{{ action('PollController@vote', $pollObj->code) }}">
                        {!! csrf_field() !!}
                        <fieldset class="form-group">
                            @foreach($pollObj->options as $optionObj)

                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="form-check-input"
                                               type="{{ $pollObj->single_option ? 'radio' : 'checkbox' }}"
                                               name="poll_option[]"
                                               value="{{ $optionObj->id }}">
                                        {{ $optionObj->name }}
                                    </label>
                                </div>

                            @endforeach
                        </fieldset>

                        <button type="submit" class="btn btn-primary">Vote</button>
                    </form>
                @endif

            </div>
        </div>


    </div>
@endsection
