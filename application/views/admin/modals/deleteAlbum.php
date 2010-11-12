<?php echo js('fotochest'); ?>
<div class="modal" id="deleteAlbum">
    <div class="form">
        <input type="hidden" name="albumID" value="<?php echo $albumID; ?>" id="albumID">
        <p>Are you sure you want to delete this album?  All photos in this album will be deleted as well.</p>
        <a class="button nextAction deleteAlbum"><span>Yes</span></a>
        <a class="button noDelete" onClick="jQuery(document).trigger('close.facebox');"><span>No</span></a>

    </div>
</div>