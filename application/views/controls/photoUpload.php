<div class="photoUploadControl">
  <div class="form">
  

<?php echo form_open_multipart('photos/singleUpload');?>
<div class="formItem">
<?php echo form_upload('photo'); ?>
</div>
<div class="formItem">
<label for="albumID">Album</label>
<?php echo $albumDropDown; ?>

</div>

<input type="submit" value="Upload" />
  </div>
</div>