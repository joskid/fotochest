<div class="sidebar">
    <a class="newButton" href="<?php echo site_url('admin/addPhotos'); ?>" rel="facebox"><span>Add Fotos</span></a>
   
    <?php if($showAlbum == TRUE){ ?>
    <a class="newButton" href="<?php echo site_url('admin/albums/addAlbum'); ?>" rel="facebox"><span>Add Album</span></a>
                                        <?php } ?>
    <?php if($showUserButton == TRUE) { ?>
    <a class="newButton" href="<?php echo site_url('admin/users/addUser'); ?>" rel="facebox"><span>Add User</span></a>

    <?php } ?>

<div class="profile">
    <?php echo getProfilePicture(); ?>

    <ul>
        <li><?php echo getPhotoCount(); ?> Photos</li>
        <li><?php echo getAlbumCount(); ?> Albums</li>

    </ul>
</div>
</div>
