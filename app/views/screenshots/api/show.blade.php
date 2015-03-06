@extends('master')

@section('container')
    <h3>Screenshots for <a href="{{$report->url}}" target="_blank">{{$report->url}}</a></h3>
    <h3>Job ID: {{$report->job_id}}</h3>

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
                    <img src="{{$screenshot['image_url']}}" />
                </td>
            </tr>

<!--
tring '6adaa3b8534bab282d96949b0d24da1e157810ae' (length=40)
          'orientation' => null
          'url' => string 'http://www.complex.com/sports/2014/10/25-best-players-nba-october-2014/' (length=71)
          'os' => string 'OS X' (length=4)
          'image_url' => string 'http://www.browserstack.com/screenshots/1924db88c9aaf826b77a58bdeea8bf169bf47a2c/macmav_opera_11.6.jpg' (length=102)
          'browser_version' => string '11.6' (length=4)
          'browser' => string 'opera' (length=5)
          'state' => string 'done' (length=4)
          'device' => null
          'created_at' => string '2014-11-01 17:43:21 UTC' (length=23)
          'os_version' => string 'Mavericks' (length=9)
          'thumb_url' => string 'http://www.browserstack.com/screenshots/1924db88c9aaf826b77a58bdeea8bf169bf47a2c/thumb_macmav_opera_11.6.jpg' (length=108)           </tr>
-->
            @endforeach
        </tbody>
    </table>

@stop
