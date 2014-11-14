<?php

class Cron extends Eloquent {

        public $table = 'crontab';

        public static $rules = array (
                'min' => 'required',
                'hour' => 'required',
                'day' => 'required',
                'month' => 'required',
                'dayofweek' => 'required',
                'command' => 'required',
        );

        public static function validate($data) {
                return Validator::make($data, static::$rules);
        }
}
