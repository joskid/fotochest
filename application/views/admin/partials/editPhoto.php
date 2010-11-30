
<script language="Javascript">

			// Remember to invoke within jQuery(window).load(...)
			// If you don't, Jcrop may not initialize properly
			jQuery(window).load(function(){

				jQuery('#cropbox').Jcrop({
					onChange: showPreview,
					onSelect: showPreview,
					aspectRatio: 1
				});

			});

			// Our simple event handler, called from onChange and onSelect
			// event handlers, as per the Jcrop invocation above
			function showPreview(coords)
			{
				if (parseInt(coords.w) > 0)
				{
					var rx = 100 / coords.w;
					var ry = 100 / coords.h;

					jQuery('#preview').css({
						width: Math.round(rx * 500) + 'px',
						height: Math.round(ry * 370) + 'px',
						marginLeft: '-' + Math.round(rx * coords.x) + 'px',
						marginTop: '-' + Math.round(ry * coords.y) + 'px'
					});
				}
			}

		</script>

<div class="content right" id ="fullEdit">
    <h2>Edit Your Foto!</h2>
    <div class="form onTop">
        <?php echo form_open('admin/photos/fullEdit'); ?>
        <?php //echo validation_errors(); ?>
        <?php foreach($photoData->result() as $row) { ?>
        <div class="formItem fullEditPhoto">
            <img id="cropbox" src="<?php echo base_url(); ?>img_stor/albums/<?php echo $row->albumName; ?>/thumbs/<?php echo $row->photoFileName; ?>" alt="<?php echo $row->photoFileName; ?>" class="photo">
            <br/>
            <div style="width: 100px; height: 100px; display:none; overflow: hidden; position: absolute; right: 100px;">
                <img id="preview" src="<?php echo base_url(); ?>img_stor/albums/<?php echo $row->albumName; ?>/thumbs/<?php echo $row->photoFileName; ?>" width="100" alt="<?php echo $row->photoFileName; ?>">
            </div>

            <div class="editControls">
                <h3>Edit This Photo</h3>
                <a class="button" href="<?php echo site_url('admin/photos/rotate/counter/' . $row->photoID); ?>"><span>Rotate Counter Clockwise</span></a>
                <a class="button" href="<?php echo site_url('admin/photos/rotate/clock/' . $row->photoID); ?>"><span>Rotate Clockwise</span></a>
                <a class="button" style="display: none;"><span>Crop Mode</span></a>
                <a href="<?php echo site_url('admin/photos/deletePhoto/' . $row->photoID); ?>" class="button" rel="facebox"><span>Delete</span></a>
                <h3>Photo Info</h3>
                <dl>
                    <dt>Date Uploaded:</dt>
                    <dd><?php echo $row->photoCreatedDate; ?></dd>
                    <dt>Album:</dt>
                    <dd><?php echo $row->albumName; ?></dd>
                </dl>
            </div>
        </div>
        <div class="formItem">
            <label for="photoTitle">Photo Title:</label>

            <div>
                <input type="text" id="photoTitle" name="photoTitle" value="<?php echo $row->photoTitle; ?>">
            </div>
        </div>
        <div class="formItem">
            <label for="photoDescription">Photo Description:</label>

            <div>
                <textarea rows="8" cols="51" name="photoDesc" id="photoDesc"></textarea>
            </div>

        </div>
        <div class="formItem check">
            <label for="showPhotoTitle"></label>
            <input type="checkbox" name="isProfile" id="isProfile" <?php
            if ($row->isProfilePic == 1)
            {
                $checked = 'TRUE';
            }
            else
            {
                $checked = 'FALSE';
            }
            echo isChecked($checked); ?>><span>Make this Photo Your Profile Picture</span>
        </div>
        <input type="hidden" value="<?php echo $row->photoID; ?>" name="photoID" id="photoID">
        <?php } ?>
        <input type="submit" value="Save Changes" class="button">

        <?php echo form_close(); ?>
    </div>

</div>

