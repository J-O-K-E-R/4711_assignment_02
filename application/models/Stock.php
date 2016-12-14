<?php

/**
 * Some stock, and accessors.  
 */
class Stock extends CI_Model {

	// Constructor
	public function __construct()
	{
		parent::__construct();
	}

	//some pun about stalking?  
	// get all the stock for a access in the controllers.
	public function getStock()
	{
        $this->rest->initialize(array('server' => REST_SERVER));
        $this->rest->option(CURLOPT_PORT, REST_PORT);
        $result = $this->rest->get('/stock/');
        return $result;
	}
    
    // retrieve a single stock
	public function get($which)
	{
		$this->rest->initialize(array('server' => REST_SERVER));
        $this->rest->option(CURLOPT_PORT, REST_PORT);
        $result = $this->rest->get('/stock/id/' . $which);
        return $result;
	}
        
    public function buildStock($stockID, $amount){
        $sql = sprintf("UPDATE supplies s INNER JOIN recipesupplies rs ON rs.supplyID = s.id SET s.onhand = (s.onhand - (rs.amount * %d)) WHERE  rs.recipeid = %d", $amount, $stockID);
        $this->db->query($sql);
        
        $sql2 = sprintf("UPDATE stock SET quantity = quantity + %d where id = %d", $amount, $stockID);
        $this->db->query($sql2);
    }
    
    public function sellStock($stockID, $amount){
        $sql = sprintf("UPDATE stock SET quantity = quantity - %d where id = %d", $amount, $stockID);
        $this->db->query($sql);
        
        // do xml selling thing here
    }
    
    public function update($stock){ 
    	$this->rest->initialize(array('server' => REST_SERVER));
        $this->rest->option(CURLOPT_PORT, REST_PORT);
        $params = array(
            'stock' => serialize($stock)
        );
        $result = $this->rest->put('/stock/', $params);
        return $result;
    } 
}
