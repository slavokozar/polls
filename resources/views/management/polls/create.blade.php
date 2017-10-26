@extends('layouts.app')

@section('content')
    <div class="container">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <h1>Create Poll</h1>

        <form action="{{ action('Management\PollController@store') }}" method="post">
            {!! csrf_field() !!}
            <div class="form-group">
                <label>Name</label>
                <input type="text" class="form-control" name="name">
            </div>
            <div class="form-group">
                <label>Description</label>
                <textarea class="form-control" name="description"></textarea>
            </div>
            <div class="form-check">
                <label class="form-check-label">
                    <input type="checkbox" class="form-check-input" name="public">
                    Public poll
                </label>
            </div>
            <div class="form-check">
                <label class="form-check-label">
                    <input type="checkbox" class="form-check-input" name="single_option" checked>
                    Single option poll
                </label>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
