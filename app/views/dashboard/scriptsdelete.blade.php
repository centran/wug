@extends('layout')
@section('content')
        <p>Are you sure you want to delete {{ $name }} from {{ $server->name }}</p>
        @if(Session::has('message'))
                <p class="alert">{{ Session::get('message') }}</p>
        @endif
        @if($errors->has())
                {{ $errors->first('server', '<li>:message</li>') }}
        @endif
        {{ Form::open(array('url'=>'dashboard/scriptsdelete', 'class'=>'form-editserver')) }}

        {{ Form::hidden('id', $server->id) }}
	{{ Form::hidden('name', $name) }}

        {{ Form::submit('Delete', array('class'=>'btn btn-large btn-primary btn-block')) }}
        {{ Form::close() }}

@stop
