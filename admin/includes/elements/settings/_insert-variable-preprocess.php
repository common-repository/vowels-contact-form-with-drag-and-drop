<?php
if (!defined('VOWELSFORMDRAGDROP_VERSION')) exit;
$dateFormats = vowels_form_builder_get_date_formats();
$timeFormats = vowels_form_builder_get_time_formats();
?><select class="ifb-insert-variable-preprocess" onchange="vowelsforminc.insertVariable('#default_value_<?php echo $id; ?>', this);">
	<option value=""><?php esc_html_e('Insert variable...','vowels-contact-form-with-drag-and-drop'); ?></option>
	<option value="{ip}"><?php esc_html_e('User IP address','vowels-contact-form-with-drag-and-drop'); ?></option>
	<option value="{user_agent}"><?php esc_html_e('User agent','vowels-contact-form-with-drag-and-drop'); ?></option>
	<option value="{post_id}"><?php esc_html_e('Form post/page ID','vowels-contact-form-with-drag-and-drop'); ?></option>
	<option value="{post_title}"><?php esc_html_e('Form post/page title','vowels-contact-form-with-drag-and-drop'); ?></option>
	<option value="{url}"><?php esc_html_e('Form URL','vowels-contact-form-with-drag-and-drop'); ?></option>
	<option value="{user_display_name}"><?php esc_html_e('User display name','vowels-contact-form-with-drag-and-drop'); ?></option>
	<option value="{user_email}"><?php esc_html_e('User email','vowels-contact-form-with-drag-and-drop'); ?></option>
	<option value="{user_login}"><?php esc_html_e('User login','vowels-contact-form-with-drag-and-drop'); ?></option>
	<option value="{referring_url}"><?php esc_html_e('Referring URL','vowels-contact-form-with-drag-and-drop'); ?></option>
	<optgroup label="<?php esc_attr_e('Date (select a format)','vowels-contact-form-with-drag-and-drop'); ?>">
		<?php foreach ($dateFormats as $dateFormat => $dateExample) : ?>
		<option value="{current_date|<?php echo $dateFormat; ?>}"><?php echo esc_html($dateExample); ?></option>
		<?php endforeach; ?>
	</optgroup>
		<optgroup label="<?php esc_attr_e('Time (select a format)','vowels-contact-form-with-drag-and-drop'); ?>">
		<?php foreach ($timeFormats as $timeFormat => $timeExample) : ?>
		<option value="{current_time|<?php echo $timeFormat; ?>}"><?php echo esc_html($timeExample); ?></option>
		<?php endforeach; ?>
	</optgroup>
</select>