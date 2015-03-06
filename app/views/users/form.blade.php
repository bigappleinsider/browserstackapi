
<div class="form-group {{$errors->has('email')?'has-error':''}}">
    {{ Form::label('email', 'Email:')}}
    {{ Form::text('email', null, ['class' => 'form-control'])}}
    {{ $errors->first('email', '<span class="help-block">:message</span>')}}
</div>
<div class="form-group {{$errors->has('username')?'has-error':''}}">
    {{ Form::label('username', 'Name:')}}
    {{ Form::text('username', null, ['class' => 'form-control'])}}
    {{ $errors->first('username', '<span class="help-block">:message</span>')}}
</div>
@if(isset($roles))
<div class="form-group {{$errors->has('role')?'has-error':''}}">
    {{ Form::label('role', 'Role:')}}
    {{ Form::select('role', $roles, null, ['class' => 'form-control'])}}
    {{ $errors->first('role', '<span class="help-block">:message</span>')}}
</div>
@endif

