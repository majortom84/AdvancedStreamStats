<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
	
// Codeigniter Note: All values are escaped automatically producing safer queries.
// CI_Model located in system > core


class MongoData extends CI_Model{
// ---------------------------------------------------------------

        protected $client;// when useing global var use '$this->' to get it
        protected $collection;

        // constructor for loading the database in a central location in the code 
        public function __construct(){
                parent::__construct(); 
                require '../home.wardwebdev.com/vendor/autoload.php' ;
                try {
                        $this->client = new MongoDB\Client(MONGODB_HOSTNAME);
                        $this->collection = $this->client->testing->streamstats; // get collection (testing = database , test = collection)
                }catch (PDOException $e) {
                        $this->error = $e->getMessage();
                        error_log('MongoDB Connection Error: ' . $this->error, 0);
                        echo 'MongoDB Error: ' . $this->error;
                }
        }// end construct


        /**
         * simple find query
         */
        public function getStatsData(){
                $query = ['subscription.subscribed' => 0];
                return $this->collection->find($query);
        }// end getStudentData

        // find all including premium data
        public function getAllStatsData(){
                return $this->collection->find();
        }// end getStudentData


}// end model ---------------------------------------------------------


