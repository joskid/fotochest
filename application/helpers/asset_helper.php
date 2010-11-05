<?php


function commonButton($controller, $text){

    $url = base_url() . $controller;
    $buttonMarkup = "<a href='$controller' class='button'><span>$text</span></a>";
    return $buttonMarkup;
}

function getJquery(){
    $jquery = "<script type='text/javascript' src='http://code.jquery.com/jquery-1.4.2.min.js'></script>";
    return $jquery;
}

function js($url){
    $builtURL = base_url() . "assets/javascript/" . $url . ".js";
    $javascript = "<script type='text/javascript' src='$builtURL'></script>";
    return $javascript;
}

function css($fileName){
    $builtURL = base_url() . "assets/css/" . $fileName . ".css";
    $outputCSS = "<link href='$builtURL' type='text/css' rel='stylesheet'>";
    return $outputCSS;
}

/** Theme Specific Loaders **/

function theme_css($filename)
{
    $builtURL = base_url() . "application/views/themes/" . getSetting('themeName') . "/assets/" . $fileName . ".css";
    $outputCSS = "<link href='$builtURL' type='text/css' rel='stylesheet'>";
    return $outputCSS;
}

function loadRequriedAssets()
{
    // Fix this
//    <?php echo link_tag("assets/css/admin/modal.css"); ?>
        //<?php echo link_tag('assets/javascript/facebox/facebox.css'); ?>
        //<?php echo link_tag("assets/javascript/uploadify/uploadify.css"); ?>
<!--        [if IE]>
        <link rel="stylesheet" type="text/css" href="//<?php echo base_url(); ?>assets/css/ie.css">
        <![endif]
        <link href='http://fonts.googleapis.com/css?family=Josefin+Sans+Std+Light' rel='stylesheet' type='text/css'>
        <link rel="shortcut icon" href="//<?php echo base_url(); ?>favicon.ico" />
       <script type="text/javascript" src="//<?php echo base_url(); ?>assets/javascript/jquery/jquery-1.4.2.js"></script>
       <script type="text/javascript" src="//<?php echo base_url(); ?>assets/javascript/uploadify/swfobject.js"></script>
       <script type="text/javascript" src="//<?php echo base_url(); ?>assets/javascript/lightbox/js/jquery.lightbox-0.5.js"></script>
        <script type="text/javascript" src="//<?php echo base_url(); ?>assets/javascript/uploadify/jquery.uploadify.v2.1.0.js"></script>
        <script type="text/javascript" src="//<?php echo base_url(); ?>assets/javascript/uploadify/swfobject.js"></script>
        <script type="text/javascript" src="//<?php echo base_url(); ?>assets/gallery/galleria.js"></script>
        <script src="//<?php echo base_url(); ?>assets/gallery/themes/classic/galleria.classic.js"></script>
        <script type="text/javascript" src="//<?php echo base_url(); ?>assets/javascript/facebox/facebox.js"></script>
        <script type="text/javascript" src="//<?php echo base_url(); ?>assets/javascript/snapit.js"></script>
    -->

}

?>
