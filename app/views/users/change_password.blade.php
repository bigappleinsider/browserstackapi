<div class="form-group {{$errors->has('password')?'has-error':''}}">
    {{ Form::label('password', 'Password:')}}
    {{ Form::password('password', ['class' => 'form-control'])}}
    {{ $errors->first('password', '<span class="help-block">:message</span>')}}
</div>
<div class="form-group {{$errors->has('password_confirm')?'has-error':''}}">
    {{ Form::label('password_confirm', 'Confirm Password:')}}
    {{ Form::password('password_confirm', ['class' => 'form-control'])}}
    {{ $errors->first('password_confirm', '<span class="help-block">:message</span>')}}
</div>

