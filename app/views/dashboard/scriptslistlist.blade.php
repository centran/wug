@extends('layout')
@section('content')
<h1>Choose a script on {{ $server->name }} to edit</h1>
<table id="table">
<thead>
	<th>
		name
	</th>
	<th></th>
</thead>
<tbody>
	<?php $x = 1; ?>
	@foreach($scripts as $script)
	<tr>
		<td>
			{{ $script }}
		</td>
		<td>
			{{ HTML::link('dashboard/scriptsedit/' . $server->id . '/' . $x, 'EDIT') }}
			{{ HTML::link('dashboard/scriptsdelete/' . $server->id . '/' . $x, 'DELETE') }}
		</td>
	</tr>
	<?php $x++ ?>
	@endforeach
</tbody>
</table>
@stop
