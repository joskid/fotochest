<?php echo js('fotochest'); ?>
<div class="modal">
    <?php foreach($albumData->result() as $row){ ?>

    <div class="form" id="editAlbum">

        <div class="formItem">
            <label for="albumFriendlyName">Public Name:</label>
            <div>
                <input type="text" name="albumFriendlyName" id="albumFriendlyName" value="<?php echo $row->albumFriendlyName; ?>">
            </div>
        </div>

        <div class="formItem">
            <label for="albumDesc">Album Description:</label>
            <div>
                <textarea rows="10" cols="45" id="albumDesc" name="albumDesc"><?php echo $row->albumDesc; ?></textarea
            </div>
        </div>
        <input type="hidden" name="albumID" id="albumID" value="<?php echo $row->albumID; ?>">
        <?php } ?>
        <div class="formItem">
            <a class="button saveAlbum"><span>Save</span></a>
        </div>
        
    </div>

</div>