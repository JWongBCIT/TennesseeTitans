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
        //$teams = $this->leagues->all();

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
        $teams = $this->leagues->getByDivision('AFC East');
        $this->table->set_heading("AFC East Team");
        foreach ($teams as $team) {
            $this->table->add_row($team);
        }
        $this->data['AFC East'] = $this->table->generate();
        $this->table->clear();

        
        $teams = $this->leagues->getByDivision('AFC North');
        $this->table->set_heading("AFC North Team");
        foreach ($teams as $team) {
            $this->table->add_row($team);
        }
        $this->data['AFC North'] = $this->table->generate();
        $this->table->clear();

        $teams = $this->leagues->getByDivision('AFC South');
        $this->table->set_heading("AFC South Team");
        foreach ($teams as $team) {
            $this->table->add_row($team);
        }
        $this->data['AFC South'] = $this->table->generate();
        $this->table->clear();

        $teams = $this->leagues->getByDivision('AFC West');
        $this->table->set_heading("AFC West Team");
        foreach ($teams as $team) {
            $this->table->add_row($team);
        }
        $this->data['AFC West'] = $this->table->generate();
        $this->table->clear();

        //NF Conference

        $this->table->set_heading('National Football Conference - 2015 Regular Season');
        $this->data['NFC'] = $this->table->generate();
        $this->table->clear();

        //Create table for each team group
        $teams = $this->leagues->getByDivision('NFC East');
        $this->table->set_heading("NFC East Team");
        foreach ($teams as $team) {
            $this->table->add_row($team);
        }
        $this->data['NFC East'] = $this->table->generate();
        $this->table->clear();

        
        $teams = $this->leagues->getByDivision('NFC North');
        $this->table->set_heading("NFC North Team");
        foreach ($teams as $team) {
            $this->table->add_row($team);
        }
        $this->data['NFC North'] = $this->table->generate();
        $this->table->clear();

        $teams = $this->leagues->getByDivision('NFC South');
        $this->table->set_heading("NFC South Team");
        foreach ($teams as $team) {
            $this->table->add_row($team);
        }
        $this->data['NFC South'] = $this->table->generate();
        $this->table->clear();

        $teams = $this->leagues->getByDivision('NFC West');
        $this->table->set_heading("NFC West Team");
        foreach ($teams as $team) {
            $this->table->add_row($team);
        }
        $this->data['NFC West'] = $this->table->generate();
        $this->table->clear();
        
        //render the page
        $this->data['pagebody'] = 'league';
        $this->render();
    }

}
