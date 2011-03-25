<?php
$this->data['isUpload'] = 1;;
$this->load->view('admin/header', $this->data);
$data['pageNum'] = 1;
$this->load->view('admin/navigation', $data);
?>

<?php echo css('default'); ?>
<div class="content right">
<div id="content" class="upload">
    <h2>Add Photos to <?php echo getAlbumFriendlyName($albumID); ?></h2>

    <?php echo form_open_multipart('/upload/basicUploader'); ?>
    <?php echo form_upload(); ?>
    <?php echo form_submit('submitUpload', 'Upload'); ?>
    <?php echo form_close(); ?>

    <p>Done uploading?  <?php echo anchor('admin/album/' . getAlbumName($albumID), 'Edit or view your pictures now.') ?></p>
</div>
</div>
 <?php $data['showAlbum'] = FALSE; ?>
    <?php $data['showUserButton'] = FALSE; ?>
    <?php $this->load->view('admin/sidebar', $data); ?>
    <?php $this->load->view('admin/footer'); ?>
