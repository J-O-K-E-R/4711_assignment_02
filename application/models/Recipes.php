<?php

/**
 * Some recipes, and accessors.  
 */
class Recipes extends CI_Model {

	// Constructor
	public function __construct() {
		parent::__construct();
        $this->load->library(['curl', 'format', 'rest']);
	}

	// retrieve a single recipe
	public function get($recipeID) {
        $this->rest->initialize(array('server' => REST_SERVER));
        $this->rest->option(CURLOPT_PORT, REST_PORT);
        $result = $this->rest->get('/recipes/id/' . $recipeID);
        return $result;
        
        /*
        $sql = sprintf("SELECT * from RECIPES where ID = %d", $which);
        $query = $this->db->query($sql);
        $result = $query->result();
        $reset = reset($result);
        return $reset;
        */
	}

	// get the recipes, what more do you want from me
	public function getRecipes() {
        $this->rest->initialize(array('server' => REST_SERVER));
        $this->rest->option(CURLOPT_PORT, REST_PORT);
        $result = $this->rest->get('/recipes/');
        return $result;
        
        /*
        $sql = sprintf("SELECT * from RECIPES");
        $query = $this->db->query($sql);
		return $query->result();
        */
	}
    
    // get the ingredients (description) of a single recipe
    public function getIngredients($recipeID) {
        $this->rest->initialize(array('server' => REST_SERVER));
        $this->rest->option(CURLOPT_PORT, REST_PORT);
        $result = $this->rest->get('/recipesupplies/id/' . $recipeID);
        return $result;
        
        /*
		$sql = sprintf("SELECT supplies.name, amount from SUPPLIES inner join RECIPESUPPLIES on SUPPLIES.id = RECIPESUPPLIES.supplyID inner join RECIPES on RECIPESUPPLIES.recipeID = RECIPES.ID where recipeID = %d", $recipeID); 
        $query = $this->db->query($sql); 
        return $query->result();
        */
    }
    

    public function createRecipe($recipe, $ingredients, $price) {
    	$this->rest->initialize(array('server' => REST_SERVER));
        $this->rest->option(CURLOPT_PORT, REST_PORT);
        $params = array(
            'recipe' => serialize($recipe),
            'ingredients' => serialize($ingredients),
            'price' => serialize($price)
        );
        $result = $this->rest->post('/recipes/', $params);
        return $result;

        /*
        // create that entry
        $sql = sprintf("INSERT into RECIPES (name) VALUES ('%s')", $recipe->name);
        $this->db->query($sql);
        
        // get the id of the last thing that was inserted
        $insert_id = $this->db->insert_id();
        
        $sql2 = "INSERT into RECIPESUPPLIES (recipeID, supplyID, amount) VALUES ";
        $first = TRUE;
        foreach($ingredients as $key => $value){
            if ($first == TRUE){
                $first = FALSE;
            } else {
                $sql2 .= ",";
            }
            $sql2 .= sprintf("(%d, %d, %d)", $insert_id, $key, $value);
        }
        $this->db->query($sql2);
        
        $sql3 = sprintf("INSERT into STOCK (name, price, quantity) VALUES ('%s', %d, 0)", $recipe->name, $price);
        $this->db->query($sql3);
        */
    }
    
    public function updateRecipe($recipe, $ingredients, $price) {
    	$this->rest->initialize(array('server' => REST_SERVER));
        $this->rest->option(CURLOPT_PORT, REST_PORT);
        $params = array(
            'recipe' => serialize($recipe),
            'ingredients' => serialize($ingredients),
            'price' => serialize($price)
        );
        $result = $this->rest->post('/recipes/', $params);
        return $result;
        
    	/*
        $sql1 = sprintf("UPDATE RECIPES set name = '%'", $recipe->name);
        $this->db->query($sql1);
        
        $sql2 = sprintf("DELETE from RECIPESUPPLIES where recipeID = %d", $recipe->id);
        $this->db->query($sql2);
        
        $sql3 = "INSERT into RECIPESUPPLIES (recipeID, supplyID) VALUES ";
        $first = TRUE;
        foreach($ingredients as $ingredient){
            if ($first == TRUE){
                $first = FALSE;
            } else {
                $sql3 .= ",";
            }
            $sql3 .= sprintf("(%d, %d, %d)", $insert_id, $ingredient->id, $ingredient->amount);
        }
        
        $this->db->query($sql3);
        
        $sql4 = sprintf("UPDATE STOCK set name = '%s', price = %d, where id = %d", $recipe->name, $price, $recipe->id);
        $this->db->query($sql4);
        */
    }
    
    public function deleteRecipe($recipeID) {
    	$this->rest->initialize(array('server' => REST_SERVER));
        $this->rest->option(CURLOPT_PORT, REST_PORT);
        $result = $this->rest->delete('/recipes/id/' . $recipeID);
        return $result;

    	/*
        $sql = sprintf("DELETE from RECIPESUPPLIES where recipeID = %d", $recipeID);
        $this->db->query($sql);
        
        $sql2 = sprintf("DELETE from RECIPES where id = %d", $recipeID);
        $this->db->query($sql2);
        
        $sql3 = sprintf("DELETE from STOCK where id = %d", $recipeID);
        $this->db->query($sql3);
        */
    }
}
