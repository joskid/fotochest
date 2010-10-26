<div class="modal">
    <h1>Move to Album</h1>
    <?php foreach($albums->result() as $row){ ?>
     <div class="album">
       <?php echo getAlbumThumb($row->albumID); ?>
        <h3><?php echo $row->albumFriendlyName; ?></h3>
        <p>
            <?php echo $row->albumDesc; ?>
        </p>
        
        <ul class="actions">
            <li><a href="<?php echo base_url(); ?>admin/movePhotoAction/<?php echo $row->albumID; ?>/<?php echo $photoID; ?>" class="button"><span>Move</span></a></li>
            
        </ul>

    </div>
    <?php } ?>
    

</div>
