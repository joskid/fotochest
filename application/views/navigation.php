<div class="nav">
<?php $queryCount = $photoData->num_rows(); ?>
<a href="<?php echo base_url(); ?>"><?php echo getProfilePicture(); ?>
                <h1><?php echo getSetting('siteName'); ?>'s Photostream</h1>
            </a>
            <ol>
                <li><?php echo anchor('photos', 'Home'); ?></li>
                <li><?php if($queryCount != 0) { echo anchor('albums', 'Albums'); } ?></li>
            </ol>
</div>