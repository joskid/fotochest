
<?php foreach ($photoInfo->result() as $row) { ?>
<div class="photoNavigation">
    <?php echo previousNav($row->photoID, $row->albumName); ?>
                       <?php echo nextNav($row->photoID, $row->albumName); ?>
</div>
<div class="singlePhoto photo">
				<a href="viewBigPhoto.html">
                                    <img src="<?php echo base_url(); ?>img_stor/albums/<?php echo $row->albumName; ?>/thumbs/<?php echo $row->photoFileName; ?>" title="<?php echo $row->photoTitle; ?>" alt="<?php echo $row->photoTitle; ?>">
				</a>
			</div>



			<div class="photoInfo">
                            <?php //if (getSetting('showPhotoTitle') == 'TRUE') { ?>
                            <h2><?php echo $row->photoTitle; ?></h2>
                            <?php //} ?>
				<p>
				<?php echo $row->photoDesc; ?>
				</p>
                                <?php if (getSetting('enableOriginalDownload') == 'TRUE') { ?>
				<a class="button" href="<?php echo site_url('download/downloadFile/' . $row->albumName . '/' . $row->photoID); ?>"><span>Download Photo</span></a>
                                <?php } ?>
                                
			</div>
<div class="comments" id="comments">
    
    <h3>Add a Comment</h3>
    <?php echo form_open('photos/saveComment', array('id'=>'addCommentForm')); ?>
    <textarea name="commentContent" id="commentContent"></textarea><br/>
    <input type="hidden" value="<?php echo $row->photoID; ?>" id="photoID" name="photoID">
    <input type="hidden" value="<?php echo $row->albumName; ?>" id="albumName" name="albumName">
    <a class="button addComment"><span>Add Comment</span></a>
    <?php echo form_close(); ?>
    <?php foreach($comments->result() as $comment) { ?>
    <div class="comment">
        <p class="date"><?php echo $comment->commentDate; ?></p>
    <?php echo $comment->commentContent; ?>
    </div>
    <?php } ?>
</div>


<?php } ?>