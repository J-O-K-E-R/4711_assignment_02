<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends Application{

	function __construct(){
		parent::__construct();
	}

	// some mock data for now.  Not hooked up to anything.
	public function index(){
		//loading in the directory
		$this->load->helper('directory');
		
		$numbers = 0;
		$sales = 0;
		$cost = 0;
		$ingredients = array();
		
		$candidates = directory_map('../data/');
		foreach ($candidates as $files) {
			if(substr($file,0,5) == 'order') {
				//sets the orders
				$order = new Order('../data/' . $files);
				//increment to log another order
				$numbers++;
				//add up the total cost of the orders
				$cost += $order->total();
		}

		$this->data['pagetitle'] = 'Welcome';
		$this->data['pagebody'] = 'homepage';
		$this->data['purchases'] = $numbers;
		$this->data['sales'] = 0; // haven't done
		$this->data['cost'] = $cost;
		$this->data['ingredients'] = 0; //haven't done
		$this->render();
	}
	
	$this->load->helper('directory');
        $candidates = directory_map('../data/');
        $parms = array();
        foreach ($candidates as $filename) {
           if (substr($filename,0,5) == 'order') {
               // restore that order object
               $order = new Order ('../data/' . $filename);
            // setup view parameters
               $parms[] = array(
                   'number' => $order->number,
                   'datetime' => $order->datetime,
                   'total' => $order->total()
                       );
            }
        }
}
