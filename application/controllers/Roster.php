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

/* 50em
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * This is the roster controller. It gets every player on the team from the 
 * rosters model and sends it to the view.
 *
 * @author Jason & Spero
 */
class Roster extends Application {
    /*
     * The index method for /roster
     */

    public $errors = array();

    public function index($id = 0) {
        session_start();
        if (isset($_SESSION['orderBy']) == FALSE) {
            $_SESSION['orderBy'] = 'name';
        }

        if (isset($_SESSION['viewState']) == FALSE) {
            $_SESSION['viewState'] = 'table';
        }

        if (isset($_SESSION['editor']) == FALSE) {
            $_SESSION['editor'] = 'off';
        }

        $players = $this->rosters->all();

        $name = "";
        $number = "";
        $position = "";
        $table = "";
        $gallery = "";
        $editorOn = "";
        $editorOff = "";

        if ($_SESSION['viewState'] == 'table') {
            $table = "active";
        } else if ($_SESSION['viewState'] == 'gallery') {
            $gallery = "active";
        }

        if ($_SESSION['editor'] == 'on') {
            $editorOn = "active";
        } else if ($_SESSION['editor'] == 'off') {
            $editorOff = "active";
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

        //Create table heading 
        $this->table->set_heading('<div style="text-align:center;">Tennessee Titans Roster - 2015</div>', '<div class="btn-group">
            <a href="' . base_url() . 'roster/order/name" class="btn btn-primary ' . $name . '">Name</a>
            <a href="' . base_url() . 'roster/order/number" class="btn btn-primary ' . $number . '">Number</a>
            <a href="' . base_url() . 'roster/order/position" class="btn btn-primary ' . $position . '">Position</a>
        </div>', '<div class="btn-group">
            <a href="' . base_url() . 'roster/toggle/table" class="btn btn-primary ' . $table . '">Table View</a>
            <a href="' . base_url() . 'roster/toggle/gallery" class="btn btn-primary ' . $gallery . '">Gallery View</a>
        </div>', '<div class="btn-group">
            <a href="' . base_url() . 'roster/editor/on" class="btn btn-primary ' . $editorOn . '">Edit</a>
            <a href="' . base_url() . 'roster/editor/off" class="btn btn-primary ' . $editorOff . '">Edit Off</a>
        </div>'
        );

        $this->data['add_player'] = '';
        $this->data['add_mugshot'] = '';
        if ($_SESSION['editor'] == 'on') {
            $this->data['add_player'] = '<a style="margin-bottom:1em" href="/Roster/add" id="player_add_button" class="btn btn-info" role="button">Add Player</a>';
            $this->data['add_mugshot'] = '<a style="margin-bottom:1em" href="/Roster/addMugshot" id="mugshot_add_button" class="btn btn-info" role="button">Upload Mugshot</a>';
        }
        $this->data['table-head'] = $this->table->generate();
        $this->table->clear();

        //Add each player to a row for displaying and headers
        $this->table->set_heading("Player", "Number", "Position");

        if ($id != 0) {
            $id = ($id - 1) * 12;
        }

        $galleryPlayers = array();

        for ($i = $id; $i < $id + 12 && $i < $num_players; $i++) {
            $player = $players[$i];
            array_push($galleryPlayers, $players[$i]);
            $this->table->add_row('<a href="/roster/player/' . $player["id"] . '">' . $player["firstname"] . " " . $player["surname"] . '</a>', $player["number"], $player["position"]);
        }

        //Set facade
        $this->data['roster'] = $this->table->generate();

        //create links
        $this->data['links'] = $this->pagination->create_links();

        //order
        $this->data['order'] = $_SESSION['orderBy'];

        //if gallery is selected, render the gallery view
        if ($_SESSION['viewState'] == 'gallery') {
            $this->data['players'] = $galleryPlayers;
            $this->data['pagebody'] = 'rosterGallery';
            $this->render();
        } else {
            //else render the table page
            $this->data['pagebody'] = 'roster';
            $this->render();
        }
    }

    /**
     * toggles from gallery to table
     * @param type $id is either gallery or table
     */
    public function toggle($id) {
        session_start();
        $_SESSION['viewState'] = $id;
        header('Location: /roster');
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

    /**
     * turns on editor mode
     * @param type $id is the mode on or off
     */
    public function editor($id) {
        session_start();
        $_SESSION['editor'] = $id;
        header('Location: /roster');
    }

    /**
     * shows a singler player. shows edit player if edit mode active
     * @param type $id is the id of the player
     */
    public function player($id) {
        session_start();

        if ($_SESSION['editor'] == 'on') {
            //Display and edit
            // format any errors
            $message = '';
            if (count($this->errors) > 0) {
                foreach ($this->errors as $booboo)
                    $message .= $booboo . '<BR>';
            }
            $this->data['message'] = $message;
            $this->load->helper('formfields');
            $this->load->helper('form');
            $player = $this->rosters->get($id);
            $this->data['pagebody'] = 'playerEdit';
            $this->data['fid'] = makeTextField('ID', 'id', $player->id);
            $this->data['fsurname'] = makeTextField('Surname', 'surname', $player->surname);
            $this->data['ffirstname'] = makeTextField('Firstname', 'firstname', $player->firstname);
            $this->data['fnumber'] = makeTextField('Number', 'number', $player->number);
            $this->data['fposition'] = makeTextField('Position', 'position', $player->position);
            $this->data['fmugshot'] = makeTextField('Mugshot', 'mugshot', $player->mugshot);
            $this->data['fsubmit'] = makeSubmitButton('Update Player', "Click here to validate player information", 'btn-success');
            $this->data['fcancel'] = makeSubmitButton('Cancel', "Click here to cancel", 'btn-warning');
            $this->data['fdelete'] = makeSubmitButton('Delete', "Click here to cdelete this player", 'btn-danger');
            $this->data['delId'] = form_input(array('name' => 'delId', 'type' => 'hidden', 'id' => 'delId', 'value' => $player->id));
        } else {
            //Display only
            $this->data = array_merge($this->data, (array) $this->rosters->get($id));
            $this->data['pagebody'] = 'player';
        }
        $this->render();
    }

    public function update() {
        $record = $this->rosters->create();
        // Extract submitted fields

        $record->id = $this->input->post('id');
        $record->surname = $this->input->post('surname');
        $record->firstname = $this->input->post('firstname');
        $record->number = $this->input->post('number');
        $record->position = $this->input->post('position');
        $record->mugshot = $this->input->post('mugshot');

        if (empty($record->surname))
            $this->errors[] = 'You must specify a last name.';
        if (empty($record->firstname))
            $this->errors[] = 'You must specify a first name.';

        if (!is_null($this->rosters->some('number', $record->number))) {
            $player = $this->rosters->some('number', $record->number)[0];
            if ($player->id != $record->id)
                $this->errors[] = 'Jersey number already exists.';
        }

        if ($record->position != 'C' && $record->position != 'CB' && $record->position != 'DB' && $record->position != 'DE' &&
                $record->position != 'DL' && $record->position != 'DT' && $record->position != 'FB' && $record->position != 'G' &&
                $record->position != 'K' && $record->position != 'LB' && $record->position != 'LS' && $record->position != 'MLB' &&
                $record->position != 'NT' && $record->position != 'OLB' && $record->position != 'P' && $record->position != 'QB' &&
                $record->position != 'RB' && $record->position != 'S' && $record->position != 'T' && $record->position != 'TE' &&
                $record->position != 'WR') {
            $this->errors[] = 'Invalid position.';
        }


        if (count($this->errors) > 0) {
            $this->player($record->id);
            return; // make sure we don't try to save anything
        }

        $this->rosters->update($record);
        redirect('/roster');
    }

    public function cancel() {
        redirect('/roster');
    }

    public function delete() {
        $this->rosters->delete($this->input->post('delId'));
        redirect('/roster');
    }

    public function add() {
        // format any errors
        $message = '';
        if (count($this->errors) > 0) {
            foreach ($this->errors as $booboo)
                $message .= $booboo . '<BR>';
        }
        $this->data['message'] = $message;
        $this->load->helper('formfields');
        $this->data['pagebody'] = 'addPlayer';
        $this->data['fid'] = makeTextField('ID', 'id', '');
        $this->data['fsurname'] = makeTextField('Surname', 'surname', '');
        $this->data['ffirstname'] = makeTextField('Firstname', 'firstname', '');
        $this->data['fnumber'] = makeTextField('Number', 'number', '');
        $this->data['fposition'] = makeTextField('Position', 'position', '');
        $this->data['fmugshot'] = makeTextField('Mugshot', 'mugshot', '');
        $this->data['fsubmit'] = makeSubmitButton('Add Player', "Click here to validate player information", 'btn-success');
        $this->data['fcancel'] = makeSubmitButton('Cancel', "Click here to cancel", 'btn-warning');
        $this->render();
    }

    public function addPlayer() {
        $record = $this->rosters->create();
        // Extract submitted fields

        $record->id = $this->input->post('id');
        $record->surname = $this->input->post('surname');
        $record->firstname = $this->input->post('firstname');
        $record->number = $this->input->post('number');
        $record->position = $this->input->post('position');
        $record->mugshot = $this->input->post('mugshot');

        if (!is_null($this->rosters->get($record->id)))
            $this->errors[] = 'That ID is already being used.';
        if (empty($record->id))
            $this->errors[] = 'You absolutely must specify an ID.';
        if (empty($record->surname))
            $this->errors[] = 'You must specify a last name.';
        if (empty($record->firstname))
            $this->errors[] = 'You must specify a first name.';



        if ($record->position != 'C' && $record->position != 'CB' && $record->position != 'DB' && $record->position != 'DE' &&
                $record->position != 'DL' && $record->position != 'DT' && $record->position != 'FB' && $record->position != 'G' &&
                $record->position != 'K' && $record->position != 'LB' && $record->position != 'LS' && $record->position != 'MLB' &&
                $record->position != 'NT' && $record->position != 'OLB' && $record->position != 'P' && $record->position != 'QB' &&
                $record->position != 'RB' && $record->position != 'S' && $record->position != 'T' && $record->position != 'TE' &&
                $record->position != 'WR') {
            $this->errors[] = 'Invalid position.';
        }


        if (count($this->errors) > 0) {
            $this->add();
            return; // make sure we don't try to save anything
        }

        $this->rosters->add($record);
        redirect('/roster');
    }

    public function addMugshot() {
        $this->errors[] = '';
        $this->data['basic_url'] = base_url();
        $this->load->helper('form');
        $this->data['formOpen'] = form_open_multipart('roster/do_upload');
        
        $message = '';
        if (count($this->errors) > 0) {
            foreach ($this->errors as $booboo)
                $message .= $booboo . '<BR>';
        }
        $this->data['message'] = $message;
        
        $this->data['pagebody'] = 'addMugshot';
        $this->render();
    }

    public function do_upload() {
        $this->load->library('upload');
        $this->data['basic_url'] = base_url();
        $config['upload_path'] = 'assets/images/players/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '1000';
        $config['max_width'] = '1024';
        $config['max_height'] = '768';

        $this->load->library('upload');
        $this->upload->initialize($config);

        if (!$this->upload->do_upload()) {
            
            $this->errors = array('error' => $this->upload->display_errors());
            $this->addMugShot();
        } else {
            $data = array('upload_data' => $this->upload->data());
            redirect('/roster');
        }
    }

}
