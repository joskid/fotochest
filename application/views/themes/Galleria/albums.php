<?php foreach($albumInfo->result() as $row) { ?>

<div class="photo">
     <a href="<?php echo site_url(); ?>album/<?php echo $row->albumName; ?>">
        <?php echo getAlbumThumbs($row->albumID, 1); ?>
    </a>
    <p><?php echo $row->albumFriendlyName; ?></p>
</div>
<?php } ?>

<div class="pagination">
    <?php echo $pages; ?>
</div>