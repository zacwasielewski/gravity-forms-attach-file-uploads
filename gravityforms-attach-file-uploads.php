<?php
/* 

Plugin Name: Gravity Forms: Attach File Uploads
Plugin URI: http://github.com/zacwasielewski/gravity-forms-attach-file-uploads/
Description: An addon for Gravity Forms to attach user-submitted File Upload data to notification emails
Version: 0.1.0
Author: Zac Wasielewski (@xac)
Author URI: http://wasielewski.org

*/

if( class_exists('GFForms') ) {
	add_filter("gform_notification_ui_settings", "attach_fileuploads_notification_ui_settings",        10, 3);
	add_action("gform_pre_notification_save",    "attach_fileuploads_notification_ui_settings_save",   10, 2);
	add_filter("gform_notification",             "attach_fileuploads_add_attachments_to_notification", 10, 3);
}

function attach_fileuploads_notification_ui_settings($ui_settings, $notification, $form) {
	
	ob_start();
	?>
	<tr valign="top">
		<th scope="row">
			<label for="gform_notification_attach_fileuploads">
				<?php _e("Attachments", "gravityforms"); ?>
			</label>
		</th>
		<td>
			<input type="checkbox" name="gform_notification_attach_fileuploads" id="gform_notification_attach_fileuploads" value="1" <?php echo empty($notification["attachFileUploads"]) ? "" : "checked='checked'" ?>/>
			<label for="gform_notification_attach_fileuploads" class="inline">
				<?php _e("Attach File Upload data to notification email", "gravityforms"); ?>
			</label>
		</td>
	</tr> <!-- / disable autoformat -->
	<?php $ui_settings['notification_attach_fileuploads'] = ob_get_contents(); ob_clean(); ?>
	<?php
	
	return $ui_settings;
}

function attach_fileuploads_notification_ui_settings_save($notification, $form) {
	$notification['attachFileUploads'] = rgpost('gform_notification_attach_fileuploads');
	return $notification;
}

function attach_fileuploads_add_attachments_to_notification($notification, $form, $entry){
	
	if ($notification['attachFileUploads'] != 1)
		return $notification;
	
	$attachments = array();
	$fileupload_fields = GFCommon::get_fields_by_type($form, array("fileupload"));
	
	if(!is_array($fileupload_fields))
		return $notification;

	if (empty($notification['attachments'])) {
		$notification['attachments'] = array();
	}

	$upload_root = RGFormsModel::get_upload_root();
	foreach($fileupload_fields as $field){
		$url = $entry[$field["id"]];    
		$attachment = preg_replace('|^(.*?)/gravity_forms/|', $upload_root, $url);
		if($attachment){
			$notification['attachments'][] = $attachment;
		}           
	}
	
	return $notification;
}
