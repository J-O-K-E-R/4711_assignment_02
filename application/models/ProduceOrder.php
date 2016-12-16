<?php

class ProduceOrder extends CI_Model {
    
    function __construct($state = null) {
        parent::__construct();
        
        if(is_array($state)) {
            foreach($state as $key => $value)
            $this->$key = $value;
        }
        elseif ($state != null) {
            $xml = simplexml_load_file($state);
            $this->number = (int) $xml->number;
            $this->datetime = (string) $xml->datetime;
            $this->ingredients = (int) $xml->ingredients;
            $this->totalCost = (int) $xml->totalCost;
            foreach ($xml->item as $item) {
                $key = (string) $item->code;
                $quantity = (int) $item->quantity;
                $this->items[$key] = $quantity;
            }
        }
        else {
            $this->number = 0;
            $this->datetime = null;
            $this->ingredients = 0;
            $this->totalCost = 0;
        }
    }
    
    public function addItem($number) {
        //if($which == null) 
          //  return;
        
        $this->ingredients += $number;
        
    }
    
    public function addCost($cost) {
        $this->totalCost += $cost;
    }

    
    public function save() {
        while ($this->number == 0) {
            $test = rand(100,999);
            if (!file_exists('../data/produce'.$test.'.xml'))
                    $this->number = $test;
        }
        $this->datetime = date(DATE_ATOM);

        $xml = new SimpleXMLElement('<produce/>');
        $xml->addChild('ingredients',$this->ingredients);
        $xml->addChild('totalCost', $this->totalCost);

        

        $xml->asXML('../data/produce' . $this->number . '.xml');
    }
}
