@extends('layout')
@section('content')
<h1>Edit Cron</h1>
{{ Form::open(array('url' => 'dashboard/cronslistlistedit'))  }}
{{ Form::hidden('id', $cron->id) }}
<h2>Minute</h2>
{{ Form::text('min', $cron->min) }}
<h2>Hour</h2>
{{ Form::text('hour', $cron->hour) }}
<h2>Day of Month</h2>
{{ Form::text('day', $cron->day) }}
<h2>Month</h2>
{{ Form::text('month', $cron->month) }}
<h2>Day of Week</h2>
{{ Form::text('dayofweek', $cron->dayofweek) }}
<h2>Command</h2>
{{ Form::text('command', $cron->command) }}
<h2>Username</h2>
<?php 
	echo '<select name="username">';
	foreach($usernames as $username) 
		echo '<option value="' . $username->id . '">' . $username->username . '</option>';
	echo '</select>';
?>
<br /><br />
{{ Form::submit('Submit') }}
{{ Form::close() }}
@stop
