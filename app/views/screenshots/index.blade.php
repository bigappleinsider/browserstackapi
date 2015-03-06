@extends('master')

@section('container')
    <h1>Automation form</h1>

    {{ Form::open(['route' => 'screenshots.store', 'files' => true]) }}
    <div class="form-group">
        {{ Form::label('urls', 'CSV with a list of URLs') }}
        {{ Form::file('urls') }}
    </div>
    @foreach($browsers as $key => $browser)
    <div class="form-group">
        {{ Form::checkbox('browsers[]', $key) }}
        {{ Form::label('browsers', implode(', ', $browser)  )}}
    </div>
    @endforeach

    <div class="form-group">
        {{ Form::submit('Generate Screenshots', ['class' => 'btn btn-primary']) }}
    </div>
    {{ Form::close() }}


@stop
