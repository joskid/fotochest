
<div class="modal viewPhoto" id="viewPhoto">
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/javascript/snapit.js"></script>
    <?php foreach($photoData->result() as $row) { ?>
    <input type="hidden" id="photoID" name="photoID" value="<?php echo $row->photoID; ?>">
    <img src="<?php echo base_url(); ?>img_stor/albums/<?php echo $row->albumName; ?>/thumbs/<?php echo $row->photoFileName; ?>" id="photo">
    <a class="arrowRight">
        <img src="<?php echo base_url(); ?>assets/images/rightArrow.png">
    </a>
    <a class="arrowLeft">
        <img src="<?php echo base_url(); ?>assets/images/leftArrow.png">
    </a>
    <?php } ?>
</div>
