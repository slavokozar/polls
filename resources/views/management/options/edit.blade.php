@extends('layouts.app')

@section('content')
    <div class="container">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <h1>Edit Option `{{$option->name}}` for `{{$poll->name}}`</h1>

        <form action="{{ action('Management\OptionController@update', [$poll->code, $option->id]) }}" method="post">
            {!! csrf_field() !!}
            <input type="hidden" name="_method" value="PUT"/>
            <div class="form-group">
                <label>Name</label>
                <input type="text" class="form-control" name="name" value="{{ $option->name }}">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
