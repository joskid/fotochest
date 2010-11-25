<?php foreach ($photoInfo->result() as $row) { ?>
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
				<a class="button" href="/"><span>Download Photo</span></a>
                                <?php } ?>
			</div>
<?php } ?>