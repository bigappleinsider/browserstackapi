@extends('master')
@section('container')

<div class="row">
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Edit User</h3>
            </div>
            <div class="panel-body">
            {{ Form::model($user, ['method' => 'PATCH', 'route' => ['users.update', $user->id]]) }}
            @include("users/form")
            {{ Form::submit('Update User', ['class' => 'btn btn-primary'])}}
            {{ Form::reset('Reset', ['class' => 'btn btn-default'])}}
            {{ Form::close() }}
            </div><!-- ./panel-body -->
        </div><!-- ./panel -->
    </div><!-- ./col-md-4 -->
</div><!-- ./row -->

@stop


