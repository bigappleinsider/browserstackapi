@extends('master')

@section('container')

    @if ($errors->has())
        <div class="alert alert-danger" role="alert">
        @foreach ($errors->all() as $error)
            <div>{{ $error }}</div>
        @endforeach
        </div>
    @endif


    <form role="form" method="get" action="/screenshots-api">
        <div class="row">

        <div class="col-md-3">
            <label>Name</label>
            <input type="text" name="name" class="form-control" />
        </div>
        <div class="col-md-6">
            <div class="search-actions">
                <input type="reset" value="Reset" class="btn btn-default" />
                <input type="submit" class="btn btn-success" name="view" value="View All" />
                <button type="submit" class="btn btn-primary" name="search"><span class="glyphicon glyphicon-search"></span> Search</button>
            </div>
       </div>
       <div class="col-md-3">
            <div class="search-actions">
        <a href="/screenshots-api/create" class="btn btn-default"><span class="glyphicon glyphicon-file"></span> Create Report</a>
            </div>

        </div>
       </div>

    </form>

    <table class="table reports-table">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Filename</th>
                <th>Created</th>
                <th>Scheduled</th>
                <th>Job ID</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reports as $report)
            <tr>
                <td>{{$report->id}}</td>
                <td>{{$report->name}}</td>
                <td><a href="/data/reports/{{$report->filename}}">{{$report->filename}}</a></td>
                <td>{{$report->created_at}}</td>
                <td>{{$report->schedule}}</td>
                <td><a href="/screenshots-api/{{$report->id}}">{{substr($report->job_id, 0, 5)}}</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{$reports->links()}}

@stop
