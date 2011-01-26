<!DOCTYPE html>
<html>
	<head>
		
                <?php echo theme_css('styles'); ?>
                <?php echo getJquery(); ?>
                <?php echo js("lightbox/js/jquery.lightbox-0.5"); ?>
                <?php echo js("facebox/facebox"); ?>
		<link href='http://fonts.googleapis.com/css?family=Cuprum&subset=latin' rel='stylesheet' type='text/css'>
		<title><?php echo $title; ?></title>
	</head>
        <?php echo js('fotochest'); ?>
	<body>
		<div id="wrapper">
		<a class="logo" href="<?php echo site_url(); ?>">
		foto<span>chest</span>
		</a>
                    <a class="button" href="<?php echo site_url('albums'); ?>"><span>Albums</span></a>

                <?php echo $content; ?>

                </div>
        </body>
</html>

