<?php
$this->load->view('admin/header');
$data['pageNum'] = 2;
$this->load->view('admin/navigation', $data); 
?>
        <div class="content right" id="albumContent">
            <h2>Albums</h2>
           <?php if ($albums->num_rows() == 0) { ?>
            <h3>You need to <?php echo anchor('admin/photoUpload/1', 'add photos'); ?> to your albums.  Go ahead, its easy!</h3>
            <?php } ?>
            <?php
            foreach($albums->result() as $row){
              ?>
            
            <div class="album">
                <a href="<?php echo site_url('admin/viewAlbum/' . $row->albumName); ?>">
                    <?php echo getAlbumThumbs($row->albumID, 1, TRUE); ?>
                </a>
                <h3><?php echo anchor('admin/viewAlbum/' . $row->albumName, $row->albumFriendlyName); ?></h3>
                <p>
                    <?php echo $row->albumDesc; ?>
                </p>
                <dl>
                    <dt>Photos</dt>
                    <dd><?php echo getAlbumPhotoCount($row->albumID); ?></dd>
                    
                </dl>
                <ul class="actions">
                    <li><a href="<?php echo base_url(); ?>admin/editAlbum/<?php echo $row->albumID; ?>" class="button nextAction" rel="facebox"><span>Edit</span></a></li>
                    <li><a href="<?php echo site_url(); ?>admin/photoUpload/<?php echo $row->albumID; ?>" class="button nextAction"><span>Add Photos</span></a></li>
                    
                    <?php if(getAlbumPhotoCount($row->albumID) < 150 && $row->albumID > 0) { ?>
                    <li><a href="<?php echo base_url(); ?>download/downloadAlbum/<?php echo $row->albumName; ?>" class="button" style="display:none;"><span>Download Album</span></a></li>
                    <?php } ?>
                    <li><a href="<?php echo base_url(); ?>admin/deleteAlbum/<?php echo $row->albumID; ?>" class="button nextAction" rel="facebox"><span>Delete</span></a></li>

                </ul>
            </div>
            <?php
            }
            ?>
            <div class="pagination">
                <?php echo $pages; ?>
            </div>
      </div>
      <?php $data['showAlbum'] = TRUE; ?>
      <?php $data['showUserButton'] = FALSE; ?>
      <?php $this->load->view('admin/sidebar', $data); ?>
      <?php $this->load->view('admin/footer'); ?>





