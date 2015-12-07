<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * The main cotroller 
 */
class Welcome extends Application {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     * 	- or -
     * 		http://example.com/index.php/welcome/index
     * 	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */
    public function index() {
        $this->load->model('History', 'history'); //load
        $this->load->model('Leagues', 'league'); //load
        $this->history->db->select('home, away');
        $checkThisOut = $this->history->all();
        //Make sure we pull if there is no data in history
        if (empty($checkThisOut)) {
            var_dump($checkThisOut);
            $this->updater();
        }

        $this->load->helper('form');
        $options = array(
            'BUF' => 'Buffalo Bills',
            'MIA' => 'Miami Dolphins',
            'NE' => 'New England Patriots',
            'NYJ' => 'New York Jets',
        );
        $options = $this->leagues->all();
        $teams = array();
        $codes = array();
        foreach ($options as $team) {
            if ($team->name != 'Tennessee Titans' && $team->code != 'TEN') {
                $teams = array_merge($teams, (array) $team->name);
                $codes = array_merge($codes, (array) $team->code);
            }
        }
        $finalOptions = array_combine($codes, $teams);
        $this->data['dropdown'] = form_dropdown('teams', $finalOptions, '', 'id="selectForm" class="form-control"');
        $this->data['pagebody'] = 'welcome';
        $this->render();
    }

    public function doAjaxCheck($opponent) {
        $this->load->model('History', 'history');
        $superAvg = 0.7 * $this->history->average('TEN') + 0.2 * $this->history->last5Average() + 0.1 * $this->history->againstAverage($opponent);
        echo $superAvg;
    }

    public function updater() {
        $this->load->model('History', 'history');//load
        $this->history->update_DB();
        header('Location: /');
    }
}
