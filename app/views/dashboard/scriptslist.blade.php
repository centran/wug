@extends('layout')
@section('content')
<h1>List of servers</h1>
<table id='table'>
	<thead>
		<tr>
			<th>
				name
			</th>	
		</tr>
	</thead>
	<tbody>
	@foreach($servers as $server)
		<tr>
			<td>
				{{ HTML::link('dashboard/scriptslistlist/'.$server->id, $server->name) }}
			</td>	
		</tr>
	@endforeach
	</tbody>
</table>
@stop
