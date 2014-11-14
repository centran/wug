@extends('layout')
@section('content')
<h1>Sync crons and scripts to server bellow</h1>
<table id='table'>
	<thead>
		<tr>
			<th>
				name
			</th>	
			<th></th>
		</tr>
	</thead>
	<tbody>
	@foreach($servers as $server)
		<tr>
			<td>
				{{ $server->name }}
			</td>
			<td>
				{{ HTML::link('dashboard/sync/sync/'.$server->id, 'SYNC') }}
			</td>	
		</tr>
	@endforeach
	</tbody>
</table>
@stop
