

<body class="loginPage">
    <div class="login">
        <?php echo form_open('users/login', array('id'=>'loginForm')); ?>
        <h1>Login</h1>
        <div class="form">
            <div class="formItem">
                <label for="email">Email:</label>
                <input type="email" name="userEmail" id="userEmail">
            </div>
            <div class="formItem">
                <label for="password">Password:</label>
                <input type="password" name="userPassword" id="userPassword">
            </div>
            <?php if($error == TRUE){
                ?>
            <div class="notification error">
                <p><?php echo $errorMsg; ?></p>
            </div>
            <?php
            }
            ?>
            <a class="loginAction button">
                <span>Login</span>
            </a>
            <?php echo anchor('forgotpassword', 'Forgot Password?'); ?>
        </div>
        <?php echo form_close(); ?>
        <div class="clear"></div>
    </div>
</body>
</html>
