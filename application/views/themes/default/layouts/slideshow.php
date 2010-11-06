<!DOCTYPE html>
<html>
    <head>
        <link href='http://fonts.googleapis.com/css?family=Josefin+Sans+Std+Light' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/javascript/slideshow/css/jd.gallery.css" type="text/css" media="screen" charset="utf-8" />
        <?php echo link_tag('assets/css/slideshow.css'); ?>
        <script src="<?php echo base_url(); ?>assets/javascript/slideshow/scripts/mootools-1.2.1-core-yc.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/javascript/slideshow/scripts/mootools-1.2-more.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/javascript/slideshow/scripts/jd.gallery.js" type="text/javascript"></script>
        
        <title><?php echo $title; ?></title>
        
    </head>
    <body>
        <script type="text/javascript">
                function startGallery() {
                        var myGallery = new gallery($('myGallery'), {
                                timed: true,
            showInfopane: false,
            textShowCarousel: 'Navigation'
                        });
                }
                window.addEvent('domready',startGallery);
        </script>
       <div id="myGallery">
        <?php foreach($photoInfo->result() as $row){ ?>
        <div class="imageElement">
            <h3><?php echo getPhotoTitle($row->photoID); ?></h3>
            <p>Item 1 Description</p>
            <a href="#" title="open image" class="open"></a>
            <img src="<?php echo base_url(); ?>img_stor/albums/<?php echo $albumName; ?>/thumbs/<?php echo $row->photoFileName; ?>" class="full" />
            <img src="<?php echo base_url(); ?>img_stor/albums/<?php echo $albumName; ?>/thumbs/<?php echo $row->photoFileName; ?>" class="thumbnail" />
        </div>
        <?php } ?>
       </div>   
    </body>
</html>
