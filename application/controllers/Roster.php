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
 * @author Jason
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
        
        //Fix bootstrap not loading
        $this->data['basic_url'] = base_url();
        
        //Count number of players for pagination calcs
        $num_players = count($players);
        
        //Config for pagination stuff
        $config['base_url'] = base_url().'/roster/';
        $config["total_rows"] = $num_players;
        $config['per_page'] = 12;
        $config['use_page_numbers']  = TRUE;
        $config['page_query_string'] = FALSE;
        
        //Bootstrap pagination controls
        $config['full_tag_open'] = "<ul class='pagination'>";
        $config['full_tag_close'] ="</ul>";
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
        
        //Add links for first/last/next/previous
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

        //Create table heading 
        $this->table->set_heading("Tennessee Titans Roster - 2015");
        $this->data['table-head'] = $this->table->generate();
        $this->table->clear();

        //Add each player to a row for displaying and headers
        $this->table->set_heading("", "Player", "Number", "Position");
        for($i = $id; $i <= $id + 12 && $i < $num_players; $i++) {
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
