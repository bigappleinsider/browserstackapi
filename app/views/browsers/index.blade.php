@extends('master')
@section('container')
    @if(Session::has('message_success'))
        <div class="alert alert-success" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            {{ Session::get('message_success') }}
        </div>
    @endif


    <div class="panel panel-default users browsers-page">
        <div class="panel-heading">
            <div class="col-md-6 pointer" data-toggle="collapse" href="#usersPanel">
                <h3 class="panel-title">Browsers</h3>
            </div>
        </div>
        <div class="panel-body panel-collapse collapse in" id="usersPanel">
            <div class="row">

            <div class="col-md-10">
            <div class="pull-left">
                <span class="hidden-xs">Results per Page: </span>
                <a href="/browsers?num=10">10</a> |
                <a href="/browsers?num=25">25</a> |
                <a href="/browsers?num=50">50</a> |
                <a href="/browsers?num=100">100</a>
            </div><!-- ./pull-left -->
            </div>

            <div class="col-md-2">
            <div class="btn-group">
            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                Action <span class="caret"></span>
            </button>
            <ul class="dropdown-menu" role="menu">
                <li><a href="#" class="enable-selected">Enable Selected</a></li>
                <li><a href="#" class="disable-selected">Disable Selected</a></li>
            </ul>
            </div>
            </div>

            </div><!-- ./row -->
            <form action="/browsers" method="post">
            <input type="hidden" name="action" value="enable" />
            <table class="table">
                <thead>
                    <tr>
                        <th>{{link_to_sort_browsers_by('id', 'ID')}}</th>
                        <th>{{link_to_sort_browsers_by('device', 'Device')}}</th>
                        <th>{{link_to_sort_browsers_by('browser', 'Browser')}}</th>
                        <th>{{link_to_sort_browsers_by('browser_version', 'Browser Version')}}</th>
                        <th>{{link_to_sort_browsers_by('os', 'OS')}}</th>
                        <th>{{link_to_sort_browsers_by('os_version', 'OS Version')}}</th>
                        <th>{{link_to_sort_browsers_by('enabled', 'Enabled')}}</th>
                        <th><input type="checkbox" class="select-all" /></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($browsers as $browser)
                    <tr>
                        <td>{{$browser->id}}</td>
                        <td>{{$browser->device}}</td>
                        <td>{{$browser->browser}}</td>
                        <td>{{$browser->browser_version}}</td>
                        <td>{{$browser->os}}</td>
                        <td>{{$browser->os_version}}</td>
                        <td>{{$browser->enabled?'Enabled':'Disabled'}}</td>
                        <td><input type="checkbox" name="enabled[]" value="{{$browser->id}}" /></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            </form>
            {{$browsers->appends(array('num' => $data['num'], 'sortBy' => $data['sortBy'], 'direction' => $data['direction']))->links()}}
        </div>
    </div>

@stop
