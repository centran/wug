@extends('layout')
@section('content')
<h1>{{ $cron->min }} {{$cron->hour }} {{ $cron->day }} {{ $cron->month }} {{ $cron->dayofweek }} {{ $cron->command }} edited successfully</h1>
@stop
