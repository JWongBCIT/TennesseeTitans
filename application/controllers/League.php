<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * This is the league controller. It gets every team in the league from the 
 * leagues model and sends it to the view.
 *
 * @author adamh
 */
class League extends Application {
    /*
     * The index method for /league
     */

    public function index() {

        //Gets all the team in the leagues model
        $teams = $this->leagues->all();

        //add the table helper
        $this->load->library('table');

        //bootstrap the table
        $parms = array(
            'table_open' => '<table class="table table-bordered">',
        );

        //set the table to use the bootstrap template
        $this->table->set_template($parms);




        //create a section for each conference
        //AF Conference
        $this->table->set_heading('American Football Conference - 2015 Regular Season');
        $this->data['AFC'] = $this->table->generate();
        $this->table->clear();

        //Create table for each team group

        $this->table->set_heading("AFC East Team");
        foreach ($teams as $team) {
            if ($team->div == "ACE") {
                $this->table->add_row($team->teamName);
            }
        }
        $this->data['ACE'] = $this->table->generate();
        $this->table->clear();

        $this->table->set_heading("AFC North Team");
        foreach ($teams as $team) {
            if ($team->div == "ACN") {
                $this->table->add_row($team->teamName);
            }
        }
        $this->data['ACN'] = $this->table->generate();
        $this->table->clear();

        $this->table->set_heading("AFC South Team");
        foreach ($teams as $team) {
            if ($team->div == "ACS") {
                $this->table->add_row($team->teamName);
            }
        }
        $this->data['ACS'] = $this->table->generate();
        $this->table->clear();

        $this->table->set_heading("AFC West Team");
        foreach ($teams as $team) {
            if ($team->div == "ACW") {
                $this->table->add_row($team->teamName);
            }
        }
        $this->data['ACW'] = $this->table->generate();
        $this->table->clear();

        //NF Conference

        $this->table->set_heading('National Football Conference - 2015 Regular Season');
        $this->data['NFC'] = $this->table->generate();
        $this->table->clear();

        //create tables for each team group
        $this->table->set_heading("NFC East Team");
        foreach ($teams as $team) {
            if ($team->div == "NCE") {
                $this->table->add_row($team->teamName);
            }
        }
        $this->data['NCE'] = $this->table->generate();
        $this->table->clear();

        $this->table->set_heading("NFC North Team");
        foreach ($teams as $team) {
            if ($team->div == "NCN") {
                $this->table->add_row($team->teamName);
            }
        }
        $this->data['NCN'] = $this->table->generate();
        $this->table->clear();

        $this->table->set_heading("NFC South Team");
        foreach ($teams as $team) {
            if ($team->div == "NCS") {
                $this->table->add_row($team->teamName);
            }
        }
        $this->data['NCS'] = $this->table->generate();
        $this->table->clear();
        
        $this->table->set_heading("NFC West Team");
        foreach ($teams as $team) {
            if ($team->div == "NCW") {
                $this->table->add_row($team->teamName);
            }
        }
        $this->data['NCW'] = $this->table->generate();
        $this->table->clear();
        
       
        //render the page
        $this->data['pagebody'] = 'league';
        $this->render();
    }

}
