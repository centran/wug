@extends('layout')
@section('content')
@if( $errors->count() > 0)
<p class="alert">{{ $errors->first('name', ':message') }}</p>
<p class="alert">{{ $errors->first('script', ':message') }}</p>
@endif
<h1> Add Script to server {{ $server->name }}</h1>
{{ Form::open(array('url' => 'dashboard/scriptsadd'))  }}
{{ Form::hidden('id', $server->id) }}
<h2>Name</h2>
{{ Form::text('name', 'test.sh') }}
<h2>Script</h2>
{{ Form::textarea('script', '#!/bin/bash
echo "Hello World"') }}
<br /><br />
{{ Form::submit('Submit') }}
{{ Form::close() }}
@stop
