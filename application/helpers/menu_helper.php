<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

	if(!function_exists('active_link')) {
	  function activate_menu($function) {
	    // Getting CI class instance.
	    $CI = get_instance();
	    // Getting router class to active.
	    $method = $CI->router->fetch_method();
	    return ($method == $function) ? 'active' : '';
	  }
	}