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
* Theme Helper
*
* @package		FotoChest
* @category		Helpers
* @author		Derek Stegelman
*/

function getTheme()
{
    $CI =& get_instance();
    // Load the library
    $CI->load->library('theme_lib');

    // get theme
    $themeName = $CI->theme_lib->getCurrentTheme();
    return $themeName;
}

function getFullThemePath()
{
    $CI =& get_instance();
    // Load the library
    $CI->load->library('theme_lib');

    // get theme
    $themeName = $CI->theme_lib->getCurrentTheme();
    $themePath = "themes/" . $themeName . "/layouts/";
    return $themePath;
}
?>
