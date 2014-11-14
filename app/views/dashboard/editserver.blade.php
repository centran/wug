@extends('layout')
@section('content')
	<p>Edit a server</p>
	<table id="table">
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
				{{ $server->name  }}
			</td>
			<td>
				{{ HTML::link('dashboard/editserver/edit/' . $server->id, 'EDIT') }} 
				{{ HTML::link('dashboard/editserver/delete/' . $server->id, 'DELETE') }}
			</td>		
		</tr>
		@endforeach			
		</tbody>
	</table>
@stop
