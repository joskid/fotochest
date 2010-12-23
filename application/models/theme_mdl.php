<?php

/**
* FotoChest
*
* FotoChest is a simple photo management web based application.
*
* @package		FotoChest
* @version		1.6
* @author		Derek Stegelman <fotochest.com|stegelman.com>
* @license		Apache License v2.0
* @copyright		2010 FotoChest
*/

// ----------------------------------------------------------------

/**
* Theme Model
*
* @package		FotoChest
* @category		Models
* @author		Derek Stegelman
*/

class Theme_mdl extends CoreModel {

    public function __construct()
    {
        parent::__construct();
        $this->_table = $this->config->item('themeTable');
    }
            
}
?>
