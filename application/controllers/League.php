<?php

defined('BASEPATH') OR exit('No direct script access allowed');

function cmpCity($a, $b) {
    return strcmp($a['city'], $b['city']);
}

function cmpName($a, $b) {
    return strcmp($a['name'], $b['name']);
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

        if (isset($_SESSION['league_ViewState']) == FALSE) {
            $_SESSION['league_ViewState'] = 'league';
        }

        
        $name = '';
        $city = '';
        $standings = '';

        $league = '';
        $conference = '';
        $division = '';

        if ($_SESSION['league_OrderBy'] == 'name') {
            $name = "active";
        } else if ($_SESSION['league_OrderBy'] == 'city') {
            $city = "active";
        } else if ($_SESSION['league_OrderBy'] == 'standings') {
            $standings = "active";
        }

        

        if ($_SESSION['league_ViewState'] == 'league') {
            $league = "active";
        } else if ($_SESSION['league_ViewState'] == 'conference') {
            $conference = "active";
        } else if ($_SESSION['league_ViewState'] == 'division') {
            $division = "active";
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




        //Create table heading 
        $this->table->set_heading('<div style="text-align:center;">League - 2015</div>', '<div class="btn-group">
            <a href="' . base_url() . 'league/order/name" class="btn btn-primary ' . $name . '">Team</a>
            <a href="' . base_url() . 'league/order/city" class="btn btn-primary ' . $city . '">City</a>
            <a href="' . base_url() . 'league/order/standings" class="btn btn-primary ' . $standings . '">Standings</a>
        </div>', '<div class="btn-group">
            <a href="' . base_url() . 'league/toggle/league" class="btn btn-primary ' . $league . '">League View</a>
            <a href="' . base_url() . 'league/toggle/conference" class="btn btn-primary ' . $conference . '">Conference View</a>
            <a href="' . base_url() . 'league/toggle/division" class="btn btn-primary ' . $division . '">Division View</a>    
        </div>'
        );
        $this->data['toggleBar'] = $this->table->generate();
        $this->table->clear();
        $this->data['allTeams2'] = '';
        $this->data['allTeams3'] = '';
        $this->data['allTeams4'] = '';
        $this->data['allTeams5'] = '';
        $this->data['allTeams6'] = '';
        $this->data['allTeams7'] = '';
        $this->data['allTeams8'] = '';


        if ($league == 'active') {
            //Create table for each team group
            $teams = $this->leagues->getAll();
            if ($_SESSION['league_OrderBy'] == 'name') {
                $name = "active";
                usort($teams, "cmpName");
            } else if ($_SESSION['league_OrderBy'] == 'city') {
                $city = "active";
                usort($teams, "cmpCity");
            } else if ($_SESSION['league_OrderBy'] == 'standings') {
                $standings = "active";
                // usort($players, "cmpPosition");
            }
            $this->table->set_heading("Team Name", "City", "Team Logo");
            foreach ($teams as $team) {
                $temp_filename = $team['filename'];
                $team['filename'] = $img_tagOpen . $img_path . $temp_filename . $img_tagClose;
                $this->table->add_row($team['name'], $team['city'], $team['filename']);
            }
            $this->data['allTeams'] = $this->table->generate();
            $this->data['pagebody'] = 'league';
            $this->render();
        } else if ($conference == 'active') {
            $teams = $this->leagues->getByConference('American Football Conference');
            if ($_SESSION['league_OrderBy'] == 'name') {
                $name = "active";
                usort($teams, "cmpName");
            } else if ($_SESSION['league_OrderBy'] == 'city') {
                $city = "active";
                usort($teams, "cmpCity");
            } else if ($_SESSION['league_OrderBy'] == 'standings') {
                $standings = "active";
                // usort($players, "cmpPosition");
            }
            $this->table->set_heading("<h4>American Football Conference</h4><br>Team Name", "<br>City", "<br>Team Logo");
            foreach ($teams as $team) {
                $temp_filename = $team['filename'];
                $team['filename'] = $img_tagOpen . $img_path . $temp_filename . $img_tagClose;
                $this->table->add_row($team['name'], $team['city'], $team['filename']);
            }
            $this->data['allTeams'] = $this->table->generate();

            $this->table->clear();

            $teams = $this->leagues->getByConference('National Football Conference');
            if ($_SESSION['league_OrderBy'] == 'name') {
                $name = "active";
                usort($teams, "cmpName");
            } else if ($_SESSION['league_OrderBy'] == 'city') {
                $city = "active";
                usort($teams, "cmpCity");
            } else if ($_SESSION['league_OrderBy'] == 'standings') {
                $standings = "active";
                // usort($players, "cmpPosition");
            }
            if ($_SESSION['league_OrderBy'] == 'name') {
                $name = "active";
                usort($teams, "cmpName");
            } else if ($_SESSION['league_OrderBy'] == 'city') {
                $city = "active";
                usort($teams, "cmpCity");
            } else if ($_SESSION['league_OrderBy'] == 'standings') {
                $standings = "active";
                // usort($players, "cmpPosition");
            }
            $this->table->set_heading("<h4>National Football Conference</h4><br>Team Name", "<br>City", "<br>Team Logo");
            foreach ($teams as $team) {
                $temp_filename = $team['filename'];
                $team['filename'] = $img_tagOpen . $img_path . $temp_filename . $img_tagClose;
                $this->table->add_row($team['name'], $team['city'], $team['filename']);
            }

            $this->data['allTeams2'] = $this->table->generate();

            //array_merge((array) $this->data['allTeams'], (array) $this->table->generate());
            $this->data['pagebody'] = 'league';
            $this->render();
        } else if ($division == 'active') {
            $teams = $this->leagues->getByDivision('AFC North');
            if ($_SESSION['league_OrderBy'] == 'name') {
                $name = "active";
                usort($teams, "cmpName");
            } else if ($_SESSION['league_OrderBy'] == 'city') {
                $city = "active";
                usort($teams, "cmpCity");
            } else if ($_SESSION['league_OrderBy'] == 'standings') {
                $standings = "active";
                // usort($players, "cmpPosition");
            }
            $this->table->set_heading("<h4>AFC North</h4><br>Team Name", "<br>City", "<br>Team Logo");
            foreach ($teams as $team) {
                $temp_filename = $team['filename'];
                $team['filename'] = $img_tagOpen . $img_path . $temp_filename . $img_tagClose;
                $this->table->add_row($team['name'], $team['city'], $team['filename']);
            }
            $this->data['allTeams'] = $this->table->generate();

            $this->table->clear();

            $teams = $this->leagues->getByDivision('AFC South');
            if ($_SESSION['league_OrderBy'] == 'name') {
                $name = "active";
                usort($teams, "cmpName");
            } else if ($_SESSION['league_OrderBy'] == 'city') {
                $city = "active";
                usort($teams, "cmpCity");
            } else if ($_SESSION['league_OrderBy'] == 'standings') {
                $standings = "active";
                // usort($players, "cmpPosition");
            }
            $this->table->set_heading("<h4>AFC South</h4><br>Team Name", "<br>City", "<br>Team Logo");
            foreach ($teams as $team) {
                $temp_filename = $team['filename'];
                $team['filename'] = $img_tagOpen . $img_path . $temp_filename . $img_tagClose;
                $this->table->add_row($team['name'], $team['city'], $team['filename']);
            }

            $this->data['allTeams2'] = $this->table->generate();

            $this->table->clear();

            $teams = $this->leagues->getByDivision('AFC East');
            if ($_SESSION['league_OrderBy'] == 'name') {
                $name = "active";
                usort($teams, "cmpName");
            } else if ($_SESSION['league_OrderBy'] == 'city') {
                $city = "active";
                usort($teams, "cmpCity");
            } else if ($_SESSION['league_OrderBy'] == 'standings') {
                $standings = "active";
                // usort($players, "cmpPosition");
            }
            $this->table->set_heading("<h4>AFC East</h4><br>Team Name", "<br>City", "<br>Team Logo");
            foreach ($teams as $team) {
                $temp_filename = $team['filename'];
                $team['filename'] = $img_tagOpen . $img_path . $temp_filename . $img_tagClose;
                $this->table->add_row($team['name'], $team['city'], $team['filename']);
            }

            $this->data['allTeams3'] = $this->table->generate();
            $this->table->clear();

            $teams = $this->leagues->getByDivision('AFC West');
            if ($_SESSION['league_OrderBy'] == 'name') {
                $name = "active";
                usort($teams, "cmpName");
            } else if ($_SESSION['league_OrderBy'] == 'city') {
                $city = "active";
                usort($teams, "cmpCity");
            } else if ($_SESSION['league_OrderBy'] == 'standings') {
                $standings = "active";
                // usort($players, "cmpPosition");
            }
            $this->table->set_heading("<h4>AFC West</h4><br>Team Name", "<br>City", "<br>Team Logo");
            foreach ($teams as $team) {
                $temp_filename = $team['filename'];
                $team['filename'] = $img_tagOpen . $img_path . $temp_filename . $img_tagClose;
                $this->table->add_row($team['name'], $team['city'], $team['filename']);
            }

            $this->data['allTeams4'] = $this->table->generate();
            $this->table->clear();

            $teams = $this->leagues->getByDivision('NFC North');
            if ($_SESSION['league_OrderBy'] == 'name') {
                $name = "active";
                usort($teams, "cmpName");
            } else if ($_SESSION['league_OrderBy'] == 'city') {
                $city = "active";
                usort($teams, "cmpCity");
            } else if ($_SESSION['league_OrderBy'] == 'standings') {
                $standings = "active";
                // usort($players, "cmpPosition");
            }
            $this->table->set_heading("<h4>NFC North</h4><br>Team Name", "<br>City", "<br>Team Logo");
            foreach ($teams as $team) {
                $temp_filename = $team['filename'];
                $team['filename'] = $img_tagOpen . $img_path . $temp_filename . $img_tagClose;
                $this->table->add_row($team['name'], $team['city'], $team['filename']);
            }
            $this->data['allTeams5'] = $this->table->generate();

            $this->table->clear();

            $teams = $this->leagues->getByDivision('NFC South');
            if ($_SESSION['league_OrderBy'] == 'name') {
                $name = "active";
                usort($teams, "cmpName");
            } else if ($_SESSION['league_OrderBy'] == 'city') {
                $city = "active";
                usort($teams, "cmpCity");
            } else if ($_SESSION['league_OrderBy'] == 'standings') {
                $standings = "active";
                // usort($players, "cmpPosition");
            }
            $this->table->set_heading("<h4>NFC South</h4><br>Team Name", "<br>City", "<br>Team Logo");
            foreach ($teams as $team) {
                $temp_filename = $team['filename'];
                $team['filename'] = $img_tagOpen . $img_path . $temp_filename . $img_tagClose;
                $this->table->add_row($team['name'], $team['city'], $team['filename']);
            }

            $this->data['allTeams6'] = $this->table->generate();

            $teams = $this->leagues->getByDivision('NFC East');
            if ($_SESSION['league_OrderBy'] == 'name') {
                $name = "active";
                usort($teams, "cmpName");
            } else if ($_SESSION['league_OrderBy'] == 'city') {
                $city = "active";
                usort($teams, "cmpCity");
            } else if ($_SESSION['league_OrderBy'] == 'standings') {
                $standings = "active";
                // usort($players, "cmpPosition");
            }
            $this->table->set_heading("<h4>NFC East</h4><br>Team Name", "<br>City", "<br>Team Logo");
            foreach ($teams as $team) {
                $temp_filename = $team['filename'];
                $team['filename'] = $img_tagOpen . $img_path . $temp_filename . $img_tagClose;
                $this->table->add_row($team['name'], $team['city'], $team['filename']);
            }

            $this->data['allTeams7'] = $this->table->generate();
            $this->table->clear();

            $teams = $this->leagues->getByDivision('NFC West');
            if ($_SESSION['league_OrderBy'] == 'name') {
                $name = "active";
                usort($teams, "cmpName");
            } else if ($_SESSION['league_OrderBy'] == 'city') {
                $city = "active";
                usort($teams, "cmpCity");
            } else if ($_SESSION['league_OrderBy'] == 'standings') {
                $standings = "active";
                // usort($players, "cmpPosition");
            }
            $this->table->set_heading("<h4>NFC West</h4><br>Team Name", "<br>City", "<br>Team Logo");
            foreach ($teams as $team) {
                $temp_filename = $team['filename'];
                $team['filename'] = $img_tagOpen . $img_path . $temp_filename . $img_tagClose;
                $this->table->add_row($team['name'], $team['city'], $team['filename']);
            }

            $this->data['allTeams8'] = $this->table->generate();





            //array_merge((array) $this->data['allTeams'], (array) $this->table->generate());
            $this->data['pagebody'] = 'league';
            $this->render();
        }
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

    /**
     * toggles from gallery to table
     * @param type $id is either gallery or table
     */
    public function toggle($id) {
        session_start();
        $_SESSION['league_ViewState'] = $id;
        header('Location: /league');
    }

}
