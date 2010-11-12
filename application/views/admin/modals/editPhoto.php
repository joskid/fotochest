<?php echo js('fotochest'); ?>
<div class="modal">

    <img src="<?php echo base_url(); ?>img_stor/albums/<?php echo $albumName; ?>/thumbs/<?php echo $photoFileName; ?>" width="370">

    <div class="form" id="editPhoto">
        <a class="button nextAction rotateCounter" style="display:none;"><span>Rotate Counter-Clockwise</span></a>
        <a class="button nextAction rotateClock" style="display:none;"><span>Rotate Clockwise</span></a>
        <div class="formItem">
            <label for="photoTitle">Photo Title:</label>
            <input type="text" name="photoTitle" id="photoTitle" value="<?php echo $photoTitle; ?>">
        </div>
        <div class="formItem">
            <label for="makeProfile">Set as profile picture?</label>
            <input type="checkbox" name="makeProfile" id="makeProfile" <?php 
            if ($isProfilePic == 1)
            {
                $checked = 'TRUE';
            }
            else
            {
                $checked = 'FALSE';
            }
            echo isChecked($checked); ?>>
        </div>

    <div class="formItem">
        <label for="photoDescription">Description:</label>
        <textarea cols="45" rows="10" id="photoDescription" name="photoDescription"><?php echo $photoDesc; ?></textarea>
    </div>
    <input type="hidden" name="albumID" id="albumID" value="<?php echo $albumID; ?>">
    <input type="hidden" name="photoID" id="photoID" value="<?php echo $photoID; ?>">
    <input type="hidden" name="isFront" id="isFront" value="<?php echo $isFront; ?>">
    <input type="hidden" name="albumName" id="albumName" value="<?php echo $albumName; ?>">
    <a class="button nextAction savePhotoBtn"><span>Save</span></a>
    </div>
				
</div>