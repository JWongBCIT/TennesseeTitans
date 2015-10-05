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
 * @author spero
 */
class Roster extends Application {
    /*
     * The index method for /roster
     */

    public function index() {
        $players = $this->rosters->all();

        //add the table helper
        $this->load->library('table');

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

        //Add each player to a row for displaying
        foreach ($players as $player) {
            $this->table->add_row($player->name, $player->num, $player->pos);
        }

        //Set facade
        $this->data['roster'] = $this->table->generate();

        //render the page
        $this->data['pagebody'] = 'roster';
        $this->render();
    }

}
