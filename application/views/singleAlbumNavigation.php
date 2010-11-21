<div class="nav">
            <a href="<?php echo base_url(); ?>albums/view/<?php echo $albumName; ?>"><?php echo getAlbumThumb($albumID); ?><h1><?php echo $albumFriendlyName; ?></h1></a>
            <ol>
                <li><?php echo anchor('photos', 'Home'); ?></li>
                <li><?php echo anchor('albums', 'Albums'); ?></li>
                <?php
                    if(getSetting('enableSlideshow') == 'TRUE'){
                        ?>
                        <li><?php
                echo anchor('photos/slideshow/' . $albumName, 'View Slideshow');
                ?>
                </li>
                        <?php
                    }
                    ?>

                    <?php
                    if(isLoggedIn() == 'TRUE'){
                        ?>
                        <li>
                            <?php echo anchor('users/logout', 'Logout'); ?>
                        </li>
                        <?php
                    }
                    ?>



            </ol>


        </div>