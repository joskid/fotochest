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
* MY Controller Controller
*
* @package		FotoChest
* @category		Controllers
* @author		Derek Stegelman
*/


class MY_Controller extends CI_Controller {

    public function  __construct() {
        parent::__construct();

        // Enable profiler in debug mode.
        $this->output->enable_profiler($this->config->item('debugMode'));
        
    }
}
?>
