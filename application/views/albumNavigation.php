<div class="nav">
            <a href="<?php echo base_url(); ?>">
            <?php echo getProfilePicture();  ?>
            <h1><?php echo getSetting('siteName'); ?>'s Albums</h1></a>
            <ol>
                <li><?php echo anchor('photos', 'Home'); ?></li>
                <li><?php echo anchor('albums', 'Albums'); ?></li>
                <?php if (isLoggedIn() == TRUE){ ?>

                    <li>
                         <?php echo anchor('logout', 'Logout'); ?>
                    </li>
                    <?php } ?>
            </ol>
        </div>