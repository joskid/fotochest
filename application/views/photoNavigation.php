 <?php
                foreach($photoInfo->result() as $row){
                  ?>
<div class="nav">
                    <a href="<?php echo base_url(); ?>albums/view/<?php echo $albumNameURL; ?>"><?php echo getAlbumThumb($row->albumID); ?><h1><?php echo $row->albumFriendlyName; ?></h1></a>
                      <ol>
                <li><?php echo anchor('photos', 'Home'); ?></li>
                <li><?php echo anchor('albums', 'Albums'); ?></li>
                <?php if(isLoggedIn () == TRUE) { ?>
                <li><?php echo anchor('admin/editPhoto/' . $photoID . '/Y', 'Edit Photo', array('rel'=>'facebox')); ?></li>
                <?php } ?>
            </ol>

                </div>
<?php } ?>