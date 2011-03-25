<div class="container_12 content">
    <h2>Settings</h2>
    <div class="form">
        <?php echo form_open('admin/settings', array('id'=>'settingsForm')); ?>
        <?php echo validation_errors(); ?>
        <div class="formItem">
            <label for="about_text">About Text:</label>
            <div>
                <textarea name="about_text"><?php echo get_setting('about_text'); ?></textarea>
                <script type="text/javascript">
                CKEDITOR.replace( 'about_text',
            {
                toolbar : 'Basic'
            });
            </script>
            </div>
        </div>
        <div class="formItem">
            <label for="home_page_text">Home Page Text:</label>
            <div>
                <textarea name="home_page_text"><?php echo get_setting('home_page_text'); ?></textarea>
                <script type="text/javascript">
                CKEDITOR.replace( 'home_page_text',
            {
                toolbar : 'Basic'
            });
            </script>
            </div>
        </div>

        <div class="formItem">
            <div>
                <input type="submit" value="Save Settings" class="large button submit purple">
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>