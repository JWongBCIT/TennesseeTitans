<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * The about controller controls the /about
 *
 * @author adamh
 */
class About extends Application {

    //index for /about
    public function index() {
        $this->data['pagebody'] = 'about';
        $this->render();
    }

}
