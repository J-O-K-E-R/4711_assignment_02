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
		$sql = sprintf("SELECT * from STOCK");
        $query = $this->db->query($sql);
        return $query->result();
	}
    
    // retrieve a single stock
	public function get($which)
	{
		$sql = sprintf("SELECT * from STOCK where ID = %d", $which);
        $query = $this->db->query($sql);
        $result = $query->result();
        $reset = reset($result);
        return $reset;
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
        $sql = sprintf("UPDATE STOCK set name = '%s', price = %d, quantity = %d where id = %d", $stock->name, $stock->price, $stock->quantity, $stock->id);
        $this->db->query($sql); 
    } 
}
