@extends('layout')
@section('content')
<h1>Scripts</h1>
<ul>
	<li>
		{{ HTML::link('dashboard/scriptsadd', 'ADD') }}
	</li>
	<li>
		{{ HTML::link('dashboard/scriptslist', 'LIST') }}
	</li>
</ul>
@stop
