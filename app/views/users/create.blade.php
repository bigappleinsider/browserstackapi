@extends('master')
@section('container')

<div class="row">
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Add New User</h3>
            </div>
            <div class="panel-body">

            {{ Form::open(['method' => 'POST', 'route' => ['users.store']]) }}
                @include("users/form")
                @include("users/change_password")
                {{ Form::reset('Reset', ['class' => 'btn btn-default'])}}
                {{ Form::submit('Add User', ['class' => 'btn btn-primary'])}}
            {{ Form::close() }}

            </div><!-- ./panel-body -->
        </div><!-- ./panel -->
    </div><!-- ./col-md-4 -->
</div><!-- ./row -->


@stop


