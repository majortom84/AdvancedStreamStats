<?php if ( ! defined('BASEPATH') ) exit( 'No direct script access allowed' );

	/*
		Name: Debug Helper
		Author: Charles Garrison
		Version: 1.1
		Relase Date: 03.25.2014
		Modified DAte: 06.25.2014
		
		Note: Helper is auto-loaded for system-wide availability
	*/

	//Function: A TEST - Simply prints out the value and type of a variable
	function atest( $a ) {
		echo '<pre>';
		print_r( $a );
		echo '</pre>';
		exit;
	} //End of Function
	
	// ----------------------------------------------------	

	//Function: A NOTE
	function anote( $filename=FALSE, $note=FALSE ) {
		if( ! $note OR ! $filename )
			return FALSE;
			
		$note = ( is_array($note) ) ? implode( ' ', $note ) : $note;
		
		date_default_timezone_set( 'America/Denver' );
		
		$filepath = '/var/www/common/' . $filename . '.log';

		$calling_function_data = debug_backtrace();

		$note = date( 'Y-m-d h:i:s' ) . ' | ' . $note . ' | ' . $calling_function_data[1]['class'] . ' class / ' . $calling_function_data[1]['function'] . '() function | line: ' . $calling_function_data[0]['line'] . "\n\n\n";
		if( file_put_contents( $filepath, $note, FILE_APPEND ) ) {
			//echo "Completed <br>";
		}
		else
			die( 'did not work' );
			
		//echo $note . "<br>" . $filepath;
		

			

	} //End of Function
	
/* End of file debug_helper.php */