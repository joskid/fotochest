<?php
$this->load->view('admin/header');
$this->data['pageNum'] = 2;
$this->load->view('admin/navigation', $this->data);
?>

<div class="content right" id ="fullEdit">
    <h2>Edit Your Foto!</h2>
    <div class="form">
        <?php echo form_open('admin/photos/fullEdit'); ?>
        <?php //echo validation_errors(); ?>
        <?php foreach($photoData->result() as $row) { ?>
        <div class="formItem">
            <img src="<?php echo base_url(); ?>img_stor/albums/<?php echo $row->albumName; ?>/thumbs/<?php echo $row->photoFileName; ?>" width="370" alt="<?php echo $row->photoFileName; ?>" class="photo">
        </div>
        <div class="editControls">
            <h3>Edit This Photo</h3>
            <a class="button rotateCounter" href="<?php echo site_url(); ?>admin/photos/rotate/counter/<?php echo $row->photoID; ?>"><span>Rotate Counter Clockwise</span></a>
            <a class="button rotateClock"><span>Rotate Clockwise</span></a>
            <a class="button auto"><span>Crop Mode</span></a>
            <a class="button auto"><span>Delete Photo</span></a>
            <h3>Photo Info</h3>
            <dl>
                <dt>Date Uploaded:</dt>
                <dd><?php echo $row->photoCreatedDate; ?></dd>
                <dt>Album:</dt>
                <dd><?php echo $row->albumName; ?></dd>
            </dl>
        </div>
        <div class="formItem">
            <label for="photoTitle">Photo Title:</label>
            <input type="text" id="siteName" name="siteName" value="<?php echo $row->photoTitle; ?>">
        </div>
        <div class="formItem">
            <label for="photoDescription">Photo Description:</label>
            <textarea rows="8" cols="51"></textarea>
        </div>
        <div class="formItem check">
            <label for="showPhotoTitle">Make this Photo Your Profile Picture</label>
            <input type="checkbox" name="showPhotoTitle" id="showPhotoTitle" <?php
            if ($row->isProfilePic == 1)
            {
                $checked = 'TRUE';
            }
            else
            {
                $checked = 'FALSE';
            }
            echo isChecked($checked); ?>>
        </div>
        
        <?php } ?>
        <input type="submit" value="Save Changes" class="button nextAction">
        <?php echo form_close(); ?>
    </div>

</div>

<?php $this->data['showAlbum'] = FALSE; ?>
<?php $this->data['showUserButton'] = FALSE; ?>
<?php $this->load->view('admin/sidebar', $this->data); ?>
<?php $this->load->view('admin/footer'); ?>
