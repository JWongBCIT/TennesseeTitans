<?php

class Rosters extends MY_Model {
    
    
    // Constructor
    public function __construct() {
       parent::__construct('roster');	
    }
    
    /* Returns all players on the team including name, number and position */
    function all() {
        return $this->db->get('roster')->result_array();
    }  
}
