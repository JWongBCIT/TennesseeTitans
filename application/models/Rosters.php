<?php

class Rosters extends CI_Model {
    
    /* Returns all players on the team including name, number and position */
    function all() {
        return $this->db->get('roster')->result_array();
    }
}
