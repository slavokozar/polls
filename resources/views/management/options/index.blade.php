@extends('layouts.app')

@section('content')
    <div class="container">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <h1>Poll `{{ $poll->name }}` options</h1>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">name</th>
                <th scope="col" class="text-right">
                    <a href="{{ action('Management\OptionController@create', $poll->code) }}" class="btn btn-info">New Option</a>
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($options as $option)
                <tr>
                    <td>{{ $option->name }}</td>
                    <td class="text-right">
                        <a href="{{ action('Management\OptionController@edit', [$poll->code, $option->id]) }}" class="btn btn-warning">Edit</a>

                        <form style="display: inline-block" method="post" action="{{ action('Management\OptionController@destroy', [$poll->code, $option->id]) }}">
                            <input type="hidden" name="_method" value="delete"/>
                            {!! csrf_field() !!}
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>



    </div>
@endsection
