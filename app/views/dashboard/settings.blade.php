@extends("layout")
@section("content")
	<h1>Dashboard</h1>
 
	<p>Settings area</p>
	<ul>
		<li>
			{{ HTML::link('dashboard/addserver','ADD SERVER') }}
		</li>
		<li>
			{{ HTML::link('dashboard/editserver', 'EDIT SERVER') }}
		</li>
	</ul>
@stop
