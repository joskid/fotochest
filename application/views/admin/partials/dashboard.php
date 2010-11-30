
    <div class="content right" id="dashContent">
        <h2>Your Photostream</h2>
       <div class="notification success hide">
        <p>Photos Added</p>
       </div>
        <?php if($photos->num_rows() == 0) { ?>
        <h3>You need to <?php echo anchor('admin/albums/addAlbum', 'add an album', array('rel'=>'facebox')); ?> to start uploading photos!</h3>
      <?php } ?>
        <?php foreach($photos->result() as $row)
        {
        ?>
        <div class="photo">
            <a href="<?php echo base_url(); ?>img_stor/albums/<?php echo $row->albumName; ?>/thumbs/<?php echo $row->photoFileName; ?>" rel="lightbox" class="preview" title="<?php echo $row->photoDesc; ?>">
            <img src="<?php echo base_url(); ?>img_stor/albums/<?php echo $row->albumName; ?>/thumbs/<?php echo $row->photoFileName; ?>" width="75">
            </a>
            <h3><?php echo $row->photoTitle; ?></h3>
            <p>
                <?php echo $row->photoDesc; ?>
            </p>
            <dl>
                <dt>Album</dt>
                <dd><?php echo $row->albumFriendlyName; ?></dd>
            </dl>
            <ul class="actions">
                <li><a href="<?php echo site_url('admin/photos/fullEdit/' . $row->photoID); ?>" class="button full"><span>Edit</span></a></li>
                <li><a href="<?php echo site_url('admin/photos/movePhoto/' . $row->photoID); ?>" class="button full" rel="facebox"><span>Move</span></a></li>
                <li><a href="<?php echo site_url('admin/photos/deletePhoto/' . $row->photoID); ?>" class="button full" rel="facebox"><span>Delete</span></a></li>
            </ul>
        </div>
        <?php
        }
        ?>


        <div class="pagination">
            <?php echo $pages; ?>
        </div>
    </div>