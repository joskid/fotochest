<div class="sidebar">
   
						<?php if($showAlbum == TRUE){ ?>
            <a class="newButton" href="<?php echo base_url(); ?>admin/albums/addAlbum" rel="facebox"><span>+</span>Add Album</a>
						<?php } ?>
            <?php if($showUserButton == TRUE) { ?>
            <a class="button nextAction" href="<?php echo base_url(); ?>admin/users/addUser" rel="facebox"><span>Add User</span></a>
            <a class="newButton" href="<?php echo base_url(); ?>admin/users/addUser" rel="facebox"><span>+</span>Add User</a>
            <?php } ?>
            
            <div class="profile">
                <?php echo getProfilePicture(); ?>
                
                <ul>
                    <li><?php echo getPhotoCount(); ?> Photos</li>
                    <li><?php echo getAlbumCount(); ?> Albums</li>
                    
                </ul>
            </div>
        </div>
