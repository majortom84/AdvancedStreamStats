<?php

/*
	AUTH: Thomas Ward
*/

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
ini_set('display_errors', 'On');
*/

// Report simple running errors
//error_reporting(E_ERROR | E_WARNING | E_PARSE);

class Index extends CI_Controller {
	
	
	public function __construct(){
		parent::__construct();
		$this->data['title'] = 'Data Binder'; // default title

		// load model 
		$this->load->model('MongoUsers');
	}

//------------------------------------------------------------------------------
	
	public function index(){
		
		$this->data['title'] = 'Sign In';
		
		$this->load->view('templates/header_index', $this->data);
		$this->load->view('index');
		$this->load->view('templates/footer');

	} // end function index

//------------------------------------------------------------------------------

/**
	 *  This is the login
	 * 	Will set session data here (session timeout is set in the config)
	 * 
	 * 	example data input from uer at login:
	 * 		{"email":"test@gmail.com","password":"MyPassword"} 
	 */
	public function login(){
		
		// Validate data for login
		$this->data['title'] = 'Sign In';

		// Get JSON input
		$json = file_get_contents("php://input");
		
		/**
		* xss_clean:
		*	CodeIgniter comes with a Cross Site Scripting prevention filter, 
		*	which looks for commonly used techniques to trigger JavaScript or other types of code 
		*	that attempt to hijack cookies or do other malicious things. If anything disallowed is 
		*	encountered it is rendered safe by converting the data to character entities.
		*/
		// convert JSON to array
		$userInput = $this->security->xss_clean(json_decode($json, true));

		

		$return = $this->MongoUsers->findUserWhereEmail($userInput['email']);// call fn from model with extra data

		//Convert $result, multiple MongoDB\Driver\Cursor objects into stdClass Objects
		$object = json_decode(json_encode($return->toArray(),true));
	
		

		// if count is 1 we found with email
		// else we did not find email - send error msg back to user
		if(count($object) > 0){
			// check password to see if match
			// else send back error msg to user
			// has the password to test if hashed pass == user hash pass
			$userHashPassword = sha1( md5( SALT. $userInput['password']));
			if( $object[0]->password == $userHashPassword){
				// set session data
				$userId = $object[0]->_id->{'$oid'};// get id
				$subscribed = $object[0]->subscription->subscribed;// get if subscribed
				$this->session->set_userdata(
					[
					'userId' => $userId,
					'logged_in' => true,
					'isSubscribed' => $subscribed
					]
				);
				echo json_encode( array('status' => 'Success') );
				
			}else{
				echo json_encode( array('status' => 'Password does not match') );
				
			}
		}else{
			echo json_encode( array('status' => 'Email address was not found') );
			
		}

		// release memory
		unset($return);
		unset($object);

	} // end function index

//------------------------------------------------------------------------------

/**
 * If data is found process
 * else show sinup page
 * 
 * check for if email already exsists
 * 	if found send message to try forgot password HREF in msg
 * else insert
 * 
 */
public function signUp(){

	// Get JSON input
	$json = file_get_contents("php://input");
	
	/**
	* xss_clean:
	*	CodeIgniter comes with a Cross Site Scripting prevention filter, 
	*	which looks for commonly used techniques to trigger JavaScript or other types of code 
	*	that attempt to hijack cookies or do other malicious things. If anything disallowed is 
	*	encountered it is rendered safe by converting the data to character entities.
	*/
	// convert JSON to array
	$userInput = $this->security->xss_clean(json_decode($json, true));

	if($userInput){

		// set date created timestamp
		$userInput['create_date'] = (int)strtotime("now");
		// convert to int (1 for true)
		$userInput['terms'] = (int)$userInput['terms'];
		// hash password
		$userInput['password'] = sha1( md5( SALT. $userInput['password']));

		//set subscription data
		// subscribed to 0 false
		$userInput['subscription'] = ['subscribed' => 0];

		

		// check if email already exists
		$return = $this->MongoUsers->findUserWhereEmail($userInput['email']);// call fn from model

		// need to convert to obj to see if data exists
		$object = json_decode(json_encode($return->toArray(),true));

		// if it does not exists already insert
		// else return msg to user
		if(!$object){
			// insert
			// convert to array because this is an insertmany fn
			$return = $this->MongoUsers->insertMany(array($userInput));// call fn from model 

			//rturn
			if($return->getInsertedCount() > 0){
				echo json_encode( array('status' => 'Success') );
			}else{
				// issues happened
				echo json_encode( array('status' => 'An unforsean issue has happened, please contact Thomas at tcward84@gmail.com') );
			}

		}else{
			echo json_encode( array('status' => 'Email already in use. Please try <a href="https://databinder.wardwebdev.com/Index/forgot">password reset</a>') );
		}
		
	}else{
		$this->data['title'] = 'Sign Up';
		$this->load->view('templates/header_index', $this->data);
		$this->load->view('users/signUp_new');
		$this->load->view('templates/footer');
	}
	
} // end function signup

//------------------------------------------------------------------------------
/**
 * this function will simply send the user an email to reset password
 */
public function forgot(){

	// Get JSON input
	$json = file_get_contents("php://input");
	
	/**
	* xss_clean:
	*	CodeIgniter comes with a Cross Site Scripting prevention filter, 
	*	which looks for commonly used techniques to trigger JavaScript or other types of code 
	*	that attempt to hijack cookies or do other malicious things. If anything disallowed is 
	*	encountered it is rendered safe by converting the data to character entities.
	*/
	// convert JSON to array
	$userInput = $this->security->xss_clean(json_decode($json, true));

	if($userInput){

		

		// TODO: send email with pass reset
		// TODO: create email template (pass email ?)

		// msg to user
		echo json_encode( array(
			'status' => 'Success',
			'msg' => 'You will recevie an Email shortly to reset your password.'
			) );


	}else{
		$this->data['title'] = 'Forgot Password';
		$this->load->view('templates/header_index', $this->data);
		$this->load->view('users/forgot');
		$this->load->view('templates/footer');
	}

} // end function forgot

//------------------------------------------------------------------------------


private function test(){
	$json = '{"first_name":"Thomas","last_name":"Ward","email":"tcward@gmail.com","password":"test1234566","terms":true}';
	$userInput = $this->security->xss_clean(json_decode($json, true));

	// set date created timestamp
	$userInput['create_date'] = (int)strtotime("now");
	// convert to int
	$userInput['terms'] = (int)$userInput['terms'];

	/* $date = new DateTime("@".$userInput['create_date']);  // will snap to UTC because of the // "@timezone" syntax
	echo $date->format('Y-m-d h:i:s') . " UTC <br>";  // UTC time
	$date->setTimezone(new DateTimeZone('America/Denver')); // set timezone
	echo $date->format('Y-m-d h:i:s') . " Local<br>";  //local time */

	echo "<pre>";
	print_r($userInput);

	$return = $this->MongoUsers->findUserWhereEmail($userInput['email']);

	// needto convert to obj to see if data exists
	$object = json_decode(json_encode($return->toArray(),true));

	print_r($object);

	if(!$object){
		$return = $this->MongoUsers->insertMany(array($userInput));// call fn from model 
		print_r($return->getInsertedCount());
		print_r($return);
		// verify insert
		if($return->getInsertedCount() > 0){
			print_r("Success");
		}
	}else{
		print_r("Email already in use");
	}
}

public function testPass(){

	echo "<pre>";

$password = 'H3@ther78';
$test = 'notthispass1234';
//Function: Hash - used to generate super-strong sh1 hashes
//$salt = '"%]tWI2Bba2ojeucxx=vE0SI!/!Fv:fSjpVSKd)<&#s&{<#$DL<!I6:r::zcw99';
  print_r( sha1( md5( SALT. $password) ) ); 

  // not same
  echo "\n ". $test;
  if(sha1( md5( SALT . $password) ) == sha1( md5( SALT . $test) )){
	echo "<br>Same password";
  }else{
	echo "<br>NOT THE Same password";
  }

  // same 
  echo "\n ". $password;
  if(sha1( md5( SALT . $password) ) == sha1( md5( SALT . $password) )){
	echo "<br>Same password";
  }else{
	echo "<br>NOT THE Same password";
  }

}



}// end controller class