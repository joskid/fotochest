<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Setting_mdl
 *
 * @author Derek
 */
class Setting_mdl extends Core_Model {

    public function  __construct() {
        parent::__construct();
        $this->load->config('settings');
        $this->_table = $this->config->item('settings_table');
    }


}

?>
