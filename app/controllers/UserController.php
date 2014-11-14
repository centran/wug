<?php

class UserController
extends BaseController
{
	public function __construct() {
   		$this->beforeFilter('csrf', array('on'=>'post'));
	}

  	public function getLogin() {
   		return View::make('users/login');
	}

	public function postSignin() {
		if (Auth::attempt(array('uid'=>Input::get('uid'), 'Password'=>Input::get('password')))) {
			return Redirect::to('dashboard/home');
		} else {
   			return Redirect::to('users/login')
      				->with('message', 'Your username/password combination was incorrect')
      				->withInput();
		} 
	}

	public function getLogout() {
		return Redirect::to('users/login')
				->with('message', 'Logged out successfully');
	}

}
