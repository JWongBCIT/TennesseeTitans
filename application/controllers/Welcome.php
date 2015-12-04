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
        $this->data['dropdown'] = form_dropdown('teams', $finalOptions, '', 'class="form-control"');
        $this->data['pagebody'] = 'welcome';
        $this->render();
    }

}
