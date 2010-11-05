<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <?php echo theme_css('styles'); ?>
        <?php echo link_tag('assets/css/styles.css'); ?>
        <?php if (getSetting('siteTheme') == 0){
            echo link_tag('assets/css/blackTheme.css');
        }
        
        ?>
        <?php echo link_tag("assets/css/admin/modal.css"); ?>
        <?php echo link_tag('assets/javascript/facebox/facebox.css'); ?>
        <?php echo link_tag("assets/javascript/uploadify/uploadify.css"); ?>
        <!--[if IE]>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/ie.css">
        <![endif]-->
        <link href='http://fonts.googleapis.com/css?family=Josefin+Sans+Std+Light' rel='stylesheet' type='text/css'>
        <link rel="shortcut icon" href="<?php echo base_url(); ?>favicon.ico" />
       <script type="text/javascript" src="<?php echo base_url(); ?>assets/javascript/jquery/jquery-1.4.2.js"></script>
       <script type="text/javascript" src="<?php echo base_url(); ?>assets/javascript/uploadify/swfobject.js"></script>
       <script type="text/javascript" src="<?php echo base_url(); ?>assets/javascript/lightbox/js/jquery.lightbox-0.5.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/javascript/uploadify/jquery.uploadify.v2.1.0.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/javascript/uploadify/swfobject.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/gallery/galleria.js"></script>
        <script src="<?php echo base_url(); ?>assets/gallery/themes/classic/galleria.classic.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/javascript/facebox/facebox.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/javascript/snapit.js"></script>
        <title><?php echo $title; ?></title>
       
    </head>

