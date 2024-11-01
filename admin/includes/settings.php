<?php if (!defined('VOWELSFORMDRAGDROP_VERSION')) exit; ?><div class="wrap">
	<div class="vowels-top-right">
        <div class="vowels-information">
        	<span class="vowels-copyright"><a href="http://www.vowelsform.com" onclick="window.open(this.href); return false;">www.vowelsform.com</a> &copy; <?php echo date('Y'); ?></span>
        	<span class="vowels-bug-link"><a href="http://www.vowelsform.com/support.php" onclick="window.open(this.href); return false;"><?php esc_html_e('Report a bug','vowels-contact-form-with-drag-and-drop'); ?></a></span>
        	<span class="vowels-help-link"><a href="<?php echo vowels_form_builder_help_link(); ?>" onclick="window.open(this.href); return false;"><?php esc_html_e('Help','vowels-contact-form-with-drag-and-drop'); ?></a></span>
        </div>
    </div>
    <div class="ifb-form-icon"></div>
    <h2 class="ifb-main-title"><span class="ifb-vowels-title"><?php echo esc_html(vowels_form_builder_get_plugin_name()); ?></span><?php esc_html_e('Settings','vowels-contact-form-with-drag-and-drop'); ?></h2>

    <?php vowels_form_builder_global_nav('settings'); ?>

    <?php if (isset($_POST['vowels_form_builder_settings'])) : ?>
        <?php
            $savedSmtpSettings = get_option('vowels_form_builder_smtp_settings');
            update_option('vowels_form_builder_recaptcha_site_key', sanitize_text_field(stripslashes($_POST['recaptcha_site_key'])));
            update_option('vowels_form_builder_recaptcha_secret_key', sanitize_text_field(stripslashes($_POST['recaptcha_secret_key'])));
            update_option('vowels_form_builder_email_sending_method', sanitize_text_field($_POST['global_email_sending_method']));
            update_option('vowels_form_builder_smtp_settings', array(
                'host' => stripslashes($_POST['smtp_host']),
                'port' => (int)$_POST['smtp_port'],
                'encryption' => sanitize_text_field($_POST['smtp_encryption']),
                'username' => stripslashes($_POST['smtp_username']),
                'password' => isset($_POST['smtp_password']) ? stripslashes($_POST['smtp_password']) : $savedSmtpSettings['password']
            ));
            update_option('vowels_form_builder_email_returnpath', sanitize_text_field(stripslashes($_POST['email_returnpath'])));
			$disable_fancybox = ( isset($_POST['disable_fancybox_output']) && $_POST['disable_fancybox_output'] == 1) ? true : false;
            update_option('vowels_form_builder_disable_fancybox_output',$disable_fancybox );
			$disable_qtip = ( isset($_POST['disable_qtip_output']) && $_POST['disable_qtip_output'] == 1) ? true : false;
            update_option('vowels_form_builder_disable_qtip_output', $disable_qtip);
			$disable_infieldlabels = ( isset($_POST['disable_infieldlabels_output']) && $_POST['disable_infieldlabels_output'] == 1) ? true : false;
            update_option('vowels_form_builder_disable_infieldlabels_output', $disable_infieldlabels);
			$disable_smoothscroll = ( isset($_POST['disable_smoothscroll_output']) && $_POST['disable_smoothscroll_output'] == 1) ? true : false;
            update_option('vowels_form_builder_disable_smoothscroll_output', $disable_smoothscroll);
			$disable_jqueryui = ( isset($_POST['disable_jqueryui_output']) && $_POST['disable_jqueryui_output'] == 1) ? true : false;
            update_option('vowels_form_builder_disable_jqueryui_output', $disable_jqueryui);
			$disable_uniform = ( isset($_POST['disable_uniform_output']) && $_POST['disable_uniform_output'] == 1) ? true : false;
            update_option('vowels_form_builder_disable_uniform_output', $disable_uniform);
			$disable_fileupload = ( isset($_POST['disable_fileupload_output']) && $_POST['disable_fileupload_output'] == 1) ? true : false;
            update_option('vowels_form_builder_disable_fileupload_output', $disable_fileupload);
			$disable_raw_detection = ( isset($_POST['disable_raw_detection']) && $_POST['disable_raw_detection'] == 1) ? true : false;
            update_option('vowels_form_builder_disable_raw_detection', $disable_raw_detection);
			$disable_fancybox_requested = ( isset($_POST['fancybox_requested']) && $_POST['fancybox_requested'] == 1) ? true : false;

            update_option('vowels_form_builder_fancybox_requested', $disable_fancybox_requested);

            if (isset($_POST['vowels_form_builder_update']) && $_POST['vowels_form_builder_update'] == '1') {
                vowels_form_builder_update_active_themes();
            }
        ?>
        <div class="updated below-h2" id="message">
            <p><?php esc_html_e('Settings saved.','vowels-contact-form-with-drag-and-drop'); ?></p>
        </div>
    <?php endif; ?>
    <form method="post" action="">
        <h3 class="ifb-sub-head"><span><?php esc_html_e('Product license','vowels-contact-form-with-drag-and-drop'); ?></span></h3>
        <p><?php printf(esc_html__('A valid license key entitles you to support and enables automatic upgrades. %3$sA
        license key may only be used for one installation of WordPress at a time%4$s, if you have previously verified a license key on %1$sthis page%2$s.', 'vowels-contact-form-with-drag-and-drop'), '<a onclick="window.open(this.href); return false;" href="http://support.vowelsform.com/form-wordpress/faq/license/how-do-i-find-my-license-key-and-activate-form">', '</a>', '<span class="ifb-bold">', '</span>'); ?></p>
        <table class="form-table vowels-purchase-settings">
            <tr>
                <th scope="row"><?php esc_html_e('License status','vowels-contact-form-with-drag-and-drop'); ?></th>
                <td>
                    <?php $valid = (strlen(get_option('vowels_form_builder_licence_key'))) ? true : false; ?>
                    <div class="vowels-valid-licence-wrap <?php if (!$valid) echo 'ifb-hidden'; ?>"><span class="vowels-valid-licence"><?php esc_html_e('Valid license key','vowels-contact-form-with-drag-and-drop'); ?></span></div>
                    <div class="vowels-invalid-licence-wrap <?php if ($valid) echo 'ifb-hidden'; ?>"><span class="vowels-invalid-licence"><?php esc_html_e('Unlicensed product','vowels-contact-form-with-drag-and-drop'); ?></span></div>
                </td>
            </tr>
            <tr id="ifb-verify-purchase-code-row">
                <th scope="row"><?php esc_html_e('Enter license key','vowels-contact-form-with-drag-and-drop'); ?></th>
                <td><div class="vowels-verify-purchase-code-wrap qfb-cf"><input id="purchase_code" type="text" name="purchase_code" class="vowels-recaptcha-key-input" value="" /> <button class="ifb-button" id="verify-purchase-code"><?php esc_html_e('Verify','vowels-contact-form-with-drag-and-drop'); ?></button> <span class="vowels-verify-loading"></span> </div></td>
            </tr>
            <tr id="ifb-manual-update-check-row">
                <th scope="row"><?php esc_html_e('Check for updates','vowels-contact-form-with-drag-and-drop'); ?></th>
                <td>
                    <div class="ifb-update-check-wrap qfb-cf"><span class="ifb-update-check-current ifb-floated-text-beside-button"><?php printf(esc_html__('You are using version %s', 'vowels-contact-form-with-drag-and-drop'), VOWELSFORMDRAGDROP_VERSION); ?></span> <button class="ifb-button" id="ifb-check-for-updates"><?php esc_html_e('Check for updates','vowels-contact-form-with-drag-and-drop'); ?></button> <span class="vowels-update-check-loading"></span></div>
                </td>
            </tr>
        </table>
    </form>
    <form method="post" action="">
        <input type="password" class="ifb-hidden"><!-- Stop Chrome 34+ autofilling -->
        <h3 class="ifb-sub-head"><span><?php esc_html_e('reCAPTCHA settings','vowels-contact-form-with-drag-and-drop'); ?></span></h3>
        <p><?php printf(esc_html__('In order to use the reCAPTCHA element in your form you must %ssign up%s
        for a free account to get your set of API keys. Once you have your Site and Secret keys, enter them below.', 'vowels-contact-form-with-drag-and-drop'),
        '<a href="https://www.google.com/recaptcha/admin#createsite?app=vowelsform" target="_blank">', '</a>'); ?></p>
        <table class="form-table vowels-recaptcha-settings">
            <tr>
                <th scope="row"><?php esc_html_e('reCAPTCHA Site key','vowels-contact-form-with-drag-and-drop'); ?></th>
                <td><input type="text" name="recaptcha_site_key" class="vowels-recaptcha-key-input" value="<?php echo esc_attr(get_option('vowels_form_builder_recaptcha_site_key')); ?>" /></td>
            </tr>
            <tr>
                <th scope="row"><?php esc_html_e('reCAPTCHA Secret key','vowels-contact-form-with-drag-and-drop'); ?></th>
                <td><input type="text" name="recaptcha_secret_key" class="vowels-recaptcha-key-input" value="<?php echo esc_attr(get_option('vowels_form_builder_recaptcha_secret_key')); ?>" /></td>
            </tr>
        </table>
        <h3 class="ifb-sub-head"><span><?php esc_html_e('Email sending settings','vowels-contact-form-with-drag-and-drop'); ?></span></h3>
        <p><?php esc_html_e('The settings here will determine the default email sending settings for all your forms
        you can also override these settings for each form at Form Builder &rarr; Settings &rarr; Email.','vowels-contact-form-with-drag-and-drop'); ?></p>
        <table class="form-table vowels-email-settings">
            <?php
                $emailSendingMethod = get_option('vowels_form_builder_email_sending_method');
                $smtpSettings = get_option('vowels_form_builder_smtp_settings');
            ?>
            <tr valign="top">
                <th scope="row"><label for="global_email_sending_method"><?php esc_html_e('Email sending method','vowels-contact-form-with-drag-and-drop'); ?></label></th>
                <td>
                    <select id="global_email_sending_method" name="global_email_sending_method">
                        <option value="mail" <?php selected($emailSendingMethod, 'mail'); ?>><?php esc_html_e('PHP mail() (default)','vowels-contact-form-with-drag-and-drop'); ?></option>
                        <option value="smtp" <?php selected($emailSendingMethod, 'smtp'); ?>><?php esc_html_e('SMTP','vowels-contact-form-with-drag-and-drop'); ?></option>
                    </select>
                </td>
            </tr>
            <tr valign="top" class="<?php if ($emailSendingMethod !== 'smtp') echo 'ifb-hidden'; ?> vowels-show-if-smtp-on">
                <th scope="row"><label for="smtp_host"><?php esc_html_e('SMTP host','vowels-contact-form-with-drag-and-drop'); ?></label></th>
                <td>
                    <input type="text" name="smtp_host" id="smtp_host" value="<?php echo esc_attr($smtpSettings['host']); ?>" />
                </td>
            </tr>
            <tr valign="top" class="<?php if ($emailSendingMethod !== 'smtp') echo 'ifb-hidden'; ?> vowels-show-if-smtp-on">
                <th scope="row"><label for="smtp_port"><?php esc_html_e('SMTP port','vowels-contact-form-with-drag-and-drop'); ?></label></th>
                <td>
                    <input type="text" name="smtp_port" id="smtp_port" value="<?php echo esc_attr($smtpSettings['port']); ?>" />
                </td>
            </tr>
            <tr valign="top" class="<?php if ($emailSendingMethod !== 'smtp') echo 'ifb-hidden'; ?> vowels-show-if-smtp-on">
                <th scope="row"><label for="smtp_encryption"><?php esc_html_e('SMTP encryption','vowels-contact-form-with-drag-and-drop'); ?></label></th>
                <td>
                    <select id="smtp_encryption" name="smtp_encryption">
                        <option value="" <?php selected($smtpSettings['encryption'], ''); ?>><?php esc_html_e('None','vowels-contact-form-with-drag-and-drop'); ?></option>
                        <option value="tls" <?php selected($smtpSettings['encryption'], 'tls'); ?>><?php esc_html_e('TLS','vowels-contact-form-with-drag-and-drop'); ?></option>
                        <option value="ssl" <?php selected($smtpSettings['encryption'], 'ssl'); ?>><?php esc_html_e('SSL','vowels-contact-form-with-drag-and-drop'); ?></option>
                    </select>
                </td>
            </tr>
            <tr valign="top" class="<?php if ($emailSendingMethod !== 'smtp') echo 'ifb-hidden'; ?> vowels-show-if-smtp-on">
                <th scope="row"><label for="smtp_username"><?php esc_html_e('SMTP username','vowels-contact-form-with-drag-and-drop'); ?></label></th>
                <td>
                    <input type="text" name="smtp_username" id="smtp_username" value="<?php echo esc_attr($smtpSettings['username']); ?>" />
                </td>
            </tr>
            <tr valign="top" class="<?php if ($emailSendingMethod !== 'smtp') echo 'ifb-hidden'; ?> vowels-show-if-smtp-on">
                <th scope="row"><label for="smtp_password"><?php esc_html_e('SMTP password','vowels-contact-form-with-drag-and-drop'); ?></label></th>
                <td>
                    <?php if (strlen($smtpSettings['password'])) : ?>
                        <span id="ifb-saved-smtp-password-message" class="ifb-floated-text-beside-button"><?php esc_html_e('A password is saved but hidden for security reasons.','vowels-contact-form-with-drag-and-drop'); ?></span><div class="ifb-button" id="ifb-set-new-smtp-password"><?php esc_html_e('Change password','vowels-contact-form-with-drag-and-drop'); ?></div>
                    <?php else : ?>
                        <input type="password" name="smtp_password" id="smtp_password">
                    <?php endif; ?>
                </td>
            </tr>
            <?php $emailReturnPath = get_option('vowels_form_builder_email_returnpath'); ?>
            <tr valign="top">
                <th scope="row"><?php esc_html_e('Email "Return-Path" address','vowels-contact-form-with-drag-and-drop'); ?></th>
                <td><input type="text" name="email_returnpath" value="<?php echo esc_attr($emailReturnPath); ?>" /></td>
            </tr>
        </table>
        <h3 class="ifb-sub-head"><span><?php esc_html_e('Update active themes cache','vowels-contact-form-with-drag-and-drop'); ?></span></h3>
        <p><?php esc_html_e('If you have added or removed a form from the database directly, e.g. via phpMyAdmin then you should tick
        the box below and Save Changes to make sure the correct themes are being loaded for all your active forms.','vowels-contact-form-with-drag-and-drop'); ?></p>
        <p><label class="ifb-bold"><input type="checkbox" value="1" name="vowels_form_builder_update" id="vowels_form_builder_update" /> <?php esc_html_e('Update active themes cache','vowels-contact-form-with-drag-and-drop'); ?></label></p>

        <h3 class="ifb-sub-head"><span><?php esc_html_e('Disable script output','vowels-contact-form-with-drag-and-drop'); ?></span></h3>
        <p><?php esc_html_e('You can disable the output of the scripts used by the Vowelsform plugin below by ticking the boxes below. This will disable both the CSS and JavaScript for the script.','vowels-contact-form-with-drag-and-drop'); ?></p>
        <p><label class="ifb-bold"><input type="checkbox" value="1" name="disable_fancybox_output" id="disable_fancybox_output" <?php checked(true, get_option('vowels_form_builder_disable_fancybox_output')); ?> /> <?php esc_html_e('Disable Fancybox output','vowels-contact-form-with-drag-and-drop'); ?></label></p>
        <p><label class="ifb-bold"><input type="checkbox" value="1" name="disable_qtip_output" id="disable_qtip_output" <?php checked(true, get_option('vowels_form_builder_disable_qtip_output')); ?> /> <?php esc_html_e('Disable qTip2 output','vowels-contact-form-with-drag-and-drop'); ?></label></p>
        <p><label class="ifb-bold"><input type="checkbox" value="1" name="disable_infieldlabels_output" id="disable_infieldlabels_output" <?php checked(true, get_option('vowels_form_builder_disable_infieldlabels_output')); ?> /> <?php esc_html_e('Disable Infield Labels output','vowels-contact-form-with-drag-and-drop'); ?></label></p>
        <p><label class="ifb-bold"><input type="checkbox" value="1" name="disable_smoothscroll_output" id="disable_smoothscroll_output" <?php checked(true, get_option('vowels_form_builder_disable_smoothscroll_output')); ?> /> <?php esc_html_e('Disable Smooth Scroll output','vowels-contact-form-with-drag-and-drop'); ?></label></p>
        <p><label class="ifb-bold"><input type="checkbox" value="1" name="disable_jqueryui_output" id="disable_jqueryui_output" <?php checked(true, get_option('vowels_form_builder_disable_jqueryui_output')); ?> /> <?php esc_html_e('Disable jQuery UI output','vowels-contact-form-with-drag-and-drop'); ?></label></p>
        <p><label class="ifb-bold"><input type="checkbox" value="1" name="disable_uniform_output" id="disable_uniform_output" <?php checked(true, get_option('vowels_form_builder_disable_uniform_output')); ?> /> <?php esc_html_e('Disable Uniform output','vowels-contact-form-with-drag-and-drop'); ?></label></p>
        <p><label class="ifb-bold"><input type="checkbox" value="1" name="disable_fileupload_output" id="disable_fileupload_output" <?php checked(true, get_option('vowels_form_builder_disable_fileupload_output')); ?> /> <?php esc_html_e('Disable jQuery File Upload output','vowels-contact-form-with-drag-and-drop'); ?></label></p>

        <h3 class="ifb-sub-head"><span><?php esc_html_e('Disable [raw] tag detection','vowels-contact-form-with-drag-and-drop'); ?></span></h3>
        <p><?php esc_html_e('The plugin detects if the theme supports [raw] tags to help with form display issues. You can turn this off here to potentially fix conflicts with some themes.','vowels-contact-form-with-drag-and-drop'); ?></p>
        <p><label class="ifb-bold"><input type="checkbox" value="1" name="disable_raw_detection" id="disable_raw_detection" <?php checked(true, get_option('vowels_form_builder_disable_raw_detection')); ?> /> <?php esc_html_e('Disable [raw] tag detection','vowels-contact-form-with-drag-and-drop'); ?></label></p>

        <h3 class="ifb-sub-head"><span><?php esc_html_e('Enable lightbox script (Fancybox)','vowels-contact-form-with-drag-and-drop'); ?></span></h3>
        <p><?php esc_html_e('This option is enabled automatically when you add a form
        in a popup to a post / page or when you add a Vowelsform Popup widget. If this does not happen for some reason
        you can tick this option to manually enable the Fancybox script. If you have disabled Fancybox output in the above settings
        the script output will still be disabled.','vowels-contact-form-with-drag-and-drop'); ?></p>
        <p><label class="ifb-bold"><input type="checkbox" value="1" name="fancybox_requested" id="fancybox_requested" <?php checked(true, get_option('vowels_form_builder_fancybox_requested')); ?> /> <?php esc_html_e('Enable Fancybox','vowels-contact-form-with-drag-and-drop'); ?></label></p>

        <h3 class="ifb-sub-head"><span><?php esc_html_e('Server compatibility','vowels-contact-form-with-drag-and-drop'); ?></span></h3>
        <table class="form-table vowels-server-compat">
            <?php
            $phpVersion = phpversion();
            $phpVersionGood = version_compare($phpVersion, '5.0.0', '>=');
            ?>
            <tr valign="top">
                <th scope="row"><label><?php esc_html_e('PHP Version','vowels-contact-form-with-drag-and-drop'); ?></label></th>
                <td class="vowels-server-compat-col2"><?php echo $phpVersion; ?></td>
                <td class="vowels-server-compat-col3"><?php echo $phpVersionGood ? '<img src="'.vowels_form_builder_admin_url().'/images/vowels-success.png" alt="" />' : '<img src="'.vowels_form_builder_admin_url().'/images/vowels-warning.png" alt="" />'; ?></td>
                <td><?php if (!$phpVersionGood) echo '<span class="ifb-compat-error">' . esc_html__('The plugin requires PHP version 5 or later.','vowels-contact-form-with-drag-and-drop') . '</span>'; ?></td>
            </tr>
            <?php
            global $wpdb;
            $mysqlVersion = $wpdb->db_version();
            $mysqlVersionGood = version_compare($mysqlVersion, '5.0.0', '>=');
            ?>
            <tr valign="top">
                <th scope="row"><label><?php esc_html_e('MySQL Version','vowels-contact-form-with-drag-and-drop'); ?></label></th>
                <td><?php echo $mysqlVersion; ?></td>
                <td><?php echo $mysqlVersionGood ? '<img src="'.vowels_form_builder_admin_url().'/images/vowels-success.png" alt="" />' : '<img src="'.vowels_form_builder_admin_url().'/images/vowels-warning.png" alt="" />'; ?></td>
                <td><?php if (!$mysqlVersionGood) echo '<span class="ifb-compat-error">' . esc_html__('The plugin requires MySQL version 5 or later.','vowels-contact-form-with-drag-and-drop') . '</span>'; ?></td>
            </tr>
            <?php
            $wordpressVersion = get_bloginfo('version');
            $wordpressVersionGood = version_compare($wordpressVersion, '3.1', '>=');
            ?>
            <tr valign="top">
                <th scope="row"><label><?php esc_html_e('WordPress Version','vowels-contact-form-with-drag-and-drop'); ?></label></th>
                <td><?php echo $wordpressVersion; ?></td>
                <td><?php echo $wordpressVersionGood ? '<img src="'.vowels_form_builder_admin_url().'/images/vowels-success.png" alt="" />' : '<img src="'.vowels_form_builder_admin_url().'/images/vowels-warning.png" alt="" />'; ?></td>
                <td><?php if (!$wordpressVersionGood) echo '<span class="ifb-compat-error">' . esc_html__('The plugin requires WordPress version 3.1 or later.','vowels-contact-form-with-drag-and-drop') . '</span>'; ?></td>
            </tr>
            <?php
            $gdImageLibaryGood = function_exists('imagecreate');
            ?>
            <tr valign="top">
                <th scope="row"><label><?php esc_html_e('GD Image Library','vowels-contact-form-with-drag-and-drop'); ?></label></th>
                <td><?php echo $gdImageLibaryGood ? __('Available','vowels-contact-form-with-drag-and-drop') : __('Unavailable','vowels-contact-form-with-drag-and-drop'); ?></td>
                <td><?php echo $gdImageLibaryGood ? '<img src="'.vowels_form_builder_admin_url().'/images/vowels-success.png" alt="" />' : '<img src="'.vowels_form_builder_admin_url().'/images/vowels-warning.png" alt="" />'; ?></td>
                <td><?php if (!$gdImageLibaryGood) echo '<span class="ifb-compat-error">' . esc_html__('The plugin requires the GD image library for the CAPTCHA element, please ask your host to install it.','vowels-contact-form-with-drag-and-drop') . '</span>'; ?></td>
            </tr>
            <?php
            $ftLibaryGood = function_exists('imagettftext');
            ?>
            <tr valign="top">
                <th scope="row"><label><?php esc_html_e('FreeType Library','vowels-contact-form-with-drag-and-drop'); ?></label></th>
                <td><?php echo $ftLibaryGood ? __('Available','vowels-contact-form-with-drag-and-drop') : __('Unavailable','vowels-contact-form-with-drag-and-drop'); ?></td>
                <td><?php echo $ftLibaryGood ? '<img src="'.vowels_form_builder_admin_url().'/images/vowels-success.png" alt="" />' : '<img src="'.vowels_form_builder_admin_url().'/images/vowels-warning.png" alt="" />'; ?></td>
                <td><?php if (!$ftLibaryGood) echo '<span class="ifb-compat-error">' . esc_html__('The plugin requires the FreeType library for the CAPTCHA element, please ask your host to install it.','vowels-contact-form-with-drag-and-drop') . '</span>'; ?></td>
            </tr>
            <?php
            $mbStringGood = extension_loaded('mbstring');
            ?>
            <tr valign="top">
                <th scope="row"><label><?php esc_html_e('mbstring Extension','vowels-contact-form-with-drag-and-drop'); ?></label></th>
                <td><?php echo $mbStringGood ? __('Available','vowels-contact-form-with-drag-and-drop') : __('Unavailable','vowels-contact-form-with-drag-and-drop'); ?></td>
                <td><?php echo $mbStringGood ? '<img src="'.vowels_form_builder_admin_url().'/images/vowels-success.png" alt="" />' : '<img src="'.vowels_form_builder_admin_url().'/images/vowels-warning.png" alt="" />'; ?></td>
                <td><?php if (!$mbStringGood) echo '<span class="ifb-compat-error">' . esc_html__('The plugin requires the mbstring PHP extension for the CSS system, please ask your host to install it.','vowels-contact-form-with-drag-and-drop') . '</span>'; ?></td>
            </tr>
            <?php
            $tempDir = vowels_form_builder_get_temp_dir();
            $tempDirGood = is_writeable($tempDir);
            ?>
            <tr valign="top">
                <th scope="row"><label><?php esc_html_e('Temporary Directory','vowels-contact-form-with-drag-and-drop'); ?></label></th>
                <td><?php echo $tempDir; ?></td>
                <td><?php echo $tempDirGood ? '<img src="'.vowels_form_builder_admin_url().'/images/vowels-success.png" alt="" />' : '<img src="'.vowels_form_builder_admin_url().'/images/vowels-warning.png" alt="" />'; ?></td>
                <td><?php if (!$tempDirGood) echo '<span class="ifb-compat-error">' . sprintf(esc_html__('The plugin requires a writeable temporary directory for file uploading. You can set a custom temporary directory path in your wp-config.php file by using the code %1$sdefine("WP_TEMP_DIR", "/path/to/tmp/dir");%2$s', 'vowels-contact-form-with-drag-and-drop'), '<code>', '</code>') . '</span>'; ?></td>
            </tr>
        </table>

        <p class="submit vowels-save-settings"><input type="submit" value="<?php esc_attr_e('Save Changes','vowels-contact-form-with-drag-and-drop'); ?>" class="button-primary" name="vowels_form_builder_settings" /></p>
    </form>
</div>
