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
* Asset Helper
*
* @package		FotoChest
* @category		Helpers
* @author		Derek Stegelman
*/


function getJquery(){
    $CI =& get_instance();
    if ($CI->config->item('debugMode') == TRUE)
    {
        $builtURL = base_url() . "assets/javascript/jquery/jquery-1.4.2.js";
        $jquery = "<script type='text/javascript' src='$builtURL'></script>";
    }
    else
    {
        $jquery = "<script type='text/javascript' src='http://code.jquery.com/jquery-1.4.2.min.js'></script>";
    }
    return $jquery;
}

function js($url){
    $builtURL = base_url() . "/" . $CI->config->item('asset_dir') . "/" . $CI->config->item('javascript_dir') . "/" . $url . ".js";
    $javascript = "<script type='text/javascript' src='$builtURL'></script>";
    return $javascript;
}

function css($fileName){
    $builtURL = base_url() . "/" . $CI->config->item('asset_dir') . "/" . $CI->config->item('css_dir') . "/"  . $fileName . ".css";
    $outputCSS = "<link href='$builtURL' type='text/css' rel='stylesheet'>";
    return $outputCSS;
}

/**** New asset helper with variable configs ****/

//function getJquery(){
//    $jquery = "<script type='text/javascript' src='http://code.jquery.com/jquery-1.4.2.min.js'></script>";
//    return $jquery;
//}
//
//function getJqueryUI(){
//    $jqueryUI = "<script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.5/jquery-ui.min.js'></script>";
//    return $jqueryUI;
//}
//
//function js($url){
//    $CI =& get_instance();
//    $CI->load->config('assets');
//    $builtURL = base_url() . "/" . $CI->config->item('asset_dir') . "/" . $CI->config->item('javascript_dir') . "/" . $url . ".js";
//    $javascript = "<script type='text/javascript' src='$builtURL'></script>";
//    return $javascript;
//}
//
//function css($fileName){
//    $builtURL = base_url() . "/" . $CI->config->item('asset_dir') . "/" . $CI->config->item('css_dir') . "/"  . $fileName . ".css";
//    $outputCSS = "<link href='$builtURL' type='text/css' rel='stylesheet'>";
//    return $outputCSS;
//}





/** Theme Specific Loaders **/

function theme_css($fileName)
{
    $builtURL = base_url() . "assets/themes/" . getTheme() . "/css/" . $fileName . ".css";
    $outputCSS = "<link href='$builtURL' type='text/css' rel='stylesheet'>";
    return $outputCSS;
}

function theme_js($fileName)
{
    $builtJS = base_url() . "assets/themes/" . getTheme() . "/js/" . $fileName . ".js";
    $outputJS = "<script type='text/css' src='$builtJS'></script>";
    return $outputJS;
}

function theme_img($fileName)
{
    
}

?>
