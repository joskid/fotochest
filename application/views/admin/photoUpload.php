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
    <h3>Having problems?  Try our <?php echo anchor('upload/basicUploader/' . $albumID, 'basic uploader'); ?></h3>
	<form id="form1" action="/upload/multiUpload" method="post" enctype="multipart/form-data">
           
		

			<div class="fieldset flash" id="fsUploadProgress">
			<span class="legend">Upload Queue</span>
			</div>
		<div id="divStatus">0 Files Uploaded</div>
			<div>
				<span id="spanButtonPlaceHolder"></span>
				<input id="btnCancel" type="button" value="Cancel All Uploads" onclick="swfu.cancelQueue();" disabled="disabled" style="margin-left: 2px; font-size: 8pt; height: 29px;" />
			</div>

	</form>
    <p>Done uploading?  <?php echo anchor('admin/album/' . getAlbumName($albumID), 'Edit or view your pictures now.') ?></p>
</div>
</div>
 <?php $data['showAlbum'] = FALSE; ?>
    <?php $data['showUserButton'] = FALSE; ?>
    <?php $this->load->view('admin/sidebar', $data); ?>
    <?php $this->load->view('admin/footer'); ?>