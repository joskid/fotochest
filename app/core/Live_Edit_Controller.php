<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Live_Edit
 *
 * @author Derek
 */
class Live_Edit_Controller extends Core_Controller {
    //put your code here

    public function __construct()
    {
        parent::__construct();
        if (is_logged_in() === FALSE)
        {
            redirect('login');
        }
    }
}
?>
