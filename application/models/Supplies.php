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
        $this->rest->initialize(array('server' => REST_SERVER));
        $this->rest->option(CURLOPT_PORT, REST_PORT);
        $result = $this->rest->get('/supplies/id/' . $which);
        return $result;

        /*
        $sql = sprintf("SELECT * from SUPPLIES where ID = %d", $which);
        $query = $this->db->query($sql);
        $result = $query->result();
        $reset = reset($result);
        return $reset;
        */
	}

	// retrieve all of the supplies
	public function getSupplies()
	{
		$this->rest->initialize(array('server' => REST_SERVER));
        $this->rest->option(CURLOPT_PORT, REST_PORT);
        $result = $this->rest->get('/supplies/');
        return $result;
        
		/*
		$sql = sprintf("SELECT * from SUPPLIES");
        $query = $this->db->query($sql);
        return $query->result();
        */
	}
    
    public function create($supply){
    	$this->rest->initialize(array('server' => REST_SERVER));
        $this->rest->option(CURLOPT_PORT, REST_PORT);
        $params = array(
            'supply' => serialize($supply)
        );
        $result = $this->rest->post('/supplies/', $params);
        return $result;
    }
    
    public function update($supply){
    	$this->rest->initialize(array('server' => REST_SERVER));
        $this->rest->option(CURLOPT_PORT, REST_PORT);
        $params = array(
            'supply' => serialize($supply)
        );
        $result = $this->rest->put('/supplies/', $params);
        return $result;
    }
    
    public function delete($id){
    	$this->rest->initialize(array('server' => REST_SERVER));
        $this->rest->option(CURLOPT_PORT, REST_PORT);
        $result = $this->rest->delete('/supplies/id/' . $id);
        return $result;
    }
}