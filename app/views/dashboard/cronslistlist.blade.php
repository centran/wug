@extends('layout')
@section('content')
<h1>Add a cron to a server below</h1>
<table id='table'>
	<thead>
		<tr>
			<th>
				minute
			</th>	
			<th>
				hour
			</th>
			<th>
				Day of Month
			</th>
			<th>
				Month
			</th>
			<th>
				Day of Week
			</th>
			<th>
				Command
			</th>
			<th>
				Username
			</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
	@foreach($crons as $cron)
		<tr>
			<td>
				{{ $cron->min }}
			</td>	
			<td>
				{{ $cron->hour }}
			</td>
			<td>
				{{ $cron->day }}
			</td>
			<td>
				{{ $cron->month }}
			</td>
			<td>
				{{ $cron->dayofweek }}
			</td>
			<td>
				{{ $cron->command }}
			</td>
			<td>
				{{ $cron->username }}
			</td>
			<td>
				{{ HTML::link('dashboard/cronslistlist/edit/' . $cron->id, 'EDIT') }} {{ HTML::link('dashboard/cronslistlist/delete/' . $cron->id, 'DELETE') }}
			</td>
		</tr>
	@endforeach
	</tbody>
</table>
@stop
