<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Sales extends Application{

    function __construct(){
        parent::__construct();
    }
    
	// like all the other controllers, pulls data from the db, throws it into the view.
    public function index(){
        // if($this->session->has_userdata('order'))
        //     $this->keep_shopping();
        // else
            // $this->summarize();
        
        
        
        //supposed to be for loading css files
        $this->load->helper('url');
        foreach($_POST as $key=>$value){
            if($value != '0') {
                file_put_contents(__DIR__ . '/../logs/sales.log', "$value,$key\n", FILE_APPEND);
            }
        }
        // identify all of the order files
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
        
        $recipeData = $this->recipes->getRecipes();
        $recipes = array();

        foreach($recipeData as $recipe){
            $ingredients = $this->recipes->getIngredients($recipe->id);
            $strIngredients = "";
            foreach($ingredients as $ingredient){
                $strIngredients .= ' ' . $ingredient->name;
            }
                
            $stock = $this->stock->get($recipe->id);
            $recipes[] = array('name' => $recipe->name, 'description' => $strIngredients, 'price' => $stock->price, 'id' => $stock->id);
        }

        $this->data['sales'] = $recipes;
        
        $this->data['orders'] = $parms;
        
        $this->data['pagetitle'] = 'Sales';
        $this->data['pagebody'] = 'summary';
        $this->render();
    }
    
    public function neworder() {
        
        if(! $this->session->has_userdata('order')) {
            $this->session->unset_userdata('order');
        }
        $order = new Order();
        $this->session->set_userdata('order', (array) $order);
        

        $recipeData = $this->recipes->getRecipes();
        $recipes = array();

        foreach($recipeData as $recipe){
            $ingredients = $this->recipes->getIngredients($recipe->id);
            $strIngredients = "";
            foreach($ingredients as $ingredient){
                $strIngredients .= ' ' . $ingredient->name;
            }
                
            $stock = $this->stock->get($recipe->id);
            $recipes[] = array('name' => $recipe->name, 'description' => $strIngredients, 'price' => $stock->price, 'id' => $stock->id);
        }

        $this->data['sales'] = $recipes;
        
        $this->data['pagebody'] = 'shopping';
        $this->data['pagetitle'] = 'Order';
        $this->render();
    }
    
    // public function keep_shopping() {
    //     $order = new Order($this->session->userdata('order'));
    //     $stuff = $order->receipt();
    //     $this->data['receipt'] = $this->parsedown->parse($stuff);
        
    //     $this->data['pagebody'] = 'sales';
    //     $source = $this->stock->getStock();
    //     $this->data['stock'] = $source;
    //     $this->render('template');
    // }
    
    public function cancel() {
        if($this->session->has_userdata('order')) {
            $this->session->unset_userdata('order');
        }
        
        $this->index();
    }
    
    public function sell(){
        
        $recipeData = $this->recipes->getRecipes();
        $recipes = array();

        foreach($recipeData as $recipe){
            $ingredients = $this->recipes->getIngredients($recipe->id);
            $strIngredients = "";
            foreach($ingredients as $ingredient){
                $strIngredients .= ' ' . $ingredient->name;
            }
                
            $stock = $this->stock->get($recipe->id);
            $recipes[] = array('name' => $recipe->name, 'description' => $strIngredients, 'price' => $stock->price, 'id' => $stock->id);
        }
        
        $order = new Order($this->session->userdata('order'));
        $sellable = array();
        foreach ($this->stock->getStock() as $stock) {
    		$amount = $this->input->post($stock->id);
            
    		if ($amount > 0 && $amount <= $stock->quantity) {
    			$this->stock->sellStock($stock->id,$amount);
                foreach($recipes as $recipe)
                {
                    if($recipe['id'] == $stock->id)
                    {
                    $order->addItem($stock->id, $recipe['name'], $amount, $recipe['price']);
                    $this->session->set_userdata('order', (array)$order);
                    }
                    
                }
    		}
    	}
        
        $stuff = $order->receipt();
        $this->data['receipt'] = $this->parsedown->parse($stuff);
        
        $order->save();
        
        $allorders = $order->details;
        $orderitems = array();
        $totalcost = 0;
        
        foreach($allorders as $orderings) {
            $orderitems[] = array (
                'name' => $orderings['name'],
                'quantity' => $orderings['quantity'],
                'price' => number_format((float)$orderings['price'], 2, '.', ''),
                'subtotal' => number_format((float)$orderings['price'] * $orderings['quantity'], 2, '.', '')
                );
            $totalcost += $orderings['price'] * $orderings['quantity'];
        }
        
        $this->data['order'] = $orderitems;
        $this->data['totalcost'] = number_format((float)$totalcost, 2, '.', '');
        
        $this->data['pagebody'] = 'sales_order';
        $this->data['total'] = $order->total();

        $this->data['sales'] = $sellable;
    	$this->render();
        
    }
    
    /*public function checkout() {
        $order = new Order($this->session->userdata('order'));
        // ignore invalid requests
        if (!$order->validate())
            redirect('/sales/neworder');

        $order->save();
        
        $stuff = $order->receipt();
        $this->data['receipt'] = $this->parsedown->parse($stuff);
        
        $this->session->unset_userdata('order');
        redirect('/sales');
    }*/

}
