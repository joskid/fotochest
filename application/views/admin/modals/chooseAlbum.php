<div class="modal">
    <h1>Choose an Album to upload to</h1>
    <?php foreach($albums->result() as $row){ ?>
     <div class="album">
       <?php echo getAlbumThumbs($row->albumID, 1, TRUE); ?>
        <h3><?php echo $row->albumFriendlyName; ?></h3>
        <p>
            <?php echo $row->albumDesc; ?>
        </p>

        <ul class="actions">
            <li><a href="<?php echo site_url(); ?>admin/upload/<?php echo $row->albumID; ?>/<?php echo $photoID; ?>" class="button"><span>Choose</span></a></li>

        </ul>

    </div>
    <?php } ?>


</div>
