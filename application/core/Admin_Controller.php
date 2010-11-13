<?php

/**
* FotoChest
*
* FotoChest is a simple photo management web based application.
*
* @package		FotoChest
* @version		1.5
* @author		Derek Stegelman <fotochest.com|stegelman.com>
* @license		Apache License v2.0
* @copyright		2010 FotoChest
*/

// ----------------------------------------------------------------

/**
* Admin Controller
*
* @package		FotoChest
* @category		Controllers
* @author		Derek Stegelman
*/


class Admin_Controller extends MY_Controller {

    public function  __construct() {
        parent::__construct();
        if(isLoggedIn() == TRUE){
            $this->load->model('Photo_mdl');
            $this->load->model('Album_mdl');

        } else {
            redirect('users/login');
        }
    }
}
?>
