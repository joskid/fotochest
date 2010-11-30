<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <?php echo css('admin/styles'); ?>
        <?php echo css('admin/modal'); ?>
        <?php echo link_tag("assets/javascript/facebox/facebox.css"); ?>
        <?php echo link_tag("assets/javascript/lightbox/css/jquery.lightbox-0.5.css"); ?>
        <?php echo link_tag("assets/javascript/Jcrop/jquery.jcrop.css"); ?>
        <link rel="shortcut icon" href="<?php echo base_url(); ?>favicon.ico" />
         <!--[if IE]>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/ie.css">
        <![endif]-->
        <link href='http://fonts.googleapis.com/css?family=Yanone+Kaffeesatz|Arimo|Cuprum|Neucha' rel='stylesheet' type='text/css'>
        <?php echo getJquery(); ?>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/javascript/uploadify/swfobject.js"></script>
        <?php echo js('lightbox/js/jquery.lightbox-0.5'); ?>
        <?php echo js('facebox/facebox'); ?>
        <?php echo js('swfupload/swfupload'); ?>
        <?php echo js('swfupload/plugins/swfupload.queue'); ?>
        <?php echo js('swfupload/fileprogress'); ?>
        <?php echo js('swfupload/handlers'); ?>
        <?php echo js('Jcrop/js/jquery.jcrop'); ?>
        <?php echo js('fotochest'); ?>
        <title><?php echo $title; ?></title>
        <?php if (isset($albumID) && isset($isUpload)) { ?>
        <script type="text/javascript">
        var swfu;

        window.onload = function() {
                var settings = {
                        flash_url : "/assets/javascript/swfupload/Flash/swfupload.swf",
                        upload_url: "/upload/multiUpload/<?php echo $albumID; ?>",
                        post_params: {"PHPSESSID" : "<?php echo session_id(); ?>"},

                        file_size_limit : "10 MB",
                        file_types : "*.*",
                        file_types_description : "All Files",
                        file_upload_limit : 1000,
                        file_queue_limit : 0,
                        custom_settings : {
                                progressTarget : "fsUploadProgress",
                                cancelButtonId : "btnCancel"
                        },
                        debug: false,

                        // Button settings
                        button_image_url: "images/TestImageNoText_65x29.png",
                        button_width: "65",
                        button_height: "29",
                        button_placeholder_id: "spanButtonPlaceHolder",
                        button_text: '<a class="button"><span>Browse</span></a>',
                        button_text_style: ".theFont { font-size: 16; }",
                        button_text_left_padding: 12,
                        button_text_top_padding: 3,

                        // The event handler functions are defined in handlers.js
                        file_queued_handler : fileQueued,
                        file_queue_error_handler : fileQueueError,
                        file_dialog_complete_handler : fileDialogComplete,
                        upload_start_handler : uploadStart,
                        upload_progress_handler : uploadProgress,
                        upload_error_handler : uploadError,
                        upload_success_handler : uploadSuccess,
                        upload_complete_handler : uploadComplete,
                        queue_complete_handler : queueComplete	// Queue plugin event
                };

                swfu = new SWFUpload(settings);
	     };
	</script>
        <?php } ?>
    </head>
    <body>
    <div id="mainWrapper">
        <a class="help" href="<?php echo site_url(); ?>help" target="_blank">Help</a>
        <a class="logo" href="<?php echo base_url(); ?>admin/dashboard">foto<span>chest</span></a>
        <?php echo $navigation; ?>
        <?php if(isOverPhotoLimit() == true){ ?>
        <div class="notification error">
            <p>You have exceeded your photo limit for this account. Your limit is <?php echo getPhotoLimit(); ?>.  <a href="#">Upgrade Today!</a></p>
        </div>
        <?php } ?>
        <?php if (getSetting('firstTimeLogin') == 'TRUE') { ?>
        <div class="notification info">
            <p>Guten Tag!  Welcome to FotoChest.  Begin by creating an album and then uploading some photos! <?php echo anchor('admin/settings/changeSetting/firstTimeLogin/FALSE', 'Thanks, close me'); ?></p>
        </div>
        <?php } ?>
        <?php echo $content; ?>
        <?php echo $sidebar; ?>
        <div class="footer clear">
            <p class="version">&copy; 2010 <a href="http://fotochest.com" target="_blank">FotoChest</a> Version <?php echo getVersion(); ?></p>
        </div>

        </div>
        </body>
