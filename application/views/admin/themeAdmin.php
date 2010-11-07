<?php
$this->load->view('admin/header');
$data['pageNum'] = 4;
$this->load->view('admin/navigation', $data);
?>

<div class="content right" id ="themes">
    <h2>Themes</h2>
    <div class="form">
        

    </div>

</div>
<?php $data['showAlbum'] = FALSE; ?>
<?php $data['showUserButton'] = FALSE; ?>
<?php $this->load->view('admin/sidebar', $data); ?>
<?php $this->load->view('admin/footer'); ?>
