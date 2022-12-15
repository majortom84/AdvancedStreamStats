<?php if ( ! defined('BASEPATH') ) exit( 'No direct script access allowed' );

	/*
		Name: Hash Password
		Author: Thomas Ward
		Date created: 10/17/2022
		Note: Hash passwords, SALT fron config > constants
	*/

    function hasPassword($password){
        returnsha1( md5( SALT. $password) ); 
    }// end function