@extends('layout')
@section('content')
@if( $errors->count() > 0)
<p class="alert">{{ $errors->first('name', ':message') }}</p>
<p class="alert">{{ $errors->first('script', ':message') }}</p>
@endif
<strong>WARNING: </strong> {{ $name }} has been deleted from the server<br />
Make sure to click sumbit even if you don't make changes!!!
<h1> Edit script on {{ $server->name }}</h1>
{{ Form::open(array('url' => 'dashboard/scriptsedit'))  }}
{{ Form::hidden('id', $server->id) }}
<h2>Name</h2>
{{ Form::text('name', $name) }}
<h2>Script</h2>
{{ Form::textarea('script', $script) }}
<br /><br />
{{ Form::submit('Submit') }}
{{ Form::close() }}
@stop
