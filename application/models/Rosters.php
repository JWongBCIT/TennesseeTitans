<?php

class Rosters extends CI_Model {
    
    /* Returns all players on the team including name, number and position */
    function all() {
        return $this->db->get('roster')->result_array();
    }
    /** gets a single player
     * 
     * @param type $id is the players id
     * @return type is the player selected
     */
    function get($id) {
        $this->db->where('id', $id);
        return $this->db->get('roster')->result_array();
    }
}
