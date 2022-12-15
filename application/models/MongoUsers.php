<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
	
// Codeigniter Note: All values are escaped automatically producing safer queries.
// CI_Model located in system > core


class MongoUsers extends CI_Model{
// ---------------------------------------------------------------

        protected $client;// when useing global var use '$this->' to get it
        protected $collection;

        // constructor for loading the database in a central location in the code 
        public function __construct(){
                parent::__construct(); 
                require '../home.wardwebdev.com/vendor/autoload.php' ;
                try {
                        $this->client = new MongoDB\Client(MONGODB_HOSTNAME);
                        $this->collection = $this->client->testing->advancedstreamstats; // get collection (testing = database , test = collection)
                }catch (PDOException $e) {
                        $this->error = $e->getMessage();
                        error_log('MongoDB Connection Error: ' . $this->error, 0);
                        echo 'MongoDB Error: ' . $this->error;
                }
        }// end construct


        /**
         * simple find query
         *  Where email is user input email
         */
        public function findUserWhereEmail($email){
                $query = ['email' => $email];
                return $this->collection->find($query);
        }// end getStudentData

        /**
         * insert function
         * insert many to allow many if needed
         * just pass an array of arrays (objects) to it
         */
        public function insertMany($data){
                return $this->collection->insertMany($data);
        }// end insertMany


        

}// end model ---------------------------------------------------------


