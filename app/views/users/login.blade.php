      	@if(Session::has('message'))
        	<p class="alert">{{ Session::get('message') }}</p>
	@endif
      
	{{ Form::open(array('url'=>'users/signin', 'class'=>'form-signin')) }}
   	<h2 class="form-signin-heading">Please Login</h2>
 
   	{{ Form::text('uid', null, array('class'=>'input-block-level', 'placeholder'=>'UserID')) }}
   	{{ Form::password('password', array('class'=>'input-block-level', 'placeholder'=>'Password')) }}
 
   	{{ Form::submit('Login', array('class'=>'btn btn-large btn-primary btn-block'))}}
	{{ Form::close() }}
