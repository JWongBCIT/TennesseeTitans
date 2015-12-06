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

}
