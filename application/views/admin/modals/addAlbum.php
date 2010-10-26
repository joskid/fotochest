
<script type="text/javascript" src="<?php echo base_url(); ?>assets/javascript/snapit.js"></script>
<div class="modal">
    <div class="form" id="addAlbum">
      <h3>Add an album</h3>
      
      <div class="formItem">
        <label for="albumName">Album Name<span>(Must be Unique with no spaces!)</span></label>
        <input type="text" name="albumName" size="35" id="albumName">
      </div>
      <div class="formItem">
        <label for="albumFriendlyName">Album Public Name</label>
        <input type="text" name="albumFriendlyName" id="albumFriendlyName" size="35">
      </div>
      <div class="formItem">
        <label for="albumParent">Parent</label>
        <?php echo getAlbumDropdownList(); ?>
            
      </div>
    
      <a class="button addAlbumBtn small nextAction">
        <span>
          Add Album
        </span>
      </a>
      
      
     
    </div>
</div>