<?php

/**
* FotoChest
*
* FotoChest is a simple photo management web based application.
*
* @package		FotoChest
* @version		1.0
* @author		Derek Stegelman <fotochest.com|stegelman.com>
* @license		Apache License v2.0
* @copyright		2010 FotoChest
*/

// ----------------------------------------------------------------

/**
* Album Library
*
* @package		FotoChest
* @category		Libraries
* @author		Derek Stegelman
*/

/*
* FotoChest - a web based photo album
* Copyright (C) 2009-2010 Derek Stegelman http://stegelman.com
* @package FotoCore
* @subpackage PhotoMgmt
* @author Derek Stegelman
*
* Modified on Oct 26 2010
*
*
*/

class Theme_lib {

    private $ci;

    public function  __construct()
    {
        $this->ci =& get_instance();
        
    }
    

    public function getThemes()
    {

        // Load Theme Model
        $this->ci->load->model('theme_mdl');

        // Get Data
        $themes = $this->ci->theme_mdl->read();

        return $themes;

    }
}
?>
