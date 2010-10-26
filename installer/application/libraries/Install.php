<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Install
 *
 * @author derek
 */
class Install {

    public function runInstall(){
        // Retrieve the database server, username and password from the session
		$server 	= $this->ci->session->userdata('hostname') . ':' . $this->ci->session->userdata('port');
		$username 	= $this->ci->session->userdata('username');
		$password 	= $this->ci->session->userdata('password');
    }

    
}
?>
