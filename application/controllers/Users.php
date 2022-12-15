<?php

/*
	AUTH: Thomas Ward
	Date: 05/02/2019
	DESC: Users Controller, Log in, sign up, all user related functions
	
*/

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
ini_set('display_errors', 'On');
*/

// Report simple running errors
//error_reporting(E_ERROR | E_WARNING | E_PARSE);

class Users extends CI_Controller {
	
	
	public function __construct(){
		parent::__construct();
		$this->data['title'] = 'Data Binder'; // default title

		// check if logged in
		authorize();

		// load model 
		$this->load->model('MongoUsers');
	}// end construct

//------------------------------------------------------------------------------

public function logOut(){
	// clear session
	session_unset();
	session_destroy();
	
	redirect('/');
}// end function logout

//------------------------------------------------------------------------------

public function subscribe(){

}

private function payment(){
	// Include the Braintree library 
	require_once 'path/to/braintree-php/lib/Braintree.php'; 
	// Set up your Braintree credentials 
	Braintree_Configuration::environment('sandbox'); 
	Braintree_Configuration::merchantId(MERCHANT_ID); 
	Braintree_Configuration::publicKey(PUBLIC_KEY); 
	Braintree_Configuration::privateKey(PRIVATE_KEY); 
	// Set up a new customer and credit card 
	$customer = Braintree_Customer::create(
		[ 	'firstName' => 'John', 
			'lastName' => 'Doe', 
			'creditCard' => [ 
								'number' => '4111111111111111', 
								'expirationMonth' => '01', 
								'expirationYear' => '2022', 
								'cvv' => '123' 
							]
		]); 
	// Set up a new subscription 
	$subscription = Braintree_Subscription::create(
		[ 	'paymentMethodToken' => $customer->creditCards[0]->token, 
			'planId' => 'your_plan_id', 
			'price' => '9.99' 
		]
	); 
	// Output the subscription details 
	echo "Subscription ID: " . $subscription->id . "\n"; 
	echo "Subscription Status: " . $subscription->status . "\n"; 
	echo "Subscription Price: " . $subscription->price . "\n"; 
}

}// end controller class