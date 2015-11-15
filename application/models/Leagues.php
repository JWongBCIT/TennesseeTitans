<?php

/* This class repersents a team in the league */

/**
 * @author adamh
 */
class Team {

    function __construct($name, $div, $key) {
        $this->teamName = $name;
        $this->div = $div;
        $this->key = $key;
    }

    public $key = "";
    public $teamName = "";
    public $div = "";

    
    
}

/**
 * This is the league model. It repersents all the teams in the league 
 * with affiliated info.
 *
 * @author adamh
 */
class Leagues extends CI_Model {

    //constructor (a good practice)
    function __construct() {
        parent::__construct();
    }

    public function getByDivision($div) {
        $this->db->select('name');
        $this->db->where('division', $div);
        return $this->db->get('league')->result_array();
    }

}
