
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
               <a href="<?php echo base_url(); ?>photo/<?php echo $albumName; ?>/<?php echo $row->id; ?>"><img src="<?php echo base_url(); ?>img_stor/albums/<?php echo $albumName; ?>/thumbs/<?php echo $row->photoFileName; ?>" class="thumb"></a>
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

