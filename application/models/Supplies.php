<?php

/**
 * Supplies, and accessors.  Also, ways to update the database
 */


class Supplies extends CI_Model {
    
    	// Constructor
	public function __construct()
	{
		parent::__construct();
        $this->load->library(['curl', 'format', 'rest']);
	}
    
	// increments the containers by the amount of containers in a pallet.
	// should also do something with cost, but dont worry about it for now
    public function orderSupplies($itemID, $amount){
        $sql = sprintf("UPDATE SUPPLIES set containers = containers + (containersPerShipment * %d) where id = %d", $amount, $itemID);
        $this->db->query($sql);
	}
	    
    // decrement the amount of containers of a supply, and increase the onhand
    public function openContainer($supplyID){
        $sql = sprintf("UPDATE SUPPLIES set onHand = onHand + itemsPerContainer, containers = containers - 1 where id = %d", $supplyID);
        $this->db->query($sql);
    }

	// retrieve a single supply
	public function get($which)
	{
        $this->rest->initialize(array('server'=>REST_SERVER));
        $this->rest->option(CURLOPT_PORT, REST_PORT);
        return $this->rest->get('/supplies/item/id/' . $key);
        // $sql = sprintf("SELECT * from SUPPLIES where ID = %d", $which);
        // $query = $this->db->query($sql);
        // $result = $query->result();
        // $reset = reset($result);
        // return $reset;
	}

	// retrieve all of the supplies
	public function getSupplies()
	{
		$this->rest->initialize(array('server'=>REST_SERVER));
        $this->rest->option(CURLOPT_PORT, REST_PORT);
        return $this->rest->get('/supplies');
	}
    
    public function create($supply){
        $sql = sprintf("INSERT into SUPPLIES (name, onHand, containersPerShipment, containers, itemsPerContainer, cost) VALUES ('%s', %d, %d, %d, %d, %d)", $supply->name, $supply->onHand, $supply->containersPerShipment, $supply->containers, $supply->itemsPerContainer, $supply->cost);
        $this->db->query($sql);
    }
    
    public function update($supply){
        $sql = sprintf("UPDATE SUPPLIES set name = '%s', onHand = %d, containersPerShipment = %d, containers = %d, itemsPerContainer = %d, cost = %d where id = %d", $supply->name, $supply->onHand, $supply->containersPerShipment, $supply->containers, $supply->itemsPerContainer, $supply->cost, $supply->id);
        $this->db->query($sql);
    }
    
    public function delete($id){
        $sql = sprintf("DELETE from SUPPLIES where id = %d", $id);
        $this->db->query($sql);
    }
}