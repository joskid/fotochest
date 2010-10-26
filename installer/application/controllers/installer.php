<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of installer
 *
 * @author derek
 */
class Installer extends Controller {

    public function index(){


        $this->load->view('install');
    }

    public function do_install(){

        $this->load->library('install');
        if($this->install->runInstall() == TRUE)
        {
            $this->load->view('installSuccess');
        }
    }

}
?>
