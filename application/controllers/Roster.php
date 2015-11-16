<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * This is the roster controller. It gets every player on the team from the 
 * rosters model and sends it to the view.
 *
 * @author Adam
 */
class Roster extends Application {
    /*
     * The index method for /roster
     */

    public function index($id = 0) {
        $players = $this->rosters->all();
        
        //add the table helper
        $this->load->library('table');
        //added pagination class
        $this->load->library('pagination');
        
        
        $config['base_url'] = base_url().'/roster/page/';
        $config['total_rows'] = count($players);
        $config['per_page'] = 12;
        
        
        
        $config['num_links'] = count($players)/5 + 1;
        
        
        $this->pagination->initialize($config);

        
        //bootstrap the table
        $parms = array(
            'table_open' => '<table class="table table-bordered">',
        );

        //set the table to use the bootstrap template
        $this->table->set_template($parms);

        //Create table heading 
        $this->table->set_heading("Tennessee Titans Roster - 2015");
        $this->data['table-head'] = $this->table->generate();
        $this->table->clear();

        //Add each player to a row for displaying and headers
        $this->table->set_heading("", "Player", "Number", "Position");
        for($i = $id; $i <= $id + 12; $i++) {
            $player = $players[$i];
            $this->table->add_row( '<img height = "40" src="../assets/images/'.$player["mugshot"].'">',$player["firstname"]. " " . $player["surname"], $player["number"], $player["position"]);
        }

        //Set facade
        $this->data['roster'] = $this->table->generate();
        
        //create links
        $this->data['links'] = $this->pagination->create_links();

        //render the page
        $this->data['pagebody'] = 'roster';
        $this->render();
    }

}
