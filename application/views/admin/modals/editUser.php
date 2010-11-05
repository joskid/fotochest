
<script type="text/javascript" src="<?php echo base_url(); ?>assets/javascript/snapit.js"></script>
<div class="modal">
    <div class="addUser form" id="addUser">
        <?php foreach($userInfo->result() as $row) { ?>
      <h3>Edit User</h3>
      <div class="formItem">
        <label>Email Address:</label>
        <input type="text" name="userEmail" id="userEmail" size="50" value="<?php echo $row->userEmail; ?>">
      </div>
      <div class="formItem">
        <label>Password:</label>
        <input type="password" name="userPassword" id="userPassword" size="50" value="<?php echo getPassword($row->userID); ?>">
      </div>
      <div class="formItem">
        <label>First Name:</label>
        <input type="text" name="userFirstName" id="userFirstName" size="50" value="<?php echo $row->userFirstName; ?>">
      </div>
      <div class="formItem">
        <label>Last Name:</label>
        <input type="text" name="userLastName" id="userLastName" size="50" value="<?php echo $row->userLastName; ?>">
        <input type="hidden" name="userUserID" id="userUserID" value="<?php echo $row->userID; ?>">
      </div>
      <a class="button saveUser">
        <span>
          Save User
        </span>
      </a>
        <?php } ?>
    </div>
</div>
