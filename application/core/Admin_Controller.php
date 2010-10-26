<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Admin_Controller
 *
 * @author derek
 */
class Admin_Controller extends MY_Controller {

    function Admin_Controller(){
        parent::MY_Controller();
        if($this->User_mdl->isLoggedIn() == TRUE){

        } else {
            redirect('users/login');
        }
    }

}
?>
