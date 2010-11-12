<?php echo js('fotochest'); ?>
<div class="modal">
    <div class="form" id="deletePhoto">
    <input type="hidden" name="photoID" value="<?php echo $photoID; ?>" id="photoID">
    <p>Are you sure you want to delete this photo?</p>
    <a class="button nextAction deletePhoto"><span>Yes</span></a>
    <a class="button" onClick="jQuery(document).trigger('close.facebox');"><span>No</span></a>

    </div>
</div>
