<?php

class Order extends CI_Model {
    
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
            $this->items = array();
            foreach ($xml->item as $item) {
                $key = (string) $item->code;
                $quantity = (int) $item->quantity;
                $this->items[$key] = $quantity;
            }
        }
        else {
            $this->number = 0;
            $this->datetime = null;
            $this->items = array();
        }
    }
    
    public function addItem($which=null, $num) {
        if($which == null) 
            return;
        
        $this->items[$which]++;
    }
    
    public function receipt() {
        $total = 0;
        $result = $this->data['pagetitle'] . ' ' . PHP_EOL;
        $result .= date(DATE_ATOM) . PHP_EOL;
        foreach($this->items as $key => $value) {
            $menu = $this->menu->get($key);
            $result .= '- ' . $value . ' ' . $menu->name . PHP_EOL;
            $total += $value * $menu->price;
        }
        $result .= PHP_EOL . 'Total: $' . number_format($total, 2) . PHP_EOL;
        return $result;
    }
    
    public function save() {
        while ($this->number == 0) {
            $test = rand(100,999);
            if (!file_exists('../data/order'.$test.'.xml'))
                    $this->number = $test;
        }
        $this->datetime = date(DATE_ATOM);

        $xml = new SimpleXMLElement('<order/>');
        $xml->addChild('number',$this->number);
        $xml->addChild('datetime',$this->datetime);
        foreach ($this->items as $key => $value) {
            $lineitem = $xml->addChild('item');
            $lineitem->addChild('code',$key);
            $lineitem->addChild('quantity',$value);
        }

        $xml->asXML('../data/order' . $this->number . '.xml');
    }
    
    public function total() {
        $total = 0;
        foreach($this->items as $key => $value) {
            $item = $this->stock->get($key);
            $item = json_decode(json_encode($item), true);
            $total += $value * $item['price'];
        }
        return $total;
    }
}