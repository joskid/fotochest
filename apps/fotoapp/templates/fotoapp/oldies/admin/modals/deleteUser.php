<?php echo js('fotochest'); ?>
<div class="modal" id="deleteUser">
    <div class="form">
        <input type="hidden" name="userID" value="<?php echo $id; ?>" id="userID">
        <p>Are you sure you want to delete this user?</p>
        <a class="newButton nextAction deleteUser"><span>Yes</span></a>
        <a class="newButton noDelete" onClick="jQuery(document).trigger('close.facebox');"><span>No</span></a>

    </div>
</div>
