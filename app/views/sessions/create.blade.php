@extends('master')


@section('container')
<div class="row">
<div class="col-sm-6">
<h1>Login</h1>
{{ Form::open(array('route' => 'sessions.store', 'class' => 'form-horizontal')) }}

    @if(Session::has('flash_message'))
        <div class="alert alert-danger" role="alert">
            {{ Session::get('flash_message') }}
        </div>
    @endif

  <div class="form-group">
    {{Form::label('email', 'Email:', array('class' => 'col-sm-2 control-label'))}}
    <div class="col-sm-10">
        {{Form::text('email', null, array('class' => 'form-control'))}}
    </div>
  </div>
  <div class="form-group">
    {{Form::label('password', 'Password:', array('class' => 'col-sm-2 control-label'))}}
    <div class="col-sm-10">
        {{Form::password('password', array('class' => 'form-control'))}}
    </div>
  </div>

  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
    {{ Form::submit('Login', ['class' => 'btn btn-primary btn-lg']) }}
    </div>
  </div>
{{ Form::close() }}

</div>
</div>

@stop
