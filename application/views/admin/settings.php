<?php
$this->load->view('admin/header');
$data['pageNum'] = 3;
$this->load->view('admin/navigation', $data);
?>

<div class="content right" id ="settings">
    <h2>Settings</h2>
    <div class="form">
        <?php echo form_open('admin/settings'); ?>
        <?php echo validation_errors(); ?>
        <div class="formItem">
            <label for="siteName">Site Name:</label>
            <input type="text" id="siteName" name="siteName" value="<?php echo getSetting('siteName'); ?>">
        </div>
        <div class="formItem">
            <label for="showPhotoTitle">Show Photo Title</label>
            <input type="checkbox" name="showPhotoTitle" id="showPhotoTitle" <?php echo isChecked(getSetting('showPhotoTitle')); ?>>
        </div>
        <div class="formItem">
            <label for="enableSlidedhow">Enable Slideshow:</label>
            <input type="checkbox" name="enableSlideshow" id="enableSlideshow" <?php echo isChecked(getSetting('enableSlideshow')); ?>>
        </div>
        <div class="formItem">
            <label for="enableComments">Enable Comments</label>
            <input type="checkbox" name="enableComments" id="enableComments" <?php echo isChecked(getSetting('enableComments')); ?>>
        </div>
        <input type="submit" value="Save Changes" class="button">
       
    </div>
    
</div>
<?php $data['showAlbum'] = FALSE; ?>
<?php $data['showUserButton'] = TRUE; ?>
<?php $this->load->view('admin/sidebar', $data); ?>
<?php $this->load->view('admin/footer'); ?>