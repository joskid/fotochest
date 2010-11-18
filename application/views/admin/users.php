<?php
$this->load->view('admin/header');
$data['pageNum'] = 5;
$this->load->view('admin/navigation', $data);

?>

        <div class="content right" id="albumContent">
            <h2>Users</h2>
          
            <?php
            foreach($users->result() as $row){
              ?>

            <div class="user">
                 
                <h3><?php echo $row->userFirstName; ?> <?php echo $row->userLastName; ?></h3>
                
                <dl>
                    <dt>Email:</dt>
                    <dd><?php echo $row->userEmail; ?></dd>

                </dl>
                <ul class="actions">
                    <li><a href="<?php echo site_url('admin/users/editUser/' . $row->userID); ?>" class="newButton nextAction" rel="facebox"><span>Edit User</span></a></li>
                    <li><a href="<?php echo site_url('admin/users/deleteUser/' . $row->userID); ?>" class="newButton nextAction" rel="facebox"><span>Delete User</span></a></li>
                   
                </ul>
            </div>
            <?php
            }
            ?>
            <div class="pagination">
                <?php //echo $pages; ?>
            </div>
      </div>
        <?php $data['showAlbum'] = FALSE; ?>
      <?php $data['showUserButton'] = TRUE; ?>
      <?php $this->load->view('admin/sidebar', $data); ?>
      <?php $this->load->view('admin/footer'); ?>
