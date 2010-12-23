<?php echo js('fotochest'); ?>
<div class="modal">
    <div class="addUser form" id="saveUser">
        <?php foreach($userInfo->result() as $row) { ?>
      <h3>Edit User</h3>
      <div class="formItem">
        <label>Email Address:</label>
        <div>
            <input type="text" name="userEmail" id="userEmail" size="50" value="<?php echo $row->userEmail; ?>">
        </div>
      </div>
      <div class="formItem">
        <label>Password:</label>
        <div>
            <input type="password" name="userPassword" id="userPassword" size="50" value="<?php echo getPassword($row->userID); ?>">
        </div>
      </div>
      <div class="formItem">
        <label>First Name:</label>
        <div>
            <input type="text" name="userFirstName" id="userFirstName" size="50" value="<?php echo $row->userFirstName; ?>">
        </div>
      </div>
      <div class="formItem">
        <label>Last Name:</label>
        <div>
            <input type="text" name="userLastName" id="userLastName" size="50" value="<?php echo $row->userLastName; ?>">
        </div>
        <input type="hidden" name="userUserID" id="userUserID" value="<?php echo $row->userID; ?>">
      </div>
      <div class="formItem">
          <div>
              <a class="button saveUser">
                <span>
                  Save User
                </span>
              </a>
          </div>
      </div>
      
        <?php } ?>
    </div>
</div>
