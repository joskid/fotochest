<div class="photoContainer">
<?php
 $queryCount2 = $photoData->num_rows();
       $count = 0;
       if($queryCount2 == 0){ ?><h2>You have no photos yet, would you like to <a href="<?php echo base_url(); ?>admin/dashboard">add an album or some photos?</a></h2>
        <?php }
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
               <a href="<?php echo base_url(); ?>photos/view/<?php echo $row->albumName; ?>/<?php echo $row->photoID; ?>"><img src="<?php echo base_url(); ?>img_stor/albums/<?php echo $row->albumName; ?>/thumbs/<?php echo $row->photoFileName; ?>" class="thumb" title="<?php echo $row->photoTitle; ?>" alt="<?php echo $row->photoTitle; ?>"></a>
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