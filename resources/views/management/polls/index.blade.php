@extends('layouts.app')

@section('content')
    <div class="container">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <h1>Polls management</h1>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">name</th>
                    <th scope="col">code</th>
                    <th scope="col" class="text-right">
                        <a href="{{ action('Management\PollController@create') }}" class="btn btn-info">New Poll</a>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($polls as $pollObj)
                    <tr>
                        <td>{{ $pollObj->name }}</td>
                        <td>{{ $pollObj->code }}</td>
                        <td class="text-right">
                            <a href="{{ action('Management\PollController@show', $pollObj->code) }}" class="btn btn-info">Results <span class="badge badge-light">{{ count($pollObj->votes) }}</span></a>

                            <a href="{{ action('Management\OptionController@index', $pollObj->code) }}" class="btn btn-primary">Options</a>

                            <a href="{{ action('Management\PollController@edit', $pollObj->code) }}" class="btn btn-warning">Edit</a>

                            <form style="display: inline-block" method="post" action="{{ action('Management\PollController@destroy', $pollObj->code) }}">
                                <input type="hidden" name="_method" value="delete"/>
                                {!! csrf_field() !!}
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $polls->render() }}

    </div>
@endsection
