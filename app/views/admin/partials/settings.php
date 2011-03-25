
<div class="content right" id ="settings">
    <h2>Settings</h2>
    <div class="form">
        <?php echo form_open('admin/settings', array('id'=>'settingsForm')); ?>
        <?php echo validation_errors(); ?>
        <div class="formItem">
            <label for="siteName">Site Name:</label>
            <div>
                <input type="text" id="siteName" name="siteName" value="<?php echo getSetting('siteName'); ?>">
            </div>
        </div>
        <div class="formItem">
            <label for="showPhotoTitle">Show Photo Title</label>
            <div>
                <input type="checkbox" name="showPhotoTitle" id="showPhotoTitle" <?php echo isChecked(getSetting('showPhotoTitle')); ?>>
            </div>
        </div>
        <div class="formItem">
            <label for="enableSlideshow">Enable Slideshow:</label>
            <div>
                <input type="checkbox" name="enableSlideshow" id="enableSlideshow" <?php echo isChecked(getSetting('enableSlideshow')); ?>>
            </div>
        </div>
        <div class="formItem">
            <label for="displayEXIF">Display EXIF Data</label>
            <div>
                <input type="checkbox" name="enablePhotoInfo" id="enablePhotoInfo" <?php echo isChecked(getSetting('enablePhotoInfo')); ?>>
            </div>
        </div>
        <div class="formItem">
            <label for="fileDownloads">Allow File Downloads</label>
            <div>
                <input type="checkbox" name="enableOriginalDownload" id="enableOriginalDownload" <?php echo isChecked(getSetting('enableOriginalDownload')); ?>>
            </div>
        </div>

        <div class="formItem">
            <label for="enableComments">Enable Comments</label>
            <div>
                <input type="checkbox" name="enableComments" id="enableComments" <?php echo isChecked(getSetting('enableComments')); ?>>
            </div>
        </div>
        <div class="formItem">
            <div>
                <a class="button saveSettings">
                    <span>Save Settings</span>
                </a>
            </div>
        </div>

    </div>

</div>
