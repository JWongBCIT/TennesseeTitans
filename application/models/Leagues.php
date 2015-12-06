<?php

/**
 * This is the league model. It repersents all the teams in the league 
 * with affiliated info.
 *
 * @author adamh & jasonw
 */
class Leagues extends MY_Model {

    //constructor (a good practice)
    function __construct() {
        parent::__construct('league');
    }

    public function getByDivision($div) {
        $this->db->select('name , city, filename');
        $this->db->where('division', $div);
        return $this->db->get('league')->result_array();
    }

    public function getByConference($conf) {
        $this->db->select('name , city, filename');
        $this->db->where('conference', $conf);
        return $this->db->get('league')->result_array();
    }

    public function getAll() {
        $this->db->select('name , city, filename');
        return $this->db->get('league')->result_array();
    }

    public function parse_results($list) {
        foreach ($list->children()->children() as $element) {
            var_dump($element);
            $this->getElements($element);
        }
    }

    function getElements($element) {
        $record = $this->create();

        //get fields for db storage
        $record->name = $element['fullname'];
        $record->wins = $element['wins'];
        $record->losses = $element['losses'];
        $record->ties = $element['ties'];
        $record->netpoints = $element['netpoints'];

        return $record;
    }

    public function add_teamStanding($record) {
        $teamExist = $this->exists($record->name);
        if (!$teamExist) {
            $this->update($record);
        }
    }

}
