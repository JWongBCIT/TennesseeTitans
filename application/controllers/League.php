<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of About
 *
 * @author spero
 */
class League extends Application {
    //put your code here
    
    public function index()
	{
                $teams = $this->leagues->all();
		$this->data['pagebody'] = 'league'; 
                $this->render();
	}
}
