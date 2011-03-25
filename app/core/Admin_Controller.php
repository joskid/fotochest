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
* Admin Controller Parent Class
*
* @package		FotoChest
* @category		Core Controllers
* @author		Derek Stegelman
*/


class Admin_Controller extends CoreController {

    public function  __construct() {
        parent::__construct();
        if(isLoggedIn() == TRUE){
            
            $this->template->set_template('admin');
        } else {
            redirect('login');
        }
    }
}
?>
