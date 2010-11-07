<?php
$this->load->view('admin/header');
$data['pageNum'] = 4;
$this->load->view('admin/navigation', $data);
?>

<div class="content right" id ="themes">
    <h2>Themes</h2>
    <div class="themes">
        <?php foreach($themes->result() as $newTheme){ ?>

        <div class="theme <?php if ($newTheme->themeActive == 1) { ?>active <?php } else {} ?>">
            <h3><?php echo $newTheme->themeName; ?></h3>
            <img src="<?php echo site_url(); ?>assets/themes/<?php echo $newTheme->themeName; ?>/screenshot.png" width="300">
        </div>

        <?php } ?>
    </div>

</div>
<?php $data['showAlbum'] = FALSE; ?>
<?php $data['showUserButton'] = FALSE; ?>
<?php $this->load->view('admin/sidebar', $data); ?>
<?php $this->load->view('admin/footer'); ?>
