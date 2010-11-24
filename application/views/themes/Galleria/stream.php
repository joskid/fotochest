<?php $count = 0; ?>
<?php foreach($photoData->result() as $row) { ?>
<?php $count = $count + 1; ?>
<?php if($count == 3) { $count = 0; } ?>

<div class="photo <?php if($count == 1) { ?> clear <? } ?>">
    <a href="<?php echo base_url(); ?>photo/<?php echo $row->albumName; ?>/<?php echo $row->photoID; ?>">
        <img src="<?php echo base_url(); ?>img_stor/albums/<?php echo $row->albumName; ?>/thumbs/<?php echo $row->photoFileName; ?>" title="<?php echo $row->photoTitle; ?>" alt="<?php echo $row->photoTitle; ?>">
    </a>
    <p><?php echo $row->photoTitle; ?></p>
</div>
<?php } ?>

<div class="pagination">
    <?php echo $pages; ?>
</div>
