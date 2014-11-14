@extends('layout')
@section('content')
<h1>Add a cron to a server below</h1>
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
				{{ HTML::link('dashboard/cronsaddadd/'.$server->id, $server->name) }}
			</td>	
		</tr>
	@endforeach
	</tbody>
</table>
@stop
