<?php


/**
 * This is the league model. It repersents all the teams in the league 
 * with affiliated info.
 *
 * @author adamh & jasonw
 */
class Leagues extends CI_Model {

    //constructor (a good practice)
    function __construct() {
        parent::__construct();
    }

    public function getByDivision($div) {
        $this->db->select('name , city, filename');
        $this->db->where('division', $div);
        return $this->db->get('league')->result_array();
    }

}
