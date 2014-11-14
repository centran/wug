@extends('layout')
@section('content')
        <p>Are you sure you want to delete {{ $cron->min }} {{ $cron->hour }} {{ $cron->day }} {{ $cron->month }} {{ $cron->dayofweek }} {{ $cron->command }}</p>
        @if(Session::has('message'))
                <p class="alert">{{ Session::get('message') }}</p>
        @endif
        @if($errors->has())
                {{ $errors->first('server', '<li>:message</li>') }}
        @endif
        {{ Form::open(array('url'=>'dashboard/cronslistlistdelete', 'class'=>'form-editserver')) }}

        {{ Form::hidden('id', $cron->id) }}

        {{ Form::submit('Delete', array('class'=>'btn btn-large btn-primary btn-block')) }}
        {{ Form::close() }}

@stop
