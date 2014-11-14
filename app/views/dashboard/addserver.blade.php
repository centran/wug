@extends('layout')
@section('content')
	<p>Add a server</p>
	@if(Session::has('message'))
                <p class="alert">{{ Session::get('message') }}</p>
        @endif
	@if($errors->has())
		{{ $errors->first('server', '<li>:message</li>') }}
	@endif
        {{ Form::open(array('url'=>'dashboard/addserveradd', 'class'=>'form-addserver')) }}

        {{ Form::text('server', Input::old('server'), array('class'=>'input-block-level', 'placeholder'=>'localhost')) }}

        {{ Form::submit('Add', array('class'=>'btn btn-large btn-primary btn-block'))}}
        {{ Form::close() }}

@stop
