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
        $img_path = 'assets/images/divisions/';
        $img_tagOpen = '<img height=50 src="';
        $img_tagClose = '">';

        //bootstrap the table
        $parms = array(
            'table_open' => '<table class="table table-bordered">',
        );

        //set the table to use the bootstrap template
        $this->table->set_template($parms);

        $name = '';
        $number = '';
        $position = '';

        $table = '';
        $gallery = '';
        $editorOn = '';
        $editorOff = '';

        //Create table heading 
        $this->table->set_heading('<div style="text-align:center;">League - 2015</div>', '<div class="btn-group">
            <a href="' . base_url() . 'league/order/city" class="btn btn-primary ' . $name . '">City</a>
            <a href="' . base_url() . 'league/order/team" class="btn btn-primary ' . $number . '">Team</a>
            <a href="' . base_url() . 'league/order/division" class="btn btn-primary ' . $position . '">Division</a>
        </div>', '<div class="btn-group">
            <a href="' . base_url() . 'league/toggle/league" class="btn btn-primary ' . $table . '">League View</a>
            <a href="' . base_url() . 'league/toggle/conference" class="btn btn-primary ' . $gallery . '">Conference View</a>
            <a href="' . base_url() . 'league/toggle/standings" class="btn btn-primary ' . $gallery . '">Standings View</a>    
        </div>'
        );
        $this->data['toggleBar'] = $this->table->generate();
        $this->table->clear();

        //Create table for each team group
        $teams = $this->leagues->all();
        //var_dump($teams);
        $this->table->set_heading("Team Name", "City", "Team Logo");
        foreach ($teams as $team) {
            $temp_filename = $team->filename;
            $team->filename = $img_tagOpen . $img_path . $temp_filename . $img_tagClose;
            $this->table->add_row($team->name, $team->city, $team->filename);
        }
        $this->data['allTeams'] = $this->table->generate();
        $this->data['pagebody'] = 'league';
        $this->render();
    }

        /**
     * id holds the type type of ordering to order the table or gallery
     * @param type $id
     */
    public function order($id) {
        session_start();
        $_SESSION['orderBy'] = $id;
        header('Location: /roster');
    }
}
