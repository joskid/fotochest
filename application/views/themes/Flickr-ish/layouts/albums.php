<?php $this->load->view('themes/' . getTheme() . '/common/header'); ?>
    <body>
         <div id="wrapper">
             <?php if (isLoggedIn() == FALSE) {

                 echo anchor('admin/dashboard', 'Sign In', array('class'=>'signin'));
                 
             } else {
                 echo anchor('admin/dashboard', 'Administration', array('class'=>'signin'));
             }
                ?>
         <div class="nav">
            <a href="<?php echo base_url(); ?>">
            <?php echo getProfilePicture();  ?>
            <h1><?php echo getSetting('siteName'); ?>'s Albums</h1></a>
            <ol>
                <li><?php echo anchor('photos', 'Home'); ?></li>
                <li><?php echo anchor('albums', 'Albums'); ?></li>
                <?php if (isLoggedIn() == TRUE){ ?>
                    
                    <li>
                         <?php echo anchor('users/logout', 'Logout'); ?>
                    </li>
                    <?php } ?>
            </ol>
        </div>
       <div class="photoContainer">
       <?
       $count = 0;
       foreach($albumInfo->result() as $row){
       $count = $count + 1;
        if($count == 1){ ?>
           <div class="photo left clear album">
           <?php } else {
              if($count == 3){
                  $count = 0;
              } ?>
               <div class="photo left album">
               <?php } ?>
               <a href="<?php echo site_url(); ?>albums/view/<?php echo $row->albumName; ?>">
                   <h2><?php echo $row->albumFriendlyName; ?></h2>
                   <?php echo getAlbumThumbs($row->albumID, 3); ?>
               </a>
           </div>
           <?php } ?>
           </div>
           <p class="pagination">

           </p>
    </div>
    </body>
</html>
