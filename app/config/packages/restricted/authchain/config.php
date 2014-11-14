<?php

return array(

    /**
     * Register providers array
     */
    'providers' => array(
        'Restricted\Authchain\Provider\Domain\LdapProvider',
        'Restricted\Authchain\Provider\Domain\ImapProvider',
		'Restricted\Authchain\Provider\Domain\IpAddressProvider',
        'Restricted\Authchain\Provider\Native\EloquentProvider'
    ),
    /**
     * Set defaults
     *
     * Settings
     *
     * fieldcheck: provide array of required model->key = value, for example, user->enabled must be true
     * native.provider: native provider (only one now supports)
     * native.connections: if you have many authentication databases, authenticate user in chain (for single sign-on)
     * ip.model: class of your ip address model
     * ip.ip_address_field: field contains ip address in ip model
     * ip.relation: name of the relation to user (method name that hasMany('ip'))
     *
     */
    'defaults'  => array(
        'native' => array(
            'provider'    => 'eloquent',
            /**
             * Connections with priority
             */
            'connections' => array(
                0 => 'pgsql',
                1 => 'sqlite'
            ),
        ),
        'ip'     => array(
            'model'            => 'Ip',
            'ip_address_field' => 'address',
            'relation'         => 'user'
        ),
    ),
    /**
     * Authentication domains
     *
     * Settings
     *
     * default: set to default if user not provide domain and not found in native provider. If user not found fallback to native provider
     * mappings.fields: keys - model parameters, values - provider parameters
     * hosts: array of authentication hosts
     * baseDN (ldap): base search distinguish name
     *
     */
    'domains'   => array(

        /**
         * Windows Active Directory example
         */
        'a4ldp01p1.apts.classifiedventures.com' => array(
            'provider' => 'ldap',
            'default'  => false,
            'mappings' => array(
                'fields' => array(
                    'username'   => 'userPrincipalName',
                    'name'       => 'cn',
                    'firstname'  => 'givenName',
                    'surname'    => 'sn',
                    'company'    => 'company',
                    'department' => 'department',
                    'email'      => 'mail',
                    'phone'      => 'telephoneNumber',
                    'mobile'     => 'mobile',
                    'enabled'    => 'userAccountControl',
                    'password'   => 'password'
                ),
            ),
            'hosts'    => array(
                'a4ldp01p1.apts.classifiedventures.com' => '172.22.133.34',
                'a4ldp02p1.apts.classifiedventures.com' => '172.22.133.36172.22.133.36'
            ),
            'baseDN'   => array(
                'cn=Manager,dc=apts,dc=classifiedventures,dc=com'
            ),
        ),
        /**
         * Imap example:
         *
         * Imap working only if user is in database and mapping 'username' => value contains login email
         *
         */
        'example.com'      => array(
            'provider' => 'imap',
            'default'  => true,
            'mappings' => array(
                'username' => 'email'
            ),
            'hosts'    => array(
                'imap.example.com' => '127.0.0.1:143',
            ),
        ),
    ),
);
