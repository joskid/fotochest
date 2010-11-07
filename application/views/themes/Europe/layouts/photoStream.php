<?php $this->load->view('themes/' . getSetting('themeName') . '/common/header');
$queryCount = $photoData->num_rows();
?>

<body>
    <div id="wrapper">
    <?php if (isLoggedIn() == FALSE) {
        echo anchor('admin/dashboard', 'Sign In', array('class'=>'signin'));
    } else {
        echo anchor('admin/dashboard', 'Administration', array('class'=>'signin'));
    } ?>
        <div class="nav">
            <a href="<?php echo base_url(); ?>"><?php echo getProfilePicture(); ?>
                <h1><?php echo getSetting('siteName'); ?>'s Photostream</h1>
            </a>
            <ol>
                <li><?php echo anchor('photos', 'Home'); ?></li>
                <li><?php if($queryCount != 0) { echo anchor('albums', 'Albums'); } ?></li>
            </ol>
        </div>
       <div class="photoContainer">
       <?php
       $count = 0;
       if($queryCount == 0){ ?><h2>You have no photos yet, would you like to <a href="<?php echo base_url(); ?>admin/dashboard">add an album or some photos?</a></h2>
        <?php }
       foreach($photoData->result() as $row){
           $count = $count + 1;
           if($count == 1){
               ?>
           <div class="photo left clear">
               <?php
           } else
           {
              if($count == 3){
                  $count = 0;
              }
               ?>

               <div class="photo left">
                   <?php
           }
           ?>
               <h2><?php echo $row->photoTitle; ?></h2>
               <a href="<?php echo base_url(); ?>photos/view/<?php echo $row->albumName; ?>/<?php echo $row->photoID; ?>"><img src="<?php echo base_url(); ?>img_stor/albums/<?php echo $row->albumName; ?>/thumbs/<?php echo $row->photoFileName; ?>" class="thumb" title="<?php echo $row->photoTitle; ?>" alt="<?php echo $row->photoTitle; ?>"></a>
           </div>
<?php
       }
       ?>
               <div class="clear"></div>
           </div>
           <p class="pagination clear">
               <?php
              echo $pages;
               ?>
           </p>
    </div>
</body>
</html>
