@extends('master')


@section('container')
<div class="row">
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Change Password</h3>
            </div>
            <div class="panel-body">
            {{ Form::open(array('route' => 'sessions.change-password')) }}
                @include("users/change_password")
                {{ Form::submit('Submit', ['class' => 'btn btn-primary']) }}
            {{ Form::close() }}

            </div><!-- ./panel-body -->
        </div><!-- ./panel -->
    </div><!-- ./col-md-4 -->
</div><!-- ./row -->

<div class="row">
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Update Profile</h3>
            </div>
            <div class="panel-body">
            {{ Form::open(array('route' => 'sessions.profile-save')) }}

                @if(Session::has('success'))
                    <div class="alert alert-success" role="alert">
                        {{ Session::get('success') }}
                    </div>
                @endif

                @if ($errors->has())
                    <div class="alert alert-danger" role="alert">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                    </div>
                @endif

                @include("users/form")
                {{ Form::submit('Save Profile', ['class' => 'btn btn-primary']) }}
                {{ Form::close() }}

            </div><!-- ./panel-body -->
        </div><!-- ./panel -->
    </div><!-- ./col-md-4 -->
</div><!-- ./row -->


@stop
