@extends('layout')
@section('content')
	<p>Edit a server</p>
	@if(Session::has('message'))
                <p class="alert">{{ Session::get('message') }}</p>
        @endif
        <h2>Edit server name</h2>
	<p><strong>WARNING!</strong>Changing the name will delete all cronjobs off the server.</p>
	{{ Form::open(array('url'=>'dashboard/editserveredit', 'class'=>'form-editserver')) }}

        {{ Form::text('server', $name, array('class'=>'input-block-level', 'placeholder'=>$name)) }}
	{{ Form::hidden('id', $id) }}
        
	{{ Form::submit('Edit', array('class'=>'btn btn-large btn-primary btn-block')) }}
        {{ Form::close() }}
	@if($errors->has())
		{{ $errors->first('server', '<li>:message</li>') }}
	@endif

	<h2>Add username</h2>
	{{ Form::open(array('url'=>'dashboard/editservereditaddusername', 'class'=>'form-editserver')) }}

        {{ Form::text('username', '', array('class'=>'input-block-level', 'placeholder'=>'root')) }}
        {{ Form::hidden('id', $id) }}

        {{ Form::submit('Add', array('class'=>'btn btn-large btn-primary btn-block')) }}
        {{ Form::close() }}
	@if($errors->has())
		{{ $errors->first('username', '<li>:message</li>') }}
	@endif
	
	<h2>Usernames</h2>
	<table id="table">
	<thead>
		<tr>
			<th>
				username
			</th>
			<th>
			</th>
		</tr>
	</thead>
	<tbody>
	@foreach($usernames as $username)
		<tr>
			<td>
				{{ $username->username }}
			</td>
			<td>
				{{ HTML::link('dashboard/editserverusername/delete/'.$id.'/'.$username->id, 'DELETE') }}
			</td>
		</tr>
	@endforeach
	</tbody>
	</table>

@stop
