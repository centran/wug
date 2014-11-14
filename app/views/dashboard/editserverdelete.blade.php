@extends('layout')
@section('content')
	<p>Are you sure you want to delete {{ $name }}</p>
	@if(Session::has('message'))
                <p class="alert">{{ Session::get('message') }}</p>
        @endif
	@if($errors->has())
		{{ $errors->first('server', '<li>:message</li>') }}
	@endif
	{{ Form::open(array('url'=>'dashboard/editserverdelete', 'class'=>'form-editserver')) }}

	{{ Form::hidden('id', $id) }}
	{{ Form::hidden('name', $name) }}
        
	{{ Form::submit('Delete', array('class'=>'btn btn-large btn-primary btn-block')) }}
        {{ Form::close() }}

@stop
