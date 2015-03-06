@extends('master')
@section('container')

    <div class="panel panel-default users">
        <div class="panel-heading">
            <div class="col-md-11 pointer" data-toggle="collapse" href="#usersPanel">
                <h3 class="panel-title">Users</h3>
            </div>
            <div class="col-md-1">
                <a class="btn btn-link btn-xs" data-original-title="Add User" href="/users/create">
                    <i class="glyphicon glyphicon-plus glyphicon-lg"></i>
                </a>
            </div>
        </div>
        <div class="panel-body panel-collapse collapse in" id="usersPanel">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Created</th>
                        <th>Edit</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td>{{$user->id}}</td>
                        <td>{{$user->username}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->created_at}}</td>
                        <td><a href="/users/{{$user->id}}/edit">Edit</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{$users->links()}}
        </div>
    </div>

@stop
