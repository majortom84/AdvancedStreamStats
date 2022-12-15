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

class Dashboard extends CI_Controller {
	
	
	public function __construct(){
		parent::__construct();
		$this->data['title'] = 'Data Binder'; // default title
		
		// check if logged in
		authorize();

		// load model 
		$this->load->model('MongoData');
		
	}

//------------------------------------------------------------------------------
	
//------------------------------------------------------------------------------


	public function index(){
		
		$this->data['title'] = 'List Data Binders List';
		
		$this->load->view('templates/header', $this->data);
		$this->load->view('dashboard/statsList'); // load main view
		$this->load->view('templates/footer');
	
		
	} // end function dataBinders
	
//------------------------------------------------------------------------------
/*
	This function gets the data from the database, if the flag isSubscribed is set
		it will grab extra data if not, it just pulls the standard data(free data).
*/
	public function getData(){
		$isSubscribed = $this->session->userdata('isSubscribed');
		if($isSubscribed){
			$data = $this->MongoData->getAllStatsData();
		}else{
			$data = $this->MongoData->getStatsData();
		}
		
        $array;

        // ************ MUST LOOP DATA TO GET DATA ****************
        foreach($data as $document){
            $array[] = (array) $document;
        }
		// return data 
        echo json_encode($array);
		
	} // end function dataBinders

//------------------------------------------------------------------------------

}// end controller class