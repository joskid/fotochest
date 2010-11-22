
<?php echo js('fotochest'); ?>
<div class="modal">
    <div class="form" id="addAlbum">
      <h3>Add an album</h3>
      
      <div class="formItem">
        <label for="albumName">Album Name<span>(Must be Unique with no spaces!)</span></label>
        <div>
            <input type="text" name="albumName" size="35" id="albumName">
        </div>
      </div>
      <div class="formItem">
        <label for="albumFriendlyName">Album Public Name</label>
        <div>
            <input type="text" name="albumFriendlyName" id="albumFriendlyName" size="35">
        </div>
      </div>
      <div class="formItem">
        <label for="albumParent">Parent</label>
        <div>
            <?php echo getAlbumDropdownList(); ?>
        </div>
            
      </div>
    
      <a class="newButton addAlbumBtn small" style="clear:left;">
        <span>
          Add Album
        </span>
      </a>
      
      
     
    </div>
</div>