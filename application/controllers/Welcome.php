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
		$cost = 0;
        $ingredients = 0;
        $sales = 0;
		
		$candidates = directory_map('../data/');
		foreach ($candidates as $files) {
			if(substr($files,0,5) == 'order') {
				//sets the orders
				$order = new Order('../data/' . $files);
				//increment to log another order
				$numbers++;
				//add up the total cost of the orders
				$cost += (double)$order->total();
            }
            elseif(substr($files,0,7) == 'produce') {
                $produceOrder = new ProduceOrder('../data/' . $files);
                $ingredients += $produceOrder->ingredients;
                $sales += $produceOrder->totalCost;
            }
		}

		$this->data['pagetitle'] = 'Welcome';
		$this->data['pagebody'] = 'homepage';
		$this->data['purchases'] = $numbers;
		$this->data['sales'] = $sales; // haven't done
		$this->data['cost'] = number_format((float)$cost, 2, '.', '');
		$this->data['ingredients'] = $ingredients; //haven't done
		$this->render();
    }
}

