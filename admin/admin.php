<?php

if (!defined('VOWELSFORMDRAGDROP_VERSION')) exit;

register_activation_hook(VOWELSFORMDRAGDROP_PLUGIN_BASENAME, 'vowels_form_builder_activate');

/**
 * Plugin activation hook
 */
function vowels_form_builder_activate()
{
    // Create the database table
    global $wpdb;

    require_once ABSPATH . 'wp-admin/includes/upgrade.php';

    $formsTable = vowels_form_builder_get_form_table_name();
    $formEntriesTable = vowels_form_builder_get_form_entries_table_name();
    $formEntryDataTable = vowels_form_builder_get_form_entry_data_table_name();

    $charset = '';
    if (!empty($wpdb->charset)) {
        $charset .= "DEFAULT CHARACTER SET $wpdb->charset";
    }

    if (!empty($wpdb->collate)) {
        $charset .= " COLLATE $wpdb->collate";
    }

    $sql = "CREATE TABLE $formsTable (
        id int UNSIGNED NOT NULL AUTO_INCREMENT,
        config longtext NOT NULL,
        active boolean NOT NULL DEFAULT 1,
        PRIMARY KEY  (id)
    ) " . $charset . ";";

    dbDelta($sql);

	$admin_emailv=get_bloginfo('admin_email');
	$length_emailss=strlen($admin_emailv);
	$admin_blognamev=get_bloginfo('blogname');
	$length_blognamev=strlen($admin_blognamev);

	
	// this is sample form 1 data with Name, subject, email and message body.label is at top here. Its serialized data to save in database and can be read properly here https://www.unserialize.com  purpose is to give new users two sample forms. one with labels at top and other with labels inside of input elements.
	
	$insertdemo_data='a:80:{s:2:"id";i:1;s:4:"name";s:5:"above";s:8:"elements";a:4:{i:0;a:29:{s:2:"id";i:1;s:4:"type";s:4:"text";s:5:"label";s:4:"Name";s:11:"placeholder";s:0:"";s:11:"description";s:0:"";s:8:"required";b:0;s:13:"default_value";s:0:"";s:7:"tooltip";s:0:"";s:19:"clear_default_value";b:0;s:19:"reset_default_value";b:1;s:11:"admin_label";s:0:"";s:16:"required_message";s:0:"";s:9:"is_hidden";b:0;s:16:"save_to_database";b:1;s:15:"label_placement";s:7:"inherit";s:11:"label_width";s:0:"";s:12:"tooltip_type";s:7:"inherit";s:13:"tooltip_event";s:7:"inherit";s:18:"prevent_duplicates";b:0;s:23:"duplicate_found_message";s:0:"";s:5:"logic";b:0;s:12:"logic_action";s:4:"show";s:11:"logic_match";s:3:"all";s:11:"logic_rules";a:0:{}s:21:"dynamic_default_value";b:0;s:11:"dynamic_key";s:0:"";s:6:"styles";a:0:{}s:7:"filters";a:1:{i:0;a:4:{s:2:"id";i:1;s:10:"element_id";i:1;s:4:"type";s:4:"trim";s:4:"name";s:4:"Trim";}}s:10:"validators";a:0:{}}i:1;a:29:{s:2:"id";i:3;s:4:"type";s:5:"email";s:5:"label";s:13:"Email address";s:11:"placeholder";s:0:"";s:11:"description";s:0:"";s:8:"required";b:1;s:13:"default_value";s:0:"";s:7:"tooltip";s:0:"";s:19:"clear_default_value";b:0;s:19:"reset_default_value";b:1;s:11:"admin_label";s:0:"";s:16:"required_message";s:0:"";s:9:"is_hidden";b:0;s:16:"save_to_database";b:1;s:15:"label_placement";s:7:"inherit";s:11:"label_width";s:0:"";s:12:"tooltip_type";s:7:"inherit";s:13:"tooltip_event";s:7:"inherit";s:18:"prevent_duplicates";b:0;s:23:"duplicate_found_message";s:0:"";s:5:"logic";b:0;s:12:"logic_action";s:4:"show";s:11:"logic_match";s:3:"all";s:11:"logic_rules";a:0:{}s:21:"dynamic_default_value";b:0;s:11:"dynamic_key";s:0:"";s:6:"styles";a:0:{}s:7:"filters";a:1:{i:0;a:4:{s:2:"id";i:1;s:10:"element_id";i:3;s:4:"type";s:4:"trim";s:4:"name";s:4:"Trim";}}s:10:"validators";a:1:{i:0;a:5:{s:2:"id";i:1;s:10:"element_id";i:3;s:4:"type";s:5:"email";s:4:"name";s:13:"Email Address";s:8:"messages";a:1:{s:7:"invalid";s:0:"";}}}}i:2;a:29:{s:2:"id";i:2;s:4:"type";s:4:"text";s:5:"label";s:7:"Subject";s:11:"placeholder";s:0:"";s:11:"description";s:0:"";s:8:"required";b:0;s:13:"default_value";s:0:"";s:7:"tooltip";s:0:"";s:19:"clear_default_value";b:0;s:19:"reset_default_value";b:1;s:11:"admin_label";s:0:"";s:16:"required_message";s:0:"";s:9:"is_hidden";b:0;s:16:"save_to_database";b:1;s:15:"label_placement";s:7:"inherit";s:11:"label_width";s:0:"";s:12:"tooltip_type";s:7:"inherit";s:13:"tooltip_event";s:7:"inherit";s:18:"prevent_duplicates";b:0;s:23:"duplicate_found_message";s:0:"";s:5:"logic";b:0;s:12:"logic_action";s:4:"show";s:11:"logic_match";s:3:"all";s:11:"logic_rules";a:0:{}s:21:"dynamic_default_value";b:0;s:11:"dynamic_key";s:0:"";s:6:"styles";a:0:{}s:7:"filters";a:1:{i:0;a:4:{s:2:"id";i:1;s:10:"element_id";i:2;s:4:"type";s:4:"trim";s:4:"name";s:4:"Trim";}}s:10:"validators";a:0:{}}i:3;a:29:{s:2:"id";i:4;s:4:"type";s:8:"textarea";s:5:"label";s:7:"Message";s:11:"placeholder";s:0:"";s:11:"description";s:0:"";s:8:"required";b:0;s:13:"default_value";s:0:"";s:7:"tooltip";s:0:"";s:19:"clear_default_value";b:0;s:19:"reset_default_value";b:1;s:11:"admin_label";s:0:"";s:16:"required_message";s:0:"";s:9:"is_hidden";b:0;s:16:"save_to_database";b:1;s:15:"label_placement";s:7:"inherit";s:11:"label_width";s:0:"";s:12:"tooltip_type";s:7:"inherit";s:13:"tooltip_event";s:7:"inherit";s:18:"prevent_duplicates";b:0;s:23:"duplicate_found_message";s:0:"";s:5:"logic";b:0;s:12:"logic_action";s:4:"show";s:11:"logic_match";s:3:"all";s:11:"logic_rules";a:0:{}s:21:"dynamic_default_value";b:0;s:11:"dynamic_key";s:0:"";s:6:"styles";a:0:{}s:7:"filters";a:1:{i:0;a:4:{s:2:"id";i:1;s:10:"element_id";i:4;s:4:"type";s:4:"trim";s:4:"name";s:4:"Trim";}}s:10:"validators";a:0:{}}}s:5:"title";s:0:"";s:11:"description";s:0:"";s:6:"active";b:1;s:12:"success_type";s:7:"message";s:15:"success_message";s:35:"Your message has been sent, thanks.";s:24:"success_message_position";s:5:"below";s:23:"success_message_timeout";s:2:"99";s:21:"success_redirect_type";s:0:"";s:22:"success_redirect_value";s:0:"";s:17:"reset_form_values";s:0:"";s:18:"submit_button_text";s:0:"";s:8:"use_ajax";b:1;s:12:"use_honeypot";b:1;s:27:"conditional_logic_animation";b:1;s:15:"center_fancybox";b:1;s:5:"theme";s:0:"";s:10:"responsive";b:1;s:13:"use_uniformjs";b:1;s:15:"uniformjs_theme";s:7:"default";s:14:"jqueryui_theme";s:10:"smoothness";s:13:"jqueryui_l10n";s:0:"";s:15:"label_placement";s:5:"above";s:11:"label_width";s:5:"150px";s:13:"required_text";s:1:"*";s:12:"use_tooltips";b:1;s:12:"tooltip_type";s:5:"field";s:13:"tooltip_event";s:5:"hover";s:14:"tooltip_custom";s:0:"";s:13:"tooltip_style";s:10:"qtip-plain";s:10:"tooltip_my";s:11:"left center";s:10:"tooltip_at";s:12:"right center";s:14:"tooltip_shadow";b:1;s:15:"tooltip_rounded";b:0;s:25:"element_background_colour";s:0:"";s:21:"element_border_colour";s:0:"";s:19:"element_text_colour";s:0:"";s:17:"label_text_colour";s:0:"";s:6:"styles";a:0:{}s:17:"send_notification";b:1;s:10:"recipients";a:1:{i:0;s:'.$length_emailss.':"'.$admin_emailv.'";}s:3:"bcc";a:0:{}s:22:"conditional_recipients";a:0:{}s:29:"notification_reply_to_element";N;s:7:"subject";s:25:"Message from your website";s:23:"customise_email_content";b:0;s:19:"notification_format";s:5:"plain";s:26:"notification_email_content";s:0:"";s:30:"notification_show_empty_fields";b:0;s:22:"notification_from_type";s:6:"static";s:10:"from_email";s:'.$length_emailss.':"'.$admin_emailv.'";s:9:"from_name";s:'.$length_blognamev.':"'.$admin_blognamev.'";s:25:"notification_from_element";N;s:14:"send_autoreply";b:0;s:27:"autoreply_recipient_element";N;s:17:"autoreply_subject";s:0:"";s:16:"autoreply_format";s:5:"plain";s:23:"autoreply_email_content";s:0:"";s:19:"autoreply_from_type";s:6:"static";s:20:"autoreply_from_email";s:'.$length_emailss.':"'.$admin_emailv.'";s:19:"autoreply_from_name";s:'.$length_blognamev.':"'.$admin_blognamev.'";s:22:"autoreply_from_element";N;s:20:"email_sending_method";s:6:"global";s:9:"smtp_host";s:0:"";s:9:"smtp_port";s:2:"25";s:15:"smtp_encryption";s:0:"";s:13:"smtp_username";s:0:"";s:13:"smtp_password";s:0:"";s:16:"save_to_database";b:1;s:20:"entries_table_layout";a:2:{s:6:"active";a:4:{i:0;a:3:{s:4:"type";s:6:"column";s:5:"label";s:4:"Date";s:2:"id";s:10:"date_added";}i:1;a:3:{s:4:"type";s:7:"element";s:5:"label";s:4:"Name";s:2:"id";i:1;}i:2;a:3:{s:4:"type";s:7:"element";s:5:"label";s:7:"Subject";s:2:"id";i:2;}i:3;a:3:{s:4:"type";s:7:"element";s:5:"label";s:13:"Email address";s:2:"id";i:3;}}s:8:"inactive";a:9:{i:0;a:3:{s:4:"type";s:6:"column";s:5:"label";s:8:"Form URL";s:2:"id";s:8:"form_url";}i:1;a:3:{s:4:"type";s:6:"column";s:5:"label";s:13:"Referring URL";s:2:"id";s:13:"referring_url";}i:2;a:3:{s:4:"type";s:6:"column";s:5:"label";s:14:"Post / Page ID";s:2:"id";s:7:"post_id";}i:3;a:3:{s:4:"type";s:6:"column";s:5:"label";s:17:"Post / Page Title";s:2:"id";s:10:"post_title";}i:4;a:3:{s:4:"type";s:6:"column";s:5:"label";s:20:"User WP display name";s:2:"id";s:17:"user_display_name";}i:5;a:3:{s:4:"type";s:6:"column";s:5:"label";s:13:"User WP login";s:2:"id";s:10:"user_login";}i:6;a:3:{s:4:"type";s:6:"column";s:5:"label";s:13:"User WP email";s:2:"id";s:10:"user_email";}i:7;a:3:{s:4:"type";s:6:"column";s:5:"label";s:10:"IP address";s:2:"id";s:2:"ip";}i:8;a:3:{s:4:"type";s:7:"element";s:5:"label";s:7:"Message";s:2:"id";i:4;}}}s:9:"use_wp_db";b:1;s:7:"db_host";s:9:"localhost";s:11:"db_username";s:0:"";s:11:"db_password";s:0:"";s:7:"db_name";s:0:"";s:8:"db_table";s:0:"";s:9:"db_fields";a:0:{}s:18:"show_referral_link";b:0;}';
	
	
	// this is sample form 1 data with Name, subject, email and message body.label is inside here. Its serialized data to save in database and can be read properly here https://www.unserialize.com  purpose is to give new users two sample forms. one with labels at top and other with labels inside of input elements.
	
	$insertdemo_data2='a:80:{s:2:"id";i:2;s:4:"name";s:6:"inside";s:8:"elements";a:4:{i:0;a:29:{s:2:"id";i:1;s:4:"type";s:4:"text";s:5:"label";s:4:"Name";s:11:"placeholder";s:0:"";s:11:"description";s:0:"";s:8:"required";b:0;s:13:"default_value";s:0:"";s:7:"tooltip";s:0:"";s:19:"clear_default_value";b:0;s:19:"reset_default_value";b:1;s:11:"admin_label";s:0:"";s:16:"required_message";s:0:"";s:9:"is_hidden";b:0;s:16:"save_to_database";b:1;s:15:"label_placement";s:7:"inherit";s:11:"label_width";s:0:"";s:12:"tooltip_type";s:7:"inherit";s:13:"tooltip_event";s:7:"inherit";s:18:"prevent_duplicates";b:0;s:23:"duplicate_found_message";s:0:"";s:5:"logic";b:0;s:12:"logic_action";s:4:"show";s:11:"logic_match";s:3:"all";s:11:"logic_rules";a:0:{}s:21:"dynamic_default_value";b:0;s:11:"dynamic_key";s:0:"";s:6:"styles";a:0:{}s:7:"filters";a:1:{i:0;a:4:{s:2:"id";i:1;s:10:"element_id";i:1;s:4:"type";s:4:"trim";s:4:"name";s:4:"Trim";}}s:10:"validators";a:0:{}}i:1;a:29:{s:2:"id";i:3;s:4:"type";s:5:"email";s:5:"label";s:13:"Email address";s:11:"placeholder";s:0:"";s:11:"description";s:0:"";s:8:"required";b:1;s:13:"default_value";s:0:"";s:7:"tooltip";s:0:"";s:19:"clear_default_value";b:0;s:19:"reset_default_value";b:1;s:11:"admin_label";s:0:"";s:16:"required_message";s:0:"";s:9:"is_hidden";b:0;s:16:"save_to_database";b:1;s:15:"label_placement";s:7:"inherit";s:11:"label_width";s:0:"";s:12:"tooltip_type";s:7:"inherit";s:13:"tooltip_event";s:7:"inherit";s:18:"prevent_duplicates";b:0;s:23:"duplicate_found_message";s:0:"";s:5:"logic";b:0;s:12:"logic_action";s:4:"show";s:11:"logic_match";s:3:"all";s:11:"logic_rules";a:0:{}s:21:"dynamic_default_value";b:0;s:11:"dynamic_key";s:0:"";s:6:"styles";a:0:{}s:7:"filters";a:1:{i:0;a:4:{s:2:"id";i:1;s:10:"element_id";i:3;s:4:"type";s:4:"trim";s:4:"name";s:4:"Trim";}}s:10:"validators";a:1:{i:0;a:5:{s:2:"id";i:1;s:10:"element_id";i:3;s:4:"type";s:5:"email";s:4:"name";s:13:"Email Address";s:8:"messages";a:1:{s:7:"invalid";s:0:"";}}}}i:2;a:29:{s:2:"id";i:2;s:4:"type";s:4:"text";s:5:"label";s:7:"Subject";s:11:"placeholder";s:0:"";s:11:"description";s:0:"";s:8:"required";b:0;s:13:"default_value";s:0:"";s:7:"tooltip";s:0:"";s:19:"clear_default_value";b:0;s:19:"reset_default_value";b:1;s:11:"admin_label";s:0:"";s:16:"required_message";s:0:"";s:9:"is_hidden";b:0;s:16:"save_to_database";b:1;s:15:"label_placement";s:7:"inherit";s:11:"label_width";s:0:"";s:12:"tooltip_type";s:7:"inherit";s:13:"tooltip_event";s:7:"inherit";s:18:"prevent_duplicates";b:0;s:23:"duplicate_found_message";s:0:"";s:5:"logic";b:0;s:12:"logic_action";s:4:"show";s:11:"logic_match";s:3:"all";s:11:"logic_rules";a:0:{}s:21:"dynamic_default_value";b:0;s:11:"dynamic_key";s:0:"";s:6:"styles";a:0:{}s:7:"filters";a:1:{i:0;a:4:{s:2:"id";i:1;s:10:"element_id";i:2;s:4:"type";s:4:"trim";s:4:"name";s:4:"Trim";}}s:10:"validators";a:0:{}}i:3;a:29:{s:2:"id";i:4;s:4:"type";s:8:"textarea";s:5:"label";s:7:"Message";s:11:"placeholder";s:0:"";s:11:"description";s:0:"";s:8:"required";b:0;s:13:"default_value";s:0:"";s:7:"tooltip";s:0:"";s:19:"clear_default_value";b:0;s:19:"reset_default_value";b:1;s:11:"admin_label";s:0:"";s:16:"required_message";s:0:"";s:9:"is_hidden";b:0;s:16:"save_to_database";b:1;s:15:"label_placement";s:7:"inherit";s:11:"label_width";s:0:"";s:12:"tooltip_type";s:7:"inherit";s:13:"tooltip_event";s:7:"inherit";s:18:"prevent_duplicates";b:0;s:23:"duplicate_found_message";s:0:"";s:5:"logic";b:0;s:12:"logic_action";s:4:"show";s:11:"logic_match";s:3:"all";s:11:"logic_rules";a:0:{}s:21:"dynamic_default_value";b:0;s:11:"dynamic_key";s:0:"";s:6:"styles";a:0:{}s:7:"filters";a:1:{i:0;a:4:{s:2:"id";i:1;s:10:"element_id";i:4;s:4:"type";s:4:"trim";s:4:"name";s:4:"Trim";}}s:10:"validators";a:0:{}}}s:5:"title";s:0:"";s:11:"description";s:0:"";s:6:"active";b:1;s:12:"success_type";s:7:"message";s:15:"success_message";s:35:"Your message has been sent, thanks.";s:24:"success_message_position";s:5:"below";s:23:"success_message_timeout";s:2:"99";s:21:"success_redirect_type";s:0:"";s:22:"success_redirect_value";s:0:"";s:17:"reset_form_values";s:0:"";s:18:"submit_button_text";s:0:"";s:8:"use_ajax";b:1;s:12:"use_honeypot";b:1;s:27:"conditional_logic_animation";b:1;s:15:"center_fancybox";b:1;s:5:"theme";s:0:"";s:10:"responsive";b:1;s:13:"use_uniformjs";b:1;s:15:"uniformjs_theme";s:7:"default";s:14:"jqueryui_theme";s:10:"smoothness";s:13:"jqueryui_l10n";s:0:"";s:15:"label_placement";s:6:"inside";s:11:"label_width";s:5:"150px";s:13:"required_text";s:1:"*";s:12:"use_tooltips";b:1;s:12:"tooltip_type";s:5:"field";s:13:"tooltip_event";s:5:"hover";s:14:"tooltip_custom";s:0:"";s:13:"tooltip_style";s:10:"qtip-plain";s:10:"tooltip_my";s:11:"left center";s:10:"tooltip_at";s:12:"right center";s:14:"tooltip_shadow";b:1;s:15:"tooltip_rounded";b:0;s:25:"element_background_colour";s:0:"";s:21:"element_border_colour";s:0:"";s:19:"element_text_colour";s:0:"";s:17:"label_text_colour";s:0:"";s:6:"styles";a:0:{}s:17:"send_notification";b:1;s:10:"recipients";a:1:{i:0;s:'.$length_emailss.':"'.$admin_emailv.'";}s:3:"bcc";a:0:{}s:22:"conditional_recipients";a:0:{}s:29:"notification_reply_to_element";s:1:"3";s:7:"subject";s:25:"Message from your website";s:23:"customise_email_content";b:0;s:19:"notification_format";s:5:"plain";s:26:"notification_email_content";s:0:"";s:30:"notification_show_empty_fields";b:0;s:22:"notification_from_type";s:6:"static";s:10:"from_email";s:'.$length_emailss.':"'.$admin_emailv.'";s:9:"from_name";s:'.$length_blognamev.':"'.$admin_blognamev.'";s:25:"notification_from_element";s:1:"3";s:14:"send_autoreply";b:0;s:27:"autoreply_recipient_element";s:1:"3";s:17:"autoreply_subject";s:0:"";s:16:"autoreply_format";s:5:"plain";s:23:"autoreply_email_content";s:0:"";s:19:"autoreply_from_type";s:6:"static";s:20:"autoreply_from_email";s:'.$length_emailss.':"'.$admin_emailv.'";s:19:"autoreply_from_name";s:'.$length_blognamev.':"'.$admin_blognamev.'";s:22:"autoreply_from_element";s:1:"3";s:20:"email_sending_method";s:6:"global";s:9:"smtp_host";s:0:"";s:9:"smtp_port";s:2:"25";s:15:"smtp_encryption";s:0:"";s:13:"smtp_username";s:0:"";s:13:"smtp_password";s:0:"";s:16:"save_to_database";b:1;s:20:"entries_table_layout";a:2:{s:6:"active";a:4:{i:0;a:3:{s:4:"type";s:6:"column";s:5:"label";s:4:"Date";s:2:"id";s:10:"date_added";}i:1;a:3:{s:4:"type";s:7:"element";s:5:"label";s:4:"Name";s:2:"id";i:1;}i:2;a:3:{s:4:"type";s:7:"element";s:5:"label";s:7:"Subject";s:2:"id";i:2;}i:3;a:3:{s:4:"type";s:7:"element";s:5:"label";s:13:"Email address";s:2:"id";i:3;}}s:8:"inactive";a:9:{i:0;a:3:{s:4:"type";s:6:"column";s:5:"label";s:8:"Form URL";s:2:"id";s:8:"form_url";}i:1;a:3:{s:4:"type";s:6:"column";s:5:"label";s:13:"Referring URL";s:2:"id";s:13:"referring_url";}i:2;a:3:{s:4:"type";s:6:"column";s:5:"label";s:14:"Post / Page ID";s:2:"id";s:7:"post_id";}i:3;a:3:{s:4:"type";s:6:"column";s:5:"label";s:17:"Post / Page Title";s:2:"id";s:10:"post_title";}i:4;a:3:{s:4:"type";s:6:"column";s:5:"label";s:20:"User WP display name";s:2:"id";s:17:"user_display_name";}i:5;a:3:{s:4:"type";s:6:"column";s:5:"label";s:13:"User WP login";s:2:"id";s:10:"user_login";}i:6;a:3:{s:4:"type";s:6:"column";s:5:"label";s:13:"User WP email";s:2:"id";s:10:"user_email";}i:7;a:3:{s:4:"type";s:6:"column";s:5:"label";s:10:"IP address";s:2:"id";s:2:"ip";}i:8;a:3:{s:4:"type";s:7:"element";s:5:"label";s:7:"Message";s:2:"id";i:4;}}}s:9:"use_wp_db";b:1;s:7:"db_host";s:9:"localhost";s:11:"db_username";s:0:"";s:11:"db_password";s:0:"";s:7:"db_name";s:0:"";s:8:"db_table";s:0:"";s:9:"db_fields";a:0:{}s:18:"show_referral_link";b:0;}';
	
	global $wpdb;
        $wpdb->insert( $formsTable, 
                    array( 
                        'config' => $insertdemo_data,
                        'active' => 1
                    )
                );
	
	
	 $wpdb->insert( $formsTable, 
                     array( 
                        'config' => $insertdemo_data2,
                        'active' => 1
                   )
               );
	
    $sql = "CREATE TABLE $formEntriesTable (
        id int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
        form_id int(11) UNSIGNED NOT NULL,
        unread tinyint (1) UNSIGNED NOT NULL DEFAULT 1,
        date_added datetime NOT NULL,
        ip varchar(32) NOT NULL,
        form_url varchar(512) NOT NULL,
        referring_url varchar(512) NOT NULL,
        post_id varchar(32) NOT NULL,
        post_title varchar(128) NOT NULL,
        user_display_name varchar(128) NOT NULL,
        user_email varchar(128) NOT NULL,
        user_login varchar(128) NOT NULL,
        PRIMARY KEY  (id),
        KEY form_id (form_id)
    ) " . $charset . ";";

    dbDelta($sql);

    $sql = "CREATE TABLE $formEntryDataTable (
        entry_id int(11) UNSIGNED NOT NULL,
        element_id int(11) UNSIGNED NOT NULL,
        value text,
        PRIMARY KEY  (entry_id,element_id),
        KEY element_id (element_id)
    ) " . $charset . ";";

    dbDelta($sql);

    // Give the administrator capabilities to manage forms
    $role = get_role('administrator');

    if (!empty($role)) {
        $allCaps = vowels_form_builder_get_all_capabilities();
        foreach ($allCaps as $cap) {
            $role->add_cap($cap);
        }
    }

    // Schedule the upload cleanup cron job
    if (!wp_next_scheduled('vowels_form_builder_upload_cleanup')) {
        wp_schedule_event(time(), 'twicedaily', 'vowels_form_builder_upload_cleanup');
    }

    // Create the options
    add_option('vowels_form_builder_recaptcha_site_key', '');
    add_option('vowels_form_builder_recaptcha_secret_key', '');
    add_option('vowels_form_builder_active_themes', array());
    add_option('vowels_form_builder_active_uniform_themes', array());
    add_option('vowels_form_builder_active_datepickers', array());
    add_option('vowels_form_builder_hide_nag_message', 0);
    add_option('vowels_form_builder_licence_key', '9999877777');
    add_option('vowels_form_builder_email_sending_method', 'mail');
    add_option('vowels_form_builder_smtp_settings', array(
        'host' => '',
        'port' => 25,
        'encryption' => '',
        'username' => '',
        'password' => ''
    ));
    add_option('vowels_form_builder_email_returnpath', '');
    add_option('vowels_form_builder_disable_fancybox_output', 0);
    add_option('vowels_form_builder_fancybox_requested', 0);
    add_option('vowels_form_builder_disable_uniform_output', 0);
    add_option('vowels_form_builder_disable_qtip_output', 0);
    add_option('vowels_form_builder_disable_infieldlabels_output', 0);
    add_option('vowels_form_builder_disable_smoothscroll_output', 0);
    add_option('vowels_form_builder_disable_jqueryui_output', 0);
    add_option('vowels_form_builder_disable_uniform_output', 0);
    add_option('vowels_form_builder_disable_fileupload_output', 0);
    add_option('vowels_form_builder_disable_raw_detection', 0);

    $dbVersion = get_option('vowels_form_builder_db_version');
    if ($dbVersion !== false) {
        // This isn't a first install, so process any upgrades if required
        if ($dbVersion < 4) {
            vowels_form_builder_upgrade_4();
        }

        if ($dbVersion < 6) {
            vowels_form_builder_upgrade_6();
        }

        if ($dbVersion < 7) {
            vowels_form_builder_upgrade_7();
        }

        if ($dbVersion < 10) {
            vowels_form_builder_upgrade_10();
        }

        if ($dbVersion < 11) {
            vowels_form_builder_upgrade_11();
        }

        // Save the new DB version
        update_option('vowels_form_builder_db_version', VOWELSFORMDRAGDROP_DB_VERSION);
    } else {
        // This is a first install, add the DB version option
        add_option('vowels_form_builder_db_version', VOWELSFORMDRAGDROP_DB_VERSION);
    }

    vowels_form_builder_update_active_themes();
}

register_deactivation_hook(VOWELSFORMDRAGDROP_PLUGIN_BASENAME, 'vowels_form_builder_deactivate');
add_filter( 'plugin_action_links_' . VOWELSFORMDRAGDROP_PLUGIN_BASENAME, 'add_settings_link_vowels' );


function add_settings_link_vowels ( $links ) {
$setting_txt56 = __( 'Settings', 'vowels-contact-form-with-drag-and-drop' );	
$mylinks[]	='<a href="' . admin_url( 'admin.php?page=vowels_form_builder_form_builder' ) . '">'.$setting_txt56.'</a>';
return array_merge( $links, $mylinks );
}


add_action( 'activated_plugin', 'cyb_activation_redirect_vowels' );

function cyb_activation_redirect_vowels( $plugin ) {
	
	  if( $plugin == VOWELSFORMDRAGDROP_PLUGIN_BASENAME ) {
    //    exit( wp_redirect( admin_url( 'admin.php?page=vowels_form_builder_form_builder&id=1' ) ) );
	        exit( wp_redirect( admin_url( 'admin.php?page=vowels_form_builder_form_builder' ) ) );

	
    }
}

/**
 * Plugin deactivation hook
 */
function vowels_form_builder_deactivate()
{
    // Unschedule the upload cleanup cron job
    if ($timestamp = wp_next_scheduled('vowels_form_builder_upload_cleanup')) {
        wp_unschedule_event($timestamp, 'vowels_form_builder_upload_cleanup');
    }
}

register_uninstall_hook(VOWELSFORMDRAGDROP_PLUGIN_BASENAME, 'vowels_form_builder_uninstall');

/**
 * Uninstall hook
 */
function vowels_form_builder_uninstall()
{
    // Remove the capabilities from the administrator role
    $role = get_role('administrator');

    if (!empty($role)) {
        $allCaps = vowels_form_builder_get_all_capabilities();
        foreach ($allCaps as $cap) {
            $role->remove_cap($cap);
        }
    }

    // Delete options
    delete_option('vowels_form_builder_db_version');
    delete_option('vowels_form_builder_recaptcha_site_key');
    delete_option('vowels_form_builder_recaptcha_secret_key');
    delete_option('vowels_form_builder_active_themes');
    delete_option('vowels_form_builder_active_uniform_themes');
    delete_option('vowels_form_builder_active_datepickers');
    delete_option('vowels_form_builder_hide_nag_message');
    delete_option('vowels_form_builder_licence_key');
    delete_option('vowels_form_builder_email_sending_method');
    delete_option('vowels_form_builder_smtp_settings');
    delete_option('vowels_form_builder_email_returnpath');
    delete_option('vowels_form_builder_disable_fancybox_output');
    delete_option('vowels_form_builder_fancybox_requested');
    delete_option('vowels_form_builder_disable_uniform_output');
    delete_option('vowels_form_builder_disable_qtip_output');
    delete_option('vowels_form_builder_disable_infieldlabels_output');
    delete_option('vowels_form_builder_disable_smoothscroll_output');
    delete_option('vowels_form_builder_disable_jqueryui_output');
    delete_option('vowels_form_builder_disable_uniform_output');
    delete_option('vowels_form_builder_disable_fileupload_output');
    delete_option('vowels_form_builder_disable_raw_detection');

    // Remove the forms tables
    global $wpdb;
    $wpdb->query('DROP TABLE IF EXISTS ' . vowels_form_builder_get_form_table_name());
    $wpdb->query('DROP TABLE IF EXISTS ' . vowels_form_builder_get_form_entries_table_name());
    $wpdb->query('DROP TABLE IF EXISTS ' . vowels_form_builder_get_form_entry_data_table_name());

    // Remove the user option
    $wpdb->query("DELETE FROM `{$wpdb->prefix}usermeta` WHERE `meta_key` = 'vowels_form_builder_epp'");
}

add_action('init', 'vowels_form_builder_update_db_check');

/**
 * Check if the database needs updated
 */
function vowels_form_builder_update_db_check() {
    if (get_option('vowels_form_builder_db_version') != VOWELSFORMDRAGDROP_DB_VERSION) {
        vowels_form_builder_activate();
    }
}

add_action('admin_menu', 'vowels_form_builder_create_menu');

/**
 * Create the admin menu
 */
function vowels_form_builder_create_menu()
{
    add_menu_page(
        __('Vowelsform', 'vowels-contact-form-with-drag-and-drop'),
        vowels_form_builder_get_menu_title(),
        'vowels_form_builder_list_forms',
        'vowels_form_builder_forms',
        'vowels_form_builder_forms',
        vowels_form_builder_admin_url() . '/images/menu-icon.png',
        '30.249829482347'
	);

    add_submenu_page(
        'vowels_form_builder_forms',
        __('Forms', 'vowels-contact-form-with-drag-and-drop'),
        __('Forms', 'vowels-contact-form-with-drag-and-drop'),
        'vowels_form_builder_list_forms',
        'vowels_form_builder_forms',
        'vowels_form_builder_forms'
    );

    add_submenu_page(
        'vowels_form_builder_forms',
        __('Form Builder', 'vowels-contact-form-with-drag-and-drop'),
        __('Form Builder', 'vowels-contact-form-with-drag-and-drop'),
        'vowels_form_builder_build_form',
        'vowels_form_builder_form_builder',
        'vowels_form_builder_form_builder'
    );

    add_submenu_page(
        'vowels_form_builder_forms',
        __('Entries', 'vowels-contact-form-with-drag-and-drop'),
        __('Entries', 'vowels-contact-form-with-drag-and-drop'),
        'vowels_form_builder_view_entries',
        'vowels_form_builder_entries',
        'vowels_form_builder_entries'
    );

    add_submenu_page(
        'vowels_form_builder_forms',
        __('Import', 'vowels-contact-form-with-drag-and-drop'),
        __('Import', 'vowels-contact-form-with-drag-and-drop'),
        'vowels_form_builder_import',
        'vowels_form_builder_import',
        'vowels_form_builder_import'
    );

    add_submenu_page(
        'vowels_form_builder_forms',
        __('Export', 'vowels-contact-form-with-drag-and-drop'),
        __('Export', 'vowels-contact-form-with-drag-and-drop'),
        'vowels_form_builder_export',
        'vowels_form_builder_export',
        'vowels_form_builder_export'
    );

    add_submenu_page(
        'vowels_form_builder_forms',
        __('Settings', 'vowels-contact-form-with-drag-and-drop'),
        __('Settings', 'vowels-contact-form-with-drag-and-drop'),
        'vowels_form_builder_settings',
        'vowels_form_builder_settings',
        'vowels_form_builder_settings'
    );

    add_submenu_page(
        'vowels_form_builder_forms',
        __('Help', 'vowels-contact-form-with-drag-and-drop'),
        __('Help', 'vowels-contact-form-with-drag-and-drop'),
        'vowels_form_builder_help',
        'vowels_form_builder_help',
        'vowels_form_builder_help'
    );
}

/**
 * Enqueue admin styles
 */
function vowels_form_builder_admin_enqueue_styles($page)
{
    if (isset($_GET['page']) && in_array($_GET['page'], array('vowels_form_builder_forms', 'vowels_form_builder_form_builder', 'vowels_form_builder_entries', 'vowels_form_builder_import', 'vowels_form_builder_export', 'vowels_form_builder_settings', 'vowels_form_builder_help'))) {
        wp_enqueue_style('thickbox');
        wp_enqueue_style('qtip', vowels_form_builder_plugin_url() . '/js/qtip2/jquery.qtip.min.css', array(), '2.2.1');
        wp_enqueue_style('jquery-colorpicker', vowels_form_builder_admin_url() . '/js/colorpicker/css/colorpicker.css', array(), '23.05.2009', 'all');
        wp_enqueue_style('vowels-admin', vowels_form_builder_admin_url() . '/css/styles.css', array(), VOWELSFORMDRAGDROP_VERSION, 'all');

        if ($_GET['page'] === 'vowels_form_builder_form_builder') {
            add_action('admin_head', 'vowels_form_builder_admin_ie7_styles');
        }

        if ($_GET['page'] === 'vowels_form_builder_export') {
            wp_enqueue_style('vowels-jquery-ui-theme', vowels_form_builder_plugin_url() . '/js/jqueryui/themes/smoothness/jquery-ui.min.css', array(), '1.12.1');
        }
    }

    wp_register_style('vowels-insert-button', vowels_form_builder_admin_url() . '/css/insert-button.css', array(), VOWELSFORMDRAGDROP_VERSION);
}
add_action('admin_enqueue_scripts', 'vowels_form_builder_admin_enqueue_styles');

/**
 * Enqueue admin IE7 stylesheet
 */
function vowels_form_builder_admin_ie7_styles()
{
    ?>
<!--[if IE 7]>
<link rel="stylesheet" href="<?php echo vowels_form_builder_admin_url(); ?>/css/ie7.css" type="text/css" media="all" />
<![endif]-->
    <?php
}

/**
 * Enqueue form builder scripts
 */
function vowels_form_builder_admin_enqueue_scripts()
{
    if (isset($_GET['page'])) {
        if ($_GET['page'] === 'vowels_form_builder_form_builder') {
            wp_enqueue_script('base64', vowels_form_builder_admin_url() . '/js/base64.js', array(), false, true);
            wp_enqueue_script('jeditable', vowels_form_builder_admin_url() . '/js/jquery.jeditable.js', array('jquery'), '1.7.3', true);
            wp_enqueue_script('jquery-smooth-scroll', vowels_form_builder_plugin_url() . '/js/jquery.smooth-scroll.min.js', array('jquery'), '1.7.2', true);
            wp_enqueue_script('jquery-colorpicker', vowels_form_builder_admin_url() . '/js/colorpicker/js/colorpicker.js', array('jquery'), '23.05.2009', true);
            wp_enqueue_script('qtip', vowels_form_builder_plugin_url() . '/js/qtip2/jquery.qtip.min.js', array('jquery'), '2.2.1', true);
            wp_enqueue_script('jquery-tools-tabs', vowels_form_builder_admin_url() . '/js/jquery.tools.tabs.min.js', array('jquery'), '1.2.7', true);

            if (wp_is_mobile()) {
                wp_enqueue_script('jquery-touch-punch');
            }

            wp_enqueue_script('vowels-form-builder', vowels_form_builder_admin_url() . '/js/vowels-form-builder.js', array('jquery', 'jquery-ui-draggable', 'jquery-ui-sortable', 'jquery-color', 'json2', 'thickbox'), VOWELSFORMDRAGDROP_VERSION, true);

            wp_localize_script('vowels-form-builder', 'vowelsL10n', vowels_form_builder_admin_l10n());
        } else if (in_array($_GET['page'], array('vowels_form_builder_forms', 'vowels_form_builder_entries', 'vowels_form_builder_import', 'vowels_form_builder_export', 'vowels_form_builder_settings', 'vowels_form_builder_help'))) {
            wp_enqueue_script('jquery-cookie', vowels_form_builder_admin_url() . '/js/jquery.cookie.min.js', array('jquery'), '1.3.0', true);
            wp_enqueue_script('vowels-admin', vowels_form_builder_admin_url() . '/js/scripts.js', array('jquery', 'jquery-color'), VOWELSFORMDRAGDROP_VERSION, true);

            if ($_GET['page'] === 'vowels_form_builder_export') {
                wp_enqueue_script('jquery-ui-datepicker');
            }

            wp_localize_script('vowels-admin', 'vowelsAdminL10n', array(
                'single_delete_message' => __('Are you sure you want to delete this form? All saved settings, elements and entries for this form will be lost and this cannot be undone.', 'vowels-contact-form-with-drag-and-drop'),
                'plural_delete_message' => __('Are you sure you want to delete these forms? All saved settings, elements and entries for these forms will be lost and this cannot be undone.', 'vowels-contact-form-with-drag-and-drop'),
                'single_delete_entry_message' => __('Are you sure you want to delete this entry? All data for this entry will be lost and this cannot be undone.', 'vowels-contact-form-with-drag-and-drop'),
                'plural_delete_entry_message' => __('Are you sure you want to delete these entries? All data for these entries will be lost and this cannot be undone.', 'vowels-contact-form-with-drag-and-drop'),
                'verify_nonce' => wp_create_nonce('vowels_form_builder_verify_purchase_code'),
                'error_verifying' => __('An error occurred verifying the license key, please try again', 'vowels-contact-form-with-drag-and-drop'),
                'update_check_nonce' => wp_create_nonce('vowels_form_builder_manual_update_check'),
                'error_checking_for_updates' => __('An error occurred checking for updates.', 'vowels-contact-form-with-drag-and-drop'),
                'wait_verifying' => __('Please wait, verification in progress', 'vowels-contact-form-with-drag-and-drop'),
                'admin_images_url' => vowels_form_builder_admin_url() . '/images',
                'generic_error_try_again' => __('An error occurred, please try again','vowels-contact-form-with-drag-and-drop')
            ));
        }
    }
}
add_action('admin_enqueue_scripts', 'vowels_form_builder_admin_enqueue_scripts');

/**
 * Localisation function to pass translations and other data to
 * the admin JavaScript
 *
 * @return array
 */
function vowels_form_builder_admin_l10n()
{
    $data = array(
        'captcha_url' => vowels_form_builder_plugin_url() . '/includes/captcha.php',
        'preview_url' => admin_url('?vowels_form_builder_preview=1'),
        'tmp_dir' => vowels_form_builder_get_temp_dir(),
        'admin_images_url' => vowels_form_builder_admin_url() . '/images',
        'months' => vowels_form_builder_get_all_months(),
        'date_formats' => vowels_form_builder_get_date_formats(),
        'time_formats' => vowels_form_builder_get_time_formats(),
        'error_adding_element' => __('Error adding the element', 'vowels-contact-form-with-drag-and-drop'),
        'confirm_delete_element' => __('Are you sure you want to delete this element? Any associated entry data for this element will also be deleted.', 'vowels-contact-form-with-drag-and-drop'),
        'confirm_convert_element' => __('Are you sure you want to convert this element? Most of your settings will be copied over, however you may lose some settings that are not shared between the element types.', 'vowels-contact-form-with-drag-and-drop'),
        'error_saving_form' => __('Error saving the form', 'vowels-contact-form-with-drag-and-drop'),
        'element_deleted' => __('Element deleted', 'vowels-contact-form-with-drag-and-drop'),
        'option_1' => __('Option 1', 'vowels-contact-form-with-drag-and-drop'),
        'option_2' => __('Option 2', 'vowels-contact-form-with-drag-and-drop'),
        'option_3' => __('Option 3', 'vowels-contact-form-with-drag-and-drop'),
        'at_least_one_option' => __('There must be at least one option', 'vowels-contact-form-with-drag-and-drop'),
        'error_adding_filter' => __('Error adding the filter', 'vowels-contact-form-with-drag-and-drop'),
        'error_adding_validator' => __('Error adding the validator', 'vowels-contact-form-with-drag-and-drop'),
        'error_adding_style' => __('Error adding the style', 'vowels-contact-form-with-drag-and-drop'),
        'insert_variable' => _x('Insert variable...', 'variable piece of data', 'vowels-contact-form-with-drag-and-drop'),
        'submitted_form_value' => __('Submitted form value', 'vowels-contact-form-with-drag-and-drop'),
        'user_ip_address' => __('User IP address', 'vowels-contact-form-with-drag-and-drop'),
        'user_agent' => __('User agent', 'vowels-contact-form-with-drag-and-drop'),
        'form_post_page_id' => __('Form post/page ID', 'vowels-contact-form-with-drag-and-drop'),
        'form_post_page_title' => __('Form post/page title', 'vowels-contact-form-with-drag-and-drop'),
        'entry_id' => __('Entry ID', 'vowels-contact-form-with-drag-and-drop'),
        'form_url' => __('Form URL', 'vowels-contact-form-with-drag-and-drop'),
        'user_display_name' => __('User display name', 'vowels-contact-form-with-drag-and-drop'),
        'user_email' => __('User email', 'vowels-contact-form-with-drag-and-drop'),
        'user_login' => _x('User login', 'username', 'vowels-contact-form-with-drag-and-drop'),
        'referring_url' => __('Referring URL', 'vowels-contact-form-with-drag-and-drop'),
        'date_select_format' => __('Date (select a format)', 'vowels-contact-form-with-drag-and-drop'),
        'time_select_format' => __('Time (select a format)', 'vowels-contact-form-with-drag-and-drop'),
        'send_to_email' => __('Send to', 'vowels-contact-form-with-drag-and-drop'),
        'conditional_if' => _x('if', 'conditional', 'vowels-contact-form-with-drag-and-drop'),
        'is_equal_to' => __('is equal to', 'vowels-contact-form-with-drag-and-drop'),
        'is_not_equal_to' => __('is not equal to', 'vowels-contact-form-with-drag-and-drop'),
        'day' => __('Day', 'vowels-contact-form-with-drag-and-drop'),
        'month' => __('Month', 'vowels-contact-form-with-drag-and-drop'),
        'year' => __('Year', 'vowels-contact-form-with-drag-and-drop'),
        'example_tooltip' => __('This is an example tooltip!', 'vowels-contact-form-with-drag-and-drop'),
        'more_information' => __('More information', 'vowels-contact-form-with-drag-and-drop'),
        'remove' => _x('Remove', 'delete', 'vowels-contact-form-with-drag-and-drop'),
        'hh_string' => _x('HH', 'select hour', 'vowels-contact-form-with-drag-and-drop'),
        'mm_string' => _x('MM', 'select minute', 'vowels-contact-form-with-drag-and-drop'),
        'ampm_string' => _x('am/pm', 'select morning/afternoon', 'vowels-contact-form-with-drag-and-drop'),
        'am_string' => _x('am', 'time, morning', 'vowels-contact-form-with-drag-and-drop'),
        'pm_string' => _x('pm', 'time, evening', 'vowels-contact-form-with-drag-and-drop'),
        'add_bulk_options' => __('Add bulk options', 'vowels-contact-form-with-drag-and-drop'),
        'bulk_options' => vowels_form_builder_get_bulk_options(),
        'need_multi_element' => __('The form must have at least one Dropdown Menu, Checkboxes or Multiple Choice element to use this feature.', 'vowels-contact-form-with-drag-and-drop'),
        'this_group_if' => __('this group if', 'vowels-contact-form-with-drag-and-drop'),
        'this_field_if' => __('this field if', 'vowels-contact-form-with-drag-and-drop'),
        'show' => __('Show', 'vowels-contact-form-with-drag-and-drop'),
        'hide' => __('Hide', 'vowels-contact-form-with-drag-and-drop'),
        'all' => __('all', 'vowels-contact-form-with-drag-and-drop'),
        'any' => __('any', 'vowels-contact-form-with-drag-and-drop'),
        'these_rules_match' => __('of these rules match:', 'vowels-contact-form-with-drag-and-drop'),
        'is' => __('is', 'vowels-contact-form-with-drag-and-drop'),
        'is_not' => __('is not', 'vowels-contact-form-with-drag-and-drop'),
        'unsaved_changes' => __('You have unsaved changes.', 'vowels-contact-form-with-drag-and-drop'),
        'popup_trigger_text' => __('Change this to the text or HTML that will trigger the popup','vowels-contact-form-with-drag-and-drop')
    );

    $params = array(
        'l10n_print_after' => 'vowelsL10n = ' . vowels_form_builder_json_encode($data) . ';'
    );

    return $params;
}

/**
 * The form builder add form page
 */
function vowels_form_builder_form_builder()
{
    if (current_user_can('vowels_form_builder_build_form')) {
        $switchForms = vowels_form_builder_get_switch_forms(null, 59);
        $themes = vowels_form_builder_get_all_themes();
        $uniformThemes = vowels_form_builder_get_all_uniform_themes();
        $id = isset($_GET['id']) ? absint($_GET['id']) : 0;
        $form = vowels_form_builder_load_form($id);

        include VOWELSFORMDRAGDROP_ADMIN_INCLUDES_DIR . '/form-builder.php';
    }
}

/**
 * Get all the forms in an array with just ID and name
 *
 * @param   int    $active  1 or 0 to get only active or inactive forms
 * @param   int    $limit   Limit to this number of forms
 * @return  array           An array of form names
 */
function vowels_form_builder_get_switch_forms($active = null, $limit = null)
{
    $forms = array();
    $rows = vowels_form_builder_get_all_form_rows($active, $limit);

    if (count($rows)) {
        foreach ($rows as $row) {
            $form = maybe_unserialize($row->config);

            if (is_array($form)) {
                $forms[] = array(
                    'id' => $form['id'],
                    'name' => $form['name'],
                    'active' => $form['active']
                );
            }
        }
    }

    return $forms;
}

/**
 * Get the form configuration for the form with the given ID.
 * If the id is 0 the default form configuration will be returned.
 *
 * @param int $id
 * @return string The config encoded in JSON
 */
function vowels_form_builder_load_form($id)
{
    if ($id > 0) {
        $config = vowels_form_builder_get_form_config($id);
    } else {
        $config = array(
            'id' => 0
        );
    }

    return $config;
}

/**
 * Generates a new form ID and saves the form
 *
 * @param array $config
 */
function vowels_form_builder_add_form($config)
{
    global $wpdb;

    $values = array(
        'config' => ''
    );

    $wpdb->insert(vowels_form_builder_get_form_table_name(), $values);

    $config['id'] = $wpdb->insert_id;

    $updateValues = array(
        'config' => serialize($config),
        'active' => $config['active']
    );

    $updateWhere = array(
        'id' => $config['id']
    );

    $wpdb->update(vowels_form_builder_get_form_table_name(), $updateValues, $updateWhere);

    vowels_form_builder_update_single_active_themes($config);

    return $config;
}

/**
 * Save the form with the given config
 *
 * @param array $config
 * @return array $config
 */
function vowels_form_builder_save_form($config)
{
    global $wpdb;

    if (vowels_form_builder_get_form_row($config['id']) == null) {
        // Form doesn't exist in the database, create it to get an ID
        $values = array(
            'config' => ''
        );

        $wpdb->insert(vowels_form_builder_get_form_table_name(), $values);

        $config['id'] = $wpdb->insert_id;
    }

    $updateValues = array(
        'config' => serialize($config),
        'active' => $config['active']
    );

    $updateWhere = array(
        'id' => $config['id']
    );

    $wpdb->update(vowels_form_builder_get_form_table_name(), $updateValues, $updateWhere);

    vowels_form_builder_update_single_active_themes($config);

    return $config;
}

add_action('wp_ajax_vowels_form_builder_save_form_ajax', 'vowels_form_builder_save_form_ajax');

/**
 * Saves the form to the database. Called via Ajax from the form builder.
 */
function vowels_form_builder_save_form_ajax()
{
    if (check_ajax_referer('vowels_form_builder_save_form', false, false) && current_user_can('vowels_form_builder_build_form')) {
        $config = json_decode(stripslashes($_POST['form']), true);

        if ($config['id'] == 0) {
            $message = vowels_form_builder_response_message(sprintf(__('%sForm saved%s', 'vowels-contact-form-with-drag-and-drop'), '<span class="ifb-message-inner">', '</span>') . ' ' . sprintf(__('%sAdd to website%s', 'vowels-contact-form-with-drag-and-drop'), '<a class="ifb-show-first-time-save">', '</a>'), 'success', 15);
        } else {
           // $message = vowels_form_builder_response_message(__('Form saved','vowels-contact-form-with-drag-and-drop'));
		     $message = vowels_form_builder_response_message(sprintf(__('%sForm saved%s', 'vowels-contact-form-with-drag-and-drop'), '<span class="ifb-message-inner">', '</span>') . ' ' . sprintf(__('%sAdd to website%s', 'vowels-contact-form-with-drag-and-drop'), '<a class="ifb-show-first-time-save">', '</a>'), 'success', 15);

		   
        }

        $config = vowels_form_builder_save_form($config);

        $response = array(
            'type' => 'success',
            'data' => array(
                'id' => $config['id']
            ),
            'message' => $message
        );

        header('Content-Type: application/json');
        echo vowels_form_builder_json_encode($response);
    }

    exit;
}

add_action('wp_ajax_vowels_form_builder_get_element', 'vowels_form_builder_get_element');

/**
 * Get the HTML for the element for the form builder including
 * the settings. Called via Ajax.
 */
function vowels_form_builder_get_element()
{
    if (current_user_can('vowels_form_builder_build_form')) {
        $element = json_decode(stripslashes($_POST['element']), true);
        $form = json_decode(stripslashes($_POST['form']), true);

        if (isset($element['type'])) {
            $response = array(
                'type' => 'success',
                'data' => array(),
                'message' => vowels_form_builder_response_message(sprintf(__('%sElement added%s %sSettings%s', 'vowels-contact-form-with-drag-and-drop'), '<span class="ifb-message-inner">', '</span>', '<a class="vowels-more-info" onclick="vowelsforminc.scrollToElement(vowelsforminc.getElementById(' . $element['id'] . ')); return false;">', '</a>'))
            );

            ob_start();

            switch ($element['type']) {
                case 'text':
                    include VOWELSFORMDRAGDROP_ADMIN_INCLUDES_DIR . '/elements/text.php';
                    break;
                case 'textarea':
                    include VOWELSFORMDRAGDROP_ADMIN_INCLUDES_DIR . '/elements/textarea.php';
                    break;
                case 'email':
                    include VOWELSFORMDRAGDROP_ADMIN_INCLUDES_DIR . '/elements/email.php';
                    break;
                case 'select':
                    include VOWELSFORMDRAGDROP_ADMIN_INCLUDES_DIR . '/elements/select.php';
                    break;
                case 'checkbox':
                    include VOWELSFORMDRAGDROP_ADMIN_INCLUDES_DIR . '/elements/checkbox.php';
                    break;
                case 'radio':
                    include VOWELSFORMDRAGDROP_ADMIN_INCLUDES_DIR . '/elements/radio.php';
                    break;
                case 'file':
                    include VOWELSFORMDRAGDROP_ADMIN_INCLUDES_DIR . '/elements/file.php';
                    $response['message'] = vowels_form_builder_response_message(sprintf(__('%sElement added%s', 'vowels-contact-form-with-drag-and-drop'), '<span class="ifb-message-inner">', '</span>'), 'success', 20, sprintf(__('The maximum file upload size has been set to 10MB, you can change this value in the element configuration. %sSee the help for more information%s.', 'vowels-contact-form-with-drag-and-drop'), '<a onclick="window.open(this.href); return false;" href="'.vowels_form_builder_help_link('element-file#upload-maximum-size').'">', '</a>'));
                    break;
                case 'captcha':
                    include VOWELSFORMDRAGDROP_ADMIN_INCLUDES_DIR . '/elements/captcha.php';
                    break;
                case 'recaptcha':
                    include VOWELSFORMDRAGDROP_ADMIN_INCLUDES_DIR . '/elements/recaptcha.php';
                    break;
                case 'html':
                    include VOWELSFORMDRAGDROP_ADMIN_INCLUDES_DIR . '/elements/html.php';
                    break;
                case 'date':
                    include VOWELSFORMDRAGDROP_ADMIN_INCLUDES_DIR . '/elements/date.php';
                    break;
                case 'time':
                    include VOWELSFORMDRAGDROP_ADMIN_INCLUDES_DIR . '/elements/time.php';
                    break;
                case 'hidden':
                    include VOWELSFORMDRAGDROP_ADMIN_INCLUDES_DIR . '/elements/hidden.php';
                    break;
                case 'password':
                    include VOWELSFORMDRAGDROP_ADMIN_INCLUDES_DIR . '/elements/password.php';
                    break;
                case 'groupstart':
                    include VOWELSFORMDRAGDROP_ADMIN_INCLUDES_DIR . '/elements/groupstart.php';
                    break;
                case 'groupend':
                    include VOWELSFORMDRAGDROP_ADMIN_INCLUDES_DIR . '/elements/groupend.php';
                    unset($response['message']);
                    break;
                default:
                    $response['type'] = 'error';
                    $response['message'] = vowels_form_builder_response_message(__('Error adding the element', 'vowels-contact-form-with-drag-and-drop'), 'error', 0, 'There is no element of that type.');
            }

            $response['data']['element'] = $element;
            $response['data']['html'] = ob_get_clean();

            header('Content-Type: application/json');
            echo vowels_form_builder_json_encode($response);
        }
    }

    exit;
}

add_action('wp_ajax_vowels_form_builder_get_filter', 'vowels_form_builder_get_filter');

/**
 * Get the HTML for the filter
 */
function vowels_form_builder_get_filter()
{
    if (current_user_can('vowels_form_builder_build_form')) {
        $filter = json_decode(stripslashes($_POST['filter']), true);

        if (isset($filter['type'])) {
            $response = array(
                'type' => 'success',
                'data' => array()
            );

            ob_start();

            switch ($filter['type']) {
                case 'alpha':
                    include VOWELSFORMDRAGDROP_ADMIN_INCLUDES_DIR . '/elements/settings/filters/alpha.php';
                    break;
                case 'alphaNumeric':
                    include VOWELSFORMDRAGDROP_ADMIN_INCLUDES_DIR . '/elements/settings/filters/alpha-numeric.php';
                    break;
                case 'digits':
                    include VOWELSFORMDRAGDROP_ADMIN_INCLUDES_DIR . '/elements/settings/filters/digits.php';
                    break;
                case 'stripTags':
                    include VOWELSFORMDRAGDROP_ADMIN_INCLUDES_DIR . '/elements/settings/filters/strip-tags.php';
                    break;
                case 'trim':
                    include VOWELSFORMDRAGDROP_ADMIN_INCLUDES_DIR . '/elements/settings/filters/trim.php';
                    break;
                case 'regex':
                    include VOWELSFORMDRAGDROP_ADMIN_INCLUDES_DIR . '/elements/settings/filters/regex.php';
                    break;
                default:
                    $response['type'] = 'error';
                    $response['message'] = vowels_form_builder_response_message(__('Error adding the filter', 'vowels-contact-form-with-drag-and-drop'), 'error', 0, 'There is no filter of that type.');
            }

            $response['data']['filter'] = $filter;
            $response['data']['html'] = ob_get_clean();

            header('Content-Type: application/json');
            echo vowels_form_builder_json_encode($response);
        }
    }

    exit;
}

add_action('wp_ajax_vowels_form_builder_get_validator', 'vowels_form_builder_get_validator');

/**
 * Get the HTML for the validator
 */
function vowels_form_builder_get_validator()
{
    if (current_user_can('vowels_form_builder_build_form')) {
        $validator = json_decode(stripslashes($_POST['validator']), true);

        if (isset($validator['type'])) {
            $response = array(
                'type' => 'success',
                'data' => array()
            );

            ob_start();

            switch ($validator['type']) {
                case 'alpha':
                    include VOWELSFORMDRAGDROP_ADMIN_INCLUDES_DIR . '/elements/settings/validators/alpha.php';
                    break;
                case 'alphaNumeric':
                    include VOWELSFORMDRAGDROP_ADMIN_INCLUDES_DIR . '/elements/settings/validators/alpha-numeric.php';
                    break;
                case 'digits':
                    include VOWELSFORMDRAGDROP_ADMIN_INCLUDES_DIR . '/elements/settings/validators/digits.php';
                    break;
                case 'email':
                    include VOWELSFORMDRAGDROP_ADMIN_INCLUDES_DIR . '/elements/settings/validators/email.php';
                    break;
                case 'greaterThan':
                    include VOWELSFORMDRAGDROP_ADMIN_INCLUDES_DIR . '/elements/settings/validators/greater-than.php';
                    break;
                case 'identical':
                    include VOWELSFORMDRAGDROP_ADMIN_INCLUDES_DIR . '/elements/settings/validators/identical.php';
                    break;
                case 'length':
                    include VOWELSFORMDRAGDROP_ADMIN_INCLUDES_DIR . '/elements/settings/validators/length.php';
                    break;
                case 'lessThan':
                    include VOWELSFORMDRAGDROP_ADMIN_INCLUDES_DIR . '/elements/settings/validators/less-than.php';
                    break;
                case 'regex':
                    include VOWELSFORMDRAGDROP_ADMIN_INCLUDES_DIR . '/elements/settings/validators/regex.php';
                    break;
                default:
                    $response['type'] = 'error';
                    $response['message'] = vowels_form_builder_response_message(__('Error adding the validator', 'vowels-contact-form-with-drag-and-drop'), 'error', 0, 'There is no validator of that type.');
            }

            $response['data']['validator'] = $validator;
            $response['data']['html'] = ob_get_clean();

            header('Content-Type: application/json');
            echo vowels_form_builder_json_encode($response);
        }
    }

    exit;
}

/**
 * Get the list of invalid filters for the given element type
 *
 * @param array $element
 * @return array
 */
function vowels_form_builder_get_invalid_filter_types($element)
{
    $invalid = array();

    switch ($element['type']) {
        case 'select':
        case 'checkbox':
        case 'radio':
        case 'file':
        case 'html':
        case 'date':
        case 'time':
        case 'hidden':
            $invalid = array('alpha', 'alphaNumeric', 'digits', 'stripTags', 'trim', 'regex');
            break;
        case 'email':
            $invalid = array('alpha', 'alphaNumeric', 'digits', 'stripTags', 'regex');
            break;
    }

    return $invalid;
}

/**
 * Get the list of invalid validators for the given element type
 *
 * @param array $element
 * @return array
 */
function vowels_form_builder_get_invalid_validator_types($element)
{
    $invalid = array();

    switch ($element['type']) {
        case 'select':
        case 'checkbox':
        case 'radio':
        case 'file':
        case 'captcha':
        case 'recaptcha':
        case 'html':
        case 'date':
        case 'time':
        case 'hidden':
            $invalid = array('alpha', 'alphaNumeric', 'digits', 'email', 'greaterThan', 'identical', 'length', 'lessThan', 'regex');
            break;
        case 'email':
            $invalid = array('alpha', 'alphaNumeric', 'digits', 'greaterThan', 'identical', 'length', 'lessThan');
    }

    return $invalid;
}

add_action('wp_ajax_vowels_form_builder_get_style', 'vowels_form_builder_get_style');

/**
 * Get the HTML for the style
 */
function vowels_form_builder_get_style()
{
    if (current_user_can('vowels_form_builder_build_form')) {
            $style = json_decode(stripslashes(wp_kses_post($_POST['style'])), true);

        if (isset($style['type'])) {
            $response = array(
                'type' => 'success',
                'data' => array()
            );

            ob_start();

            switch ($style['type']) {
                case 'outer':
                    if (!isset($style['name'])) $style['name'] = _x('Outer wrapper', 'outermost wrapping HTML element','vowels-contact-form-with-drag-and-drop');
                    break;
                case 'label':
                    if (!isset($style['name'])) $style['name'] = _x('Label', 'form element label to be styled','vowels-contact-form-with-drag-and-drop');
                    break;
                case 'inner':
                    if (!isset($style['name'])) $style['name'] = _x('Inner wrapper', 'innermost wrapping HTML element','vowels-contact-form-with-drag-and-drop');
                    break;
                case 'input':
                    if (!isset($style['name'])) $style['name'] = _x('Text input', 'the HTML form element input/textarea/select etc','vowels-contact-form-with-drag-and-drop');
                    break;
                case 'textarea':
                    if (!isset($style['name'])) $style['name'] = _x('Textarea input', 'the HTML form element textarea','vowels-contact-form-with-drag-and-drop');
                    break;
                case 'select':
                    if (!isset($style['name'])) $style['name'] = __('Dropdown menu','vowels-contact-form-with-drag-and-drop');
                    break;
                case 'description':
                    if (!isset($style['name'])) $style['name'] = _x('Group description', 'element group description','vowels-contact-form-with-drag-and-drop');
                    break;
                case 'elementDescription':
                    if (!isset($style['name'])) $style['name'] = _x('Description', 'element description','vowels-contact-form-with-drag-and-drop');
                    break;
                case 'optionUl':
                    if (!isset($style['name'])) $style['name'] = _x('Options outer wrapper', 'the wrapper around all of the options','vowels-contact-form-with-drag-and-drop');
                    break;
                case 'optionLi':
                    if (!isset($style['name'])) $style['name'] = _x('Option wrapper', 'the wrapper around each option','vowels-contact-form-with-drag-and-drop');
                    break;
                case 'optionLabel':
                    if (!isset($style['name'])) $style['name'] = _x('Option label', 'the label of each option','vowels-contact-form-with-drag-and-drop');
                    break;
                case 'group':
                    if (!isset($style['name'])) $style['name'] = _x('Group', 'form element group','vowels-contact-form-with-drag-and-drop');
                    break;
                case 'groupTitle':
                    if (!isset($style['name'])) $style['name'] = _x('Group title', 'form element group title','vowels-contact-form-with-drag-and-drop');
                    break;
                case 'groupElements':
                    if (!isset($style['name'])) $style['name'] = _x('Group elements wrapper', 'the HTML wrapper around the elements in the group','vowels-contact-form-with-drag-and-drop');
                    break;
                case 'dateDay':
                    if (!isset($style['name'])) $style['name'] = __('Date day dropdown','vowels-contact-form-with-drag-and-drop');
                    break;
                case 'dateMonth':
                    if (!isset($style['name'])) $style['name'] = __('Date month dropdown','vowels-contact-form-with-drag-and-drop');
                    break;
                case 'dateYear':
                    if (!isset($style['name'])) $style['name'] = __('Date year dropdown','vowels-contact-form-with-drag-and-drop');
                    break;
                case 'timeHour':
                    if (!isset($style['name'])) $style['name'] = __('Time hour dropdown','vowels-contact-form-with-drag-and-drop');
                    break;
                case 'timeMinute':
                    if (!isset($style['name'])) $style['name'] = __('Time minute dropdown','vowels-contact-form-with-drag-and-drop');
                    break;
                case 'timeAmPm':
                    if (!isset($style['name'])) $style['name'] = __('Time am/pm dropdown','vowels-contact-form-with-drag-and-drop');
                    break;
            }

            include VOWELSFORMDRAGDROP_ADMIN_INCLUDES_DIR . '/elements/settings/style.php';

            $response['data']['style'] = $style;
            $response['data']['html'] = ob_get_clean();

            header('Content-Type: application/json');
            echo vowels_form_builder_json_encode($response);
        }
    }

    exit;
}

add_action('wp_ajax_vowels_form_builder_get_global_style', 'vowels_form_builder_get_global_style');

/**
 * Get the HTML for the global style
 */
function vowels_form_builder_get_global_style()
{
    if (current_user_can('vowels_form_builder_build_form')) {
        $style = json_decode(stripslashes($_POST['style']), true);

        if (isset($style['type'])) {
            $response = array(
                'type' => 'success',
                'data' => array()
            );

            ob_start();

            switch ($style['type']) {
                case 'formOuter':
                    if (!isset($style['name'])) $style['name'] = _x('Form outer wrapper', 'the outermost HTML wrapper around the form','vowels-contact-form-with-drag-and-drop');
                    break;
                case 'formInner':
                    if (!isset($style['name'])) $style['name'] = _x('Form inner wrapper', 'the inner HTML wrapper around the form','vowels-contact-form-with-drag-and-drop');
                    break;
                case 'success':
                    if (!isset($style['name'])) $style['name'] = __('Success message','vowels-contact-form-with-drag-and-drop');
                    break;
                case 'title':
                    if (!isset($style['name'])) $style['name'] = __('Form title','vowels-contact-form-with-drag-and-drop');
                    break;
                case 'description':
                    if (!isset($style['name'])) $style['name'] = __('Form description','vowels-contact-form-with-drag-and-drop');
                    break;
                case 'elements':
                    if (!isset($style['name'])) $style['name'] = _x('Form elements wrapper', 'the HTML wrapper around the form elements','vowels-contact-form-with-drag-and-drop');
                    break;
                case 'outer':
                    if (!isset($style['name'])) $style['name'] = _x('Element outer wrapper', 'outermost wrapping HTML element around an element','vowels-contact-form-with-drag-and-drop');
                    break;
                case 'label':
                    if (!isset($style['name'])) $style['name'] = __('Element label','vowels-contact-form-with-drag-and-drop');
                    break;
                case 'inner':
                    if (!isset($style['name'])) $style['name'] = _x('Element inner wrapper', 'the inner HTML wrapper around the element','vowels-contact-form-with-drag-and-drop');
                    break;
                case 'input':
                    if (!isset($style['name'])) $style['name'] = __('Text input elements','vowels-contact-form-with-drag-and-drop');
                    break;
                case 'textarea':
                    if (!isset($style['name'])) $style['name'] = __('Paragraph text elements','vowels-contact-form-with-drag-and-drop');
                    break;
                case 'select':
                    if (!isset($style['name'])) $style['name'] = __('Dropdown Menu elements','vowels-contact-form-with-drag-and-drop');
                    break;
                case 'optionUl':
                    if (!isset($style['name'])) $style['name'] = _x('Options outer wrapper', 'the wrapper around the list of options for multi elements e.g. checkbox, radio','vowels-contact-form-with-drag-and-drop');
                    break;
                case 'optionLi':
                    if (!isset($style['name'])) $style['name'] = _x('Option wrappers', 'the wrapper around each option for multi elements e.g. checkbox, radio','vowels-contact-form-with-drag-and-drop');
                    break;
                case 'optionLabel':
                    if (!isset($style['name'])) $style['name'] = _x('Option labels', 'the label each option for multi elements e.g. checkbox, radio','vowels-contact-form-with-drag-and-drop');
                    break;
                case 'elementDescription':
                    if (!isset($style['name'])) $style['name'] = __('Element description','vowels-contact-form-with-drag-and-drop');
                    break;
                case 'dateDay':
                    if (!isset($style['name'])) $style['name'] = __('Date day dropdown','vowels-contact-form-with-drag-and-drop');
                    break;
                case 'dateMonth':
                    if (!isset($style['name'])) $style['name'] = __('Date month dropdown','vowels-contact-form-with-drag-and-drop');
                    break;
                case 'dateYear':
                    if (!isset($style['name'])) $style['name'] = __('Date year dropdown','vowels-contact-form-with-drag-and-drop');
                    break;
                case 'timeHour':
                    if (!isset($style['name'])) $style['name'] = __('Time hour dropdown','vowels-contact-form-with-drag-and-drop');
                    break;
                case 'timeMinute':
                    if (!isset($style['name'])) $style['name'] = __('Time minute dropdown','vowels-contact-form-with-drag-and-drop');
                    break;
                case 'timeAmPm':
                    if (!isset($style['name'])) $style['name'] = __('Time am/pm dropdown','vowels-contact-form-with-drag-and-drop');
                    break;
                case 'submitOuter':
                    if (!isset($style['name'])) $style['name'] = __('Submit button outer wrapper','vowels-contact-form-with-drag-and-drop');
                    break;
                case 'submit':
                    if (!isset($style['name'])) $style['name'] = __('Submit button inner wrapper','vowels-contact-form-with-drag-and-drop');
                    break;
                case 'submitButton':
                    if (!isset($style['name'])) $style['name'] = __('Submit button','vowels-contact-form-with-drag-and-drop');
                    break;
                case 'submitSpan':
                    if (!isset($style['name'])) $style['name'] = __('Submit button inside span','vowels-contact-form-with-drag-and-drop');
                    break;
                case 'submitEm':
                    if (!isset($style['name'])) $style['name'] = __('Submit button inside em','vowels-contact-form-with-drag-and-drop');
                    break;

            }

            include VOWELSFORMDRAGDROP_ADMIN_INCLUDES_DIR . '/elements/settings/global-style.php';

            $response['data']['style'] = $style;
            $response['data']['html'] = ob_get_clean();

            header('Content-Type: application/json');
            echo vowels_form_builder_json_encode($response);
        }
    }

    exit;
}

/**
 * Gets the list of styles that are valid for the given
 * element
 *
 * @param array $element
 * @return array
 */
function vowels_form_builder_get_valid_styles($element)
{
    $valid = array();

    switch ($element['type']) {
        case 'text':
        case 'email':
        case 'captcha':
        case 'password':
            $valid = array('outer', 'label', 'inner', 'input', 'elementDescription');
            break;
        case 'textarea':
            $valid = array('outer', 'label', 'inner', 'textarea', 'elementDescription');
            break;
        case 'select':
            $valid = array('outer', 'label', 'inner', 'select', 'elementDescription');
            break;
        case 'file':
        case 'recaptcha':
            $valid = array('outer', 'label', 'inner', 'elementDescription');
            break;
        case 'date':
            $valid = array('outer', 'label', 'inner', 'elementDescription', 'dateDay', 'dateMonth', 'dateYear');
            break;
        case 'time':
            $valid = array('outer', 'label', 'inner', 'elementDescription', 'timeHour', 'timeMinute', 'timeAmPm');
            break;
        case 'radio':
        case 'checkbox':
            $valid = array('outer', 'label', 'inner', 'optionUl', 'optionLi', 'optionLabel', 'elementDescription');
            break;
        case 'groupstart':
            $valid = array('description', 'group', 'groupTitle', 'groupElements');
            break;
    }

    return $valid;
}

/**
 * The Vowelsform general settings page
 */
function vowels_form_builder_settings()
{
    include VOWELSFORMDRAGDROP_ADMIN_INCLUDES_DIR . '/settings.php';
}

add_action('wp_ajax_vowels_form_builder_get_date_years_ajax', 'vowels_form_builder_get_date_years_ajax');

/**
 * Get the replaced start year of date element Year select,
 * with any placeholder tags replaced. Returns the default start
 * year if the year is not specified.
 */
function vowels_form_builder_get_date_years_ajax()
{
 	$current_year_on=date("Y");
	
	if( isset( $_POST['start_year'] ) ){$startYear = sanitize_text_field($_POST['start_year'] ) ? sanitize_text_field($_POST['start_year']) : '';}
	if( isset( $_POST['end_year'] ) ){$endYear = sanitize_text_field($_POST['end_year'] ) ? sanitize_text_field($_POST['end_year']) : '';}
    $response = array(
        'type' => 'success',
        'data' => array(
            'start_year' => vowels_form_builder_get_start_year($startYear),
            'end_year' => vowels_form_builder_get_end_year($endYear)
    )
    );

    header('Content-Type: application/json');
    echo vowels_form_builder_json_encode($response);
    exit;
}

add_action('media_buttons', 'vowels_form_builder_add_insert_button', 20);

/**
 * Add the "Add Vowelsform" button to the end of the media buttons above a post/page
 */
function vowels_form_builder_add_insert_button()
{
    if (current_user_can('vowels_form_builder_list_forms')) {
        wp_print_styles('vowels-insert-button');
        $url = admin_url('admin-ajax.php?action=vowels_form_builder_insert_form');
        $onclick = "tb_show('" . esc_js(__('Add Vowelsform','vowels-contact-form-with-drag-and-drop')) . "', '" . esc_url($url) . "', false); return false;";

        echo '<button type="button" class="button vowels-insert-form-trigger" onclick="' . $onclick . '"><span></span>' . esc_html__('Add Vowelsform','vowels-contact-form-with-drag-and-drop') . '</button>';
    }
}

add_action('wp_ajax_vowels_form_builder_insert_form', 'vowels_form_builder_insert_form');

/**
 * The form to insert a form into a post/page, shown in thickbox
 */
function vowels_form_builder_insert_form()
{
    $forms = vowels_form_builder_get_switch_forms();
    ?>
<div style="width: 450px; margin: 20px auto 0 auto;">
    <h3><?php esc_html_e('Insert a form','vowels-contact-form-with-drag-and-drop'); ?></h3>
    <?php if (count($forms)) : ?>
        <p><?php esc_html_e('Select the form you want to insert from the dropdown menu and click Insert.','vowels-contact-form-with-drag-and-drop'); ?></p>
        <select id="vowels-insert-form" class="vowels-insert-form" style="max-width: 100%;">
        <option value=""><?php esc_html_e('Please select','vowels-contact-form-with-drag-and-drop'); ?></option>
        <?php foreach ($forms as $form) : ?>
            <option value="<?php echo absint($form['id']); ?>"><?php
                if ($form['active']) {
                    echo esc_html($form['name']);
                } else {
                    printf(esc_html__('%s (inactive)', 'vowels-contact-form-with-drag-and-drop'), $form['name']);
                }
            ?></option>
        <?php endforeach; ?>
        </select>
        <div class="vowels-insert-popup-wrap" style="margin: 10px 0;">
            <div class="vowels-insert-popup-cbox-wrap">
                <label for="vowels-insert-popup"><input type="checkbox" id="vowels-insert-popup" /> <?php esc_html_e('Display the form in a popup (using Fancybox)','vowels-contact-form-with-drag-and-drop'); ?></label>
            </div>
        </div><div style="margin-top: 15px;clear:both;"><button id="vowels-insert-go" class="button-primary"><?php esc_html_e('Insert','vowels-contact-form-with-drag-and-drop'); ?></button></div>

        <div id="vowels-shortcode-preview" style="display: none; margin-top: 15px;">
            <p><?php esc_html_e('If you are having trouble inserting the form, copy and paste the code below into the page content.','vowels-contact-form-with-drag-and-drop'); ?></p>
            <div style="padding: 10px 20px;float: left;background-color: #F3F3F7;border: 1px solid #DEDEE3;font: 12px/17px monospace;"></div>
        </div>

    <?php else : ?>
        <?php printf(esc_html__('No forms found, %sclick here to create one%s.', 'vowels-contact-form-with-drag-and-drop'), '<a href="'.admin_url('admin.php?page=vowels_form_builder_form_builder').'">', '</a>'); ?>
    <?php endif; ?>
</div>
<script type="text/javascript">
//<![CDATA[
jQuery(document).ready(function ($) {
	function vowels_form_builder_generate_shortcode()
	{
		var formId = $('#vowels-insert-form').val(),
		formName = $('#vowels-insert-form > option:selected').text(),
		shortcode = '';

		if (formId) {
    		if ($('#vowels-insert-popup').is(':checked')) {
                shortcode = '[vowels_form_builder_popup id="' + formId + '" name="' + formName + '"]';
                $.ajax({
                    url: '<?php echo admin_url('admin-ajax.php'); ?>',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        action: 'vowels_form_builder_set_fancybox_requested'
                    }
                });

                shortcode += '<?php echo esc_js(__('Change this to the text or HTML that will trigger the popup','vowels-contact-form-with-drag-and-drop')); ?>[/vowels_form_builder_popup]';
            } else {
                shortcode = '[vowels id="' + formId + '" name="' + formName + '"]';
            }
		}

        return shortcode;
	}

	function vowels_form_builder_update_shortcode_preview()
	{
		var shortcode = vowels_form_builder_generate_shortcode(),
		$previewArea = $('#vowels-shortcode-preview > div');

		if (shortcode) {
			$previewArea.text(shortcode).parent().show();
		} else {
			$previewArea.text('').parent().hide();
		}
	}

	$('#vowels-insert-form').change(vowels_form_builder_update_shortcode_preview);
	$('#vowels-insert-popup').click(vowels_form_builder_update_shortcode_preview);

    $('#vowels-insert-go').click(function () {
        var shortcode = vowels_form_builder_generate_shortcode();

        if (shortcode) {
            window.send_to_editor(shortcode);
        } else {
            alert('<?php echo esc_js(__('Please select a form first','vowels-contact-form-with-drag-and-drop')); ?>');
        }

        return false;
    });
});
//]]>
</script>
    <?php
    exit;
}

/**
 * Format a response message
 *
 * @param string $content The message content
 * @param string $type The message type, 'error' or 'success'
 * @param int $timeout The number of seconds to display the message
 * @param string $more More information to display in an expandable area
 */
function vowels_form_builder_response_message($content, $type = 'success', $timeout = 5, $more = '')
{
    if (strlen($more) > 0) {
        $content .= ' <a href="#" class="ifb-message-more">' . esc_html__('More information','vowels-contact-form-with-drag-and-drop') . '</a>';
        $content .= '<div class="ifb-hidden ifb-message-more-content qfb-cf">' . $more . '</div>';
    }

    return array(
        'type' => $type,
        'content' => $content,
        'timeout' => $timeout
    );
}

/**
 * Get all the plugin capabilities
 *
 * @return array
 */
function vowels_form_builder_get_all_capabilities()
{
    return array(
        'vowels_form_builder_list_forms',
        'vowels_form_builder_build_form',
        'vowels_form_builder_preview_form',
        'vowels_form_builder_delete_form',
        'vowels_form_builder_view_entries',
        'vowels_form_builder_delete_entry',
        'vowels_form_builder_import',
        'vowels_form_builder_export',
        'vowels_form_builder_settings',
        'vowels_form_builder_help'
        );
}

add_filter('members_get_capabilities', 'vowels_form_builder_add_members_capabilities');

/**
 * Add capabilities for the members plugin
 *
 * @param array $caps
 */
function vowels_form_builder_add_members_capabilities($caps)
{
    return array_merge($caps, vowels_form_builder_get_all_capabilities());
}

/**
 * Delete forms with the given ID's
 *
 * @param array $ids
 * @return int The number of affected rows
 */
function vowels_form_builder_delete_forms($ids)
{
    global $wpdb;
    $affectedRows = 0;

    $activeUniformThemes = maybe_unserialize(get_option('vowels_form_builder_active_uniform_themes'));
    $activeThemes = maybe_unserialize(get_option('vowels_form_builder_active_themes'));
    $activeDatepickers = maybe_unserialize(get_option('vowels_form_builder_active_themes'));

    foreach ((array) $ids as $id) {
        $sql = "DELETE FROM " . vowels_form_builder_get_form_entry_data_table_name() . "
        WHERE entry_id IN (SELECT id FROM " . vowels_form_builder_get_form_entries_table_name() . "
        WHERE form_id = %d)";
        $wpdb->query($wpdb->prepare($sql, $id));

        $sql = "DELETE FROM " . vowels_form_builder_get_form_entries_table_name() . " WHERE form_id = %d";
        $wpdb->query($wpdb->prepare($sql, $id));

        $sql = "DELETE FROM " . vowels_form_builder_get_form_table_name() . " WHERE id = %d";
        $result = $wpdb->query($wpdb->prepare($sql, $id));
        $affectedRows += (int) $result;

        if (is_array($activeUniformThemes) && array_key_exists($id, $activeUniformThemes)) {
            unset($activeUniformThemes[$id]);
        }

        if (is_array($activeThemes) && array_key_exists($id, $activeThemes)) {
            unset($activeThemes[$id]);
        }

        if (is_array($activeDatepickers) && array_key_exists($id, $activeDatepickers)) {
            unset($activeDatepickers[$id]);
        }
    }

    update_option('vowels_form_builder_active_uniform_themes', serialize($activeUniformThemes));
    update_option('vowels_form_builder_active_themes', serialize($activeThemes));
    update_option('vowels_form_builder_active_datepickers', serialize($activeDatepickers));

    return $affectedRows;
}

/**
 * Activate forms with the given ID's
 *
 * @param array $ids
 * @return int The number of affected rows
 */
function vowels_form_builder_activate_forms($ids)
{
    global $wpdb;
    $affectedRows = 0;

    foreach ((array) $ids as $id) {
        $config = vowels_form_builder_get_form_config($id);
        $config['active'] = 1;

        $updateValues = array(
            'config' => serialize($config),
            'active' => 1
        );

        $updateWhere = array(
            'id' => $id
        );

        $result = $wpdb->update(vowels_form_builder_get_form_table_name(), $updateValues, $updateWhere);
        $affectedRows += (int) $result;

        vowels_form_builder_update_single_active_themes($config);
    }

    return $affectedRows;
}

/**
 * Dectivate forms with the given ID's
 *
 * @param array $ids
 * @return int The number of affected rows
 */
function vowels_form_builder_deactivate_forms($ids)
{
    global $wpdb;
    $affectedRows = 0;

    foreach ((array) $ids as $id) {
        $config = vowels_form_builder_get_form_config($id);
        $config['active'] = 0;

        $updateValues = array(
            'config' => serialize($config),
            'active' => 0
        );

        $updateWhere = array(
            'id' => $id
        );

        $result = $wpdb->update(vowels_form_builder_get_form_table_name(), $updateValues, $updateWhere);
        $affectedRows += (int) $result;

        vowels_form_builder_update_single_active_themes($config);
    }

    return $affectedRows;
}

/**
 * Display the list of forms
 */
function vowels_form_builder_forms()
{
    $message = '';

    if (isset($_GET['action']) && $_GET['action'] == 'delete' && current_user_can('vowels_form_builder_delete_form')) {
        $id = isset($_GET['id']) ? absint($_GET['id']) : 0;
        if ($id && wp_verify_nonce($_GET['_wpnonce'], 'vowels_form_builder_delete_form_' . $id)) {
            $deleted = vowels_form_builder_delete_forms(array($id));
            if ($deleted) {
                $message = sprintf(_n('Form deleted', '%d forms deleted', $deleted, 'vowels-contact-form-with-drag-and-drop'), $deleted);
            }
        }
    }

    if (isset($_GET['action']) && $_GET['action'] == 'activate' && current_user_can('vowels_form_builder_build_form')) {
        $id = isset($_GET['id']) ? absint($_GET['id']) : 0;
        if ($id && wp_verify_nonce($_GET['_wpnonce'], 'vowels_form_builder_activate_form_' . $id)) {
            $activated = vowels_form_builder_activate_forms(array($id));
            if ($activated) {
                $message = sprintf(_n('Form activated', '%d forms activated', $activated, 'vowels-contact-form-with-drag-and-drop'), $activated);
            }
        }
    }

    if (isset($_GET['action']) && $_GET['action'] == 'deactivate' && current_user_can('vowels_form_builder_build_form')) {
        $id = isset($_GET['id']) ? absint($_GET['id']) : 0;
        if ($id && wp_verify_nonce($_GET['_wpnonce'], 'vowels_form_builder_deactivate_form_' . $id)) {
            $deactivated = vowels_form_builder_deactivate_forms(array($id));
            if ($deactivated) {
                $message = sprintf(_n('Form deactivated', '%d forms deactivated', $deactivated, 'vowels-contact-form-with-drag-and-drop'), $deactivated);
            }
        }
    }

    if (isset($_GET['action']) && $_GET['action'] == 'duplicate' && current_user_can('vowels_form_builder_build_form')) {
        $id = isset($_GET['id']) ? absint($_GET['id']) : 0;
        if ($id && wp_verify_nonce($_GET['_wpnonce'], 'vowels_form_builder_duplicate_form_' . $id)) {
            $config = vowels_form_builder_get_form_config($id);
            if (is_array($config)) {
                $config['name'] .= ' (' . __('duplicate','vowels-contact-form-with-drag-and-drop') . ')';
            }

            $config = vowels_form_builder_add_form($config);

            if (is_array($config)) {
                $message = sprintf(esc_html__('Form duplicated, %sedit the form%s', 'vowels-contact-form-with-drag-and-drop'), '<a href="' . admin_url('admin.php?page=vowels_form_builder_form_builder&amp;id=' . $config['id']) . '">', '</a>');
            }
        }
    }

    $bulkAction = '';
    if (isset($_POST['bulk_action']) && $_POST['bulk_action'] != '-1') {
        $bulkAction = $_POST['bulk_action'];
    } elseif (isset($_POST['bulk_action2']) && $_POST['bulk_action2'] != '-1') {
        $bulkAction = $_POST['bulk_action2'];
    }

    if ($bulkAction == 'delete' && isset($_POST['form']) && current_user_can('vowels_form_builder_delete_form')) {
        $deleted = vowels_form_builder_delete_forms($_POST['form']);
        if ($deleted) {
            $message = sprintf(_n('Form deleted', '%d forms deleted', $deleted, 'vowels-contact-form-with-drag-and-drop'), $deleted);
        }
    } else if ($bulkAction == 'activate' && isset($_POST['form']) && current_user_can('vowels_form_builder_build_form')) {
        $activated = vowels_form_builder_activate_forms($_POST['form']);
        if ($activated) {
            $message = sprintf(_n('Form activated', '%d forms activated', $activated, 'vowels-contact-form-with-drag-and-drop'), $activated);
        }
    } else if ($bulkAction == 'deactivate' && isset($_POST['form']) && current_user_can('vowels_form_builder_build_form')) {
        $deactivated = vowels_form_builder_deactivate_forms($_POST['form']);
        if ($deactivated) {
            $message = sprintf(_n('Form deactivated', '%d forms deactivated', $deactivated, 'vowels-contact-form-with-drag-and-drop'), $deactivated);
        }
    }

    $active = isset($_GET['active']) ? absint($_GET['active']) : null;
    $forms = vowels_form_builder_get_all_form_rows($active);

    include VOWELSFORMDRAGDROP_ADMIN_INCLUDES_DIR . '/forms.php';
}

add_action('auth_redirect', 'vowels_form_builder_preview');

/**
 * Hook for previewing a form
 */
function vowels_form_builder_preview()
{
    if (isset($_GET['vowels_form_builder_preview']) && $_GET['vowels_form_builder_preview'] == 1 && !isset($_POST['vowels_form_builder_ajax']) && current_user_can('vowels_form_builder_preview_form')) {
        $form = null;
        if (isset($_GET['id'])) {
            $form = vowels_form_builder_get_form_config(absint($_GET['id']));
        }

        $previewL10n = array(
            'ajax_url' => admin_url('admin-ajax.php'),
            'preview_not_loaded' => __('Sorry, the form preview could not be loaded.','vowels-contact-form-with-drag-and-drop')
        );

        include VOWELSFORMDRAGDROP_ADMIN_INCLUDES_DIR . '/preview.php';

        exit; // Prevent the rest of WP loading
    }
}

add_action('wp_ajax_vowels_form_builder_preview_form_ajax', 'vowels_form_builder_preview_form_ajax');

/**
 * Display the form via ajax for the form preview
 */
function vowels_form_builder_preview_form_ajax()
{
    if (current_user_can('vowels_form_builder_preview_form')) {
        if (isset($_POST['form'])) {
            $response = array(
                'type' => 'success'
            );

            $config = json_decode(stripslashes($_POST['form']), true);

            $form = new vowelsforminc($config);

            $response['data'] = vowels_form_builder_display_form($form);

            header('Content-Type: application/json');
            echo vowels_form_builder_json_encode($response);
        }
    }

    exit;
}

/**
 * Get all the available Uniform themes
 *
 * @return array
 */
function vowels_form_builder_get_all_uniform_themes()
{
    $uniformThemes = array();

    $defaultHeaders = array(
        'UniformTheme' => 'Uniform Theme',
        'By' => 'By'
        );

        $files = vowels_form_builder_list_files(VOWELSFORMDRAGDROP_PLUGIN_DIR . '/js/uniform/themes');

        foreach ($files as $file) {
            if (substr($file, -4) == '.css') {
                $theme = get_file_data($file, $defaultHeaders);

                if (isset($theme['UniformTheme'])) {
                    $theme['Folder'] = basename(dirname($file));
                    $uniformThemes[$theme['Folder']] = $theme;
                }
            }
        }

        return $uniformThemes;
}

/**
 * Get the default Uniform themes, i.e. not user-created
 *
 * @return array
 */
function vowels_form_builder_get_default_uniform_themes()
{
    return array('default', 'aristo', 'agent');
}

/**
 * Get all the installed Vowelsform themes
 *
 * @return array
 */
function vowels_form_builder_get_all_themes()
{
    $themes = array();

    $defaultHeaders = array(
        'Name' => 'Theme Name',
        'UniformTheme' => 'Uniform Theme',
        'Description' => 'Description',
        'Version' => 'Version',
        'Author' => 'Author',
        'AuthorURI' => 'Author URI'
        );

        $files = vowels_form_builder_list_files(VOWELSFORMDRAGDROP_PLUGIN_DIR . '/themes');

        foreach ($files as $file) {
            if (substr($file, -4) == '.css') {
                $theme = get_file_data($file, $defaultHeaders);

                if (isset($theme['Name'])) {
                    $info = pathinfo($file);
                    $theme['Filename'] = basename($file, '.' . $info['extension']);
                    $theme['Folder'] = basename(dirname($file));
                    $themeKey = $theme['Folder'] . '|' . $theme['Filename'];
                    $themes[$themeKey] = $theme;

                }
            }
        }

        return $themes;
}

/**
 * Get all the default themes, i.e. not user-created
 *
 * @return array
 */
function vowels_form_builder_get_default_themes()
{
    return array('light', 'dark', 'storm', 'react');
}

/**
 * Update the saved list of active themes
 *
 * If a form is added or deleted via direct database access this function
 * will need to be called so that the correct theme CSS is loaded on the site.
 */
function vowels_form_builder_update_active_themes()
{
    $activeUniformThemes = array();
    $uniformThemes = vowels_form_builder_get_all_uniform_themes();

    $activeThemes = array();
    $themes = vowels_form_builder_get_all_themes();

    $activeDatepickers = array();

    $forms = vowels_form_builder_get_all_forms(1);

    foreach ($forms as $config) {
        if (isset($config['use_uniformjs']) && $config['use_uniformjs'] && isset($config['uniformjs_theme']) && array_key_exists($config['uniformjs_theme'], $uniformThemes)) {
            $activeUniformThemes[$config['id']] = $config['uniformjs_theme'];
        }

        if (strlen($config['theme']) && isset($themes[$config['theme']])) {
            $activeThemes[$config['id']] = $config['theme'];
        }

        foreach ($config['elements'] as $element) {
            if ($element['type'] == 'date' && (!isset($element['show_datepicker']) || (isset($element['show_datepicker']) && $element['show_datepicker']))) {
                $activeDatepickers[$config['id']] = true;
                break;
            }
        }
    }

    update_option('vowels_form_builder_active_uniform_themes', serialize($activeUniformThemes));
    update_option('vowels_form_builder_active_themes', serialize($activeThemes));
    update_option('vowels_form_builder_active_datepickers', serialize($activeDatepickers));
}

function vowels_form_builder_update_single_active_themes($config)
{
    // Update list of uniform themes in use
    $activeUniformThemes = maybe_unserialize(get_option('vowels_form_builder_active_uniform_themes'));
    if (!is_array($activeUniformThemes)) {
        $activeUniformThemes = array();
    }

    if ($config['active'] == 1 && isset($config['use_uniformjs']) && $config['use_uniformjs'] && isset($config['uniformjs_theme'])) {
        $activeUniformThemes[$config['id']] = $config['uniformjs_theme'];
    } else if (isset($activeUniformThemes[$config['id']])) {
        unset($activeUniformThemes[$config['id']]);
    }

    update_option('vowels_form_builder_active_uniform_themes', serialize($activeUniformThemes));

    // Update list of themes in use
    $activeThemes = maybe_unserialize(get_option('vowels_form_builder_active_themes'));
    if (!is_array($activeThemes)) {
        $activeThemes = array();
    }
    if ($config['active'] == 1 && strlen($config['theme'])) {
        $activeThemes[$config['id']] = $config['theme'];
    } else if (isset($activeThemes[$config['id']])) {
        unset($activeThemes[$config['id']]);
    }

    update_option('vowels_form_builder_active_themes', serialize($activeThemes));

    $activeDatepickers = maybe_unserialize(get_option('vowels_form_builder_active_datepickers'));
    if (!is_array($activeDatepickers)) {
        $activeDatepickers = array();
    }
    if ($config['active'] == 1) {
        $hasDatepicker = false;
        foreach ($config['elements'] as $element) {
            if ($element['type'] == 'date' && (!isset($element['show_datepicker']) || (isset($element['show_datepicker']) && $element['show_datepicker']))) {
                $hasDatepicker = true;
                break;
            }
        }

        if ($hasDatepicker) {
            $activeDatepickers[$config['id']] = true;
        } else if (isset($activeDatepickers[$config['id']])) {
            unset($activeDatepickers[$config['id']]);
        }
    }

    update_option('vowels_form_builder_active_datepickers', serialize($activeDatepickers));
}

/**
 * Help page
 */
function vowels_form_builder_help()
{
    if (current_user_can('vowels_form_builder_help')) {
        $section = isset($_GET['section']) ? $_GET['section'] : 'basics' ;

        include VOWELSFORMDRAGDROP_ADMIN_INCLUDES_DIR . '/help.php';
    }
}

/**
 * Returns the full URL to the given help section
 *
 * @param string $section
 */
function vowels_form_builder_help_link($section = '')
{
    if (strlen($section)) {
        return admin_url('admin.php?page=vowels_form_builder_help&amp;section=' . $section);
    }

    return admin_url('admin.php?page=vowels_form_builder_help');
}

add_action('wp_ajax_vowels_form_builder_hide_nag_message', 'vowels_form_builder_hide_nag_message');

/**
 * Permanently hide the nag message saying the WP uploads directory
 * is not writable
 */
function vowels_form_builder_hide_nag_message()
{
    update_option('vowels_form_builder_hide_nag_message', 1);
    exit;
}

/**
 * Import page
 */
function vowels_form_builder_import()
{
    if (current_user_can('vowels_form_builder_import')) {
        $messages = array();

        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['form_config']) && strlen($_POST['form_config'])) {
               $config = base64_decode(trim(stripslashes(sanitize_text_field($_POST['form_config']))));
            $config = maybe_unserialize($config);

            if (is_array($config)) {
                $config = vowels_form_builder_add_form($config);
                $messages[] = array(
                    'type' => 'success',
                    'message' => sprintf(esc_html__('Form imported successfully, %sedit the form%s', 'vowels-contact-form-with-drag-and-drop'), '<a href="admin.php?page=vowels_form_builder_form_builder&amp;id=' . $config['id'] . '">', '</a>')
                );
            } else {
                $messages[] = array(
                    'type' => 'error',
                    'message' => esc_html__('Invalid import data','vowels-contact-form-with-drag-and-drop')
                );
            }
        }

        include VOWELSFORMDRAGDROP_ADMIN_INCLUDES_DIR . '/import.php';
    }
}

/**
 * Export page
 */
function vowels_form_builder_export()
{
    if (current_user_can('vowels_form_builder_export')) {
        $switchForms = vowels_form_builder_get_switch_forms();

        if (isset($_GET['action']) && $_GET['action'] == 'form') {
            $action = 'form';
        } else {
            $action = 'entries';
        }

        $exportData = '';
        if ($_SERVER['REQUEST_METHOD'] == 'GET' && $action === 'form' && isset($_GET['id'])) {
            $form = vowels_form_builder_get_form_row(absint($_GET['id']));
            if ($form !== null) {
                $exportData = base64_encode($form->config);
            }
        }

        include VOWELSFORMDRAGDROP_ADMIN_INCLUDES_DIR . '/export.php';
    }
}

/**
 * Entries list page and single entry page
 */
function vowels_form_builder_entries()
{
    if (current_user_can('vowels_form_builder_view_entries')) {
        global $wpdb;
        $message= '';

        if (isset($_GET['action']) && $_GET['action'] == 'entry') {
            $id = isset($_GET['entry_id']) ? absint($_GET['entry_id']) : 0;
            $formId = isset($_GET['id']) ? absint($_GET['id']) : 0;

            $config = vowels_form_builder_get_form_config($formId);

            if (is_array($config)) {
                $columns = array();
                $sql = "SELECT `entries`.*";

                if (isset($config['elements']) && is_array($config['elements'])) {
                    foreach ($config['elements'] as $element) {
                        $elementId = absint($element['id']);
                        if (isset($element['save_to_database']) && $element['save_to_database']) {
                            $sql .= ", GROUP_CONCAT(if (`data`.`element_id` = $elementId, value, NULL)) AS `element_$elementId`";
                            $columns['element_' . $elementId] = $element;
                        } else if ($element['type'] == 'html' && isset($element['show_in_entry']) && $element['show_in_entry']) {
                            $columns['element_' . $elementId] = $element;
                        }
                    }
                }

                $sql .= " FROM `" . vowels_form_builder_get_form_entries_table_name() . "` `entries`
                LEFT JOIN `" . vowels_form_builder_get_form_entry_data_table_name() . "` `data` ON `data`.`entry_id` = `entries`.`id`
                WHERE `entries`.`id` = $id
                GROUP BY `data`.`entry_id`";

                $wpdb->query('SET @@GROUP_CONCAT_MAX_LEN = 65535');
                $entry = $wpdb->get_row($sql);

                // Mark as read
                if (isset($entry->unread) && $entry->unread == 1) {
                    vowels_form_builder_read_entries($entry->id);
                }

                $showEmptyFields = isset($_COOKIE['vowels-show-empty-fields']) ? true : false;
            }

            include VOWELSFORMDRAGDROP_ADMIN_INCLUDES_DIR . '/entry.php';
        } else {
            $id = isset($_GET['id']) ? absint($_GET['id']) : 0;

            if ($id == 0 || !vowels_form_builder_form_exists($id)) {
                $sql = "SELECT id FROM " . vowels_form_builder_get_form_table_name() . " LIMIT 1";

                $id = $wpdb->get_var($sql);
            }

            if ($id > 0) {
                // Deal with setting read/unread
                if (isset($_GET['action'])) {
                    if ($_GET['action'] == 'read') {
                        $entryId = isset($_GET['entry_id']) ? absint($_GET['entry_id']) : 0;
                        if ($entryId > 0 && wp_verify_nonce($_GET['_wpnonce'], 'vowels_form_builder_entry_read_' . $entryId)) {
                            vowels_form_builder_read_entries($entryId);
                        }
                    } else if ($_GET['action'] == 'unread') {
                        $entryId = isset($_GET['entry_id']) ? absint($_GET['entry_id']) : 0;
                        if ($entryId > 0 && wp_verify_nonce($_GET['_wpnonce'], 'vowels_form_builder_entry_unread_' . $entryId)) {
                            vowels_form_builder_unread_entries($entryId);
                        }
                    } else if ($_GET['action'] == 'delete' && current_user_can('vowels_form_builder_delete_entry')) {
                        $entryId = isset($_GET['entry_id']) ? absint($_GET['entry_id']) : 0;
                        if ($entryId > 0 && wp_verify_nonce($_GET['_wpnonce'], 'vowels_form_builder_entry_delete_' . $entryId)) {
                            vowels_form_builder_delete_entries($entryId);
                        }
                    }
                }

                // Deal with bulk actions
                $bulkAction = '';
                if (isset($_GET['bulk_action']) && $_GET['bulk_action'] != '-1') {
                    $bulkAction = $_GET['bulk_action'];
                } elseif (isset($_GET['bulk_action2']) && $_GET['bulk_action2'] != '-1') {
                    $bulkAction = $_GET['bulk_action2'];
                }

                if ($bulkAction == 'delete' && isset($_GET['entry']) && current_user_can('vowels_form_builder_delete_entry')) {
                    $deleted = vowels_form_builder_delete_entries($_GET['entry']);
                    if ($deleted) {
                        $message = sprintf(_n('Entry deleted', '%d entries deleted', $deleted, 'vowels-contact-form-with-drag-and-drop'), $deleted);
                    }
                } else if ($bulkAction == 'read' && isset($_GET['entry'])) {
                    vowels_form_builder_read_entries($_GET['entry']);
                } else if ($bulkAction == 'unread' && isset($_GET['entry'])) {
                    vowels_form_builder_unread_entries($_GET['entry']);
                }

                $config = vowels_form_builder_get_form_config($id);
                $switchForms = vowels_form_builder_get_switch_forms(null, 59);
                $columns = $config['entries_table_layout']['active'];
                array_unshift($columns, array(
                    'type' => 'column',
                    'label' => 'ID',
                    'id' => 'id'
                ));

                // Get entries per page
                $currentUser = wp_get_current_user();
                $validEPP = array('10', '20', '40', '60', '80', '100', '1000000');
                $savedEPP = get_user_meta($currentUser->ID, 'vowels_form_builder_epp', true);
                if (!in_array($savedEPP, $validEPP)) $savedEPP = '20';
                $requestedEPP = isset($_GET['epp']) && in_array($_GET['epp'], $validEPP) ? $_GET['epp'] : $savedEPP;
                if ($requestedEPP != $savedEPP) {
                    update_user_meta($currentUser->ID, 'vowels_form_builder_epp', $requestedEPP);
                    $savedEPP = $requestedEPP;
                }

                $limit = absint($savedEPP);
                $offset = $limit * (vowels_form_builder_get_current_pagenum() - 1);

                // Build the query
                $sql = "SELECT SQL_CALC_FOUND_ROWS `entries`.*";
                $searchColumns = array(
                    '`entries`.`date_added`',
                    '`entries`.`ip`',
                    '`entries`.`form_url`',
                    '`entries`.`referring_url`',
                    '`entries`.`post_id`',
                    '`entries`.`post_title`',
                    '`entries`.`user_display_name`',
                    '`entries`.`user_email`',
                    '`entries`.`user_login`'
                );

                $validOrderBy = array(
                    'id',
                    'date_added',
                    'ip',
                    'form_url',
                    'referring_url',
                    'post_id',
                    'post_title',
                    'user_display_name',
                    'user_email',
                    'user_login'
                );

                if (isset($config['elements']) && is_array($config['elements'])) {
                    foreach ($config['elements'] as $element) {
                        if (isset($element['save_to_database']) && $element['save_to_database']) {
                            $elementId = absint($element['id']);
                            $sql .= ", GROUP_CONCAT(if (`data`.`element_id` = $elementId, value, NULL)) AS `element_$elementId`";
                            $searchColumns[] = "`element_$elementId`";
                            $validOrderBy[] = "element_$elementId";
                        }
                    }
                }

                // Sorting
                $orderby = (isset($_GET['orderby']) && in_array($_GET['orderby'], $validOrderBy)) ? $_GET['orderby'] : 'date_added';
                $order = isset($_GET['order']) && strtolower($_GET['order']) == 'asc' ? 'asc' : 'desc';
                $reverseOrder = $order == 'asc' ? 'desc' : 'asc';
                $unread = null;
                if (isset($_GET['unread'])) {
                    $unread = $_GET['unread'] === '0' ? 0 : 1;
                }

                $sql .= "
                    FROM `" . vowels_form_builder_get_form_entries_table_name() . "` `entries`
                    LEFT JOIN `" . vowels_form_builder_get_form_entry_data_table_name() . "` `data` ON `data`.`entry_id` = `entries`.`id`
                    WHERE `entries`.`form_id` = $id" . ($unread !== null ? " AND `entries`.`unread` = $unread" : "") . "
                    GROUP BY `entries`.`id` ";

                $search = isset($_GET['s']) && strlen($_GET['s']) ? $_GET['s'] : null;
                if (strlen($search)) {
                    $wpdb->escape_by_ref($search);
                    $sql .= "HAVING ";
                    $filteredSearchColumns = array();

                    foreach ($searchColumns as $searchColumn) {
                        if ($searchColumn == '`entries`.`date_added`' && preg_match('/[^\d\-: ]/', $search)) {
                            continue;
                        }

                        $filteredSearchColumns[] = "$searchColumn LIKE '%$search%'";
                    }

                    $sql .= join(' OR ', $filteredSearchColumns);
                }

                $sql .= " ORDER BY `$orderby` $order
                LIMIT $limit OFFSET $offset";

                $wpdb->query('SET @@GROUP_CONCAT_MAX_LEN = 65535');
                $entries = $wpdb->get_results($sql);

                $totalItems = $wpdb->get_var("SELECT FOUND_ROWS()");
                $allItems = $wpdb->get_var("SELECT COUNT(*) FROM " . vowels_form_builder_get_form_entries_table_name() . " WHERE `form_id` = $id");
                $unreadItems = $wpdb->get_var("SELECT COUNT(*) FROM " . vowels_form_builder_get_form_entries_table_name() . " WHERE `form_id` = $id AND `unread` = 1");
                $readItems = $allItems - $unreadItems;
                $topPagination = vowels_form_builder_entries_pagination($limit, $totalItems, 'top');
                $bottomPagination = vowels_form_builder_entries_pagination($limit, $totalItems, 'bottom');
                $currentUrl = remove_query_arg(array('bulk_action', 'bulk_action2', 'entry'));
            }

            include VOWELSFORMDRAGDROP_ADMIN_INCLUDES_DIR . '/entries.php';
        }
    }
}

/**
 * Get the current page number
 *
 * @return int
 */
function vowels_form_builder_get_current_pagenum()
{
    $current = isset($_GET['paged']) ? absint($_GET['paged']) : 0;
    return max(1, $current);
}

/**
 * Get the HTML for the entries pagination
 *
 * @param int $per_page How many items per page?
 * @param int $total_items How many total items?
 * @param string $which Display top or bottom
 * @return string The HTML
 */
function vowels_form_builder_entries_pagination($per_page, $total_items, $which)
{
    $total_pages = ceil( $total_items / $per_page );
    $current = vowels_form_builder_get_current_pagenum();
    $output = '<span class="displaying-num">' . sprintf( _n( '1 item', '%s items', $total_items ), number_format_i18n( $total_items ) ) . '</span>';

    $current_url = ( is_ssl() ? 'https://' : 'http://' ) . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

    $page_links = array();

    $disable_first = $disable_last = '';
    if ( $current == 1 )
    $disable_first = ' disabled';
    if ( $current == $total_pages )
    $disable_last = ' disabled';

    $page_links[] = sprintf( "<a class='%s' title='%s' href='%s'>%s</a>",
        'first-page' . $disable_first,
    esc_attr__( 'Go to the first page' ),
    esc_url( remove_query_arg( 'paged', $current_url ) ),
        '&laquo;'
        );

        $page_links[] = sprintf( "<a class='%s' title='%s' href='%s'>%s</a>",
        'prev-page' . $disable_first,
        esc_attr__( 'Go to the previous page' ),
        esc_url( add_query_arg( 'paged', max( 1, $current-1 ), $current_url ) ),
        '&lsaquo;'
        );

        if ( 'bottom' == $which )
        $html_current_page = $current;
        else
        $html_current_page = sprintf( "<input class='current-page' title='%s' type='text' name='%s' value='%s' size='%d' />",
        esc_attr__( 'Current page' ),
        esc_attr( 'paged' ),
        $current,
        strlen( $total_pages )
        );

        $html_total_pages = sprintf( "<span class='total-pages'>%s</span>", number_format_i18n( $total_pages ) );
        $page_links[] = '<span class="paging-input">' . sprintf( _x( '%1$s of %2$s', 'paging' ), $html_current_page, $html_total_pages ) . '</span>';

        $page_links[] = sprintf( "<a class='%s' title='%s' href='%s'>%s</a>",
        'next-page' . $disable_last,
        esc_attr__( 'Go to the next page' ),
        esc_url( add_query_arg( 'paged', min( $total_pages, $current+1 ), $current_url ) ),
        '&rsaquo;'
        );

        $page_links[] = sprintf( "<a class='%s' title='%s' href='%s'>%s</a>",
        'last-page' . $disable_last,
        esc_attr__( 'Go to the last page' ),
        esc_url( add_query_arg( 'paged', $total_pages, $current_url ) ),
        '&raquo;'
        );

        $output .= "\n<span class='pagination-links'>" . join( "\n", $page_links ) . '</span>';

        if ( $total_pages )
        $page_class = $total_pages < 2 ? ' one-page' : '';
        else
        $page_class = ' no-pages';

        return "<div class='tablenav-pages{$page_class}'>$output</div>";
}

/**
 * Get the admin label for an element
 *
 * @param array $element The element configuration
 * @return string
 */
function vowels_form_builder_get_element_admin_label($element)
{
    $label = $element['label'];

    if (isset($element['admin_label']) && strlen($element['admin_label'])) {
        $label = $element['admin_label'];
    }

    return $label;
}

/**
 * Delete the entries with the given IDs
 *
 * @param int|array $ids
 */
function vowels_form_builder_delete_entries($ids)
{
    global $wpdb;
    $affectedRows = 0;

    foreach ((array) $ids as $id) {
        $sql = "DELETE FROM " . vowels_form_builder_get_form_entries_table_name() . " WHERE id = %d";
        $result = $wpdb->query($wpdb->prepare($sql, $id));
        $affectedRows += (int) $result;

        $sql = "DELETE FROM " . vowels_form_builder_get_form_entry_data_table_name() . " WHERE entry_id = %d";
        $wpdb->query($wpdb->prepare($sql, $id));
    }

    return $affectedRows;
}

/**
 * Get the number of entries for the form with the given ID
 *
 * @param int $id
 * @param int $unread Count only unread entries
 */
function vowels_form_builder_get_form_entry_count($id, $unread = null)
{
    global $wpdb;

    $sql = "SELECT COUNT(*) FROM " . vowels_form_builder_get_form_entries_table_name() . " WHERE form_id = %d";

    if ($unread !== null) {
        $sql .= " AND unread = " . absint($unread);
    }

    return $wpdb->get_var($wpdb->prepare($sql, $id));
}

/**
 * Get the total number of entries
 *
 * @param $unread Count only unread entries
 */
function vowels_form_builder_get_all_entry_count($unread = null)
{
    global $wpdb;

    $sql = "SELECT COUNT(*) FROM " . vowels_form_builder_get_form_entries_table_name();

    if ($unread !== null) {
        $sql .= " WHERE unread = " . absint($unread);
    }

    return $wpdb->get_var($sql);
}

/**
 * Mark entries with the given IDs as read
 *
 * @param int|array $ids
 */
function vowels_form_builder_read_entries($ids)
{
    global $wpdb;
    $affectedRows = 0;

    foreach ((array) $ids as $id) {
        $sql = "UPDATE " . vowels_form_builder_get_form_entries_table_name() . " SET unread = 0 WHERE id = %d";
        $result = $wpdb->query($wpdb->prepare($sql, $id));
        $affectedRows += (int) $result;
    }

    return $affectedRows;
}

/**
 * Mark the entries with the given IDs as unread
 *
 * @param int|array $ids
 */
function vowels_form_builder_unread_entries($ids)
{
    global $wpdb;
    $affectedRows = 0;

    foreach ((array) $ids as $id) {
        $sql = "UPDATE " . vowels_form_builder_get_form_entries_table_name() . " SET unread = 1 WHERE id = %d";
        $result = $wpdb->query($wpdb->prepare($sql, $id));
        $affectedRows += (int) $result;
    }

    return $affectedRows;
}

/**
 * Get all the forms from the database with unread entries
 *
 * @return object The result object
 */
function vowels_form_builder_get_all_forms_with_unread_entries($active = null)
{
    global $wpdb;

    $sql = "SELECT f.*, (SELECT COUNT(*) FROM " . vowels_form_builder_get_form_entries_table_name() . " WHERE form_id = f.id AND unread = 1) AS entries FROM " . vowels_form_builder_get_form_table_name() . " f";

    if ($active !== null) {
        $active = absint($active);
        $sql .= " WHERE f.active = $active";
    }

    $sql .= " HAVING entries > 0";

    return $wpdb->get_results($sql);
}


/**
 * Limit the given text to the specified number of characters
 *
 * @param string $text The text to limit
 * @param int $length The maximum number of characters to show
 * @param string $after Any text to append to the string
 */
function vowels_form_builder_limit_text($text, $length = 200, $after = '&hellip;')
{
    if (strlen($text) <= $length) {
        return $text;
    } else {
        $limitedText = substr($text, 0, $length);
        return $limitedText . $after;
    }
}

add_action('wp_dashboard_setup', 'vowels_form_builder_dashboard_widget');

/**
 * Add the dashboard widget
 */
function vowels_form_builder_dashboard_widget()
{
    if (vowels_form_builder_get_all_entry_count(1) && current_user_can('vowels_form_builder_view_entries')) {
        wp_enqueue_style('vowels-dashboard', vowels_form_builder_admin_url() . '/css/dashboard.css', array(), VOWELSFORMDRAGDROP_VERSION);
        wp_add_dashboard_widget('vowels-dashboard-widget', vowels_form_builder_get_plugin_name(), 'vowels_form_builder_dashboard_widget_display');
    }
}

/**
 * Display the dashboard widget
 */
function vowels_form_builder_dashboard_widget_display()
{
    $forms = vowels_form_builder_get_all_forms_with_unread_entries(1);

    if (count($forms)) {
        include VOWELSFORMDRAGDROP_ADMIN_INCLUDES_DIR . '/dashboard.php';
    } else {
        echo '<p>' . esc_html__('Form information will appear here when you create a form.','vowels-contact-form-with-drag-and-drop') . '</p>';
    }
}

add_action('wp_ajax_vowels_form_builder_verify_purchase_code', 'vowels_form_builder_verify_purchase_code');

/**
 * Verify the given purchase code
 */
function vowels_form_builder_verify_purchase_code()
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && check_ajax_referer('vowels_form_builder_verify_purchase_code')) {
        $purchaseCode = isset($_POST['purchase_code']) && strlen($_POST['purchase_code']) ? trim($_POST['purchase_code']) : '';

        $response = array(
            'type' => 'error',
            'message' => __('An error occurred verifying the license key, please try again','vowels-contact-form-with-drag-and-drop')
        );

        $remoteResponse = wp_remote_post(VOWELSFORMDRAGDROP_API_URL . 'verify.php', array(
            'body' => array(
                'site_url' => site_url(),
                'purchase_code' => $purchaseCode
            ),
            'timeout' => 20
        ));

        if (wp_remote_retrieve_response_code($remoteResponse) == 200 && strlen($json = wp_remote_retrieve_body($remoteResponse))) {
            $data = json_decode($json, true);

            if (isset($data['type'])) {
                if ($data['type'] == 'success') {
                    update_option('vowels_form_builder_licence_key', $data['licence_key']);
                    delete_transient('vowels_form_builder_latest_version_info');
                    delete_site_transient('update_plugins');

                    $response = array(
                        'type' => 'success',
                        'status' => 'valid',
                        'message' => __('License key successfully verified','vowels-contact-form-with-drag-and-drop')
                    );
                } else if ($data['type'] == 'error' && isset($data['code'])) {
                    switch ($data['code']) {
                        case 1:
                            $response['message'] = __('Invalid license key','vowels-contact-form-with-drag-and-drop');
                            $response['status'] = 'invalid';
                            update_option('vowels_form_builder_licence_key', '');
                            break;
                        case 2:
                            $response['message'] = __('Licence key verification will be available shortly, please try again later','vowels-contact-form-with-drag-and-drop');
                            break;
                    }
                }
            }
        }

        header('Content-Type: application/json');
        echo vowels_form_builder_json_encode($response);
        exit;
    }
}

add_action('pre_set_site_transient_update_plugins', 'vowels_form_builder_update_check');

/**
 * Checks for updates
 */
function vowels_form_builder_update_check($transient)
{
    $latestVersionInfo = vowels_form_builder_get_latest_version_info();

    if ($latestVersionInfo && version_compare(VOWELSFORMDRAGDROP_VERSION, $latestVersionInfo->new_version, '<')) {
        $transient->response[VOWELSFORMDRAGDROP_PLUGIN_BASENAME] = $latestVersionInfo;
    }

    return $transient;
}

/**
 * Get the latest version information
 *
 * @param  boolean $cache   Whether the information should be fectched from the cache if available
 * @return boolean|StdClass The version information object or false on failure
 */
function vowels_form_builder_get_latest_version_info($cache = true)
{
    if ($cache) {
        $latestVersionInfo = get_transient('vowels_form_builder_latest_version_info');
    } else {
        $latestVersionInfo = false;
    }

    if (!$latestVersionInfo) {
        // Fetch fresh version info
        $licenceKey = get_option('vowels_form_builder_licence_key');

        if (!strlen($licenceKey)) {
            return false;
        }

        $args = array(
            'action' => 'update-check',
            'plugin_name' => VOWELSFORMDRAGDROP_PLUGIN_BASENAME,
            'version' => VOWELSFORMDRAGDROP_VERSION,
            'licence_key' => $licenceKey,
            'site_url' => site_url()
        );

        $response = vowels_form_builder_api_request($args);

        if ($response !== false) {
            if ((isset($response->type, $response->code) && $response->type == 'error' && $response->code == 1)) {
                update_option('vowels_form_builder_licence_key', '');
            } else {
                $latestVersionInfo = $response;
                $latestVersionInfo->slug = VOWELSFORMDRAGDROP_PLUGIN_NAME;
                $latestVersionInfo->plugin = VOWELSFORMDRAGDROP_PLUGIN_BASENAME;
                set_transient('vowels_form_builder_latest_version_info', $latestVersionInfo, 43200); // Cache for 12 hours
            }
        }
    }

    return $latestVersionInfo;
}

add_action('wp_ajax_vowels_form_builder_manual_update_check', 'vowels_form_builder_manual_update_check');

/**
 * Checks the Vowelsform servers for the latest version information for the Settings page
 */
function vowels_form_builder_manual_update_check()
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && check_ajax_referer('vowels_form_builder_manual_update_check')) {
        $latestVersionInfo = vowels_form_builder_get_latest_version_info(false);

        if ($latestVersionInfo && isset($latestVersionInfo->new_version)) {
            $response = array(
                'type' => 'success'
            );

            if (version_compare(VOWELSFORMDRAGDROP_VERSION, $latestVersionInfo->new_version, '<')) {
                $response['message'] = sprintf(__('An update to version %s is available. %sVisit the Updates page%s to update.', 'vowels-contact-form-with-drag-and-drop'), $latestVersionInfo->new_version, '<a href="' . admin_url('update-core.php') . '">', '</a>');
            } else {
                $response['message'] = __('You are using the latest version.','vowels-contact-form-with-drag-and-drop');
            }
        } else {
            $response = array(
                'type' => 'error',
                'message' => __('Could not find an updated version.','vowels-contact-form-with-drag-and-drop')
            );
        }

        header('Content-Type: application/json');
        echo vowels_form_builder_json_encode($response);
        exit;
    }
}

/**
 * Send a request to the Vowelsform API
 *
 * @param array $args
 * @return object|false
 */
function vowels_form_builder_api_request($args)
{
    $request = wp_remote_post(VOWELSFORMDRAGDROP_API_URL, array('body' => $args, 'timeout' => 10));

    if (is_wp_error($request) || wp_remote_retrieve_response_code($request) != 200) {
        return false;
    }

    $response = unserialize(wp_remote_retrieve_body($request));

    if (is_object($response)) {
        return $response;
    } else {
        return false;
    }
}

add_filter('plugins_api', 'vowels_form_builder_plugin_information', 10, 3);

/**
 * Get plugin information
 */
function vowels_form_builder_plugin_information($false, $action, $args)
{
    if ($action != 'plugin_information' || !isset($args->slug) || $args->slug != VOWELSFORMDRAGDROP_PLUGIN_NAME) {
        return $false;
    }

    $args = array(
        'action' => 'plugin_information',
        'plugin_name' => VOWELSFORMDRAGDROP_PLUGIN_BASENAME,
        'licence_key' => get_option('vowels_form_builder_licence_key'),
        'site_url' => site_url()
    );

    $response = vowels_form_builder_api_request($args);

    if (!is_object($response)) {
        return $false;
    }

    if (isset($response->type) && $response->type == 'error') {
        return $false;
    }

    $response->slug = VOWELSFORMDRAGDROP_PLUGIN_NAME;

    return $response;
}

add_filter('upgrader_pre_install', 'vowels_form_builder_pre_upgrade', 10, 2);

/**
 * Pre-upgrade actions
 *
 * Copies any custom themes, uniform themes and languages files to a temporary directory
 */
function vowels_form_builder_pre_upgrade($value, $extra_args)
{
    if (isset($extra_args['plugin']) && $extra_args['plugin'] == VOWELSFORMDRAGDROP_PLUGIN_BASENAME) {
        global $wp_filesystem;
        $pluginPath = untrailingslashit($wp_filesystem->wp_plugins_dir());
        $vowelsPluginPath = $pluginPath . '/' . VOWELSFORMDRAGDROP_PLUGIN_NAME;

        $allUniformThemes = vowels_form_builder_get_all_uniform_themes();
        $defaultUniformThemes = vowels_form_builder_get_default_uniform_themes();

        $uniformThemesToBackup = array();
        foreach ($allUniformThemes as $allUniformTheme) {
            if (!in_array($allUniformTheme['Folder'], $defaultUniformThemes)) {
                $uniformThemesToBackup[] = $allUniformTheme['Folder'];
            }
        }

        $allThemes = vowels_form_builder_get_all_themes();
        $defaultThemes = vowels_form_builder_get_default_themes();

        $themesToBackup = array();
        foreach ($allThemes as $allTheme) {
            if (!in_array($allTheme['Folder'], $defaultThemes)) {
                $themesToBackup[] = $allTheme['Folder'];
            }
        }

        $languageFilesToBackup = vowels_form_builder_get_custom_language_files();

        $customCSS = $wp_filesystem->is_file($vowelsPluginPath . '/css/custom.css');

        if (count($uniformThemesToBackup) || count($themesToBackup) || count($languageFilesToBackup) || $customCSS) {
            if ($wp_filesystem->is_writable($pluginPath)) {
                $targetDir = $pluginPath . '/vowels-upgrade.tmp';
                if ($wp_filesystem->exists($targetDir)) {
                    $wp_filesystem->delete($targetDir, true);
                }

                if (!$wp_filesystem->exists($targetDir)) {
                    $wp_filesystem->mkdir($targetDir);

                    // All set, start copying themes over
                    if (count($uniformThemesToBackup)) {
                        $targetUniformDir = $targetDir . '/uniform/';
                        $wp_filesystem->mkdir($targetUniformDir);
                        $sourceUniformDir = $vowelsPluginPath . '/js/uniform/themes/';

                        foreach ($uniformThemesToBackup as $uniformThemeToBackup) {
                            if ($wp_filesystem->exists($sourceUniformDir . $uniformThemeToBackup)) {
                                $wp_filesystem->mkdir($targetUniformDir . $uniformThemeToBackup);
                                copy_dir($sourceUniformDir . $uniformThemeToBackup, $targetUniformDir . $uniformThemeToBackup);
                            }
                        }
                    }

                    if (count($themesToBackup)) {
                        $targetThemeDir = $targetDir . '/themes/';
                        $wp_filesystem->mkdir($targetThemeDir);
                        $sourceThemeDir = $vowelsPluginPath . '/themes/';

                        foreach ($themesToBackup as $themeToBackup) {
                            if ($wp_filesystem->exists($sourceThemeDir . $themeToBackup)) {
                                $wp_filesystem->mkdir($targetThemeDir . $themeToBackup);
                                copy_dir($sourceThemeDir . $themeToBackup, $targetThemeDir . $themeToBackup);
                            }
                        }
                    }

                    if (count($languageFilesToBackup)) {
                        $targetLanguagesDir = $targetDir . '/languages/';
                        $sourceLanguagesDir = $vowelsPluginPath . '/languages/';
                        $wp_filesystem->mkdir($targetLanguagesDir);

                        foreach ($languageFilesToBackup as $languageFileToBackup) {
                            if ($wp_filesystem->is_file($sourceLanguagesDir . $languageFileToBackup)) {
                                $wp_filesystem->copy($sourceLanguagesDir . $languageFileToBackup, $targetLanguagesDir . $languageFileToBackup);
                            }
                        }
                    }

                    if ($customCSS) {
                        $wp_filesystem->copy($vowelsPluginPath . '/css/custom.css', $targetDir . '/custom.css');
                    }
                }
            }
        }
    }

    return $value;
}

add_filter('upgrader_post_install', 'vowels_form_builder_post_upgrade', 10, 2);

/**
 * Post-upgrade actions
 *
 * Restores any previously backed up themes and uniform themes
 */
function vowels_form_builder_post_upgrade($value, $extra_args)
{
    if (isset($extra_args['plugin']) && $extra_args['plugin'] == VOWELSFORMDRAGDROP_PLUGIN_BASENAME) {
        global $wp_filesystem;
        $pluginPath = untrailingslashit($wp_filesystem->wp_plugins_dir());
        $vowelsPluginPath = $pluginPath . '/' . VOWELSFORMDRAGDROP_PLUGIN_NAME;
        $sourceDir = $pluginPath . '/vowels-upgrade.tmp';

        if ($wp_filesystem->exists($sourceDir)) {
            $sourceUniformDir = $sourceDir . '/uniform';
            $targetUniformDir = $vowelsPluginPath . '/js/uniform/themes';
            if ($wp_filesystem->exists($sourceUniformDir)) {
                copy_dir($sourceUniformDir, $targetUniformDir);
            }

            $sourceThemeDir = $sourceDir . '/themes';
            $targetThemeDir = $vowelsPluginPath . '/themes';
            if ($wp_filesystem->exists($sourceThemeDir)) {
                copy_dir($sourceThemeDir, $targetThemeDir);
            }

            $sourceLanguagesDir = $sourceDir . '/languages/';
            $targetLanguagesDir = $vowelsPluginPath . '/languages/';
            if ($wp_filesystem->exists($sourceLanguagesDir)) {
                $sourceLanguagesFiles = $wp_filesystem->dirlist($sourceLanguagesDir);
                foreach ($sourceLanguagesFiles as $sourceLanguagesFile) {
                    if ($wp_filesystem->is_file($sourceLanguagesDir . $sourceLanguagesFile['name'])) {
                        $wp_filesystem->copy($sourceLanguagesDir . $sourceLanguagesFile['name'], $targetLanguagesDir . $sourceLanguagesFile['name']);
                    }
                }
            }

            if ($wp_filesystem->is_file($sourceDir . '/custom.css')) {
                $wp_filesystem->copy($sourceDir . '/custom.css', $vowelsPluginPath . '/css/custom.css');
            }

            $wp_filesystem->delete($sourceDir, true);
        }
    }

    return $value;
}

/**
 * Get the list of custom language files
 *
 * @return array
 */
function vowels_form_builder_get_custom_language_files()
{
    $files = vowels_form_builder_list_files(VOWELSFORMDRAGDROP_PLUGIN_DIR . '/languages');

    $languageFiles = array();
    $packagedLanguageFiles = unserialize(VOWELSFORMDRAGDROP_LANGUAGE_FILES);

    foreach ($files as $file) {
        $filename = basename($file);
        if ($filename != 'vowels-form-builder.pot' && $filename != 'readme.txt' && $filename != 'index.php' && !in_array($filename, $packagedLanguageFiles)) {
            $languageFiles[] = $filename;
        }
    }

    return $languageFiles;
}

/*
 * Get the predefined bulk options
 *
 * @return array
 */
function vowels_form_builder_get_bulk_options()
{
    return apply_filters('vowels_form_builder_bulk_options', array(
        __('Countries','vowels-contact-form-with-drag-and-drop') => vowels_form_builder_get_countries(),
        __('U.S. States','vowels-contact-form-with-drag-and-drop') => vowels_form_builder_get_us_states(),
        __('Canadian Provinces','vowels-contact-form-with-drag-and-drop') => vowels_form_builder_get_canadian_provinces(),
        __('UK Counties','vowels-contact-form-with-drag-and-drop') => vowels_form_builder_get_uk_counties(),
        __('German States','vowels-contact-form-with-drag-and-drop') => array('Baden-Wurttemberg', 'Bavaria', 'Berlin', 'Brandenburg', 'Bremen', 'Hamburg', 'Hesse', 'Mecklenburg-West Pomerania', 'Lower Saxony', 'North Rhine-Westphalia', 'Rhineland-Palatinate', 'Saarland', 'Saxony', 'Saxony-Anhalt', 'Schleswig-Holstein', 'Thuringia'),
        __('Dutch Provinces','vowels-contact-form-with-drag-and-drop') => array('Drente', 'Flevoland', 'Friesland', 'Gelderland', 'Groningen', 'Limburg', 'Noord-Brabant', 'Noord-Holland', 'Overijssel', 'Zuid-Holland', 'Utrecht', 'Zeeland'),
        __('Continents','vowels-contact-form-with-drag-and-drop') => array(__('Africa', 'vowels-contact-form-with-drag-and-drop'), __('Antarctica', 'vowels-contact-form-with-drag-and-drop'), __('Asia', 'vowels-contact-form-with-drag-and-drop'), __('Australia', 'vowels-contact-form-with-drag-and-drop'), __('Europe', 'vowels-contact-form-with-drag-and-drop'), __('North America', 'vowels-contact-form-with-drag-and-drop'), __('South America','vowels-contact-form-with-drag-and-drop')),
        __('Gender','vowels-contact-form-with-drag-and-drop') => array(__('Male', 'vowels-contact-form-with-drag-and-drop'), __('Female','vowels-contact-form-with-drag-and-drop')),
        __('Age','vowels-contact-form-with-drag-and-drop') => array('Under 18', '18-24', '25-34', '35-44', '45-54', '55-64', '65 or over'),
        __('Marital Status','vowels-contact-form-with-drag-and-drop') => array(__('Single', 'vowels-contact-form-with-drag-and-drop'), __('Married', 'vowels-contact-form-with-drag-and-drop'), __('Divorced', 'vowels-contact-form-with-drag-and-drop'), __('Widowed','vowels-contact-form-with-drag-and-drop')),
        __('Income','vowels-contact-form-with-drag-and-drop') => array('Under $20,000', '$20,000 - $30,000', '$30,000 - $40,000', '$40,000 - $50,000', '$50,000 - $75,000', '$75,000 - $100,000', '$100,000 - $150,000', '$150,000 or more'),
        __('Days','vowels-contact-form-with-drag-and-drop') => array(__('Monday', 'vowels-contact-form-with-drag-and-drop'), __('Tuesday', 'vowels-contact-form-with-drag-and-drop'), __('Wednesday', 'vowels-contact-form-with-drag-and-drop'), __('Thursday', 'vowels-contact-form-with-drag-and-drop'), __('Friday', 'vowels-contact-form-with-drag-and-drop'), __('Saturday', 'vowels-contact-form-with-drag-and-drop'), __('Sunday','vowels-contact-form-with-drag-and-drop')),
        __('Months','vowels-contact-form-with-drag-and-drop') => array_values(vowels_form_builder_get_all_months())
    ));
}

/**
 * Returns an array of all countries
 *
 * @return array
 */
function vowels_form_builder_get_countries()
{
    return apply_filters('vowels_form_builder_countries', array(
        __('Afghanistan', 'vowels-contact-form-with-drag-and-drop'), __('Albania', 'vowels-contact-form-with-drag-and-drop'), __('Algeria', 'vowels-contact-form-with-drag-and-drop'), __('American Samoa', 'vowels-contact-form-with-drag-and-drop'), __('Andorra', 'vowels-contact-form-with-drag-and-drop'), __('Angola', 'vowels-contact-form-with-drag-and-drop'), __('Anguilla', 'vowels-contact-form-with-drag-and-drop'), __('Antarctica', 'vowels-contact-form-with-drag-and-drop'), __('Antigua And Barbuda', 'vowels-contact-form-with-drag-and-drop'), __('Argentina', 'vowels-contact-form-with-drag-and-drop'), __('Armenia', 'vowels-contact-form-with-drag-and-drop'), __('Aruba', 'vowels-contact-form-with-drag-and-drop'), __('Australia', 'vowels-contact-form-with-drag-and-drop'), __('Austria', 'vowels-contact-form-with-drag-and-drop'), __('Azerbaijan', 'vowels-contact-form-with-drag-and-drop'), __('Bahamas', 'vowels-contact-form-with-drag-and-drop'), __('Bahrain', 'vowels-contact-form-with-drag-and-drop'), __('Bangladesh', 'vowels-contact-form-with-drag-and-drop'), __('Barbados', 'vowels-contact-form-with-drag-and-drop'), __('Belarus', 'vowels-contact-form-with-drag-and-drop'), __('Belgium', 'vowels-contact-form-with-drag-and-drop'),
        __('Belize', 'vowels-contact-form-with-drag-and-drop'), __('Benin', 'vowels-contact-form-with-drag-and-drop'), __('Bermuda', 'vowels-contact-form-with-drag-and-drop'), __('Bhutan', 'vowels-contact-form-with-drag-and-drop'), __('Bolivia', 'vowels-contact-form-with-drag-and-drop'), __('Bosnia And Herzegovina', 'vowels-contact-form-with-drag-and-drop'), __('Botswana', 'vowels-contact-form-with-drag-and-drop'), __('Bouvet Island', 'vowels-contact-form-with-drag-and-drop'), __('Brazil', 'vowels-contact-form-with-drag-and-drop'), __('British Indian Ocean Territory', 'vowels-contact-form-with-drag-and-drop'), __('Brunei Darussalam', 'vowels-contact-form-with-drag-and-drop'), __('Bulgaria', 'vowels-contact-form-with-drag-and-drop'), __('Burkina Faso', 'vowels-contact-form-with-drag-and-drop'), __('Burundi', 'vowels-contact-form-with-drag-and-drop'), __('Cambodia', 'vowels-contact-form-with-drag-and-drop'), __('Cameroon', 'vowels-contact-form-with-drag-and-drop'), __('Canada', 'vowels-contact-form-with-drag-and-drop'), __('Cape Verde', 'vowels-contact-form-with-drag-and-drop'), __('Cayman Islands', 'vowels-contact-form-with-drag-and-drop'), __('Central African Republic', 'vowels-contact-form-with-drag-and-drop'), __('Chad', 'vowels-contact-form-with-drag-and-drop'),
        __('Chile', 'vowels-contact-form-with-drag-and-drop'), __('China', 'vowels-contact-form-with-drag-and-drop'), __('Christmas Island', 'vowels-contact-form-with-drag-and-drop'), __('Cocos (Keeling) Islands', 'vowels-contact-form-with-drag-and-drop'), __('Colombia', 'vowels-contact-form-with-drag-and-drop'), __('Comoros', 'vowels-contact-form-with-drag-and-drop'), __('Congo', 'vowels-contact-form-with-drag-and-drop'), __('Congo, The Democratic Republic Of The', 'vowels-contact-form-with-drag-and-drop'), __('Cook Islands', 'vowels-contact-form-with-drag-and-drop'), __('Costa Rica', 'vowels-contact-form-with-drag-and-drop'), __('Cote D\'Ivoire', 'vowels-contact-form-with-drag-and-drop'), __('Croatia (Local Name: Hrvatska)', 'vowels-contact-form-with-drag-and-drop'), __('Cuba', 'vowels-contact-form-with-drag-and-drop'), __('Cyprus', 'vowels-contact-form-with-drag-and-drop'), __('Czech Republic', 'vowels-contact-form-with-drag-and-drop'), __('Denmark', 'vowels-contact-form-with-drag-and-drop'), __('Djibouti', 'vowels-contact-form-with-drag-and-drop'), __('Dominica', 'vowels-contact-form-with-drag-and-drop'), __('Dominican Republic', 'vowels-contact-form-with-drag-and-drop'), __('East Timor', 'vowels-contact-form-with-drag-and-drop'), __('Ecuador', 'vowels-contact-form-with-drag-and-drop'),
        __('Egypt', 'vowels-contact-form-with-drag-and-drop'), __('El Salvador', 'vowels-contact-form-with-drag-and-drop'), __('Equatorial Guinea', 'vowels-contact-form-with-drag-and-drop'), __('Eritrea', 'vowels-contact-form-with-drag-and-drop'), __('Estonia', 'vowels-contact-form-with-drag-and-drop'), __('Ethiopia', 'vowels-contact-form-with-drag-and-drop'), __('Falkland Islands (Malvinas)', 'vowels-contact-form-with-drag-and-drop'), __('Faroe Islands', 'vowels-contact-form-with-drag-and-drop'), __('Fiji', 'vowels-contact-form-with-drag-and-drop'), __('Finland', 'vowels-contact-form-with-drag-and-drop'), __('France', 'vowels-contact-form-with-drag-and-drop'), __('France, Metropolitan', 'vowels-contact-form-with-drag-and-drop'), __('French Guiana', 'vowels-contact-form-with-drag-and-drop'), __('French Polynesia', 'vowels-contact-form-with-drag-and-drop'), __('French Southern Territories', 'vowels-contact-form-with-drag-and-drop'), __('Gabon', 'vowels-contact-form-with-drag-and-drop'), __('Gambia', 'vowels-contact-form-with-drag-and-drop'), __('Georgia', 'vowels-contact-form-with-drag-and-drop'), __('Germany', 'vowels-contact-form-with-drag-and-drop'), __('Ghana', 'vowels-contact-form-with-drag-and-drop'), __('Gibraltar', 'vowels-contact-form-with-drag-and-drop'),
        __('Greece', 'vowels-contact-form-with-drag-and-drop'), __('Greenland', 'vowels-contact-form-with-drag-and-drop'), __('Grenada', 'vowels-contact-form-with-drag-and-drop'), __('Guadeloupe', 'vowels-contact-form-with-drag-and-drop'), __('Guam', 'vowels-contact-form-with-drag-and-drop'), __('Guatemala', 'vowels-contact-form-with-drag-and-drop'), __('Guinea', 'vowels-contact-form-with-drag-and-drop'), __('Guinea-Bissau', 'vowels-contact-form-with-drag-and-drop'), __('Guyana', 'vowels-contact-form-with-drag-and-drop'), __('Haiti', 'vowels-contact-form-with-drag-and-drop'), __('Heard And Mc Donald Islands', 'vowels-contact-form-with-drag-and-drop'), __('Holy See (Vatican City State)', 'vowels-contact-form-with-drag-and-drop'), __('Honduras', 'vowels-contact-form-with-drag-and-drop'), __('Hong Kong', 'vowels-contact-form-with-drag-and-drop'), __('Hungary', 'vowels-contact-form-with-drag-and-drop'), __('Iceland', 'vowels-contact-form-with-drag-and-drop'), __('India', 'vowels-contact-form-with-drag-and-drop'), __('Indonesia', 'vowels-contact-form-with-drag-and-drop'), __('Iran (Islamic Republic Of)', 'vowels-contact-form-with-drag-and-drop'), __('Iraq', 'vowels-contact-form-with-drag-and-drop'), __('Ireland', 'vowels-contact-form-with-drag-and-drop'),
        __('Israel', 'vowels-contact-form-with-drag-and-drop'), __('Italy', 'vowels-contact-form-with-drag-and-drop'), __('Jamaica', 'vowels-contact-form-with-drag-and-drop'), __('Japan', 'vowels-contact-form-with-drag-and-drop'), __('Jordan', 'vowels-contact-form-with-drag-and-drop'), __('Kazakhstan', 'vowels-contact-form-with-drag-and-drop'), __('Kenya', 'vowels-contact-form-with-drag-and-drop'), __('Kiribati', 'vowels-contact-form-with-drag-and-drop'), __('Korea, Democratic People\'s Republic Of', 'vowels-contact-form-with-drag-and-drop'), __('Korea, Republic Of', 'vowels-contact-form-with-drag-and-drop'), __('Kuwait', 'vowels-contact-form-with-drag-and-drop'), __('Kyrgyzstan', 'vowels-contact-form-with-drag-and-drop'), __('Lao People\'s Democratic Republic', 'vowels-contact-form-with-drag-and-drop'), __('Latvia', 'vowels-contact-form-with-drag-and-drop'), __('Lebanon', 'vowels-contact-form-with-drag-and-drop'), __('Lesotho', 'vowels-contact-form-with-drag-and-drop'), __('Liberia', 'vowels-contact-form-with-drag-and-drop'), __('Libyan Arab Jamahiriya', 'vowels-contact-form-with-drag-and-drop'), __('Liechtenstein', 'vowels-contact-form-with-drag-and-drop'), __('Lithuania', 'vowels-contact-form-with-drag-and-drop'), __('Luxembourg', 'vowels-contact-form-with-drag-and-drop'),
        __('Macau', 'vowels-contact-form-with-drag-and-drop'), __('Macedonia, Former Yugoslav Republic Of', 'vowels-contact-form-with-drag-and-drop'), __('Madagascar', 'vowels-contact-form-with-drag-and-drop'), __('Malawi', 'vowels-contact-form-with-drag-and-drop'), __('Malaysia', 'vowels-contact-form-with-drag-and-drop'), __('Maldives', 'vowels-contact-form-with-drag-and-drop'), __('Mali', 'vowels-contact-form-with-drag-and-drop'), __('Malta', 'vowels-contact-form-with-drag-and-drop'), __('Marshall Islands', 'vowels-contact-form-with-drag-and-drop'), __('Martinique', 'vowels-contact-form-with-drag-and-drop'), __('Mauritania', 'vowels-contact-form-with-drag-and-drop'), __('Mauritius', 'vowels-contact-form-with-drag-and-drop'), __('Mayotte', 'vowels-contact-form-with-drag-and-drop'), __('Mexico', 'vowels-contact-form-with-drag-and-drop'), __('Micronesia, Federated States Of', 'vowels-contact-form-with-drag-and-drop'), __('Moldova, Republic Of', 'vowels-contact-form-with-drag-and-drop'), __('Monaco', 'vowels-contact-form-with-drag-and-drop'), __('Mongolia', 'vowels-contact-form-with-drag-and-drop'), __('Montserrat', 'vowels-contact-form-with-drag-and-drop'), __('Morocco', 'vowels-contact-form-with-drag-and-drop'), __('Mozambique', 'vowels-contact-form-with-drag-and-drop'),
        __('Myanmar', 'vowels-contact-form-with-drag-and-drop'), __('Namibia', 'vowels-contact-form-with-drag-and-drop'), __('Nauru', 'vowels-contact-form-with-drag-and-drop'), __('Nepal', 'vowels-contact-form-with-drag-and-drop'), __('Netherlands', 'vowels-contact-form-with-drag-and-drop'), __('Netherlands Antilles', 'vowels-contact-form-with-drag-and-drop'), __('New Caledonia', 'vowels-contact-form-with-drag-and-drop'), __('New Zealand', 'vowels-contact-form-with-drag-and-drop'), __('Nicaragua', 'vowels-contact-form-with-drag-and-drop'), __('Niger', 'vowels-contact-form-with-drag-and-drop'), __('Nigeria', 'vowels-contact-form-with-drag-and-drop'), __('Niue', 'vowels-contact-form-with-drag-and-drop'), __('Norfolk Island', 'vowels-contact-form-with-drag-and-drop'), __('Northern Mariana Islands', 'vowels-contact-form-with-drag-and-drop'), __('Norway', 'vowels-contact-form-with-drag-and-drop'), __('Oman', 'vowels-contact-form-with-drag-and-drop'), __('Pakistan', 'vowels-contact-form-with-drag-and-drop'), __('Palau', 'vowels-contact-form-with-drag-and-drop'), __('Panama', 'vowels-contact-form-with-drag-and-drop'), __('Papua New Guinea', 'vowels-contact-form-with-drag-and-drop'), __('Paraguay', 'vowels-contact-form-with-drag-and-drop'),
        __('Peru', 'vowels-contact-form-with-drag-and-drop'), __('Philippines', 'vowels-contact-form-with-drag-and-drop'), __('Pitcairn', 'vowels-contact-form-with-drag-and-drop'), __('Poland', 'vowels-contact-form-with-drag-and-drop'), __('Portugal', 'vowels-contact-form-with-drag-and-drop'), __('Puerto Rico', 'vowels-contact-form-with-drag-and-drop'), __('Qatar', 'vowels-contact-form-with-drag-and-drop'), __('Reunion', 'vowels-contact-form-with-drag-and-drop'), __('Romania', 'vowels-contact-form-with-drag-and-drop'), __('Russian Federation', 'vowels-contact-form-with-drag-and-drop'), __('Rwanda', 'vowels-contact-form-with-drag-and-drop'), __('Saint Kitts And Nevis', 'vowels-contact-form-with-drag-and-drop'), __('Saint Lucia', 'vowels-contact-form-with-drag-and-drop'), __('Saint Vincent And The Grenadines', 'vowels-contact-form-with-drag-and-drop'), __('Samoa', 'vowels-contact-form-with-drag-and-drop'), __('San Marino', 'vowels-contact-form-with-drag-and-drop'), __('Sao Tome And Principe', 'vowels-contact-form-with-drag-and-drop'), __('Saudi Arabia', 'vowels-contact-form-with-drag-and-drop'), __('Senegal', 'vowels-contact-form-with-drag-and-drop'), __('Seychelles', 'vowels-contact-form-with-drag-and-drop'), __('Sierra Leone', 'vowels-contact-form-with-drag-and-drop'),
        __('Singapore', 'vowels-contact-form-with-drag-and-drop'), __('Slovakia (Slovak Republic)', 'vowels-contact-form-with-drag-and-drop'), __('Slovenia', 'vowels-contact-form-with-drag-and-drop'), __('Solomon Islands', 'vowels-contact-form-with-drag-and-drop'), __('Somalia', 'vowels-contact-form-with-drag-and-drop'), __('South Africa', 'vowels-contact-form-with-drag-and-drop'), __('South Georgia, South Sandwich Islands', 'vowels-contact-form-with-drag-and-drop'), __('Spain', 'vowels-contact-form-with-drag-and-drop'), __('Sri Lanka', 'vowels-contact-form-with-drag-and-drop'), __('St. Helena', 'vowels-contact-form-with-drag-and-drop'), __('St. Pierre And Miquelon', 'vowels-contact-form-with-drag-and-drop'), __('Sudan', 'vowels-contact-form-with-drag-and-drop'), __('Suriname', 'vowels-contact-form-with-drag-and-drop'), __('Svalbard And Jan Mayen Islands', 'vowels-contact-form-with-drag-and-drop'), __('Swaziland', 'vowels-contact-form-with-drag-and-drop'), __('Sweden', 'vowels-contact-form-with-drag-and-drop'), __('Switzerland', 'vowels-contact-form-with-drag-and-drop'), __('Syrian Arab Republic', 'vowels-contact-form-with-drag-and-drop'), __('Taiwan', 'vowels-contact-form-with-drag-and-drop'), __('Tajikistan', 'vowels-contact-form-with-drag-and-drop'), __('Tanzania, United Republic Of', 'vowels-contact-form-with-drag-and-drop'),
        __('Thailand', 'vowels-contact-form-with-drag-and-drop'), __('Togo', 'vowels-contact-form-with-drag-and-drop'), __('Tokelau', 'vowels-contact-form-with-drag-and-drop'), __('Tonga', 'vowels-contact-form-with-drag-and-drop'), __('Trinidad And Tobago', 'vowels-contact-form-with-drag-and-drop'), __('Tunisia', 'vowels-contact-form-with-drag-and-drop'), __('Turkey', 'vowels-contact-form-with-drag-and-drop'), __('Turkmenistan', 'vowels-contact-form-with-drag-and-drop'), __('Turks And Caicos Islands', 'vowels-contact-form-with-drag-and-drop'), __('Tuvalu', 'vowels-contact-form-with-drag-and-drop'), __('Uganda', 'vowels-contact-form-with-drag-and-drop'), __('Ukraine', 'vowels-contact-form-with-drag-and-drop'), __('United Arab Emirates', 'vowels-contact-form-with-drag-and-drop'), __('United Kingdom', 'vowels-contact-form-with-drag-and-drop'), __('United States', 'vowels-contact-form-with-drag-and-drop'), __('United States Minor Outlying Islands', 'vowels-contact-form-with-drag-and-drop'), __('Uruguay', 'vowels-contact-form-with-drag-and-drop'), __('Uzbekistan', 'vowels-contact-form-with-drag-and-drop'), __('Vanuatu', 'vowels-contact-form-with-drag-and-drop'), __('Venezuela', 'vowels-contact-form-with-drag-and-drop'), __('Vietnam', 'vowels-contact-form-with-drag-and-drop'),
        __('Virgin Islands (British)', 'vowels-contact-form-with-drag-and-drop'), __('Virgin Islands (U.S.)', 'vowels-contact-form-with-drag-and-drop'), __('Wallis And Futuna Islands', 'vowels-contact-form-with-drag-and-drop'), __('Western Sahara', 'vowels-contact-form-with-drag-and-drop'), __('Yemen', 'vowels-contact-form-with-drag-and-drop'), __('Yugoslavia', 'vowels-contact-form-with-drag-and-drop'), __('Zambia', 'vowels-contact-form-with-drag-and-drop'), __('Zimbabwe','vowels-contact-form-with-drag-and-drop')
    ));
}

/**
 * Returns an array of US states
 *
 * @return array
 */
function vowels_form_builder_get_us_states()
{
    return array(
        'Alabama', 'Alaska', 'Arizona', 'Arkansas', 'California', 'Colorado', 'Connecticut', 'Delaware', 'District Of Columbia', 'Florida', 'Georgia', 'Hawaii', 'Idaho',
        'Illinois', 'Indiana', 'Iowa', 'Kansas', 'Kentucky', 'Louisiana', 'Maine', 'Maryland', 'Massachusetts', 'Michigan', 'Minnesota', 'Mississippi', 'Missouri', 'Montana',
        'Nebraska', 'Nevada', 'New Hampshire', 'New Jersey', 'New Mexico', 'New York', 'North Carolina', 'North Dakota', 'Ohio', 'Oklahoma', 'Oregon', 'Pennsylvania', 'Rhode Island',
        'South Carolina', 'South Dakota', 'Tennessee', 'Texas', 'Utah', 'Vermont', 'Virginia', 'Washington', 'West Virginia', 'Wisconsin', 'Wyoming'
    );
}

/**
 * Returns an array of Canadian Provinces / Territories
 *
 * @return array
 */
function vowels_form_builder_get_canadian_provinces()
{
    return array(
        'Alberta', 'British Columbia', 'Manitoba', 'New Brunswick',
        'Newfoundland & Labrador', 'Northwest Territories', 'Nova Scotia', 'Nunavut', 'Ontario', 'Prince Edward Island', 'Quebec', 'Saskatchewan', 'Yukon'
    );
}

/**
 * Returns an array of UK counties
 *
 * @return array
 */
function vowels_form_builder_get_uk_counties()
{
    return array(
        'Aberdeenshire',
        'Anglesey/Sir Fon',
        'Angus/Forfarshire',
        'Argyllshire',
        'Ayrshire',
        'Banffshire',
        'Bedfordshire',
        'Berkshire',
        'Berwickshire',
        'Brecknockshire/Sir Frycheiniog',
        'Buckinghamshire',
        'Buteshire',
        'Caernarfonshire/Sir Gaernarfon',
        'Caithness',
        'Cambridgeshire',
        'Cardiganshire/Ceredigion',
        'Carmarthenshire/Sir Gaerfyrddin',
        'Cheshire',
        'Clackmannanshire',
        'Cornwall',
        'County Antrim',
        'County Armagh',
        'County Down',
        'County Fermanagh',
        'County Londonderry/Derry',
        'County Tyrone',
        'Cromartyshire',
        'Cumberland',
        'Denbighshire/Sir Ddinbych',
        'Derbyshire',
        'Devon',
        'Dorset',
        'Dumfriesshire',
        'Dunbartonshire/Dumbartonshire',
        'Durham',
        'East Lothian/Haddingtonshire',
        'East Yorkshire',
        'Essex',
        'Fife',
        'Flintshire/Sir Fflint',
        'Glamorgan/Morgannwg',
        'Gloucestershire',
        'Hampshire',
        'Herefordshire',
        'Hertfordshire',
        'Huntingdonshire',
        'Inverness-shire',
        'Kent',
        'Kincardineshire',
        'Kinross-shire',
        'Kirkcudbrightshire',
        'Lanarkshire',
        'Lancashire',
        'Leicestershire',
        'Lincolnshire',
        'Merioneth/Meirionnydd',
        'Middlesex',
        'Midlothian/Edinburghshire',
        'Monmouthshire/Sir Fynwy',
        'Montgomeryshire/Sir Drefaldwyn',
        'Morayshire',
        'Nairnshire',
        'Norfolk',
        'North Yorkshire',
        'Northamptonshire',
        'Northumberland',
        'Nottinghamshire',
        'Orkney',
        'Oxfordshire',
        'Peeblesshire',
        'Pembrokeshire/Sir Benfro',
        'Perthshire',
        'Radnorshire/Sir Faesyfed',
        'Renfrewshire',
        'Ross-shire',
        'Roxburghshire',
        'Rutland',
        'Selkirkshire',
        'Shetland',
        'Shropshire',
        'Somerset',
        'Staffordshire',
        'Stirlingshire',
        'Suffolk',
        'Surrey',
        'Sussex',
        'Sutherland',
        'Warwickshire',
        'West Lothian/Linlithgowshire',
        'West Yorkshire',
        'Westmorland',
        'Wigtownshire',
        'Wiltshire',
        'Worcestershire'
    );
}

add_action('wp_ajax_vowels_form_builder_get_export_field_list_ajax', 'vowels_form_builder_get_export_field_list_ajax');

/**
 * Get the list of available fields to export
 */
function vowels_form_builder_get_export_field_list_ajax()
{
    $id = isset($_POST['form_id']) ? absint($_POST['form_id']) : 0;

    if (vowels_form_builder_form_exists($id)) {
        $form = vowels_form_builder_get_form_config($id);
        $response = array(
            'type' => 'success',
            'data' => array()
        );

        foreach ($form['elements'] as $element) {
            if (isset($element['save_to_database']) && $element['save_to_database']) {
                $response['data'][] = array(
                    'value' => 'element_' . $element['id'],
                    'label' => vowels_form_builder_get_element_admin_label($element)
                );
            }
        }

        $defaultFields = vowels_form_builder_get_valid_entry_fields();
        foreach ($defaultFields as $key => $label) {
            $response['data'][] = array(
                'value' => $key,
                'label' => $label
            );
        }

        header('Content-Type: application/json');
        echo vowels_form_builder_json_encode($response);
        exit;
    }
}

add_action('auth_redirect', 'vowels_form_builder_export_entries');

/**
 * Export form entries
 */
function vowels_form_builder_export_entries()
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['vowels_form_builder_do_entries_export']) && $_POST['vowels_form_builder_do_entries_export'] == 1) {
        if (isset($_POST['form_id']) && vowels_form_builder_form_exists($_POST['form_id'])) {
            $config = vowels_form_builder_get_form_config($_POST['form_id']);
            $id = $config['id'];
            $filenameFilter = new vowelsforminc_Filter_Filename();
            $filename = $filenameFilter->filter($config['name']);

            // Send headers
            header('Content-Type: text/csv');
            header('Content-Disposition: attachment;filename=' . $filename . '-' . date('Y-m-d') . '.csv');

            global $wpdb;
            $elementsCache = array();
            // Build the query
            $sql = "SELECT `entries`.*";

            if (isset($config['elements']) && is_array($config['elements'])) {
                foreach ($config['elements'] as $element) {
                    if (isset($element['save_to_database']) && $element['save_to_database']) {
                        $elementId = absint($element['id']);
                        $sql .= ", GROUP_CONCAT(if (`data`.`element_id` = $elementId, value, NULL)) AS `element_$elementId`";
                        $elementsCache[$elementId] = vowels_form_builder_get_element_config($elementId, $config);
                    }
                }
            }

            if (isset($_POST['from'], $_POST['to'])) {
                $pattern = '/^\d{4}-\d{2}-\d{2}$/';
                if (preg_match($pattern, $_POST['from']) && preg_match($pattern, $_POST['to'])) {
                    $from = vowels_form_builder_local_to_utc($_POST['from'] . ' 00:00:00');
                    $to = vowels_form_builder_local_to_utc($_POST['to'] . ' 23:59:59');
                    $dateSql = $wpdb->prepare(' AND (`entries`.`date_added` >= %s AND `entries`.`date_added` <= %s)', array($from, $to));
                }
            }

            $sql .= "
            FROM `" . vowels_form_builder_get_form_entries_table_name() . "` `entries`
            LEFT JOIN `" . vowels_form_builder_get_form_entry_data_table_name() . "` `data` ON `data`.`entry_id` = `entries`.`id`
            WHERE `entries`.`form_id` = $id";

            if (isset($dateSql)) {
                $sql .= $dateSql;
            }

            $sql .= "
            GROUP BY `entries`.`id`;";

            $wpdb->query('SET @@GROUP_CONCAT_MAX_LEN = 65535');
            $entries = $wpdb->get_results($sql, ARRAY_A);

            $validFields = array(
                'id' => 'Entry ID',
                'date_added' => 'Date',
                'ip' => 'IP address',
                'form_url' => 'Form URL',
                'referring_url' => 'Referring URL',
                'post_id' => 'Post / page ID',
                'post_title' => 'Post / page title',
                'user_display_name' => 'User WordPress display name',
                'user_email' => 'User WordPress email',
                'user_login' => 'User WordPress login'
            );

            // Sanitize chosen fields
            $validFields = vowels_form_builder_get_valid_entry_fields();
            $fields = array();
            if (isset($_POST['export_fields']) && is_array($_POST['export_fields'])) {
                // Check which fields have been chosen for export and get their labels
                foreach ($_POST['export_fields'] as $field) {
                    if (array_key_exists($field, $validFields)) {
                        // It's a default column, get the label
                        $fields[$field] = $validFields[$field];
                    } elseif (preg_match('/element_(\d+)/', $field, $matches)) {
                        // It's an element column, so get the element label
                        $elementId = absint($matches[1]);
                        if (isset($elementsCache[$elementId])) {
                            $label = vowels_form_builder_get_element_admin_label($elementsCache[$elementId]);
                        } else {
                            $label = '';
                        }
                        $fields[$field] = $label;
                    }
                }
            }

            $fh = fopen('php://output', 'w');
            // Write column headings row
            fputcsv($fh, $fields);

            // Write each entry
            if (is_array($entries)) {
                foreach ($entries as $entry) {
                    $row = array();

                    foreach ($fields as $field => $label) {
                        $row[$field] = isset($entry[$field]) ? $entry[$field] : '';

                        if (strlen($row[$field]) && strpos($field, 'element_') !== false) {
                            $elementId = absint(str_replace('element_', '', $field));
                            if (isset($elementsCache[$elementId])) {
                                // Per element modifications to the output
                                if (isset($elementsCache[$elementId]['type'])) {
                                    switch ($elementsCache[$elementId]['type']) {
                                        // Remove <br /> from textarea newlines
                                        case 'text':
                                        case 'textarea':
                                        case 'password':
                                        case 'hidden':
                                            $row[$field] = htmlspecialchars_decode(preg_replace('/<br\s*?\/>/', '', $row[$field]), ENT_QUOTES);
                                            break;
                                        case 'email':
                                            // Email elements: remove <a> tag
                                            $row[$field] = trim(strip_tags($row[$field]));
                                            break;
                                        case 'checkbox':
                                        case 'radio':
                                            // Multiple elements: replace <br /> with new line
                                            $row[$field] = trim(preg_replace('/<br\s*?\/>/', "\n", $row[$field]));
                                            break;
                                        case 'file':
                                            // File uploads: replace <br /> with newline, remove anchor tag, use href attr as value
                                            $result = preg_match_all('/href=([\'"])?((?(1).+?|[^\s>]+))(?(1)\1)/is', $row[$field], $uploads);
                                            if ($result > 0) {
                                                $row[$field] = join("\n", $uploads[2]);
                                            } else {
                                                $row[$field] = trim(preg_replace('/<br\s*?\/>/', "\n", $row[$field]));
                                            }
                                            break;
                                    }
                                }
                            }
                        }

                        // Format the date to include the WordPress Timezone offset
                        if ($field === 'date_added') {
                            $row[$field] = vowels_form_builder_format_date($row[$field]);
                        }
                    }

                    fputcsv($fh, $row);
                }
            }

            fclose($fh);
            exit;
        }
    }
}

/**
 * Get the list of default valid entry fields
 *
 * @return array
 */
function vowels_form_builder_get_valid_entry_fields()
{
    return array(
        'id' => __('Entry ID', 'vowels-contact-form-with-drag-and-drop'),
        'date_added' => __('Date', 'vowels-contact-form-with-drag-and-drop'),
        'ip' => __('IP address', 'vowels-contact-form-with-drag-and-drop'),
        'form_url' => __('Form URL', 'vowels-contact-form-with-drag-and-drop'),
        'referring_url' => __('Referring URL', 'vowels-contact-form-with-drag-and-drop'),
        'post_id' => __('Post / page ID', 'vowels-contact-form-with-drag-and-drop'),
        'post_title' => __('Post / page title', 'vowels-contact-form-with-drag-and-drop'),
        'user_display_name' => __('User WordPress display name', 'vowels-contact-form-with-drag-and-drop'),
        'user_email' => __('User WordPress email', 'vowels-contact-form-with-drag-and-drop'),
        'user_login' => __('User WordPress login','vowels-contact-form-with-drag-and-drop')
    );
}

/**
 * Alternative fputcsv function if it doesn't exist
 */
if (!function_exists('fputcsv')) {
    function fputcsv(&$handle, $fields = array(), $delimiter = ',', $enclosure = '"') {

        // Sanity Check
        if (!is_resource($handle)) {
            trigger_error('fputcsv() expects parameter 1 to be resource, ' .
            gettype($handle) . ' given', E_USER_WARNING);
            return false;
        }

        if ($delimiter!=NULL) {
            if( strlen($delimiter) < 1 ) {
                trigger_error('delimiter must be a character', E_USER_WARNING);
                return false;
            }elseif( strlen($delimiter) > 1 ) {
                trigger_error('delimiter must be a single character', E_USER_NOTICE);
            }

            /* use first character from string */
            $delimiter = $delimiter[0];
        }

        if( $enclosure!=NULL ) {
            if( strlen($enclosure) < 1 ) {
                trigger_error('enclosure must be a character', E_USER_WARNING);
                return false;
            }elseif( strlen($enclosure) > 1 ) {
                trigger_error('enclosure must be a single character', E_USER_NOTICE);
            }

            /* use first character from string */
            $enclosure = $enclosure[0];
        }

        $i = 0;
        $csvline = '';
        $escape_char = '\\';
        $field_cnt = count($fields);
        $enc_is_quote = in_array($enclosure, array('"',"'"));
        reset($fields);

        foreach( $fields AS $field ) {

            /* enclose a field that contains a delimiter, an enclosure character, or a newline */
            if( is_string($field) && (
            strpos($field, $delimiter)!==false ||
            strpos($field, $enclosure)!==false ||
            strpos($field, $escape_char)!==false ||
            strpos($field, "\n")!==false ||
            strpos($field, "\r")!==false ||
            strpos($field, "\t")!==false ||
            strpos($field, ' ')!==false ) ) {

                $field_len = strlen($field);
                $escaped = 0;

                $csvline .= $enclosure;
                for( $ch = 0; $ch < $field_len; $ch++ )    {
                    if( $field[$ch] == $escape_char && $field[$ch+1] == $enclosure && $enc_is_quote ) {
                        continue;
                    }elseif( $field[$ch] == $escape_char ) {
                        $escaped = 1;
                    }elseif( !$escaped && $field[$ch] == $enclosure ) {
                        $csvline .= $enclosure;
                    }else{
                        $escaped = 0;
                    }
                    $csvline .= $field[$ch];
                }
                $csvline .= $enclosure;
            } else {
                $csvline .= $field;
            }

            if( $i++ != $field_cnt ) {
                $csvline .= $delimiter;
            }
        }

        $csvline .= "\n";

        return fwrite($handle, $csvline);
    }
}

/**
 * Get the element config with the given ID
 *
 * @param int $elementId
 * @param array $form
 */
function vowels_form_builder_get_element_config($elementId, $form)
{
    if (isset($form['elements']) && is_array($form['elements'])) {
        foreach ($form['elements'] as $element) {
            if ($element['id'] == $elementId) {
                return $element;
            }
        }
    }

    return null;
}

add_action('wp_ajax_vowels_form_builder_set_fancybox_requested', 'vowels_form_builder_set_fancybox_requested');

/**
 * Sets that fancybox should be loaded
 */
function vowels_form_builder_set_fancybox_requested()
{
    update_option('vowels_form_builder_fancybox_requested', true);
    exit;
}

/**
 * Returns an HTML options list of only email elements
 *
 * @param array $config The form config
 * @param int $selected Selected element ID
 */
function vowels_form_builder_email_elements_as_options($config, $selected)
{
    $xhtml = '';
    foreach ($config['elements'] as $element) {
        if ($element['type'] == 'email') {
            $xhtml .= '<option value="' . $element['id'] . '" ' . selected($element['id'], $selected, false) . '>' . vowels_form_builder_get_element_admin_label($element) . '</option>';
        }
    }
    return $xhtml;
}

/**
 * Formats a date to local time and translates
 *
 * @param string $datetime
 * @param boolean $hideDateIfSameDay
 */
function vowels_form_builder_format_date($datetime, $hideDateIfSameDay = false)
{
    if (!strlen($datetime)) {
        return '';
    }

    $dateAdded = mysql2date('G', $datetime);
    $dateAdded += get_option('gmt_offset') * 3600;

    if ($hideDateIfSameDay && date('Y-m-d', $dateAdded) == date('Y-m-d')) {
        return date_i18n(get_option('time_format'), $dateAdded);
    } else {
        return date_i18n(get_option('time_format'), $dateAdded) . ' ' . date_i18n(get_option('date_format'), $dateAdded);
    }
}

/**
 * Converts a date in YYYY-MM-DD format to UTC time taking into
 * account the WordPress Timezone setting
 *
 * @param string $date
 * @return string The date in MySQL DATETIME format
 */
function vowels_form_builder_local_to_utc($date)
{
    // Get the number of minutes offset
    $offsetMinutes = get_option('gmt_offset') * 60;

    // Get the number of hours and minutes
    $hours = absint($offsetMinutes / 60);
    $minutes = absint($offsetMinutes % 60);

    // Pad with zero
    $hours = str_pad($hours, 2, '0', STR_PAD_LEFT);
    $minutes = str_pad($minutes, 2, '0', STR_PAD_LEFT);

    // Join together
    $offset = $hours . $minutes;

    // If it's a positive offset add a +
    if ($offsetMinutes >= 0) {
        $offset = '+' . $offset;
    } else {
        $offset = '-' . $offset;
    }

    // Get the Unix timestamp of the offset date
    $timestamp = strtotime($date . ' ' . $offset);

    // Return the date in MySQL DATETIME format
    return date('Y-m-d H:i:s', $timestamp);
}

function vowels_form_builder_global_nav($active)
{
    $activeStr = 'class="vowels-global-nav-active"';
    ?>
<div class="vowels-global-nav-wrap qfb-cf">
    <ul class="vowels-global-nav-ul">
        <?php if (current_user_can('vowels_form_builder_list_forms')) : ?>
            <li><a href="admin.php?page=vowels_form_builder_forms" <?php if ($active == 'forms') echo $activeStr; ?>><span class="ifb-no-arrow"><?php esc_html_e('All Forms','vowels-contact-form-with-drag-and-drop'); ?></span></a></li>
        <?php endif; ?>
        <?php if (current_user_can('vowels_form_builder_build_form')) : ?>
            <li><a href="admin.php?page=vowels_form_builder_form_builder" <?php if ($active == 'form_builder') echo $activeStr; ?>><span class="ifb-no-arrow"><?php esc_html_e('Form Builder','vowels-contact-form-with-drag-and-drop'); ?></span></a></li>
        <?php endif; ?>
        <?php if (current_user_can('vowels_form_builder_view_entries')) : ?>
            <li><a href="admin.php?page=vowels_form_builder_entries" <?php if ($active == 'entries') echo $activeStr; ?>><span class="ifb-no-arrow"><?php esc_html_e('Entries','vowels-contact-form-with-drag-and-drop'); ?></span></a></li>
        <?php endif; ?>
        <?php if (current_user_can('vowels_form_builder_import')) : ?>
            <li><a href="admin.php?page=vowels_form_builder_import" <?php if ($active == 'import') echo $activeStr; ?>><span class="ifb-no-arrow"><?php esc_html_e('Import','vowels-contact-form-with-drag-and-drop'); ?></span></a></li>
        <?php endif; ?>
        <?php if (current_user_can('vowels_form_builder_export')) : ?>
            <li><a href="admin.php?page=vowels_form_builder_export" <?php if ($active == 'export') echo $activeStr; ?>><span class="ifb-no-arrow"><?php esc_html_e('Export','vowels-contact-form-with-drag-and-drop'); ?></span></a></li>
        <?php endif; ?>
        <?php if (current_user_can('vowels_form_builder_settings')) : ?>
            <li><a href="admin.php?page=vowels_form_builder_settings" <?php if ($active == 'settings') echo $activeStr; ?>><span class="ifb-no-arrow"><?php esc_html_e('Settings','vowels-contact-form-with-drag-and-drop'); ?></span></a></li>
        <?php endif; ?>
        <?php if (current_user_can('vowels_form_builder_help')) : ?>
            <li><a href="admin.php?page=vowels_form_builder_help" <?php if ($active == 'help') echo $activeStr; ?>><span class="ifb-no-arrow"><?php esc_html_e('Help','vowels-contact-form-with-drag-and-drop'); ?></span></a></li>
        <?php endif; ?>
    </ul>
</div>
    <?php
}

/**
 * This is a duplicate of the list_files WP function as it seems we cannot
 * rely on this function being available when processing Ajax calls
 *
 * @param string $folder Full path to folder
 * @param int $levels (optional) Levels of folders to follow, Default: 100 (PHP Loop limit).
 * @return bool|array False on failure, Else array of files
 */
function vowels_form_builder_list_files( $folder = '', $levels = 100 ) {
    if ( empty($folder) )
        return false;

    if ( ! $levels )
        return false;

    $files = array();
    if ( $dir = @opendir( $folder ) ) {
        while (($file = readdir( $dir ) ) !== false ) {
            if ( in_array($file, array('.', '..') ) )
                continue;
            if ( is_dir( $folder . '/' . $file ) ) {
                $files2 = vowels_form_builder_list_files( $folder . '/' . $file, $levels - 1);
                if ( $files2 )
                    $files = array_merge($files, $files2 );
                else
                    $files[] = $folder . '/' . $file . '/';
            } else {
                $files[] = $folder . '/' . $file;
            }
        }
    }
    @closedir( $dir );
    return $files;
}

/**
 * Updgrade fixes for versions before DB version 4 (plugin versions before 1.3.3)
 */
function vowels_form_builder_upgrade_4()
{
    $forms = vowels_form_builder_get_all_forms();

    foreach ($forms as $form) {
        if (isset($form['conditional_recipients'])) {
            foreach ($form['conditional_recipients'] as &$recipient) {
                $crElement = vowels_form_builder_get_element_config($recipient['element'], $form);
                if ($crElement['type'] == 'radio') {
                    $recipient['value'] = _wp_specialchars($recipient['value'], ENT_NOQUOTES);
                }
            }
        }

        foreach ($form['elements'] as &$element) {
            // Go through the logic rules and escape the value if the element that the rule is referring to is a checkbox or radio element
            if (isset($element['logic_rules']) && is_array($element['logic_rules'])) {
                foreach ($element['logic_rules'] as &$logicRule) {
                    $lrElement = vowels_form_builder_get_element_config($logicRule['element_id'], $form);
                    if (in_array($lrElement['type'], array('checkbox', 'radio'))) {
                        $logicRule['value'] = _wp_specialchars($logicRule['value'], ENT_NOQUOTES);
                    }
                }
            }

            if ($element['type'] == 'groupstart') {
                // Escape Group title and description
                $element['title'] = _wp_specialchars($element['title'], ENT_NOQUOTES);
                $element['description'] = _wp_specialchars($element['description'], ENT_NOQUOTES);
            } elseif (in_array($element['type'], array('radio', 'checkbox'))) {
                // Escape options labels and values for radio and checkbox elements
                foreach ($element['options'] as &$option) {
                    $option['label'] = _wp_specialchars($option['label'], ENT_NOQUOTES);
                    $option['value'] = _wp_specialchars($option['value'], ENT_NOQUOTES);
                }
            }
        }

        vowels_form_builder_save_form($form);
    }
}

/**
 * Updgrade fixes for versions before DB version 6 (plugin versions before 1.4.1)
 */
function vowels_form_builder_upgrade_6()
{
    $forms = vowels_form_builder_get_all_forms();

    foreach ($forms as $form) {
        foreach ($form['elements'] as &$element) {
            if ($element['type'] == 'groupstart') {
                $element['admin_title'] = isset($element['name']) ? $element['name'] : __('New','vowels-contact-form-with-drag-and-drop');
                unset($element['name']);
            }
        }

        vowels_form_builder_save_form($form);
    }
}

/**
 * Upgrades for versions before DB version 7 (v1.4.3 or earlier)
 */
function vowels_form_builder_upgrade_7()
{
    $forms = vowels_form_builder_get_all_forms();

    foreach ($forms as $form) {
        $form['tooltip_style'] = str_replace('ui-tooltip', 'qtip', $form['tooltip_style']);
        vowels_form_builder_save_form($form);
    }
}

/**
 * Upgrades for versions before DB version 10 (v1.4.18 or earlier)
 */
function vowels_form_builder_upgrade_10()
{
    $forms = vowels_form_builder_get_all_forms();

    foreach ($forms as $form) {
        $form['responsive'] = false;

        foreach ($form['elements'] as &$element) {
            if ($element['type'] == 'recaptcha') {
                $element['recaptcha_theme'] = 'light';
            }
        }

        vowels_form_builder_save_form($form);
    }

    // Copy the reCAPTCHA keys to the new option names but don't remove the old ones in case they have to downgrade
    update_option('vowels_form_builder_recaptcha_site_key', get_option('vowels_form_builder_recaptcha_public_key'));
    update_option('vowels_form_builder_recaptcha_secret_key', get_option('vowels_form_builder_recaptcha_private_key'));
}

/**
 * Upgrades for version before DB version 11 (v.1.7.10 or earlier)
 */
function vowels_form_builder_upgrade_11()
{
    foreach (vowels_form_builder_get_all_forms() as $form) {
        if (isset($form['entries_table_layout']['inactive']) && is_array($form['entries_table_layout']['inactive'])) {
            foreach ($form['entries_table_layout']['inactive'] as $key => $column) {
                if (isset($column['id']) && $column['id'] == 'ip') {
                    continue 2;
                }
            }

            $form['entries_table_layout']['inactive'][] = array(
                'type' => 'column',
                'label' => __('IP address', 'vowels-contact-form-with-drag-and-drop'),
                'id' => 'ip'
            );

            vowels_form_builder_save_form($form);
        }
    }
}

/**
 * Allow users to whitelabel the plugin name the WordPress menu
 *
 * @return string The plugin name
 */
function vowels_form_builder_get_menu_title()
{
    return apply_filters('vowels_form_builder_menu_title', vowels_form_builder_get_plugin_name());
}

/**
 * Allow users to whitelabel the plugin name on Vowelsform pages
 *
 * @return string The plugin name
 */
function vowels_form_builder_get_plugin_name()
{
    return apply_filters('vowels_form_builder_plugin_name', __('Vowelsform','vowels-contact-form-with-drag-and-drop'));
}