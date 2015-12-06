<?php

defined('BASEPATH') OR exit('No direct script access allowed');

function cmpCity($a, $b) {
    return strcmp($a->city, $b->city);
}

function cmpName($a, $b) {
    return strcmp($a->name, $b->name);
}

/**
 * This is the league controller. It gets every team in the league from the 
 * leagues model and sends it to the view.
 *
 * @author Spero
 */
class League extends Application {
    /*
     * The index method for /league
     */

    public function index() {

        session_start();
        if (isset($_SESSION['league_OrderBy']) == FALSE) {
            $_SESSION['league_OrderBy'] = 'name';
        }
        
        //Create table for each team group
        $teams = $this->leagues->all();
        
        if ($_SESSION['league_OrderBy'] == 'name') {
            $name = "active";
            usort($teams, "cmpName");
        } else if ($_SESSION['league_OrderBy'] == 'city') {
            $city = "active";
            usort($teams, "cmpCity");
        } else if ($_SESSION['league_OrderBy'] == 'standings') {
            $standings = "active";
            //usort($players, "cmpPosition");
        }
        
        
        
        
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
        $city = '';
        $standings = '';

        $table = '';
        $gallery = '';
        $editorOn = '';
        $editorOff = '';

        //Create table heading 
        $this->table->set_heading('<div style="text-align:center;">League - 2015</div>', '<div class="btn-group">
            <a href="' . base_url() . 'league/order/name" class="btn btn-primary ' . $name . '">Team</a>
            <a href="' . base_url() . 'league/order/city" class="btn btn-primary ' . $city . '">City</a>
            <a href="' . base_url() . 'league/order/standings" class="btn btn-primary ' . $standings . '">Standings</a>
        </div>', '<div class="btn-group">
            <a href="' . base_url() . 'league/toggle/league" class="btn btn-primary ' . $table . '">League View</a>
            <a href="' . base_url() . 'league/toggle/conference" class="btn btn-primary ' . $gallery . '">Conference View</a>
            <a href="' . base_url() . 'league/toggle/division" class="btn btn-primary ' . $gallery . '">Division View</a>    
        </div>'
        );
        $this->data['toggleBar'] = $this->table->generate();
        $this->table->clear();

        
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
        $_SESSION['league_OrderBy'] = $id;
        header('Location: /league');
    }
}
