@extends('master')

@section('container')
    <h1>Automation form</h1>

    {{ Form::open(['route' => 'screenshots-api.store', 'files' => true, 'id' => 'create_report_form']) }}
<div class="row">
    <div class="form-group col-sm-3 {{$errors->has('urls')?'has-error':''}}">
        {{ Form::label('urls', 'CSV with a list of URLs') }}
        {{ Form::file('urls') }}
        {{ $errors->first('urls', '<span class="help-block">:message</span>')}}
    </div>
    <div class="form-group col-sm-3 {{$errors->has('name')?'has-error':''}}">
        {{ Form::label('name', 'Project name') }}
        {{ Form::text('name', null, ['class' => 'form-control']) }}
        {{ $errors->first('name', '<span class="help-block">:message</span>')}}
    </div>
    <div class="form-group col-sm-3">
        {{ Form::label('schedule', 'Schedule Time') }}
        <div class='input-group date' id='schedule'>
            <input type='text' class="form-control" name="schedule"/>
            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
        </div>
    </div>

    <div class="form-group col-sm-3">
        {{ Form::label('submit', 'Create a report') }}
        {{ Form::submit('Generate Screenshots', ['class' => 'btn btn-primary']) }}
    </div>
</div>

<div class="row">
    <div class="form-group col-sm-12 {{$errors->has('browsers')?'has-error':''}}">
        {{ $errors->first('browsers', '<span class="help-block">:message</span>')}}
    </div>
</div>



<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
  @foreach($os as $o)
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingOne">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#{{str_replace(' ', '', $o['os'])}}" aria-controls="{{str_replace(' ', '', $o['os'])}}">{{$o['os']}}</a>
      </h4>
    </div><!-- ./panel-heading -->
    <div id="{{str_replace(' ', '', $o['os'])}}" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="{{str_replace(' ', '', $o['os'])}}">
      <div class="panel-body">
        <div class="form-group">
            <button type="button" class="btn btn-primary select-all-browsers">Toggle All {{$o['os']}}</button>
        </div>
        @foreach($o['items'] as $item)
            <div class="form-group">
                {{ Form::checkbox('browsers[]', $item['id']) }}
                {{ Form::label('browsers', implode(', ', $item)  )}}
            </div>
        @endforeach
    </div>
    </div>
  </div><!-- ./panel -->
  @endforeach

</div>



    <div class="form-group">
        {{ Form::submit('Generate Screenshots', ['class' => 'btn btn-primary']) }}
    </div>
    {{ Form::close() }}


@stop
