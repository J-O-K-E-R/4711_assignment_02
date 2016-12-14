<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Recieving extends Application{
    
    function __construct(){
        parent::__construct();
        $has_access = FALSE;
        $role = $this->session->userdata('userrole');
        if($role == 'user' || $role == 'administrator') {
            $has_access = TRUE;
        }
        if($has_access == FALSE){
            redirect('index.php');
        }
    }
    
	// like all the other controllers, pulls data from the db, throws it into the view.
	// this one posts to a log file, which serves as a record for now.
    public function index(){
        $this->load->helper('url');
        foreach($_POST as $key=>$value){
            if($value != '0') {
                file_put_contents(__DIR__ . '/../logs/recieving.log', "$value,$key\n", FILE_APPEND);
            }
        }
        
        $source = $this->supplies->getSupplies();
        $supplies = array();

        foreach ($source as $supply)
        {
            $supplies[] = array ('name' => $supply->name, 'on hand' => $supply->onHand, 'items per container' => $supply->itemsPerContainer, 'id' => $supply->id);
        }
        $this->data['supplies'] = $supplies;

        $this->data['pagetitle'] = 'Recieving';
        $this->data['pagebody'] = 'recieving';
		$this->render();
    }

    public function recieve(){
    	foreach ($this->supplies->getSupplies() as $supply) {
    		$amount = $this->input->post($supply->id);
    		if ($amount > 0) {
    			$this->supplies->orderSupplies($supply->id,$amount);
    		}
    	}
    	redirect('index.php');
    }
}