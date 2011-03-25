<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Core_Library
 *
 * @author Derek
 */
class Core_Library {
    //put your code here
    
    public $ci;

    public function __construct()
    {
        $this->ci =& get_instance();
        log_message('info', 'TRYING TO LOAD ' . get_class($this)."_mdl");
        $this->ci->load->model(get_class($this)."_mdl");
        log_message('info', get_class($this)."_mdl"." has been loaded");
    }
}

?>
