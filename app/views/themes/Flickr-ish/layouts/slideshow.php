<!DOCTYPE html>
<html>
    <head>
         <?php $this->load->view('common/slideshowRequired'); ?>
        
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
