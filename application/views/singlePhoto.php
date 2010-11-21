<div class="photoPage">
                <?php
                foreach($photoInfo->result() as $row){
                  ?>



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
                        <a class="prev" href="<?php echo site_url(); ?>photos/view/<?php echo $row->albumName; ?>/<?php echo $row->photoID + 1; ?>">
                            <img src="<?php echo base_url(); ?>assets/images/Arrow-Left.png" width="24">
                        </a>
                        <a class="next" href="<?php echo site_url(); ?>photos/view/<?php echo $row->albumName; ?>/<?php echo $row->photoID - 1; ?>">
                            <img src="<?php echo base_url(); ?>assets/images/Arrow-Right.png" width="24">
                        </a>
                    </div>


            <div class="photoInfo">


                <h3>More from <?php echo $row->albumName; ?></h3>
                <a class="<?php if(!checkPhoto($row->photoID + 1, $row->albumName)) { ?> disabled <?php } ?>" href="<?php echo site_url(); ?>photos/view/<?php echo $row->albumName; ?>/<?php echo $row->photoID + 1; ?>">
                    <img src="<?php echo base_url(); ?>img_stor/albums/<? echo $row->albumName; ?>/thumbs/<?php echo getPhotoFileName($row->photoID + 1); ?>" width="90" class="thumb">
                </a>
                <a class="<?php if(!checkPhoto($row->photoID - 1, $row->albumName)) { ?> disabled <?php } ?>" href="<?php echo site_url(); ?>photos/view/<?php echo $row->albumName; ?>/<?php echo $row->photoID - 1; ?>">
                    <img src="<?php echo base_url(); ?>img_stor/albums/<? echo $row->albumName; ?>/thumbs/<?php echo getPhotoFileName($row->photoID - 1); ?>" width="90" class="thumb">
                </a>
                <?php if (getSetting('enablePhotoInfo') == 'TRUE')

                {
                ?>
                <h2>Photo Information</h2>
                <dl>

                    <dt>Model</dt>
                    <dd><?php

                    //echo $photoEXIF['Model']; ?></dd>

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

         <?php
                }
                ?>
