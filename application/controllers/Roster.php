<?php

defined('BASEPATH') OR exit('No direct script access allowed');

function cmpName($a, $b) {
    return strcmp($a['surname'], $b['surname']);
}

function cmpNumber($a, $b) {
    return $a['number'] > $b['number'];
}

function cmpPosition($a, $b) {
    return strcmp($a['position'], $b['position']);
}

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * This is the roster controller. It gets every player on the team from the 
 * rosters model and sends it to the view.
 *
 * @author Jason
 */
class Roster extends Application {
    /*
     * The index method for /roster
     */

    public function index($id = 0) {
        session_start();
        if (isset($_SESSION['orderBy']) == FALSE) {
            $_SESSION['orderBy'] = 'name';
        }

        if (isset($_SESSION['viewState']) == FALSE) {
            $_SESSION['viewState'] = 'table';
        }
        
        $players = $this->rosters->all();

        $name = "";
        $number = "";
        $position = "";
        $table = "";
        $gallery = "";
               
        if ($_SESSION['viewState'] == 'table') {
            $table = "active";
        } else if ($_SESSION['viewState'] == 'gallery') {
            $gallery = "active";
        }
        

        if ($_SESSION['orderBy'] == 'name') {
            $name = "active";
            usort($players, "cmpName");
        } else if ($_SESSION['orderBy'] == 'number') {
            $number = "active";
            usort($players, "cmpNumber");
        } else if ($_SESSION['orderBy'] == 'position') {
            $position = "active";
            usort($players, "cmpPosition");
        }

        //add the table helper
        $this->load->library('table');
        //added pagination class
        $this->load->library('pagination');

        //Fix bootstrap not loading
        $this->data['basic_url'] = base_url();

        //Count number of players for pagination calcs
        $num_players = count($players);

        //Config for pagination stuff
        $config['base_url'] = base_url() . '/roster/';
        $config['total_rows'] = $num_players - 1;
        $config['per_page'] = 12;
        $config['use_page_numbers'] = TRUE;
        $config['page_query_string'] = FALSE;


        //Jason's nice styling
        $config['full_tag_open'] = "<ul class='pagination'>";
        $config['full_tag_close'] = "</ul>";
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
        $config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
        $config['next_tag_open'] = "<li>";
        $config['next_tagl_close'] = "</li>";
        $config['prev_tag_open'] = "<li>";
        $config['prev_tagl_close'] = "</li>";
        $config['first_tag_open'] = "<li>";
        $config['first_tagl_close'] = "</li>";
        $config['last_tag_open'] = "<li>";
        $config['last_tagl_close'] = "</li>";
        $config['first_link'] = 'First';
        $config['last_link'] = 'Last';
        $config['next_link'] = 'Next';
        $config['prev_link'] = 'Previous';

        $this->pagination->initialize($config);


        //bootstrap the table
        $parms = array(
            'table_open' => '<table class="table table-bordered">',
        );

        //set the table to use the bootstrap template
        $this->table->set_template($parms);
//
        //Create table heading 
        $this->table->set_heading('<div style="text-align:center;">Tennessee Titans Roster - 2015</div>', '<div class="btn-group">
            <a href="' . base_url() . 'roster/order/name" class="btn btn-primary ' . $name . '">Name</a>
            <a href="' . base_url() . 'roster/order/number" class="btn btn-primary ' . $number . '">Number</a>
            <a href="' . base_url() . 'roster/order/position" class="btn btn-primary ' . $position . '">Position</a>
        </div>',
                '<div class="btn-group">
            <a href="' . base_url() . 'roster/toggle/table" class="btn btn-primary ' . $table . '">Table View</a>
            <a href="' . base_url() . 'roster/toggle/gallery" class="btn btn-primary ' . $gallery . '">Gallery View</a>
        </div>'
        );
        
        $this->data['table-head'] = $this->table->generate();
        $this->table->clear();

        //Add each player to a row for displaying and headers
        $this->table->set_heading("", "Player", "Number", "Position");

        if ($id != 0) {
            $id = ($id - 1) * 12;
        }

        $galleryPlayers = array();
        
        for ($i = $id; $i < $id + 12 && $i < $num_players; $i++) {
            $player = $players[$i];
            array_push($galleryPlayers, $players[$i]);
            $this->table->add_row('<img height = "40" src="assets/images/players/' . $player["mugshot"] . '">', $player["firstname"] . " " . $player["surname"], $player["number"], $player["position"]);
        }

        //Set facade
        $this->data['roster'] = $this->table->generate();

        //create links
        $this->data['links'] = $this->pagination->create_links();

        //order
        $this->data['order'] = $_SESSION['orderBy'];

        //if gallery is selected, render the gallery view
        if($_SESSION['viewState'] == 'gallery'){
            $this->data['players'] = $galleryPlayers;
            $this->data['pagebody'] = 'rosterGallery';
            $this->render();
        }else {
            //else render the table page
            $this->data['pagebody'] = 'roster';
            $this->render();
        }
    }

    public function toggle($id){
        session_start();
        $_SESSION['viewState'] = $id;
        header('Location: /roster');
    }
    
    public function order($id) {
        session_start();
        $_SESSION['orderBy'] = $id;
        header('Location: /roster');
    }

}
