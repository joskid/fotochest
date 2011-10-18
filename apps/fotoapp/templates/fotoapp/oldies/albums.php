
       <div class="photoContainer">
       <?
       $count = 0;
       foreach($albumInfo->result() as $row){
       $count = $count + 1;
        if($count == 1){ ?>
           <div class="photo left clear album">
           <?php } else {
              if($count == 3){
                  $count = 0;
              } ?>
               <div class="photo left album">
               <?php } ?>
               <a href="<?php echo site_url(); ?>album/<?php echo $row->albumName; ?>">
                   <h2><?php echo $row->albumFriendlyName; ?></h2>
                   <?php echo getAlbumThumbs($row->albumID, 3); ?>
               </a>
           </div>
           <?php } ?>
           </div>
           <p class="pagination">

           </p>
    </div>
