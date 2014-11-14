<?php

class Server extends Eloquent {

//	public static $table = 'servers';

	public static $rules = array (
		'server' => 'required'
	);

	public static function validate($data) {
		return Validator::make($data, static::$rules);
	}
}
