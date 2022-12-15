<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

function authorize(){
	if(!isset($_SESSION['logged_in'])){
		// load login if not logged in
		redirect('index');
	}
	else{
		return true;
	}
}