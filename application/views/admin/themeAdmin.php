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
            <h3><?php echo $newTheme->themeName; ?><?php if ($newTheme->themeActive == 1) { ?> - Current Theme <?php } ?></h3>
            <img src="<?php echo site_url(); ?>assets/themes/<?php echo $newTheme->themeName; ?>/screenshot.png" width="300">
            <ul>
                <li>Author: <?php echo $newTheme->themeAuthor; ?></li>
                <li>
                    <?php if ($newTheme->themeActive != 1) { ?>
                    
                    <a class="button" href="<?php echo base_url(); ?>admin/themes/activateTheme/<?php echo $newTheme->themeID; ?>"><span>Activate</span></a>
                    <?php } ?>
                </li>
            </ul>
            <div class="clear"></div>
        </div>

        <?php } ?>
    </div>

</div>
<?php $data['showAlbum'] = FALSE; ?>
<?php $data['showUserButton'] = FALSE; ?>
<?php $this->load->view('admin/sidebar', $data); ?>
<?php $this->load->view('admin/footer'); ?>
