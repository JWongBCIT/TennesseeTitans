<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class History extends MY_Model2 {

    public function __construct() {
        parent::__construct('history', 'home', 'date');
    }

    public function update_DB() {
        $this->load->library('xmlrpc');
        $this->xmlrpc->server('nfl.jlparry.com/rpc', '80');
        $this->xmlrpc->method('since');
        $request = array('20150830');
        $this->xmlrpc->request($request);
        if (!$this->xmlrpc->send_request()) {
            echo $this->xmlrpc->display_error();
        }
        $response = $this->xmlrpc->display_response();
        $this->parse_result($response);
    }

    public function parse_result($list) {
        foreach ($list as $team) {
            $record = $this->getElements($team);
            $this->add_game($record);
        }
    }

    function getElements($element) {
        $record = $this->create();

        //get fields for db storage
        $record->home = $element['home'];
        $record->away = $element['away'];
        $record->score = $element['score'];
        $record->date = $element['date'];
        $record->inserted = Date("Y-m-d H:i:s");

        return $record;
    }

    public function add_game($record) {
        $gameExists = $this->exists($record->home, $record->date);
        if (!$gameExists) {
            $this->add($record);
        }
    }

    public function average($teamName) {
        $this->db->select('score');
        $this->db->where('home', $teamName);
        $scoresBoth = $this->db->get('history')->result_array();

        $total = 0;
        $totalScore = 0;
        for ($i = 0; $i < count($scoresBoth); $i++) {
            $singleScore = explode(':', $scoresBoth[$i]['score']);
            $totalScore += $singleScore[0];
            $total++;
        }

        $this->db->select('score');
        $this->db->where('away', $teamName);
        $scoresBoth = $this->db->get('history')->result_array();

        for ($i = 0; $i < count($scoresBoth); $i++) {
            $singleScore = explode(':', $scoresBoth[$i]['score']);
            $totalScore += $singleScore[1];
            $total++;
        }

        if ($total == 0) {
            return 0;
        }

        return $totalScore / $total;
    }
    
    public function last5Average(){
        $this->db->select('home, score');

        $this->db->where('home', 'TEN');
        $this->db->or_where('away', 'TEN');

        $scoresBoth = $this->db->get('history')->result_array();

        for ($i = 0; $i < count($scoresBoth) && $i < 5; $i++) {
            $singleScore = explode(':', $scoresBoth[$i]['score']);
            
            $totalScore = 0;
            $total = 0;
            //Home game, else away game
            if ($scoresBoth[$i]['home'] == 'TEN') {
                $totalScore += $singleScore[0];
                $total++;
            } else {
                $totalScore += $singleScore[1];
                $total++;
            }
        }
        return $totalScore / $total;
    }

    public function againstAverage($teamName) {
        $this->db->select('home, score');

        $array1 = array('home' => 'TEN', 'away' => $teamName);
        $this->db->where($array1);
        $array2 = array('home' => $teamName, 'away' => 'TEN');
        $this->db->or_where($array2);

        $scoresBoth = $this->db->get('history')->result_array();

        for ($i = 0; $i < count($scoresBoth) && $i < 5; $i++) {
            $singleScore = explode(':', $scoresBoth[$i]['score']);
           
            $totalScore = 0;
            $total = 0;
            //Home game, else away game
            if ($scoresBoth[$i]['home'] == 'TEN') {
                $totalScore += $singleScore[0];
                $total++;
            } else {
                $totalScore += $singleScore[1];
                $total++;
            }
        }
        return $totalScore / $total;
    }

}
