@extends('layout')
@section('content')
<h1>Crons</h1>
<ul>
	<li>{{ HTML::link('dashboard/cronsadd', 'ADD') }}</li>
	<li>{{ HTML::link('dashboard/cronslist', 'LIST') }}</li>
</ul>
	<hr />
	<br />
	<br />
<h1>ALL list</h1>
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
			<th>
				Host
			</th>
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
				{{ $cron->hostname }}
			</td>
                </tr>
        @endforeach
        </tbody>
</table>	
@stop
