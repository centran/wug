@extends('layout')
@section('content')
	<p>Are you sure you want to delete {{ $username }} from {{ $servername }}</p>
        @if(Session::has('message'))
                <p class="alert">{{ Session::get('message') }}</p>
        @endif
        @if($errors->has())
                {{ $errors->first('server', '<li>:message</li>') }}
        @endif
        {{ Form::open(array('url'=>'dashboard/editusernamedelete', 'class'=>'form-editserver')) }}

        {{ Form::hidden('usernameID', $usernameID) }}
        {{ Form::hidden('serverID', $serverID) }}

        {{ Form::submit('Delete', array('class'=>'btn btn-large btn-primary btn-block')) }}
        {{ Form::close() }}

@stop
