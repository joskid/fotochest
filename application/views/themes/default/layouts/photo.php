<?php $this->load->view('themes/' . getTheme() . '/common/header'); ?>
    <body>
        <div id="wrapper">
                        <?php if (isLoggedIn() == FALSE) {

                 echo anchor('admin/dashboard', 'Sign In', array('class'=>'signin'));

             } else {
                 echo anchor('admin/dashboard', 'Administration', array('class'=>'signin'));
             }
?>
            <div class="photoPage">
                <?php
                foreach($photoInfo->result() as $row){
                  ?>
                <a class="button previous" href="<?php echo site_url(); ?>photos/view/<?php echo $row->albumName; ?>/<?php echo $row->photoID - 1; ?>"><span>Previous</span></a>
                <a class="button next" href="<?php echo site_url(); ?>photos/view/<?php echo $row->albumName; ?>/<?php echo $row->photoID + 1; ?>"><span>Next</span></a>
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
                
                    <div class="photo">
                        <?php if (getSetting('showPhotoTitle') == 'TRUE') { ?>
                        <h2><?php echo $row->photoTitle; ?></h2>
                        <?php } ?>
                        <?php if(getSetting('enableFullViewPhoto') == 'TRUE'){
                            ?>
                            <a href="<?php echo base_url(); ?>img_stor/albums/<?php echo $row->albumName; ?>/originals/<?php echo $row->photoFileName; ?>" rel="facebox" class="viewOriginal"><img src="<?php echo base_url(); ?>img_stor/albums/<?php echo $row->albumName; ?>/thumbs/<?php echo $row->photoFileName; ?>" title="<?php echo $row->photoTitle; ?>" alt="<?php echo $row->photoTitle; ?>"></a>
                    <?php
                        } else {
                        ?>
                    <img src="<?php echo base_url(); ?>img_stor/albums/<?php echo $row->albumName; ?>/thumbs/<?php echo $row->photoFileName; ?>" title="<?php echo $row->photoTitle; ?>" alt="<?php echo $row->photoTitle; ?>">
                        <?php
                        }
                        ?>
                    </div>
               
            <?php if (getSetting('enablePhotoInfo') == 'TRUE')
                
                {
                ?>
            <div class="photoInfo">
                <h2>Photo Information</h2>
                <dl>
                    <dt>Album</dt>
                    <dd><?php echo anchor('albums/view/' . $row->albumName, $row->albumFriendlyName); ?></dd>
                    <dt>Make</dt>
                    <dd><?php
                    
                    
                    //echo $photoEXIF['Make'];
                    ?>
                    </dd>
                    <dt>Model</dt>
                    <dd><?php
                    
                    //echo $photoEXIF['Model']; ?></dd>
                    <dt>View</dt>
                    <dd><a href="<?php echo base_url(); ?>img_stor/albums/<?php echo $row->albumName; ?>/originals/<?php echo $row->photoFileName; ?>" rel="facebox" class="viewOriginal">View Original</a>

                    </dl>
                    <?php
                    if(getSetting('enableOriginalDownload') == 'TRUE'){
                        ?>
                        <dt>Download</dt>
                        <dd><a href="<?php echo base_url(); ?>downloads/downloadFile/<?php echo $row->albumName; ?>/<?php echo $row->photoFileName; ?>">Download</a></dd>
                        <?php
                    }
                    ?>
            </div>
                <div class="photoDesc">
                    <p>
                        <?php echo $row->photoDesc; ?>
                    </p>
                </div>
            <?php
            }
            ?>
            <?php if(getSetting('enableComments') == 'TRUE'){
            ?>
            <div class="photoComments">
                <h2>Discussion</h2>
                <?php foreach($comments->result() as $commentRow){ ?>
                <div class="comment">
                    <p><?php echo $commentRow->commentContent; ?></p>
                </div>
                    
              <?php  } ?>
                <h3>Add a Comment</h3>
                <textarea cols="90" rows="6"></textarea>
                <a class="button" href="#"><span>Add Comment</span></a>
            </div>
            <?php
            }
            ?>
                </div>
        </div>
         <?php
                }
                ?>
    </body>
</html>
