<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

        <?php echo theme_css('styles'); ?>
        <!--[if IE]>
        <?php echo theme_css('ie'); ?>
        <![endif]-->

        <?php echo css("admin/modal"); ?>
        <?php echo link_tag('assets/javascript/facebox/facebox.css'); ?>
        <link href='http://fonts.googleapis.com/css?family=Josefin+Sans+Std+Light' rel='stylesheet' type='text/css'>
        <link rel="shortcut icon" href="<?php echo base_url(); ?>favicon.ico" />
        <?php echo getJquery(); ?>
        <?php echo js("lightbox/js/jquery.lightbox-0.5"); ?>
        <?php echo js("facebox/facebox"); ?>
        <?php echo js("fotochest"); ?>

        <title><?php echo $title; ?></title>

    </head>
<body>
    <div id="wrapper">
        this is using the template library.
    <?php if (isLoggedIn() == FALSE) {
        echo anchor('admin/dashboard', 'Sign In', array('class'=>'signin'));
    } else {
        echo anchor('admin/dashboard', 'Administration', array('class'=>'signin'));
    } ?>
        
            <?php echo $navigation; ?>

       
       <?php echo $content; ?>
    
</body>
</html>
