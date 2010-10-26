<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <?php echo link_tag("assets/css/admin/styles.css"); ?>
        <?php echo link_tag("assets/css/admin/modal.css"); ?>
        <?php echo link_tag("assets/javascript/facebox/facebox.css"); ?>
        <?php echo link_tag("assets/javascript/uploadify/uploadify.css"); ?>
        <?php echo link_tag("assets/javascript/lightbox/css/jquery.lightbox-0.5.css"); ?>
        <link rel="shortcut icon" href="<?php echo base_url(); ?>favicon.ico" />
         <!--[if IE]>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/ie.css">
        <![endif]-->
        <link href='http://fonts.googleapis.com/css?family=Yanone+Kaffeesatz' rel='stylesheet' type='text/css'>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/javascript/jquery/jquery-1.4.2.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/javascript/lightbox/js/jquery.lightbox-0.5.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/javascript/uploadify/swfobject.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/javascript/uploadify/jquery.uploadify.v2.1.0.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/javascript/uploadify/swfobject.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/javascript/facebox/facebox.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/javascript/snapit.js"></script>
        <?php echo js('swfupload/swfupload'); ?>
        <?php echo js('swfupload/plugins/swfupload.queue'); ?>
        <?php echo js('swfupload/fileprogress'); ?>
        <?php echo js('swfupload/handlers'); ?>
        <title>Manage Your Photos</title>
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
    
