<body>
    <div id="mainWrapper">
        <a class="logo" href="<?php echo base_url(); ?>admin/dashboard">foto<span>chest</span></a>
        <div class="nav">
            <ul>
                <?php if($pageNum == 1){ ?> <li class="active"> <?php } else { ?> <li> <?php } ?>

                <?php echo anchor('admin/photos', 'Home'); ?>
                </li>
                <?php if($pageNum == 2){ ?> <li class="active"> <?php } else { ?> <li> <?php } ?>
                    <?php echo anchor('admin/albums', 'Albums'); ?>
                </li>
                 <?php if ($pageNum == 5) { ?> <li class="active"> <?php } else { ?> <li> <?php } ?>
                    <?php echo anchor('admin/users', 'Users'); ?>
                </li>
                
                 <?php if($pageNum == 3){ ?> <li class="active"> <?php } else { ?> <li> <?php } ?>


                    <?php echo anchor('admin/settings', 'Settings'); ?>

                 </li>

                 <?php if($pageNum == 4){ ?> <li class="active"> <?php } else { ?> <li> <?php } ?>
                     <?php echo anchor('admin/themes', 'Themes'); ?>
                 </li>
                <li><a href="<?php echo base_url(); ?>" target="_blank">View Site</a></li>
               

            </ul>
            <span class="logout">
                Welcome <?php echo getFirstName(); ?>, <?php echo anchor('users/logout', 'Logout'); ?>
            </span>
        </div>
         <?php if(isOverPhotoLimit() == true){ ?>
        <div class="notification error">
            <p>You have exceeded your photo limit for this account. Your limit is <?php echo getPhotoLimit(); ?>.  <a href="#">Upgrade Today!</a></p>
        </div>
        <?php } ?>