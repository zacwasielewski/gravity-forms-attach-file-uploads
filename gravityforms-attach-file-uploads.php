<?php
/* 

Plugin Name: Gravity Forms Attach File Uploads
Plugin URI: http://github.com/zacwasielewski/gravity-forms-attach-file-uploads/
Description: An add-on for Gravity Forms to attach user-submitted File Upload data to notification emails
Version: 0.2.0
Author: Zac Wasielewski
Author URI: http://wasielewski.org

*/

add_action( 'plugins_loaded', 'gravity_forms_attach_file_uploads_init' );

function gravity_forms_attach_file_uploads_init () {
	require_once( plugin_dir_path(__FILE__).'GFAttachFileUploads.php' );
	new GFAttachFileUploads();
}

