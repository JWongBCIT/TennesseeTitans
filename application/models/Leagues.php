<?php

/**
 * This is the league model. It repersents all the teams in the league 
 * with affiliated info.
 *
 * @author sperol & jasonw
 */
class Leagues extends MY_Model {

    //constructor (a good practice)
    function __construct() {
        parent::__construct('league');
    }

    public function getByDivision($div) {
        $this->db->select('name , city, filename, netpoints');
        $this->db->where('division', $div);
        return $this->db->get('league')->result_array();
    }

    public function getByConference($conf) {
        $this->db->select('name , city, filename, netpoints');
        $this->db->where('conference', $conf);
        return $this->db->get('league')->result_array();
    }

    public function getAll() {
        $this->db->select('name , city, filename, netpoints');
        return $this->db->get('league')->result_array();
    }

    public function parse_results($list) {
        
        foreach ($list as $element) {
            //var_dump($element);
            $this->getElements($element);
            
        }
    }

    function getElements($element) {
        $record = $this->create();
       
            //var_dump( $element->totals);
        //get fields for db storage
        $record->name = $element->fullname;
        $record->wins = $element->totals->wins;
        $record->losses = $element->totals->losses;
        $record->ties = $element->totals->ties;
        $record->netpoints = $element->totals->net;
        
        $this->add_teamStanding($record);
        //eturn $record;
    }

    public function add_teamStanding($record) {
        $result = $this->some('name', $record->name);
        $record->id = $result[0]->id;
        $record->city = $result[0]->city;
        $record->code = $result[0]->code;
        $record->conference = $result[0]->conference;
        $record->division = $result[0]->division;
        $record->filename = $result[0]->filename;
        
        //var_dump($result);
        //var_dump($record);
       // $teamExist = $this->exists($record->name);
       // var_dump($record->name);
            $this->update($record);
        
    }

}
