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
                Welcome <?php echo getFirstName(); ?>, <?php echo anchor('logout', 'Logout'); ?>
            </span>
        </div>