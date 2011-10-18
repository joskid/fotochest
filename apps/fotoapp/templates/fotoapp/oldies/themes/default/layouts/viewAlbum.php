<?php $this->load->view('themes/' . getTheme() . '/common/header'); ?>
<body>
    <div id="wrapper">
                    <?php if (isLoggedIn() == FALSE) {

                 echo anchor('admin/dashboard', 'Sign In', array('class'=>'signin'));

             } else  {
                 echo anchor('admin/dashboard', 'Administration', array('class'=>'signin'));
             }
?>
        <div class="topNav">
            <ul>

            </ul>
        </div>

        <div class="nav">
            <a href="<?php echo base_url(); ?>albums/view/<?php echo $albumName; ?>"><?php echo getAlbumThumb($albumID); ?><h1><?php echo $albumFriendlyName; ?></h1></a>
            <ol>
                <li><?php echo anchor('photos', 'Home'); ?></li>
                <li><?php echo anchor('albums', 'Albums'); ?></li>
                <?php
                    if(getSetting('enableSlideshow') == 'TRUE'){
                        ?>
                        <li><?php
                echo anchor('photos/slideshow/' . $albumName, 'View Slideshow');
                ?>
                </li>
                        <?php
                    }
                    ?>
                
                    <?php
                    if(isLoggedIn() == 'TRUE'){
                        ?>
                        <li>
                            <?php echo anchor('users/logout', 'Logout'); ?>
                        </li>
                        <?php
                    }
                    ?>
               
                

            </ol>


        </div>


       <div class="photoContainer">

       <?
       $count = 0;
       foreach($photoData->result() as $row){
           $count = $count + 1;
           if($count == 1){
               ?>
           <div class="photo left clear">

               <?php


           } else
           {
              if($count == 3){
                  $count = 0;
              }
               ?>

               <div class="photo left">
                   <?php
           }
           ?>

               <h2><?php echo $row->photoTitle; ?></h2>
               <a href="<?php echo base_url(); ?>photos/view/<?php echo $albumName; ?>/<?php echo $row->photoID; ?>"><img src="<?php echo base_url(); ?>img_stor/albums/<?php echo $albumName; ?>/thumbs/<?php echo $row->photoFileName; ?>" class="thumb"></a>
           </div>
<?php
       }
       ?>

               <div class="clear"></div>
           </div>
           <p class="pagination clear">
               <?php

              echo $pages;
               ?>
           </p>
    </div>
</body>
</html>
