<?php $this->load->view('admin/header'); ?>

<body class="loginPage">
    <div class="login">
        <?php echo form_open('users/forgotPassword'); ?>
        <h1>Retreive Your Password</h1>
        <div class="form">
            <div class="formItem">
                <label for="email">Email:</label>
                <input type="email" name="userEmail" id="userEmail">
            </div>
            <?php if (isset($message)) { ?>
            <div class="notification success">
                <p><?php echo $message; ?></p>
            </div>
            <?php } ?>
           
            <input type="submit" class="loginBtn" value="Reset My Password">
           
        </div>
        <?php echo form_close(); ?>
        <div class="clear"></div>
    </div>
</body>
</html>

