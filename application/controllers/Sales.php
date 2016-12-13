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
        $this->load->helper('url');
        foreach($_POST as $key=>$value){
            if($value != '0') {
                file_put_contents(__DIR__ . '/../logs/sales.log', "$value,$key\n", FILE_APPEND);
            }
        }
        $this->data['pagetitle'] = 'Sales';
        $this->data['pagebody'] = 'summary';
        $this->render();
    }
    
    public function neworder() {
        if(! $this->session->has_userdata('order')) {
            $order = new Order();
            $this->session->set_userdata('order', (array) $order);
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
            $recipes[] = array('name' => $recipe->name, 'description' => $strIngredients, 'price' => $stock->price);
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
    
    public function add($what) {
        $order = new Order($this->session->userdata('order'));
        $order->additem($what);
        $this->session->set_userdata('order', (array)$order);
        $this->keep_shopping();
        redirect('/sales/neworder');
    }
    
    public function checkout() {
        $order = new Order($this->session->userdata('order'));
        // ignore invalid requests
        if (!$order->validate())
            redirect('/sales/neworder');
        $order->save();
        $this->session->unset_userdata('order');
        redirect('/sales');
    }
    
    public function examine($which) {
        $order = new Order ('../data/order' . $which . '.xml');
        $stuff = $order->receipt();
        $this->data['content'] = $this->parsedown->parse($stuff);
        $this->render();
    }
}
