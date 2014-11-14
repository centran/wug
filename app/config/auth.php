<?php

return array(

	/*
	|--------------------------------------------------------------------------
	| Default Authentication Driver
	|--------------------------------------------------------------------------
	|
	| This option controls the authentication driver that will be utilized.
	| This driver manages the retrieval and authentication of the users
	| attempting to get access to protected areas of your application.
	|
	| Supported: "database", "eloquent"
	|
	*/

	'driver' => 'ldap',

	/*
	|--------------------------------------------------------------------------
	| Authentication Model
	|--------------------------------------------------------------------------
	|
	| When using the "Eloquent" authentication driver, we need to know which
	| Eloquent model should be used to retrieve your users. Of course, it
	| is often just the "User" model but you may use whatever you like.
	|
	*/

	'model' => 'User',

	/*
	|--------------------------------------------------------------------------
	| Authentication Table
	|--------------------------------------------------------------------------
	|
	| When using the "Database" authentication driver, we need to know which
	| table should be used to retrieve your users. We have chosen a basic
	| default value but you may easily change it to any table you like.
	|
	*/

	'table' => 'users',

	/*
	|--------------------------------------------------------------------------
	| Password Reminder Settings
	|--------------------------------------------------------------------------
	|
	| Here you may set the settings for password reminders, including a view
	| that should be used as your password reminder e-mail. You will also
	| be able to set the name of the table that holds the reset tokens.
	|
	| The "expire" time is the number of minutes that the reminder should be
	| considered valid. This security feature keeps tokens short-lived so
	| they have less time to be guessed. You may change this as needed.
	|
	*/

	'reminder' => array(

		'email' => 'emails.auth.reminder',

		'table' => 'password_reminders',

		'expire' => 60,

	),

/**
 * LDAP Configuration for wells/l4-ldap-ntlm
 */
'ldap' => array(
    // Domain controller (host), Domain to search (domain), 
    // OU containing users (basedn), OU containing groups (groupdn)
    'host' => 'a4ldp01p1.apts.classifiedventures.com',
//    'domain' => 'a4ldp01p1.apts.classifiedventures.com',
    'basedn' => 'cn=Manager,dc=apts,dc=classifiedventures,dc=com',
    'dn' => 'dc=apts,dc=classifiedventures,dc=com',
    'groupdn' => 'ou=Groups,dc=domain,dc=com',

    // Domain credentials the app should use to access DC
    // This user doesn't need any privileges
    'dn_user' => 'cn=Manager,dc=apts,dc=classifiedventures,dc=com',
    'dn_pass' => 'ooch2Lii',

    //At minimum, you'll need these attributes
    'attributes' => array(
	'uid',
        'cn',
	'Password', 
    ),

    // Optionally require groups to gain auth view access
    'groups' => array('AuthViewers'),

    // Optionally require group admins
    'admin_groups' => array('staff'),

    // Optionally require owners/admins (username)
    'owners' => array('ceo'),
),

);
