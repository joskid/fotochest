<?php $count = 0; ?>
<?php foreach($albumInfo->result() as $row) { ?>
<?php $count = $count + 1; ?>
<?php if ($count == 3) { $count = 0; } ?>

<div class="photo <?php if($count == 1) { ?> clear <?php } ?>">
     <a href="<?php echo site_url(); ?>album/<?php echo $row->albumName; ?>">
        <?php echo getAlbumThumbs($row->albumID, 1); ?>
    </a>
    <p><?php echo $row->albumFriendlyName; ?></p>
</div>
<?php } ?>

<div class="pagination">
    <?php echo $pages; ?>
</div>