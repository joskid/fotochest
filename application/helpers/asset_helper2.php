<?php

/**
 *
 * @name Asset Helper - Loads css, javascript, and common markup controls to a page with ease.
 *
 * @author Derek Stegelman
 * @package CI Defect Tracker
 * @subpackage Global Helpers
 *
 *
 * Last Modified Oct 8 2010
 *
 *
 *
 *
 */


function getJquery(){
    $jquery = "<script type='text/javascript' src='http://code.jquery.com/jquery-1.4.2.min.js'></script>";
    return $jquery;
}

function getJqueryUI(){
    $jqueryUI = "<script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.5/jquery-ui.min.js'></script>";
    return $jqueryUI;
}

function js($url){
    $CI =& get_instance();
    $CI->load->config('assets');
    $builtURL = base_url() . "/" . $CI->config->item('asset_dir') . "/" . $CI->config->item('javascript_dir') . "/" . $url . ".js";
    $javascript = "<script type='text/javascript' src='$builtURL'></script>";
    return $javascript;
}

function css($fileName){
    $builtURL = base_url() . "/" . $CI->config->item('asset_dir') . "/" . $CI->config->item('css_dir') . "/"  . $fileName . ".css";
    $outputCSS = "<link href='$builtURL' type='text/css' rel='stylesheet'>";
    return $outputCSS;
}


/* End of Asset_helper.php */

?>
