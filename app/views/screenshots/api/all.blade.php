@extends('master')

@section('container')
    @foreach($screenshots as $data)
    <a href="/screenshots-api">Back to automation report</a>

    <table class="table">
        <thead>
            <tr>
                <th>Orientation</th>
                <th>OS</th>
                <th>OS Version</th>
                <th>Browser Version</th>
                <th>Browser</th>
                <th>State</th>
                <th>Device</th>
                <th>Created</th>
            </tr>
        </thead>

        <tbody>
            @foreach($data['screenshots'] as $screenshot)
            <tr>
                <td>
                    {{$screenshot['orientation']}}
                </td>
                <td>
                    {{$screenshot['os']}}
                </td>
                <td>
                    {{$screenshot['os_version']}}
                </td>
                <td>
                    {{$screenshot['browser_version']}}
                </td>
                 <td>
                    {{$screenshot['browser']}}
                </td>

               <td>
                    {{$screenshot['state']}}
                </td>

               <td>
                    {{$screenshot['device']}}
                </td>

               <td>
                    {{$screenshot['created_at']}}
                </td>

            </tr>
            <tr>
                <td colspan="8">
                    <p>Screenshots for <a href="{{$screenshot['url']}}" target="_blank">{{$screenshot['url']}}</a></p>
                </td>
            </tr>
            <tr>
                <td colspan="8">
                    <p>Job ID: {{$screenshot['id']}}</p>
                </td>
            </tr>
            <tr>
                <td colspan="8">
                    <img src="{{$screenshot['image_url']}}" />
                </td>
            </tr>

            @endforeach
        </tbody>
    </table>
    @endforeach

@stop
