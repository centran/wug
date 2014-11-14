<?php

return array(
    'account_suffix' => "",
    'domain_controllers' => array("a4ldp02p1.apts.classifiedventures.com"), // An array of domains may be provided for load balancing.
    'base_dn' => 'dc=apts,dc=classifiedventures,dc=com',
    'admin_username' => 'cn=Manager,dc=apts,dc=classifiedventures,dc=com',
    'admin_password' => 'ooch2Lii',
//    'real_primary_group' => true, // Returns the primary group (an educated guess).
    'use_ssl' => false, // If TLS is true this MUST be false.
    'use_tls' => false, // If SSL is true this MUST be false.
//    'recursive_groups' => true,
);
