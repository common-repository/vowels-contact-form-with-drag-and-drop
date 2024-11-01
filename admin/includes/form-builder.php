<?php if (!defined('VOWELSFORMDRAGDROP_VERSION')) exit; ?><div id="ifb-top" class="wrap qfb-cf">
    <div class="vowels-top-right">
        <div class="vowels-information">
            <span class="vowels-copyright"><a href="http://www.Vowelsform.com" onclick="window.open(this.href); return false;">www.Vowelsform.com</a> &copy; <?php echo date('Y'); ?></span>
            <span class="vowels-bug-link"><a href="http://www.Vowelsform.com/support.php" onclick="window.open(this.href); return false;"><?php esc_html_e('Report a bug','vowels-contact-form-with-drag-and-drop'); ?></a></span>
            <span class="vowels-help-link"><a href="<?php echo vowels_form_builder_help_link(); ?>" onclick="window.open(this.href); return false;"><?php esc_html_e('Help','vowels-contact-form-with-drag-and-drop'); ?></a></span>
        </div>
    </div>
    <?php if (is_array($form)) : ?>
    <div class="ifb-form-icon"></div>
    <?php if (!isset($form['name'])) $form['name'] = __('New form','vowels-contact-form-with-drag-and-drop'); ?>
    <h2 class="ifb-main-title"><span class="ifb-vowels-title"><?php echo esc_html(vowels_form_builder_get_plugin_name()); ?></span><?php esc_html_e('Form Builder','vowels-contact-form-with-drag-and-drop'); ?><span class="ifb-vowels-title-form-name ifb-update-form-name ifb-hidden"><?php echo esc_html($form['name']); ?></span></h2>
        <?php
            if (!get_option('vowels_form_builder_hide_nag_message')) {
                $uploadDir = wp_upload_dir();
                if (($uploadDir['error'] !== false || !is_writable($uploadDir['basedir']))) {
                    echo '<div id="ifb-nag-message" class="vowels-admin-notice error"><p><strong>' . sprintf(esc_html__('The WordPress uploads directory is not writable, it will not be possible to save files uploaded via your forms. %sPermanently hide this message%s', 'vowels-contact-form-with-drag-and-drop'), '<a href="javascript:;" onclick="vowelsforminc.hideNagMessage(); return false;">', '</a>') . '</strong></p></div>';
                }
            }

            if (!strlen(get_option('vowels_form_builder_licence_key'))) {
                echo '<div class="error"><p><strong>' . sprintf(esc_html__('You are using an unlicensed version. Please %senter your license key%s or %spurchase a license key%s.', 'vowels-contact-form-with-drag-and-drop'), '<a href="' . admin_url('admin.php?page=vowels_form_builder_settings') .'">', '</a>', '<a href="http://www.vowelsform.com/buy.php" onclick="window.open(this.href); return false;">', '</a>') . '</strong></p></div>';
            }
        ?>

        <div class="vowels-global-nav-wrap qfb-cf">
            <ul class="vowels-global-nav-ul">
                <?php if (current_user_can('vowels_form_builder_list_forms')) : ?>
                    <li><a href="admin.php?page=vowels_form_builder_forms"><span class="ifb-no-arrow"><?php esc_html_e('All Forms','vowels-contact-form-with-drag-and-drop'); ?></span></a></li>
                <?php endif; ?>
                <li>
                 <div class="vowels-form-switcher">
                    <a id="vowels-form-switcher-trigger" class="ifb-form-switcher-closed"><span class="ifb-arrow-down"><?php esc_html_e('Switch Form','vowels-contact-form-with-drag-and-drop'); ?></span></a>
                    <div class="vowels-form-switcher-list">
                        <ul class="qfb-cf">
                            <li class="vowels-create-new qfb-cf"><a title="<?php esc_attr_e('Create a new form','vowels-contact-form-with-drag-and-drop'); ?>" href="admin.php?page=vowels_form_builder_form_builder"><?php esc_html_e('Create a new form','vowels-contact-form-with-drag-and-drop'); ?><span class="ifb-add-icon"></span></a></li>
                            <?php if (count($switchForms)) : ?>
                                <?php foreach ($switchForms as $switchForm) : ?>
                                    <li class="qfb-cf"><a title="<?php echo esc_attr($switchForm['name']); ?>" href="<?php echo esc_url(admin_url('admin.php?page=vowels_form_builder_form_builder&id=' . absint($switchForm['id']))); ?>"><?php echo esc_html($switchForm['name']); ?><span class="ifb-fade-overflow"></span></a></li>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
                </li>
                <?php if (current_user_can('vowels_form_builder_view_entries')) : ?>
                    <li><a id="vowels-builder-to-entries-link" class="ifb-hide-if-new-form" href="<?php echo admin_url('admin.php?page=vowels_form_builder_entries&amp;id=' . $id); ?>"><span class="ifb-no-arrow"><?php esc_html_e('Entries','vowels-contact-form-with-drag-and-drop'); ?></span></a></li>
                <?php endif; ?>
                <li><a id="vowels-add-to-website" class="ifb-add-to-website-closed ifb-hide-if-new-form"><span class="ifb-arrow-down"><?php esc_html_e('Add to website','vowels-contact-form-with-drag-and-drop'); ?></span></a></li>
                <li><a id="vowels-reload-link" class="ifb-hide-if-new-form" href="<?php echo admin_url('admin.php?page=vowels_form_builder_form_builder&amp;id=' . $id); ?>"><span class="ifb-no-arrow"><?php esc_html_e('Reload','vowels-contact-form-with-drag-and-drop'); ?></span></a></li>
            </ul>
            <div class="vowels-current-form ifb-hidden">
                <span id="ifb-current-form-name" class="ifb-update-form-name"><?php echo esc_html($form['name']); ?></span><span class="ifb-current-form-id-wrap">(<span class="ifb-update-form-id"><?php echo $id; ?></span>)</span>
            </div>
        </div>

        <div id="ifb-first-save-message">
            <div id="ifb-first-save-close"></div>
            <h2><?php esc_html_e('You can now add the form to any post, page or widget.','vowels-contact-form-with-drag-and-drop'); ?></h2>
            <div id="ifb-first-save-accordion">
                <h3 class="ifb-show-atw-content ifb-show-atw-content-closed"><?php esc_html_e('Add your form to a post or page','vowels-contact-form-with-drag-and-drop'); ?></h3>
                <div class="ifb-add-to-website-content-area ifb-first-save-1">
                <p><?php esc_html_e('Add or edit the page you want to show the form on. If you look above
                    the visual editor you should see a Vowelsform icon above it, as shown below.','vowels-contact-form-with-drag-and-drop'); ?></p>
                <p><img src="<?php echo vowels_form_builder_admin_url() . '/images/insert-screenshot.png'; ?>" alt="" /></p>
                <p><?php esc_html_e('Click the Vowelsform icon and a popup should appear, select the form from
                    the list and click the Insert form button. The shortcode for this form should now appear
                    inside the page editor. Alternatively, you can copy and paste one of the shortcodes below into your
                    post or page content.','vowels-contact-form-with-drag-and-drop'); ?></p>
                <h4><?php esc_html_e('Standard form','vowels-contact-form-with-drag-and-drop'); ?></h4>
                <div id="ifb-shortcode-preview-form" class="ifb-shortcode-preview qfb-cf">[vowels id="<?php echo $id; ?>" name="<?php echo esc_html($form['name']); ?>"]</div>
                <h4><?php esc_html_e('Popup form','vowels-contact-form-with-drag-and-drop'); ?></h4>
                <div id="ifb-shortcode-preview-popup" class="ifb-shortcode-preview qfb-cf">[vowels_form_builder_popup id="<?php echo $id; ?>" name="<?php echo esc_html($form['name']); ?>"]<?php esc_html_e('Change this to the text or HTML that will trigger the popup','vowels-contact-form-with-drag-and-drop'); ?>[/vowels_form_builder_popup]</div>
                </div>
                <h3 class="ifb-show-atw-content ifb-show-atw-content-closed"><?php esc_html_e('Add your form as a widget','vowels-contact-form-with-drag-and-drop'); ?></h3>
                <div class="ifb-add-to-website-content-area ifb-first-save-2">
                <p><?php esc_html_e('To add the form as a widget into a widget enabled area, go to the Appearance &rarr; Widgets
                    in the WordPress navigation. Find the widget with the title "Vowelsform" (or "Vowelsform Popup" for a popup form) and simply
                    drag it to your widget enabled area. Select one of the forms from the dropdown menu
                    and click Save.','vowels-contact-form-with-drag-and-drop'); ?></p>
                </div>
                <h3 class="ifb-show-atw-content ifb-show-atw-content-closed"><?php esc_html_e('Add your form to a theme PHP file','vowels-contact-form-with-drag-and-drop'); ?></h3>
                <div class="ifb-add-to-website-content-area ifb-first-save-3">
                <p><?php esc_html_e('To add this form to one of your theme PHP files, use one of the PHP snippets below.','vowels-contact-form-with-drag-and-drop'); ?></p>
                <h4><?php esc_html_e('Standard form','vowels-contact-form-with-drag-and-drop'); ?></h4>
                <pre>&lt;?php if (function_exists('vowels')) echo vowels(<span class="ifb-update-form-id"><?php echo $id; ?></span>); ?&gt;</pre>
                <h4><?php esc_html_e('Popup form','vowels-contact-form-with-drag-and-drop'); ?></h4>
                <pre>&lt;?php if (function_exists('vowels_form_builder_popup')) echo vowels_form_builder_popup(<span class="ifb-update-form-id"><?php echo $id; ?></span>, '<?php esc_html_e('Change this to the text or HTML that will trigger the popup','vowels-contact-form-with-drag-and-drop'); ?>'); ?&gt;</pre>
                </div>
            </div>
        </div>
        <div id="ifb-new-form-name-overlay" class="ifb-new-form-name-overlay">
            <div class="ifb-new-form-name-outer">
                <div class="ifb-new-form-name-close">x</div>
               <div class="ifb-new-form-name-inner">
                    <div class="ifb-new-form-name-inner2 qfb-cf">
                        <input id="new_form_name" class="new-form-name" type="text" value="" autocomplete="off" placeholder="<?php esc_html_e('Enter name for your new form', 'vowels-contact-form-with-drag-and-drop'); ?>" />
                    </div>
                    <p class="description"><?php 
					$vowels_txt175 = __( 'New Post', 'vowels-contact-form-with-drag-and-drop' );	
					$vowels_txt176 = __( '<input type="text" onfocus="this.select();" size="12" readonly="readonly" value="[vowels id=&quot;1&quot;]"> or <input type="text" onfocus="this.select();" size="12" readonly="readonly" value="[vowels id=&quot;2&quot;]"> in ', 'vowels-contact-form-with-drag-and-drop' );	
					$postlinkk='<a href="'. esc_url( admin_url('post-new.php') ).'" target="_blank">'.$vowels_txt175.'</a>';
					$vowels_txt186 = __( 'Or load Prebuilt forms here', 'vowels-contact-form-with-drag-and-drop' );	

				echo '<br>Or use Inbuilt Shortcodes below<br>'.$vowels_txt176.' '.$postlinkk.'<br><br>'.$vowels_txt186.'<a href="/wp-admin/admin.php?page=vowels_form_builder_form_builder&id=1" target="_blank"> Above </a><a href="/wp-admin/admin.php?page=vowels_form_builder_form_builder&id=2" target="_blank"> Inside</a>'; ?> <span class="blink_infi"> |</span></p><br><br><br>
					<div class="ifb-new-form-name-ok"><?php esc_html_e('+', 'vowels-contact-form-with-drag-and-drop'); ?></div>

                </div>
            </div>
        </div>
        <form id="ifb" method="post" action="">
        <div class="ifb-wrap-outer">
            <input type="submit" class="ifb-hidden" /><!-- Prevent the enter key doing wierd stuff -->
            <input type="password" class="ifb-hidden"><!-- Stop Chrome 34+ autofilling -->
            <div class="ifb-wrap qfb-cf">
                <div class="ifb-right-col">
                    <div class="ifb-right-scroll-wrap">
                        <div class="ifb-add-element-wrap">
                            <div id="ifb-add-element-tabs">
                                <ul class="ifb-tabs-nav">
                                  <li><a href="#ifb-add-element-popular"><?php esc_html_e('Popular','vowels-contact-form-with-drag-and-drop'); ?></a></li>
                                  <li><a href="#ifb-add-element-more"><?php esc_html_e('More','vowels-contact-form-with-drag-and-drop'); ?></a></li>
                               </ul>
                               <div id="ifb-add-element-popular" class="ifb-add-element-list ifb-tabs-panel">
                                    <ul class="ifb-add-element-ul">
                                        <li><div class="ifb-add-element-button" data-type="text" onclick="vowelsforminc.addElement('text'); return false;"><?php esc_html_e('Single Line Text','vowels-contact-form-with-drag-and-drop'); ?></div></li>
                                        <li><div class="ifb-add-element-button" data-type="textarea" onclick="vowelsforminc.addElement('textarea'); return false;"><?php esc_html_e('Paragraph Text','vowels-contact-form-with-drag-and-drop'); ?></div></li>
                                        <li><div class="ifb-add-element-button" data-type="email" onclick="vowelsforminc.addElement('email'); return false;"><?php esc_html_e('Email Address','vowels-contact-form-with-drag-and-drop'); ?></div></li>
                                        <li><div class="ifb-add-element-button" data-type="select" onclick="vowelsforminc.addElement('select'); return false;"><?php esc_html_e('Dropdown Menu','vowels-contact-form-with-drag-and-drop'); ?></div></li>
                                        <li><div class="ifb-add-element-button" data-type="checkbox" onclick="vowelsforminc.addElement('checkbox'); return false;"><?php esc_html_e('Checkboxes','vowels-contact-form-with-drag-and-drop'); ?></div></li>
                                        <li><div class="ifb-add-element-button" data-type="radio" onclick="vowelsforminc.addElement('radio'); return false;"><?php esc_html_e('Multiple Choice','vowels-contact-form-with-drag-and-drop'); ?></div></li>
                                        <li><div class="ifb-add-element-button" data-type="captcha" onclick="vowelsforminc.addElement('captcha'); return false;"><?php esc_html_e('CAPTCHA','vowels-contact-form-with-drag-and-drop'); ?></div></li>
                                        <li><div class="ifb-add-element-button" data-type="group" onclick="vowelsforminc.addElement('group'); return false;"><?php esc_html_e('Group','vowels-contact-form-with-drag-and-drop'); ?></div></li>
                                    </ul>
                                </div>
                                <div id="ifb-add-element-more" class="ifb-add-element-list ifb-tabs-panel">
                                    <ul class="ifb-add-element-ul">
                                        <li><div class="ifb-add-element-button" data-type="file" onclick="vowelsforminc.addElement('file'); return false;"><?php esc_html_e('File Upload','vowels-contact-form-with-drag-and-drop'); ?></div></li>
                                        <li><div class="ifb-add-element-button" data-type="recaptcha" onclick="vowelsforminc.addElement('recaptcha'); return false;"><?php esc_html_e('reCAPTCHA','vowels-contact-form-with-drag-and-drop'); ?></div></li>
                                        <li><div class="ifb-add-element-button" data-type="html" onclick="vowelsforminc.addElement('html'); return false;"><?php esc_html_e('HTML','vowels-contact-form-with-drag-and-drop'); ?></div></li>
                                        <li><div class="ifb-add-element-button" data-type="date" onclick="vowelsforminc.addElement('date'); return false;"><?php esc_html_e('Date','vowels-contact-form-with-drag-and-drop'); ?></div></li>
                                        <li><div class="ifb-add-element-button" data-type="time" onclick="vowelsforminc.addElement('time'); return false;"><?php esc_html_e('Time','vowels-contact-form-with-drag-and-drop'); ?></div></li>
                                        <li><div class="ifb-add-element-button" data-type="hidden" onclick="vowelsforminc.addElement('hidden'); return false;"><?php esc_html_e('Hidden','vowels-contact-form-with-drag-and-drop'); ?></div></li>
                                        <li><div class="ifb-add-element-button" data-type="password" onclick="vowelsforminc.addElement('password'); return false;"><?php esc_html_e('Password','vowels-contact-form-with-drag-and-drop'); ?></div></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="ifb-buttons qfb-cf">
                            <a class="ifb-grey" onclick="vowelsforminc.preview(); return false;"><?php esc_html_e('Preview','vowels-contact-form-with-drag-and-drop'); ?></a>
                            <a class="ifb-blue" onclick="vowelsforminc.saveForm(this, '<?php echo wp_create_nonce('vowels_form_builder_save_form'); ?>'); return false;">
                                <span class="ifb-save"><?php esc_attr_e('Save','vowels-contact-form-with-drag-and-drop'); ?></span>
                                <span class="ifb-saving"></span>
                                <span class="ifb-saved"></span>
                                <span class="ifb-save-failed"></span>
                            </a>

                        </div>
                    </div>
                </div>
                <div class="ifb-left-col">
                    <div id="ifb-message-area"></div>
                    <div id="ifb-tabs">
                        <ul class="ifb-tabs-nav">
                            <li><a id="ifb-edit-form-tab" title="<?php esc_attr_e('Edit your form','vowels-contact-form-with-drag-and-drop'); ?>" href="#ifb-elements"><span></span><?php esc_html_e('Form','vowels-contact-form-with-drag-and-drop'); ?></a></li>
                            <li><a id="ifb-settings-tab"  title="<?php esc_attr_e('Global form settings','vowels-contact-form-with-drag-and-drop'); ?>" href="#ifb-settings"><span></span><?php esc_html_e('Settings','vowels-contact-form-with-drag-and-drop'); ?></a></li>
                        </ul>
                        <?php if (!isset($form['elements'])) $form['elements'] = array(); ?>
                        <div class="ifb-tabs-panel" id="ifb-elements">
                            <h2 id="ifb-title" class="ifb-hidden"></h2>
                            <p id="ifb-description" class="ifb-hidden"></p>
                            <p id="ifb-elements-empty">
                                <span class="ibf-elements-empty-line1"><?php esc_html_e('Submit button will be added automatically','vowels-contact-form-with-drag-and-drop'); ?></span>
                                <span class="ibf-elements-empty-line2"><?php esc_html_e('(drop an element here or just click it)','vowels-contact-form-with-drag-and-drop'); ?></span>
                            </p>
                            <div id="ifb-elements-wrap">
                                <?php
                                    foreach ($form['elements'] as $element) {
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
                                                break;
                                        }
                                    }
                                ?>
                            </div>
                        </div>
                        <div class="ifb-tabs-panel" id="ifb-settings">
                            <div id="ifb-settings-tabs">
                                <ul class="ifb-tabs-nav">
                                    <li><a title="<?php esc_attr_e('Common settings','vowels-contact-form-with-drag-and-drop'); ?>" href="#ifb-settings-general"><?php esc_html_e('General','vowels-contact-form-with-drag-and-drop'); ?></a></li>
                                    <li><a title="<?php esc_attr_e('What the form will look like','vowels-contact-form-with-drag-and-drop'); ?>" href="#ifb-settings-style"><?php esc_html_e('Style','vowels-contact-form-with-drag-and-drop'); ?></a></li>
                                    <li><a title="<?php esc_attr_e("Where the data is sent and how it's displayed", 'vowels-contact-form-with-drag-and-drop'); ?>" href="#ifb-settings-email"><?php esc_html_e('Email','vowels-contact-form-with-drag-and-drop'); ?></a></li>
                                    <li><a title="<?php esc_attr_e('Set up saving submitted form entries','vowels-contact-form-with-drag-and-drop'); ?>" href="#ifb-settings-entries"><?php echo esc_html_x('Entries', 'saved submitted form entries','vowels-contact-form-with-drag-and-drop'); ?></a></li>
                                    <li><a title="<?php esc_attr_e('Save form data to a custom database','vowels-contact-form-with-drag-and-drop'); ?>" href="#ifb-settings-database"><?php esc_html_e('Database','vowels-contact-form-with-drag-and-drop'); ?></a></li>
                                </ul>
                                <div class="ifb-tabs-panel" id="ifb-settings-general">
                                    <table class="ifb-form-table ifb-settings-form-table ifb-settings-general-form-table">
                                        <tr class="ifb-settings-sub-head" valign="top">
                                            <td colspan="2" scope="row"><h3><?php esc_html_e('Form information','vowels-contact-form-with-drag-and-drop'); ?></h3></td>
                                        </tr>
                                        <tr valign="top">
                                            <th scope="row">
                                            <div class="ifb-tooltip"><div class="ifb-tooltip-content"><?php esc_html_e('This is your form name within WordPress, it will not appear on your website','vowels-contact-form-with-drag-and-drop'); ?></div></div>
                                            <label for="name"><?php esc_html_e('Name','vowels-contact-form-with-drag-and-drop'); ?></label></th>
                                            <td>
                                                <input type="text" name="name" id="name" onkeyup="vowelsforminc.updateFormName();" value="<?php echo esc_attr($form['name']); ?>" />
                                                <p class="description"><?php esc_html_e('Give the form a name','vowels-contact-form-with-drag-and-drop'); ?></p>
                                            </td>
                                        </tr>
                                        <?php if (!isset($form['title'])) $form['title'] = ''; ?>
                                        <tr valign="top">
                                            <th scope="row">
                                             <div class="ifb-tooltip"><div class="ifb-tooltip-content"><?php esc_html_e('The heading that will show above the form on your website','vowels-contact-form-with-drag-and-drop'); ?></div></div>
                                            <label for="title"><?php esc_html_e('Title','vowels-contact-form-with-drag-and-drop'); ?></label></th>
                                            <td>
                                                <input type="text" name="title" id="title" onkeyup="vowelsforminc.updateFormTitle();" value="<?php echo _wp_specialchars($form['title'], ENT_COMPAT, false, true); ?>" />
                                                <p class="description"><?php esc_html_e('Title to display above the form','vowels-contact-form-with-drag-and-drop'); ?></p>
                                            </td>
                                        </tr>
                                        <?php if (!isset($form['description'])) $form['description'] = ''; ?>
                                        <tr valign="top">
                                            <th scope="row">
                                            <div class="ifb-tooltip"><div class="ifb-tooltip-content"><?php esc_html_e('The description that will show below the form title.','vowels-contact-form-with-drag-and-drop'); ?></div></div>
                                            <label for="description"><?php esc_html_e('Description','vowels-contact-form-with-drag-and-drop'); ?></label></th>
                                            <td>
                                                <textarea name="description" id="description" onkeyup="vowelsforminc.updateFormDescription();"><?php echo _wp_specialchars($form['description'], ENT_NOQUOTES, false, true); ?></textarea>
                                                <p class="description"><?php esc_html_e('Description to display above the form','vowels-contact-form-with-drag-and-drop'); ?></p>
                                            </td>
                                        </tr>
                                        <?php if (!isset($form['active'])) $form['active'] = true; ?>
                                        <tr valign="top">
                                            <th scope="row"><label for="active"><?php esc_html_e('Active','vowels-contact-form-with-drag-and-drop'); ?></label></th>
                                            <td>
                                                <input type="checkbox" id="active" name="active" <?php checked($form['active'], true); ?> />
                                                <p class="description"><?php esc_html_e('Inactive forms will not appear on your website','vowels-contact-form-with-drag-and-drop'); ?></p>
                                            </td>
                                        </tr>
                                        <tr class="ifb-settings-sub-head" valign="top">
                                            <td colspan="2" scope="row"><h3><?php esc_html_e('Successful submit options','vowels-contact-form-with-drag-and-drop'); ?></h3></td>
                                        </tr>
                                        <?php if (!isset($form['success_type'])) $form['success_type'] = 'message'; ?>
                                        <tr valign="top">
                                            <th scope="row"><label for="success_type"><?php esc_html_e('On successful submit','vowels-contact-form-with-drag-and-drop'); ?></label></th>
                                            <td>
                                                <select id="success_type" name="success_type" onchange="vowelsforminc.updateSuccessType();">
                                                    <option value="message" <?php selected($form['success_type'], 'message'); ?>><?php esc_html_e('Display a message','vowels-contact-form-with-drag-and-drop'); ?></option>
                                                    <option value="redirect" <?php selected($form['success_type'], 'redirect'); ?>><?php esc_html_e('Redirect to another page','vowels-contact-form-with-drag-and-drop'); ?></option>
                                                </select>
                                            </td>
                                        </tr>
                                        <?php if (!isset($form['success_message'])) $form['success_message'] = __('Your message has been sent, thanks.','vowels-contact-form-with-drag-and-drop'); ?>
                                        <tr valign="top" class="<?php if ($form['success_type'] != 'message') echo 'ifb-hidden'; ?> show-if-success-type-message">
                                            <th scope="row"><label for="success_message"><?php esc_html_e('Message','vowels-contact-form-with-drag-and-drop'); ?></label></th>
                                            <td>
                                            	<div class="ifb-success-message-options"><select title="<?php esc_attr_e('Add more data to your message by inserting a variable tag','vowels-contact-form-with-drag-and-drop'); ?>" class="ifb-insert-variable" onchange="vowelsforminc.insertVariable('#success_message', this);"></select></div>
                                                <textarea id="success_message" name="success_message"><?php echo _wp_specialchars($form['success_message'], ENT_NOQUOTES, false, true); ?></textarea>
                                                <p class="description"><?php esc_html_e('Message to display when the form is successfully submitted. You can enter HTML to format the message.','vowels-contact-form-with-drag-and-drop'); ?></p>
                                            </td>
                                        </tr>
                                        <?php if (!isset($form['success_message_position'])) $form['success_message_position'] = 'above'; ?>
                                        <tr valign="top" class="<?php if ($form['success_type'] != 'message') echo 'ifb-hidden'; ?> show-if-success-type-message">
                                            <th scope="row"><label for="success_message_position"><?php esc_html_e('Message position','vowels-contact-form-with-drag-and-drop'); ?></label></th>
                                            <td>
                                                <select id="success_message_position" name="success_message_position">
                                                    <option value="above" <?php selected($form['success_message_position'], 'above'); ?>><?php esc_html_e('Above the form','vowels-contact-form-with-drag-and-drop'); ?></option>
                                                    <option value="below" <?php selected($form['success_message_position'], 'below'); ?>><?php esc_html_e('Below the form','vowels-contact-form-with-drag-and-drop'); ?></option>
                                                </select>
                                            </td>
                                        </tr>
                                        <?php if (!isset($form['success_message_timeout'])) $form['success_message_timeout'] = '10'; ?>
                                        <tr valign="top" class="<?php if ($form['success_type'] != 'message') echo 'ifb-hidden'; ?> show-if-success-type-message">
                                            <th scope="row"><label for="success_message_timeout"><?php esc_html_e('Message timeout','vowels-contact-form-with-drag-and-drop'); ?></label></th>
                                            <td>
                                                <input type="text" id="success_message_timeout" name="success_message_timeout" value="<?php echo esc_attr($form['success_message_timeout']); ?>" />
                                                <p class="description"><?php esc_html_e('The success message will fade out and disappear after this number of seconds. Set to 0 to disable the timeout.','vowels-contact-form-with-drag-and-drop'); ?></p>
                                            </td>
                                        </tr>
                                        <?php if (!isset($form['success_redirect_type'])) $form['success_redirect_type'] = ''; ?>
                                        <?php if (!isset($form['success_redirect_value'])) $form['success_redirect_value'] = ''; ?>
                                        <tr valign="top" class="<?php if ($form['success_type'] != 'redirect') echo 'ifb-hidden'; ?> show-if-success-type-redirect">
                                            <th scope="row"><label for="success_redirect_type"><?php esc_html_e('Redirect to','vowels-contact-form-with-drag-and-drop'); ?></label></th>
                                            <td>
                                                <select id="success_redirect_type" name="success_redirect_type" onchange="vowelsforminc.updateSuccessRedirectType(this);">
                                                    <option value="" <?php selected($form['success_redirect_type'], ''); ?>><?php esc_html_e('Please select...','vowels-contact-form-with-drag-and-drop'); ?></option>
                                                    <option value="page" <?php selected($form['success_redirect_type'], 'page'); ?>><?php esc_html_e('Page','vowels-contact-form-with-drag-and-drop'); ?></option>
                                                    <option value="post" <?php selected($form['success_redirect_type'], 'post'); ?>><?php esc_html_e('Post','vowels-contact-form-with-drag-and-drop'); ?></option>
                                                    <option value="url" <?php selected($form['success_redirect_type'], 'url'); ?>><?php esc_html_e('URL','vowels-contact-form-with-drag-and-drop'); ?></option>
                                                </select>
                                                <select id="success_redirect_page" name="success_redirect_page" class="<?php if ($form['success_redirect_type'] != 'page') echo 'ifb-hidden'; ?>">
                                                    <?php $pages = get_pages(); ?>
                                                    <?php foreach ($pages as $page) : ?>
                                                        <option value="<?php echo esc_attr($page->ID); ?>" <?php if ($form['success_redirect_type'] == 'page') selected($form['success_redirect_value'], $page->ID); ?>><?php echo esc_attr($page->post_title); ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <select id="success_redirect_post" name="success_redirect_post" class="<?php if ($form['success_redirect_type'] != 'post') echo 'ifb-hidden'; ?>">
                                                    <?php $posts = get_posts(array('numberposts' => -1)); ?>
                                                    <?php foreach ($posts as $post) : ?>
                                                        <option value="<?php echo esc_attr($post->ID); ?>" <?php if ($form['success_redirect_type'] == 'post') selected($form['success_redirect_value'], $post->ID); ?>><?php echo esc_attr($post->post_title); ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <input type="text" id="success_redirect_url" name="success_redirect_url" class="<?php if ($form['success_redirect_type'] != 'url') echo 'ifb-hidden'; ?>" value="<?php if ($form['success_redirect_type'] == 'url') echo esc_attr($form['success_redirect_value']); ?>" />
                                                <p class="description"><?php esc_html_e('When the form is successfully submitted you can redirect the user to post, page or URL.','vowels-contact-form-with-drag-and-drop'); ?></p>
                                            </td>
                                        </tr>
                                        <?php if (!isset($form['reset_form_values'])) $form['reset_form_values'] = ''; ?>
                                        <tr valign="top">
                                            <th scope="row"><label for="reset_form_values"><?php esc_html_e('Reset form values','vowels-contact-form-with-drag-and-drop'); ?></label></th>
                                            <td>
                                                <select id="reset_form_values" name="reset_form_values">
                                                    <option value="" <?php selected($form['reset_form_values'], ''); ?>><?php esc_html_e('Reset form values to default','vowels-contact-form-with-drag-and-drop'); ?></option>
                                                    <option value="clear" <?php selected($form['reset_form_values'], 'clear'); ?>><?php esc_html_e('Clear form values','vowels-contact-form-with-drag-and-drop'); ?></option>
                                                    <option value="keep" <?php selected($form['reset_form_values'], 'keep'); ?>><?php esc_html_e('Keep form values','vowels-contact-form-with-drag-and-drop'); ?></option>
                                                </select>
                                                <p class="description"><?php esc_html_e('Choose what to do with the form values when the form is successfully submitted.','vowels-contact-form-with-drag-and-drop'); ?></p>
                                            </td>
                                        </tr>
                                        <tr class="ifb-settings-sub-head" valign="top">
                                            <td colspan="2" scope="row"><h3><?php esc_html_e('More options','vowels-contact-form-with-drag-and-drop'); ?></h3></td>
                                        </tr>
                                        <?php if (!isset($form['submit_button_text'])) $form['submit_button_text'] = ''; ?>
                                        <tr valign="top">
                                            <th scope="row">
                                             <div class="ifb-tooltip"><div class="ifb-tooltip-content"><?php esc_html_e('What would you like your form submit button to say? E.g. Submit, Go, Get in touch ... etc','vowels-contact-form-with-drag-and-drop'); ?></div></div>
                                            <label for="submit_button_text"><?php esc_html_e('Submit button text','vowels-contact-form-with-drag-and-drop'); ?></label></th>
                                            <td>
                                                <input type="text" id="submit_button_text" name="submit_button_text" value="<?php echo esc_attr($form['submit_button_text']); ?>" />
                                                <p class="description"><?php echo esc_html(sprintf(__('Override the default text of the submit button which is "%s"', 'vowels-contact-form-with-drag-and-drop'), __('Send','vowels-contact-form-with-drag-and-drop'))); ?></p>
                                            </td>
                                        </tr>
                                        <?php if (!isset($form['use_ajax'])) $form['use_ajax'] = true; ?>
                                        <tr valign="top">
                                            <th scope="row"><label for="use_ajax"><?php esc_html_e('Use Ajax','vowels-contact-form-with-drag-and-drop'); ?></label></th>
                                            <td>
                                                <input type="checkbox" id="use_ajax" name="use_ajax" <?php checked($form['use_ajax'], true); ?> />
                                                <p class="description"><?php esc_html_e('When enabled, the form will submit without reloading the page. If disabled, it will also disable the enhanced file uploader.','vowels-contact-form-with-drag-and-drop'); ?></p>
                                            </td>
                                        </tr>
                                        <?php if (!isset($form['use_honeypot'])) $form['use_honeypot'] = true; ?>
                                        <tr valign="top">
                                            <th scope="row"><label for="use_honeypot"><?php esc_html_e('Enable honeypot CAPTCHA','vowels-contact-form-with-drag-and-drop'); ?></label></th>
                                            <td>
                                                <input type="checkbox" id="use_honeypot" name="use_honeypot" <?php checked($form['use_honeypot'], true); ?> />
                                                <p class="description"><?php esc_html_e('A hidden anti-spam measure that requires no user interaction','vowels-contact-form-with-drag-and-drop'); ?></p>
                                            </td>
                                        </tr>
                                        <?php if (!isset($form['conditional_logic_animation'])) $form['conditional_logic_animation'] = true; ?>
                                        <tr valign="top">
                                            <th scope="row"><label for="conditional_logic_animation"><?php esc_html_e('Conditional logic animation','vowels-contact-form-with-drag-and-drop'); ?></label></th>
                                            <td>
                                                <input type="checkbox" id="conditional_logic_animation" name="conditional_logic_animation" <?php checked($form['conditional_logic_animation'], true); ?> />
                                                <p class="description"><?php esc_html_e('If enabled the fields that are hidden or shown via conditional logic will be
                                                animated instead of hidden or shown instantly.','vowels-contact-form-with-drag-and-drop'); ?></p>
                                            </td>
                                        </tr>
                                        <?php if (!isset($form['center_fancybox'])) $form['center_fancybox'] = true; ?>
                                        <tr valign="top">
                                            <th scope="row"><label for="center_fancybox"><?php esc_html_e('Re-center Fancybox after conditional logic','vowels-contact-form-with-drag-and-drop'); ?></label></th>
                                            <td>
                                                <input type="checkbox" id="center_fancybox" name="center_fancybox" <?php checked($form['center_fancybox'], true); ?> />
                                                <p class="description"><?php esc_html_e('If enabled, when conditional logic causes the Fancybox popup to change size it will center the popup.','vowels-contact-form-with-drag-and-drop'); ?></p>
                                            </td>
                                        </tr>
                                     
                                    </table>
                                </div>
                                <div class="ifb-tabs-panel" id="ifb-settings-style">
                                    <table class="ifb-form-table ifb-settings-form-table ifb-settings-style-form-table">
                                        <tr class="ifb-settings-sub-head" valign="top">
                                            <td colspan="2" scope="row"><h3><?php esc_html_e('Style','vowels-contact-form-with-drag-and-drop'); ?></h3></td>
                                        </tr>
                                        <?php if (!isset($form['theme'])) $form['theme'] = ''; ?>
                                        <tr valign="top">
                                            <th scope="row">
                                                <div class="ifb-tooltip"><div class="ifb-tooltip-content"><?php esc_html_e('Themes define the look of your form. You can add your own themes, see the Help for more information.','vowels-contact-form-with-drag-and-drop'); ?></div></div>
                                                <label for="theme"><?php esc_html_e('Theme','vowels-contact-form-with-drag-and-drop'); ?></label>
                                            </th>
                                            <td>
                                                <select id="theme" name="theme">
                                                    <?php if (count($themes)) : ?>
                                                        <option value=""><?php esc_html_e('None','vowels-contact-form-with-drag-and-drop'); ?></option>
                                                        <?php foreach ($themes as $theme) : ?>
                                                            <?php $value = esc_attr($theme['Folder']) . '|' . esc_attr($theme['Filename']); ?>
                                                            <option value="<?php echo $value; ?>" <?php selected($form['theme'], $value); ?>><?php echo esc_attr($theme['Name']); ?></option>
                                                        <?php endforeach; ?>
                                                    <?php else: ?>
                                                        <option value=""><?php esc_html_e('No themes found','vowels-contact-form-with-drag-and-drop'); ?></option>
                                                    <?php endif; ?>
                                                </select>
                                            </td>
                                        </tr>
                                        <?php if (!isset($form['responsive'])) $form['responsive'] = true; ?>
                                        <tr valign="top">
                                            <th scope="row">
                                                <div class="ifb-tooltip"><div class="ifb-tooltip-content"><?php esc_html_e('This makes the layout automatically adjust to fit the screen on smaller devices.','vowels-contact-form-with-drag-and-drop'); ?></div></div>
                                                <label for="responsive"><?php esc_html_e('Responsive','vowels-contact-form-with-drag-and-drop'); ?></label>
                                            </th>
                                            <td>
                                                <input type="checkbox" name="responsive" id="responsive" <?php checked($form['responsive'], true); ?> />
                                            </td>
                                        </tr>
                                        <tr class="ifb-settings-sub-head" valign="top">
                                            <td colspan="2" scope="row"><h3><?php esc_html_e('Uniform','vowels-contact-form-with-drag-and-drop'); ?></h3></td>
                                        </tr>
                                        <?php if (!isset($form['use_uniformjs'])) $form['use_uniformjs'] = true; ?>
                                        <tr valign="top">
                                            <th scope="row">
                                                <div class="ifb-tooltip"><div class="ifb-tooltip-content"><?php esc_html_e('Uniform makes form inputs look consistent in all browsers.','vowels-contact-form-with-drag-and-drop'); ?></div></div>
                                                <label for="use_uniformjs"><?php esc_html_e('Use Uniform','vowels-contact-form-with-drag-and-drop'); ?></label>
                                            </th>
                                            <td>
                                                <input type="checkbox" name="use_uniformjs" id="use_uniformjs" onclick="vowelsforminc.toggleUseUniform(this.checked);" <?php checked($form['use_uniformjs'], true); ?> />
                                            </td>
                                        </tr>
                                        <?php if (!isset($form['uniformjs_theme'])) $form['uniformjs_theme'] = 'default'; ?>
                                        <tr valign="top" class="<?php if (!$form['use_uniformjs']) echo 'ifb-hidden'; ?> show-if-use-uniform">
                                            <th scope="row">
                                                <label for="uniformjs_theme"><?php esc_html_e('Theme','vowels-contact-form-with-drag-and-drop'); ?></label>
                                            </th>
                                            <td>
                                                <select id="uniformjs_theme" name="uniformjs_theme">
                                                    <?php foreach ($uniformThemes as $uniformTheme) : ?>
                                                        <option value="<?php echo esc_attr($uniformTheme['Folder']); ?>" <?php selected($form['uniformjs_theme'], $uniformTheme['Folder']); ?>><?php echo esc_html($uniformTheme['UniformTheme']); if (isset($uniformTheme['By'])) echo esc_html(sprintf(__(' (by %s)', 'vowels-contact-form-with-drag-and-drop'), $uniformTheme['By'])); ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <script type="text/javascript">
                                                //<![CDATA[
                                                    jQuery(document).ready(function ($) {
                                                        $('#theme').change(function () {
                                                            if ($(this).val() == '')  {
                                                                $('#uniformjs_theme').val('default');
                                                            }
                                                            <?php foreach ($themes as $theme) : ?>
                                                                <?php if (isset($theme['UniformTheme']) && array_key_exists($theme['UniformTheme'], $uniformThemes)) : ?>
                                                                    if ($(this).val() == '<?php echo esc_js($theme['Folder']) . '|' . esc_js($theme['Filename']); ?>') {
                                                                        $('#uniformjs_theme').val('<?php echo esc_js($theme['UniformTheme']); ?>');
                                                                    }
                                                                <?php endif; ?>
                                                            <?php endforeach; ?>
                                                        });
                                                    });
                                                //]]>
                                                </script>
                                            </td>
                                        </tr>
                                        <tr class="ifb-settings-sub-head" valign="top">
                                            <td colspan="2" scope="row"><h3><?php esc_html_e('Datepicker','vowels-contact-form-with-drag-and-drop'); ?></h3></td>
                                        </tr>
                                        <?php if (!isset($form['jqueryui_theme'])) $form['jqueryui_theme'] = 'smoothness'; ?>
                                        <tr valign="top">
                                            <th scope="row">
                                                <div class="ifb-tooltip"><div class="ifb-tooltip-content"><?php esc_html_e('The theme chosen here will apply to all datepicker elements in your form.','vowels-contact-form-with-drag-and-drop'); ?></div></div>
                                                <label for="jqueryui_theme"><?php esc_html_e('Theme','vowels-contact-form-with-drag-and-drop'); ?></label>
                                            </th>
                                            <td>
                                                <?php $jqueryUiThemes = array(
                                                    '' => 'None',
                                                    'black-tie' => 'Black Tie',
                                                    'blitzer' => 'Blitzer',
                                                    'cupertino' => 'Cupertino',
                                                    'dark-hive' => 'Dark Hive',
                                                    'dot-luv' => 'Dot Luv',
                                                    'eggplant' => 'Eggplant',
                                                    'excite-bike' => 'Excite Bike',
                                                    'flick' => 'Flick',
                                                    'hot-sneaks' => 'Hot Sneaks',
                                                    'humanity' => 'Humanity',
                                                    'le-frog' => 'Le Frog',
                                                    'mint-choc' => 'Mint Chocolate',
                                                    'overcast' => 'Overcast',
                                                    'pepper-grinder' => 'Pepper Grinder',
                                                    'redmond' => 'Redmond',
                                                    'smoothness' => 'Smoothness',
                                                    'south-street' => 'South Street',
                                                    'start' => 'Start',
                                                    'sunny' => 'Sunny',
                                                    'swanky-purse' => 'Swanky Purse',
                                                    'trontastic' => 'Trontastic',
                                                    'ui-darkness' => 'UI Darkness',
                                                    'ui-lightness' => 'UI Lightness',
                                                    'vader' => 'Vader'
                                                ); ?>
                                                <select id="jqueryui_theme" name="jqueryui_theme">
                                                    <?php foreach ($jqueryUiThemes as $key => $name) : ?>
                                                        <option value="<?php echo esc_attr($key); ?>" <?php selected($form['jqueryui_theme'], $key); ?>><?php echo esc_html($name); ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <p class="description"><?php printf(esc_html__('Choose the theme of the datepicker, %ssee examples of each theme%s.', 'vowels-contact-form-with-drag-and-drop'), '<a href="http://jqueryui.com/demos/datepicker/" onclick="window.open(this.href); return false;">', '</a>'); ?>
                                            </td>
                                        </tr>
                                        <?php if (!isset($form['jqueryui_l10n'])) $form['jqueryui_l10n'] = ''; ?>
                                        <tr valign="top">
                                            <th scope="row">
                                                <div class="ifb-tooltip"><div class="ifb-tooltip-content"><?php esc_html_e('The datepicker will be translated into the language you choose
                                                and the date settings will be appropriate for your region.','vowels-contact-form-with-drag-and-drop'); ?></div></div>
                                                <label for="jqueryui_l10n"><?php esc_html_e('Locale','vowels-contact-form-with-drag-and-drop'); ?></label>
                                            </th>
                                            <td>
                                                <?php $jqueryUiLocales = array(
                                                    '' => 'Default (English/Western)',
                                                    'af' => 'Afrikaans',
                                                    'sq' => 'Albanian (Gjuha shqipe)',
                                                    'ar-DZ' => 'Algerian Arabic',
                                                    'ar' => 'Arabic (&#8235;(&#1604;&#1593;&#1585;&#1576;&#1610;',
                                                    'hy' => 'Armenian (&#1344;&#1377;&#1397;&#1381;&#1408;&#1381;&#1398;)',
                                                    'az' => 'Azerbaijani (Az&#601;rbaycan dili)',
                                                    'eu' => 'Basque (Euskara)',
                                                    'bs' => 'Bosnian (Bosanski)',
                                                    'bg' => 'Bulgarian (&#1073;&#1098;&#1083;&#1075;&#1072;&#1088;&#1089;&#1082;&#1080; &#1077;&#1079;&#1080;&#1082;)',
                                                    'ca' => 'Catalan (Catal&agrave;)',
                                                    'zh-HK' => 'Chinese Hong Kong (&#32321;&#39636;&#20013;&#25991;)',
                                                    'zh-CN' => 'Chinese Simplified (&#31616;&#20307;&#20013;&#25991;)',
                                                    'zh-TW' => 'Chinese Traditional (&#32321;&#39636;&#20013;&#25991;)',
                                                    'hr' => 'Croatian (Hrvatski jezik)',
                                                    'cs' => 'Czech (&#269;e&#353;tina)',
                                                    'da' => 'Danish (Dansk)',
                                                    'nl' => 'Dutch (Nederlands)',
                                                    'nl-BE' => 'Dutch (Belgium)',
                                                    'en-AU' => 'English/Australia',
                                                    'en-NZ' => 'English/New Zealand',
                                                    'en-GB' => 'English/UK',
                                                    'eo' => 'Esperanto',
                                                    'et' => 'Estonian (eesti keel)',
                                                    'fo' => 'Faroese (f&oslash;royskt)',
                                                    'fa' => 'Farsi/Persian (&#8235;(&#1601;&#1575;&#1585;&#1587;&#1740;',
                                                    'fi' => 'Finnish (suomi)',
                                                    'fr' => 'French (Fran&ccedil;ais)',
                                                    'fr-CH' => 'French/Swiss (Fran&ccedil;ais de Suisse)',
                                                    'gl' => 'Galician',
                                                    'ka' => 'Georgian',
                                                    'de' => 'German (Deutsch)',
                                                    'el' => 'Greek (&#917;&#955;&#955;&#951;&#957;&#953;&#954;&#940;)',
                                                    'he' => 'Hebrew (&#8235;(&#1506;&#1489;&#1512;&#1497;&#1514;',
                                                    'hi' => 'Hindi (&#2361;&#2367;&#2306;&#2342;&#2368;)',
                                                    'hu' => 'Hungarian (Magyar)',
                                                    'is' => 'Icelandic (&Otilde;slenska)',
                                                    'id' => 'Indonesian (Bahasa Indonesia)',
                                                    'it' => 'Italian (Italiano)',
                                                    'ja' => 'Japanese (&#26085;&#26412;&#35486;)',
                                                    'kk' => 'Kazakhstan (Kazakh)',
                                                    'km' => 'Khmer',
                                                    'ko' => 'Korean (&#54620;&#44397;&#50612;)',
                                                    'lv' => 'Latvian (Latvie&ouml;u Valoda)',
                                                    'lt' => 'Lithuanian (lietuviu kalba)',
                                                    'lb' => 'Luxembourgish',
                                                    'mk' => 'Macedonian',
                                                    'ml' => 'Malayalam',
                                                    'ms' => 'Malaysian (Bahasa Malaysia)',
                                                    'no' => 'Norwegian (Norsk)',
                                                    'pl' => 'Polish (Polski)',
                                                    'pt' => 'Portuguese (Portugu&ecirc;s)',
                                                    'pt-BR' => 'Portuguese/Brazilian (Portugu&ecirc;s)',
                                                    'rm' => 'Rhaeto-Romanic (Romansh)',
                                                    'ro' => 'Romanian (Rom&acirc;n&#259;)',
                                                    'ru' => 'Russian (&#1056;&#1091;&#1089;&#1089;&#1082;&#1080;&#1081;)',
                                                    'sr' => 'Serbian (&#1089;&#1088;&#1087;&#1089;&#1082;&#1080; &#1112;&#1077;&#1079;&#1080;&#1082;)',
                                                    'sr-SR' => 'Serbian (srpski jezik)',
                                                    'sk' => 'Slovak (Slovencina)',
                                                    'sl' => 'Slovenian (Slovenski Jezik)',
                                                    'es' => 'Spanish (Espa&ntilde;ol)',
                                                    'sv' => 'Swedish (Svenska)',
                                                    'ta' => 'Tamil (&#2980;&#2990;&#3007;&#2996;&#3021;)',
                                                    'th' => 'Thai (&#3616;&#3634;&#3625;&#3634;&#3652;&#3607;&#3618;)',
                                                    'tj' => 'Tajikistan',
                                                    'tr' => 'Turkish (T&uuml;rk&ccedil;e)',
                                                    'uk' => 'Ukranian (&#1059;&#1082;&#1088;&#1072;&#1111;&#1085;&#1089;&#1100;&#1082;&#1072;)',
                                                    'vi' => 'Vietnamese (Ti&#7871;ng Vi&#7879;t)',
                                                    'cy-GB' => 'Welsh/UK (Cymraeg)'
                                                ); ?>
                                                <select id="jqueryui_l10n" name="jqueryui_l10n">
                                                    <?php foreach ($jqueryUiLocales as $key => $label) : ?>
                                                        <option value="<?php echo $key; ?>" <?php selected($form['jqueryui_l10n'], $key); ?>><?php echo $label; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <p class="description"><?php esc_html_e('Choose the calendar localization','vowels-contact-form-with-drag-and-drop'); ?></p>
                                            </td>
                                        </tr>
                                        <tr class="ifb-settings-sub-head" valign="top">
                                            <td colspan="2" scope="row"><h3><?php esc_html_e('Labels','vowels-contact-form-with-drag-and-drop'); ?></h3></td>
                                        </tr>
                                        <?php if (!isset($form['label_placement'])) $form['label_placement'] = 'above'; ?>
                                        <tr valign="top">
                                            <th scope="row"><label for="label_placement"><?php esc_html_e('Label placement','vowels-contact-form-with-drag-and-drop'); ?></label></th>
                                            <td>
                                                <select id="label_placement" name="label_placement" onchange="vowelsforminc.setLabelPlacement();">
                                                    <option value="above" <?php selected($form['label_placement'], 'above'); ?>><?php esc_html_e('Above','vowels-contact-form-with-drag-and-drop'); ?></option>
                                                    <option value="left" <?php selected($form['label_placement'], 'left'); ?>><?php esc_html_e('Left','vowels-contact-form-with-drag-and-drop'); ?></option>
                                                    <option value="inside" <?php selected($form['label_placement'], 'inside'); ?>><?php esc_html_e('Inside','vowels-contact-form-with-drag-and-drop'); ?></option>
                                                </select>
                                                <p class="description"><?php esc_html_e('Choose where to display the label relative to the input','vowels-contact-form-with-drag-and-drop'); ?></p>
                                            </td>
                                        </tr>
                                        <?php if (!isset($form['label_width'])) $form['label_width'] = '150px'; ?>
                                        <tr valign="top" class="<?php if ($form['label_placement'] !== 'left') echo 'ifb-hidden'; ?> ifb-show-if-label-placement-left">
                                            <th scope="row">
                                                <div class="ifb-tooltip"><div class="ifb-tooltip-content"><?php esc_html_e('Specify how wide the labels should be, this only applies when the label placement is left','vowels-contact-form-with-drag-and-drop'); ?></div></div>
                                                <label for="label_width"><?php esc_html_e('Label width','vowels-contact-form-with-drag-and-drop'); ?></label>
                                            </th>
                                            <td>
                                                <input id="label_width" name="label_width" type="text" value="<?php echo esc_attr($form['label_width']); ?>" />
                                                <p class="description"><?php printf(esc_html__('The width of the labels, any valid CSS width is accepted, e.g. %s200px%s', 'vowels-contact-form-with-drag-and-drop'), '<span class="ifb-bold">', '</span>'); ?></p>
                                            </td>
                                        </tr>
                                        <?php if (!isset($form['required_text'])) $form['required_text'] = __('*','vowels-contact-form-with-drag-and-drop'); ?>
                                        <tr valign="top">
                                            <th scope="row"><label for="required_text"><?php esc_html_e('Required indicator text','vowels-contact-form-with-drag-and-drop'); ?></label></th>
                                            <td>
                                                <input type="text" id="required_text" name="required_text" onkeyup="vowelsforminc.updateRequiredText(this);" value="<?php echo esc_attr($form['required_text']); ?>" />
                                            </td>
                                        </tr>
                                        <tr class="ifb-settings-sub-head" valign="top">
                                            <td colspan="2" scope="row"><h3><?php esc_html_e('Tooltips','vowels-contact-form-with-drag-and-drop'); ?></h3></td>
                                        </tr>
                                        <?php if (!isset($form['use_tooltips'])) $form['use_tooltips'] = true; ?>
                                        <tr valign="top">
                                            <th scope="row">
                                                <div class="ifb-tooltip"><div class="ifb-tooltip-content"><?php esc_html_e("What's a tooltip? You're looking at one.", 'vowels-contact-form-with-drag-and-drop'); ?></div></div>
                                                <label for="use_tooltips"><?php esc_html_e('Enable tooltips','vowels-contact-form-with-drag-and-drop'); ?></label>
                                            </th>
                                            <td>
                                                <input type="checkbox" id="use_tooltips" name="use_tooltips" onclick="vowelsforminc.toggleTooltipSettings(this.checked);" <?php checked($form['use_tooltips'], true); ?> />
                                                <p class="description"><?php esc_html_e('If enabled, when the user hovers over an element with tooltip text set, a tooltip will appear.','vowels-contact-form-with-drag-and-drop'); ?></p>
                                            </td>
                                        </tr>
                                        <?php if (!isset($form['tooltip_type'])) $form['tooltip_type'] = 'field'; ?>
                                        <tr valign="top" class="<?php if (!$form['use_tooltips']) echo 'ifb-hidden'; ?> show-if-tooltips-enabled">
                                            <th scope="row">
                                                <div class="ifb-tooltip"><div class="ifb-tooltip-content"><?php printf(esc_html__('If set to %1$sField%2$s, the tooltip will show when the user interacts with
                                                the field. If set to %1$sHelp icon%2$s, the tooltip will be shown when the user interacts with a help icon.', 'vowels-contact-form-with-drag-and-drop'), '<span class="ifb-bold">', '</span>'); ?></div></div>
                                                <label for="tooltip_type"><?php esc_html_e('Trigger','vowels-contact-form-with-drag-and-drop'); ?></label>
                                            </th>
                                            <td>
                                                <select name="tooltip_type" id="tooltip_type">
                                                    <option value="field" <?php selected($form['tooltip_type'], 'field'); ?>><?php esc_html_e('Field','vowels-contact-form-with-drag-and-drop'); ?></option>
                                                    <option value="icon" <?php selected($form['tooltip_type'], 'icon'); ?>><?php esc_html_e('Help icon','vowels-contact-form-with-drag-and-drop'); ?></option>
                                                </select>
                                                <p class="description"><?php esc_html_e('Choose what the user will be interacting with to show the tooltip.','vowels-contact-form-with-drag-and-drop'); ?></p>
                                            </td>
                                        </tr>
                                        <?php if (!isset($form['tooltip_event'])) $form['tooltip_event'] = 'hover'; ?>
                                        <tr valign="top" class="<?php if (!$form['use_tooltips']) echo 'ifb-hidden'; ?> show-if-tooltips-enabled">
                                            <th scope="row">
                                                <label for="tooltip_event"><?php esc_html_e('Event','vowels-contact-form-with-drag-and-drop'); ?></label>
                                            </th>
                                            <td>
                                                <select name="tooltip_event" id="tooltip_event">
                                                    <option value="hover" <?php selected($form['tooltip_event'], 'hover'); ?>><?php esc_html_e('Hover','vowels-contact-form-with-drag-and-drop'); ?></option>
                                                    <option value="click" <?php selected($form['tooltip_event'], 'click'); ?>><?php esc_html_e('Click','vowels-contact-form-with-drag-and-drop'); ?></option>
                                                </select>
                                                <p class="description"><?php esc_html_e('Choose the event that will trigger the tooltip to show.','vowels-contact-form-with-drag-and-drop'); ?></p>
                                            </td>
                                        </tr>
                                        <tr valign="top" class="<?php if (!$form['use_tooltips']) echo 'ifb-hidden'; ?> show-if-tooltips-enabled">
                                            <th scope="row"><?php esc_html_e('Tooltip style','vowels-contact-form-with-drag-and-drop'); ?></th>
                                            <td>
                                                <table class="ifb-form-table ifb-tooltip-style-subtable">
                                                    <?php if (!isset($form['tooltip_custom'])) $form['tooltip_custom'] = ''; ?>
                                                    <tr valign="top" class="<?php if ($form['tooltip_custom'] === 'custom') echo 'ifb-hidden'; ?> show-if-tooltip-style-previewable">
                                                        <th scope="row" colspan="2">
                                                            <input type="text" id="ifb-tooltip-example" class="ifb-tooltip-example" value="<?php esc_attr_e('Hover me for preview','vowels-contact-form-with-drag-and-drop'); ?>" />
                                                        </th>
                                                    </tr>
                                                    <?php if (!isset($form['tooltip_style'])) $form['tooltip_style'] = 'qtip-plain'; ?>
                                                    <tr valign="top">
                                                        <th scope="row"><label for="tooltip_style"><?php esc_html_e('Style','vowels-contact-form-with-drag-and-drop'); ?></label></th>
                                                        <td>
                                                            <select id="tooltip_style" name="tooltip_style" onchange="vowelsforminc.updateTooltipStyle();">
                                                                <optgroup label="CSS2 styles">
                                                                    <option value="qtip-cream" <?php selected($form['tooltip_style'], 'qtip-cream'); ?>><?php esc_html_e('Cream','vowels-contact-form-with-drag-and-drop'); ?> (qtip-cream)</option>
                                                                    <option value="qtip-plain" <?php selected($form['tooltip_style'], 'qtip-plain'); ?>><?php esc_html_e('Plain','vowels-contact-form-with-drag-and-drop'); ?> (qtip-plain)</option>
                                                                    <option value="qtip-light" <?php selected($form['tooltip_style'], 'qtip-light'); ?>><?php esc_html_e('Light','vowels-contact-form-with-drag-and-drop'); ?> (qtip-light)</option>
                                                                    <option value="qtip-dark" <?php selected($form['tooltip_style'], 'qtip-dark'); ?>><?php esc_html_e('Dark','vowels-contact-form-with-drag-and-drop'); ?> (qtip-dark)</option>
                                                                    <option value="qtip-red" <?php selected($form['tooltip_style'], 'qtip-red'); ?>><?php esc_html_e('Red','vowels-contact-form-with-drag-and-drop'); ?> (qtip-red)</option>
                                                                    <option value="qtip-green" <?php selected($form['tooltip_style'], 'qtip-green'); ?>><?php esc_html_e('Green','vowels-contact-form-with-drag-and-drop'); ?> (qtip-green)</option>
                                                                    <option value="qtip-blue" <?php selected($form['tooltip_style'], 'qtip-blue'); ?>><?php esc_html_e('Blue','vowels-contact-form-with-drag-and-drop'); ?> (qtip-blue)</option>
                                                                </optgroup>
                                                                <optgroup label="CSS3 styles">
                                                                    <option value="qtip-youtube" <?php selected($form['tooltip_style'], 'qtip-youtube'); ?>><?php esc_html_e('YouTube','vowels-contact-form-with-drag-and-drop'); ?> (qtip-youtube) </option>
                                                                    <option value="qtip-jtools" <?php selected($form['tooltip_style'], 'qtip-jtools'); ?>><?php esc_html_e('jTools','vowels-contact-form-with-drag-and-drop'); ?> (qtip-jtools)</option>
                                                                    <option value="qtip-cluetip" <?php selected($form['tooltip_style'], 'qtip-cluetip'); ?>><?php esc_html_e('Cluetip','vowels-contact-form-with-drag-and-drop'); ?> (qtip-cluetip)</option>
                                                                    <option value="qtip-tipped" <?php selected($form['tooltip_style'], 'qtip-tipped'); ?>><?php esc_html_e('Tipped','vowels-contact-form-with-drag-and-drop'); ?> (qtip-tipped)</option>
                                                                    <option value="qtip-tipsy" <?php selected($form['tooltip_style'], 'qtip-tipsy'); ?>><?php esc_html_e('Tipsy','vowels-contact-form-with-drag-and-drop'); ?> (qtip-tipsy)</option>
                                                                </optgroup>
                                                                <option value="custom" <?php selected($form['tooltip_style'], 'custom'); ?>><?php esc_html_e('Custom class','vowels-contact-form-with-drag-and-drop'); ?></option>
                                                            </select>
                                                        </td>
                                                    </tr>
                                                    <tr valign="top" class="<?php if ($form['tooltip_custom'] !== 'custom') echo 'ifb-hidden'; ?> show-if-tooltip-style-custom">
                                                        <th scope="row"><label for="tooltip_custom"><?php esc_html_e('Custom class','vowels-contact-form-with-drag-and-drop'); ?></label></th>
                                                        <td>
                                                            <input type="text" id="tooltip_custom" name="tooltip_custom" value="<?php echo esc_attr($form['tooltip_custom']); ?>" />
                                                        </td>
                                                    </tr>
                                                    <?php if (!isset($form['tooltip_my'])) $form['tooltip_my'] = 'left center'; ?>
                                                    <tr valign="top">
                                                        <th scope="row"><label for="tooltip_my"><?php esc_html_e('Tip position','vowels-contact-form-with-drag-and-drop'); ?></label></th>
                                                        <td>
                                                            <select id="tooltip_my" name="tooltip_my" onchange="vowelsforminc.updateTooltipStyle();">
                                                                <option value="left center" <?php selected($form['tooltip_my'], 'left center'); ?>><?php esc_html_e('left center','vowels-contact-form-with-drag-and-drop'); ?></option>
                                                                <option value="left top" <?php selected($form['tooltip_my'], 'left top'); ?>><?php esc_html_e('left top','vowels-contact-form-with-drag-and-drop'); ?></option>
                                                                <option value="top left" <?php selected($form['tooltip_my'], 'top left'); ?>><?php esc_html_e('top left','vowels-contact-form-with-drag-and-drop'); ?></option>
                                                                <option value="top center" <?php selected($form['tooltip_my'], 'top center'); ?>><?php esc_html_e('top center','vowels-contact-form-with-drag-and-drop'); ?></option>
                                                                <option value="top right" <?php selected($form['tooltip_my'], 'top right'); ?>><?php esc_html_e('top right','vowels-contact-form-with-drag-and-drop'); ?></option>
                                                                <option value="right top" <?php selected($form['tooltip_my'], 'right top'); ?>><?php esc_html_e('right top','vowels-contact-form-with-drag-and-drop'); ?></option>
                                                                <option value="right center" <?php selected($form['tooltip_my'], 'right center'); ?>><?php esc_html_e('right center','vowels-contact-form-with-drag-and-drop'); ?></option>
                                                                <option value="right bottom" <?php selected($form['tooltip_my'], 'right bottom'); ?>><?php esc_html_e('right bottom','vowels-contact-form-with-drag-and-drop'); ?></option>
                                                                <option value="bottom right" <?php selected($form['tooltip_my'], 'bottom right'); ?>><?php esc_html_e('bottom right','vowels-contact-form-with-drag-and-drop'); ?></option>
                                                                <option value="bottom center" <?php selected($form['tooltip_my'], 'bottom center'); ?>><?php esc_html_e('bottom center','vowels-contact-form-with-drag-and-drop'); ?></option>
                                                                <option value="bottom left" <?php selected($form['tooltip_my'], 'bottom left'); ?>><?php esc_html_e('bottom left','vowels-contact-form-with-drag-and-drop'); ?></option>
                                                                <option value="left bottom" <?php selected($form['tooltip_my'], 'left bottom'); ?>><?php esc_html_e('left bottom','vowels-contact-form-with-drag-and-drop'); ?></option>
                                                                <option value="center" <?php selected($form['tooltip_my'], 'center'); ?>><?php esc_html_e('center','vowels-contact-form-with-drag-and-drop'); ?></option>
                                                            </select>
                                                        </td>
                                                    </tr>
                                                    <?php if (!isset($form['tooltip_at'])) $form['tooltip_at'] = 'right center'; ?>
                                                    <tr valign="top">
                                                        <th scope="row"><label for="tooltip_at"><?php esc_html_e('Position on input','vowels-contact-form-with-drag-and-drop'); ?></label></th>
                                                        <td>
                                                            <select id="tooltip_at" name="tooltip_at" onchange="vowelsforminc.updateTooltipStyle();">
                                                                <option value="left center" <?php selected($form['tooltip_at'], 'left center'); ?>><?php esc_html_e('left center','vowels-contact-form-with-drag-and-drop'); ?></option>
                                                                <option value="left top" <?php selected($form['tooltip_at'], 'left top'); ?>><?php esc_html_e('left top','vowels-contact-form-with-drag-and-drop'); ?></option>
                                                                <option value="top left" <?php selected($form['tooltip_at'], 'top left'); ?>><?php esc_html_e('top left','vowels-contact-form-with-drag-and-drop'); ?></option>
                                                                <option value="top center" <?php selected($form['tooltip_at'], 'top center'); ?>><?php esc_html_e('top center','vowels-contact-form-with-drag-and-drop'); ?></option>
                                                                <option value="top right" <?php selected($form['tooltip_at'], 'top right'); ?>><?php esc_html_e('top right','vowels-contact-form-with-drag-and-drop'); ?></option>
                                                                <option value="top right" <?php selected($form['tooltip_at'], 'top right'); ?>><?php esc_html_e('right top','vowels-contact-form-with-drag-and-drop'); ?></option>
                                                                <option value="right center" <?php selected($form['tooltip_at'], 'right center'); ?>><?php esc_html_e('right center','vowels-contact-form-with-drag-and-drop'); ?></option>
                                                                <option value="right bottom" <?php selected($form['tooltip_at'], 'right bottom'); ?>><?php esc_html_e('right bottom','vowels-contact-form-with-drag-and-drop'); ?></option>
                                                                <option value="bottom right" <?php selected($form['tooltip_at'], 'bottom right'); ?>><?php esc_html_e('bottom right','vowels-contact-form-with-drag-and-drop'); ?></option>
                                                                <option value="bottom center" <?php selected($form['tooltip_at'], 'bottom center'); ?>><?php esc_html_e('bottom center','vowels-contact-form-with-drag-and-drop'); ?></option>
                                                                <option value="bottom left" <?php selected($form['tooltip_at'], 'bottom left'); ?>><?php esc_html_e('bottom left','vowels-contact-form-with-drag-and-drop'); ?></option>
                                                                <option value="left bottom" <?php selected($form['tooltip_at'], 'left bottom'); ?>><?php esc_html_e('left bottom','vowels-contact-form-with-drag-and-drop'); ?></option>
                                                                <option value="center" <?php selected($form['tooltip_at'], 'center'); ?>><?php esc_html_e('center','vowels-contact-form-with-drag-and-drop'); ?></option>
                                                            </select>
                                                        </td>
                                                    </tr>
                                                    <?php if (!isset($form['tooltip_shadow'])) $form['tooltip_shadow'] = true; ?>
                                                    <tr valign="top">
                                                        <th scope="row"><label for="tooltip_shadow"><?php esc_html_e('CSS3 Shadow','vowels-contact-form-with-drag-and-drop'); ?></label></th>
                                                        <td>
                                                            <input type="checkbox" id="tooltip_shadow" name="tooltip_shadow" onclick="vowelsforminc.updateTooltipStyle();" <?php checked($form['tooltip_shadow'], true); ?> />
                                                        </td>
                                                    </tr>
                                                    <?php if (!isset($form['tooltip_rounded'])) $form['tooltip_rounded'] = false; ?>
                                                    <tr valign="top">
                                                        <th scope="row"><label for="tooltip_rounded"><?php esc_html_e('CSS3 Rounded Corners','vowels-contact-form-with-drag-and-drop'); ?></label></th>
                                                        <td>
                                                            <input type="checkbox" id="tooltip_rounded" name="tooltip_rounded" onclick="vowelsforminc.updateTooltipStyle();" <?php checked($form['tooltip_rounded'], true); ?>/>
                                                        </td>
                                                    </tr>
                                                </table>
                                                <p class="description"><?php esc_html_e('The CSS3 effects may not work with some styles and may only be visible in modern browsers.','vowels-contact-form-with-drag-and-drop'); ?></p>
                                            </td>
                                        </tr>
                                        <tr class="ifb-settings-sub-head" valign="top">
                                            <td colspan="2" scope="row"><h3><?php esc_html_e('Global styling','vowels-contact-form-with-drag-and-drop'); ?></h3></td>
                                        </tr>
                                        <?php if (!isset($form['element_background_colour'])) $form['element_background_colour'] = ''; ?>
                                        <tr valign="top">
                                            <th scope="row">
                                                <label for="element_background_colour"><?php esc_html_e('Element background color','vowels-contact-form-with-drag-and-drop'); ?></label>
                                            </th>
                                            <td>
                                                <input type="text" id="element_background_colour" name="element_background_colour" value="<?php echo esc_attr($form['element_background_colour']); ?>" />
                                            </td>
                                        </tr>
                                        <?php if (!isset($form['element_border_colour'])) $form['element_border_colour'] = ''; ?>
                                        <tr valign="top">
                                            <th scope="row">
                                                <label for="element_border_colour"><?php esc_html_e('Element border color','vowels-contact-form-with-drag-and-drop'); ?></label>
                                            </th>
                                            <td>
                                                <input type="text" id="element_border_colour" name="element_border_colour" value="<?php echo esc_attr($form['element_border_colour']); ?>" />
                                            </td>
                                        </tr>
                                        <?php if (!isset($form['element_text_colour'])) $form['element_text_colour'] = ''; ?>
                                        <tr valign="top">
                                            <th scope="row">
                                                <label for="element_text_colour"><?php esc_html_e('Element text color','vowels-contact-form-with-drag-and-drop'); ?></label>
                                            </th>
                                            <td>
                                                <input type="text" id="element_text_colour" name="element_text_colour" value="<?php echo esc_attr($form['element_text_colour']); ?>" />
                                            </td>
                                        </tr>
                                        <?php if (!isset($form['label_text_colour'])) $form['label_text_colour'] = ''; ?>
                                        <tr valign="top">
                                            <th scope="row">
                                                <label for="label_text_colour"><?php esc_html_e('Label text color','vowels-contact-form-with-drag-and-drop'); ?></label>
                                            </th>
                                            <td>
                                                <input type="text" id="label_text_colour" name="label_text_colour" value="<?php echo esc_attr($form['label_text_colour']); ?>" />
                                            </td>
                                        </tr>
                                        <?php if (!isset($form['styles'])) $form['styles'] = array(); ?>
                                        <tr valign="top">
                                            <th scope="row">
                                                <div class="ifb-tooltip"><div class="ifb-tooltip-content">
                                                    <?php printf(esc_html__('Styles entered here will apply to all form elements, you can override these for
                                                    each element inside the element settings. Once you have added a style, enter the CSS styles one per line, with each line ending in
                                                    a semi-colon. %sClick here%s for an example.', 'vowels-contact-form-with-drag-and-drop'), '<a onclick="window.open(this.href); return false;" href="'.vowels_form_builder_help_link('element-text#example-styles').'">', '</a>'); ?>
                                                </div></div>
                                                <label><?php esc_html_e('Global CSS Styles','vowels-contact-form-with-drag-and-drop'); ?></label>
                                            </th>
                                            <td>
                                                <div id="ifb-global-styles">
                                                    <?php
                                                        foreach ($form['styles'] as $style)  {
                                                            include VOWELSFORMDRAGDROP_ADMIN_INCLUDES_DIR . '/elements/settings/global-style.php';
                                                        }
                                                    ?>
                                                </div>
                                                <div class="ifb-global-styles-empty ifb-info-message <?php if (count($form['styles'])) echo 'ifb-hidden'; ?>"><span class="ifb-info-message-icon"></span><?php esc_html_e('No global styles.','vowels-contact-form-with-drag-and-drop'); ?></div>
                                            </td>
                                        </tr>
                                        <tr valign="top">
                                            <th scope="row">
                                                <label><?php esc_html_e('Add a style','vowels-contact-form-with-drag-and-drop'); ?></label>
                                            </th>
                                            <td>
                                                <a class="ifb-button ifb-simple-tooltip" title="<?php esc_attr_e('The outer wrapper of the form','vowels-contact-form-with-drag-and-drop'); ?>" onclick="vowelsforminc.addGlobalStyle('formOuter');"><?php esc_html_e('Form outer wrapper','vowels-contact-form-with-drag-and-drop'); ?></a>
                                                <a class="ifb-button ifb-simple-tooltip" title="<?php esc_attr_e('The inner wrapper of the form','vowels-contact-form-with-drag-and-drop'); ?>" onclick="vowelsforminc.addGlobalStyle('formInner');"><?php esc_html_e('Form inner wrapper','vowels-contact-form-with-drag-and-drop'); ?></a>
                                                <a class="ifb-button ifb-simple-tooltip" title="<?php esc_attr_e('The message shown when the form is successfully submitted','vowels-contact-form-with-drag-and-drop'); ?>" onclick="vowelsforminc.addGlobalStyle('success');"><?php esc_html_e('Success message','vowels-contact-form-with-drag-and-drop'); ?></a>
                                                <a class="ifb-button ifb-simple-tooltip" title="<?php esc_attr_e('The form title','vowels-contact-form-with-drag-and-drop'); ?>" onclick="vowelsforminc.addGlobalStyle('title');"><?php esc_html_e('Form title','vowels-contact-form-with-drag-and-drop'); ?></a>
                                                <a class="ifb-button ifb-simple-tooltip" title="<?php esc_attr_e('The form description','vowels-contact-form-with-drag-and-drop'); ?>" onclick="vowelsforminc.addGlobalStyle('description');"><?php esc_html_e('Form description','vowels-contact-form-with-drag-and-drop'); ?></a>
                                                <a class="ifb-button ifb-simple-tooltip" title="<?php esc_attr_e('The wrapper surrounding all elements in the form','vowels-contact-form-with-drag-and-drop'); ?>" onclick="vowelsforminc.addGlobalStyle('elements');"><?php esc_html_e('Form elements wrapper','vowels-contact-form-with-drag-and-drop'); ?></a>
                                                <a class="ifb-button ifb-simple-tooltip" title="<?php esc_attr_e('The outer wrapper of each element','vowels-contact-form-with-drag-and-drop'); ?>" onclick="vowelsforminc.addGlobalStyle('outer');"><?php esc_html_e('Element outer wrapper','vowels-contact-form-with-drag-and-drop'); ?></a>
                                                <a class="ifb-button ifb-simple-tooltip" title="<?php esc_attr_e('The label of each element','vowels-contact-form-with-drag-and-drop'); ?>" onclick="vowelsforminc.addGlobalStyle('label');"><?php esc_html_e('Element label','vowels-contact-form-with-drag-and-drop'); ?></a>
                                                <a class="ifb-button ifb-simple-tooltip" title="<?php esc_attr_e('The inner wrapper of each element','vowels-contact-form-with-drag-and-drop'); ?>" onclick="vowelsforminc.addGlobalStyle('inner');"><?php esc_html_e('Element inner wrapper','vowels-contact-form-with-drag-and-drop'); ?></a>
                                                <a class="ifb-button ifb-simple-tooltip" title="<?php esc_attr_e('The description of each element','vowels-contact-form-with-drag-and-drop'); ?>" onclick="vowelsforminc.addGlobalStyle('elementDescription');"><?php esc_html_e('Element description','vowels-contact-form-with-drag-and-drop'); ?></a>
                                                <a class="ifb-button ifb-simple-tooltip" title="<?php esc_attr_e('The input field of Single Line Text, Email, Password and CAPTCHA elements','vowels-contact-form-with-drag-and-drop'); ?>" onclick="vowelsforminc.addGlobalStyle('input');"><?php esc_html_e('Text input elements','vowels-contact-form-with-drag-and-drop'); ?></a>
                                                <a class="ifb-button ifb-simple-tooltip" title="<?php esc_attr_e('The textarea field of Paragraph Text elements','vowels-contact-form-with-drag-and-drop'); ?>" onclick="vowelsforminc.addGlobalStyle('textarea');"><?php esc_html_e('Paragraph Text elements','vowels-contact-form-with-drag-and-drop'); ?></a>
                                                <a class="ifb-button ifb-simple-tooltip" title="<?php esc_attr_e('The select field of Dropdown Menu elements','vowels-contact-form-with-drag-and-drop'); ?>" onclick="vowelsforminc.addGlobalStyle('select');"><?php esc_html_e('Dropdown Menu elements','vowels-contact-form-with-drag-and-drop'); ?></a>
                                                <a class="ifb-button ifb-simple-tooltip" title="<?php esc_attr_e('The wrapper around all of the options of Multiple Choice and Checkbox elements','vowels-contact-form-with-drag-and-drop'); ?>" onclick="vowelsforminc.addGlobalStyle('optionUl');"><?php esc_html_e('Options outer wrapper','vowels-contact-form-with-drag-and-drop'); ?></a>
                                                <a class="ifb-button ifb-simple-tooltip" title="<?php esc_attr_e('The wrapper around each option of Multiple Choice and Checkbox elements','vowels-contact-form-with-drag-and-drop'); ?>" onclick="vowelsforminc.addGlobalStyle('optionLi');"><?php esc_html_e('Option wrappers','vowels-contact-form-with-drag-and-drop'); ?></a>
                                                <a class="ifb-button ifb-simple-tooltip" title="<?php esc_attr_e('The label of each option of Multiple Choice and Checkbox elements','vowels-contact-form-with-drag-and-drop'); ?>" onclick="vowelsforminc.addGlobalStyle('optionLabel');"><?php esc_html_e('Option labels','vowels-contact-form-with-drag-and-drop'); ?></a>
                                                <a class="ifb-button ifb-simple-tooltip" title="<?php esc_attr_e('Each of the dropdown menus of the Date element','vowels-contact-form-with-drag-and-drop'); ?>" onclick="vowelsforminc.addGlobalStyle('date');"><?php esc_html_e('Date dropdowns','vowels-contact-form-with-drag-and-drop'); ?></a>
                                                <a class="ifb-button ifb-simple-tooltip" title="<?php esc_attr_e('Each of the dropdown menus of the Time element','vowels-contact-form-with-drag-and-drop'); ?>" onclick="vowelsforminc.addGlobalStyle('time');"><?php esc_html_e('Time dropdowns','vowels-contact-form-with-drag-and-drop'); ?></a>
                                                <a class="ifb-button ifb-simple-tooltip" title="<?php esc_attr_e('The outer wrapper of the submit button','vowels-contact-form-with-drag-and-drop'); ?>" onclick="vowelsforminc.addGlobalStyle('submitOuter');"><?php esc_html_e('Submit button outer wrapper','vowels-contact-form-with-drag-and-drop'); ?></a>
                                                <a class="ifb-button ifb-simple-tooltip" title="<?php esc_attr_e('The inner wrapper of the submit button','vowels-contact-form-with-drag-and-drop'); ?>" onclick="vowelsforminc.addGlobalStyle('submit');"><?php esc_html_e('Submit button inner wrapper','vowels-contact-form-with-drag-and-drop'); ?></a>
                                                <a class="ifb-button ifb-simple-tooltip" title="<?php esc_attr_e('The submit button','vowels-contact-form-with-drag-and-drop'); ?>" onclick="vowelsforminc.addGlobalStyle('submitButton');"><?php esc_html_e('Submit button','vowels-contact-form-with-drag-and-drop'); ?></a>
                                                <a class="ifb-button ifb-simple-tooltip" title="<?php esc_attr_e('The span tag inside the submit button','vowels-contact-form-with-drag-and-drop'); ?>" onclick="vowelsforminc.addGlobalStyle('submitSpan');"><?php esc_html_e('Submit button inside span','vowels-contact-form-with-drag-and-drop'); ?></a>
                                                <a class="ifb-button ifb-simple-tooltip" title="<?php esc_attr_e('The em tag inside the submit button','vowels-contact-form-with-drag-and-drop'); ?>" onclick="vowelsforminc.addGlobalStyle('submitEm');"><?php esc_html_e('Submit button inside em','vowels-contact-form-with-drag-and-drop'); ?></a>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="ifb-tabs-panel" id="ifb-settings-email">
                                    <table class="ifb-form-table ifb-settings-form-table ifb-settings-email-form-table">
                                        <tr class="ifb-settings-sub-head" valign="top">
                                            <td colspan="2" scope="row"><h3><?php esc_html_e('Notification email settings','vowels-contact-form-with-drag-and-drop'); ?></h3></td>
                                        </tr>
                                        <?php if (!isset($form['send_notification'])) $form['send_notification'] = true; ?>
                                        <tr valign="top">
                                            <th scope="row"><label for="send_notification"><?php esc_html_e('Send form data via email','vowels-contact-form-with-drag-and-drop'); ?></label></th>
                                            <td>
                                                <input type="checkbox" id="send_notification" name="send_notification" onclick="vowelsforminc.setSendNotification();" <?php if ($form['send_notification']) echo 'checked="checked"'; ?> />
                                                <p class="description"><?php esc_html_e('If checked, when the user submits the form the submitted form data will be sent in an email to the recipients specified below.','vowels-contact-form-with-drag-and-drop'); ?></p>
                                            </td>
                                        </tr>
                                        <?php if (!isset($form['recipients']) || !count($form['recipients'])) $form['recipients'] = array(get_bloginfo('admin_email')); ?>
                                        <tr valign="top" class="<?php if (!$form['send_notification']) echo 'ifb-hidden'; ?> ifb-show-if-send-notification-on">
                                            <th scope="row">
                                                <div class="ifb-tooltip"><div class="ifb-tooltip-content">
                                                    <?php esc_html_e('Add email address(es) which the submitted form data will be sent to.','vowels-contact-form-with-drag-and-drop'); ?>
                                                </div></div>
                                                <label><?php esc_html_e('Recipients','vowels-contact-form-with-drag-and-drop'); ?></label>
                                            </th>
                                            <td>
                                                <ul id="recipients">
                                                    <?php foreach ($form['recipients'] as $recipient) : ?>
                                                        <li><input name="ifb_recipient_email" type="text" value="<?php echo esc_attr($recipient); ?>" /> <span class="ifb-small-add-button" onclick="vowelsforminc.addRecipientField(this); return false;">+</span> <span class="ifb-small-delete-button" onclick="vowelsforminc.removeRecipientField(this); return false;">x</span></li>
                                                    <?php endforeach; ?>
                                                </ul>
                                            </td>
                                        </tr>
                                        <?php if (!isset($form['bcc'])) $form['bcc'] = array(); ?>
                                        <tr valign="top" class="<?php if (!$form['send_notification']) echo 'ifb-hidden'; ?> ifb-show-if-send-notification-on">
                                            <th scope="row">
                                                <div class="ifb-tooltip"><div class="ifb-tooltip-content">
                                                    <?php esc_html_e('Add BCC email addresses','vowels-contact-form-with-drag-and-drop'); ?>
                                                </div></div>
                                                <label><?php esc_html_e('BCC recipients','vowels-contact-form-with-drag-and-drop'); ?></label>
                                            </th>
                                            <td>
                                                <button id="add_bcc" onclick="vowelsforminc.addBcc();" <?php if (count($form['bcc'])) echo 'class="ifb-hidden"';?>><?php esc_html_e('Add BCC','vowels-contact-form-with-drag-and-drop'); ?></button>
                                                <div id="bcc">
                                                    <?php foreach ($form['bcc'] as $bcc) : ?>
                                                        <div><input name="ifb_bcc_email" type="text" value="<?php echo esc_attr($bcc); ?>" /> <span class="ifb-small-add-button" onclick="vowelsforminc.addBccField(this); return false;">+</span> <span class="ifb-small-delete-button" onclick="vowelsforminc.removeBccField(this); return false;">x</span></div>
                                                    <?php endforeach; ?>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php if (!isset($form['conditional_recipients'])) $form['conditional_recipients'] = array(); ?>
                                        <tr valign="top" class="<?php if (!$form['send_notification']) echo 'ifb-hidden'; ?> ifb-show-if-send-notification-on">
                                            <th scope="row">
                                                <div class="ifb-tooltip"><div class="ifb-tooltip-content">
                                                    <?php esc_html_e('Send the form data to different email addresses depending on the submitted form values.','vowels-contact-form-with-drag-and-drop'); ?>
                                                </div></div>
                                                <label><?php esc_html_e('Conditional recipients','vowels-contact-form-with-drag-and-drop'); ?></label></th>
                                            <td>
                                                <div id="ifb-add-conditional-recipient" class="qfb-cf">
                                                    <button class="ifb-button" id="ifb-add-conditional-recipient-button" onclick="vowelsforminc.addConditionalRecipient(); return false;"><?php esc_html_e('Add a new rule','vowels-contact-form-with-drag-and-drop'); ?></button>
                                                    <div id="ifb-conditional-no-valid-elements" class="ifb-info-message"><span class="ifb-info-message-icon"></span><?php esc_html_e('The form must have at least one Dropdown Menu or Multiple Choice element to use this feature.','vowels-contact-form-with-drag-and-drop'); ?></div>
                                                </div>
                                                <div id="ifb-conditional-recipient-list-wrap" class="ifb-hidden">
                                                    <div class="ifb-conditional-heading"><?php esc_html_e('Active rules','vowels-contact-form-with-drag-and-drop'); ?></div>
                                                    <ul id="ifb-conditional-recipient-list"></ul>
                                                    <p class="description"><?php esc_html_e('If the active conditional rules result in no recipients for the email then the recipients specified in the section above will be used.','vowels-contact-form-with-drag-and-drop'); ?></p>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php if (!isset($form['notification_reply_to_element'])) $form['notification_reply_to_element'] = null; ?>
                                        <tr valign="top" class="<?php if (!$form['send_notification']) echo 'ifb-hidden'; ?> ifb-show-if-send-notification-on">
                                            <th scope="row">
                                                <label for="notification_reply_to_element"><?php esc_html_e('"Reply-To" address','vowels-contact-form-with-drag-and-drop'); ?></label>
                                            </th>
                                            <td>
                                                <div>
                                                    <select class="ifb-show-if-email-element" name="notification_reply_to_element" id="notification_reply_to_element"><?php echo vowels_form_builder_email_elements_as_options($form, $form['notification_reply_to_element']); ?></select>
                                                    <div class="ifb-hidden ifb-info-message ifb-show-if-no-email-element"><span class="ifb-info-message-icon"></span><?php echo esc_html_e('The form must have at least one Email Address element to use this feature.','vowels-contact-form-with-drag-and-drop'); ?></div>
                                                </div>
                                                <p class="description ifb-show-if-email-element"><?php esc_html_e('When you compose a reply to the notification email, it will be addressed to the email address submitted in this field.','vowels-contact-form-with-drag-and-drop'); ?></p>
                                            </td>
                                        </tr>
                                        <?php if (!isset($form['subject'])) $form['subject'] = __('Message from your website','vowels-contact-form-with-drag-and-drop'); ?>
                                        <tr valign="top" class="<?php if (!$form['send_notification']) echo 'ifb-hidden'; ?> ifb-show-if-send-notification-on">
                                            <th scope="row"><label for="subject"><?php esc_html_e('Email subject','vowels-contact-form-with-drag-and-drop'); ?></label></th>
                                            <td>
                                                <input type="text" id="subject" name="subject" value="<?php echo esc_attr($form['subject']); ?>" /> <select title="<?php esc_attr_e('Add more data to your email by inserting a variable tag','vowels-contact-form-with-drag-and-drop'); ?>" class="ifb-insert-variable" onchange="vowelsforminc.insertVariable('#subject', this);"></select>
                                            </td>
                                        </tr>
                                        <?php if (!isset($form['customise_email_content'])) $form['customise_email_content'] = false; ?>
                                        <tr valign="top" class="<?php if (!$form['send_notification']) echo 'ifb-hidden'; ?> ifb-show-if-send-notification-on">
                                            <th scope="row"><label for="customise_email_content"><?php esc_html_e('Customize email content','vowels-contact-form-with-drag-and-drop'); ?></label></th>
                                            <td>
                                                <input type="checkbox" id="customise_email_content" name="customise_email_content" onclick="vowelsforminc.toggleCustomiseEmailContent();" <?php checked($form['customise_email_content'], true); ?> />
                                                <p class="description"><?php esc_html_e('Tick to customize the email content. By default all submitted form data is sent, you can see an example by submitting the form.' , 'vowels-contact-form-with-drag-and-drop'); ?></p>
                                            </td>
                                        </tr>
                                        <?php if (!isset($form['notification_format'])) $form['notification_format'] = 'plain'; ?>
                                        <?php if (!isset($form['notification_email_content'])) $form['notification_email_content'] = ''; ?>
                                        <tr valign="top" class="<?php if (!$form['send_notification'] || !$form['customise_email_content']) echo 'ifb-hidden'; ?> ifb-show-if-customise-email-content ifb-show-if-send-notification-on">
                                            <th scope="row"><label for="notification_email_content"><?php esc_html_e('Email content','vowels-contact-form-with-drag-and-drop'); ?></label></th>
                                            <td>
                                                <div class="ifb-email-content-options">
                                                    <?php esc_html_e('Email format','vowels-contact-form-with-drag-and-drop'); ?>
                                                    <select id="notification_format">
                                                        <option value="plain" <?php selected($form['notification_format'], 'plain'); ?>><?php esc_html_e('Plain text','vowels-contact-form-with-drag-and-drop'); ?></option>
                                                        <option value="html" <?php selected($form['notification_format'], 'html'); ?>><?php esc_html_e('HTML','vowels-contact-form-with-drag-and-drop'); ?></option>
                                                    </select>
                                                    <select title="<?php esc_attr_e('Add more data to your email by inserting a variable tag','vowels-contact-form-with-drag-and-drop'); ?>" class="ifb-insert-variable" onchange="vowelsforminc.insertVariable('#notification_email_content', this);"></select>
                                                </div>
                                                <textarea id="notification_email_content" name="notification_email_content"><?php echo _wp_specialchars($form['notification_email_content'], ENT_NOQUOTES, false, true);?></textarea>
                                            </td>
                                        </tr>
                                        <?php if (!isset($form['notification_show_empty_fields'])) $form['notification_show_empty_fields'] = false; ?>
                                        <tr valign="top" class="<?php if (!$form['send_notification'] || $form['customise_email_content']) echo 'ifb-hidden'; ?> ifb-show-if-send-notification-on ifb-show-if-customise-email-content-off">
                                            <th scope="row"><label for="notification_show_empty_fields"><?php esc_html_e('Show empty fields','vowels-contact-form-with-drag-and-drop'); ?></label></th>
                                            <td>
                                                <input type="checkbox" id="notification_show_empty_fields" name="notification_show_empty_fields" <?php checked($form['notification_show_empty_fields'], true); ?> />
                                                <p class="description"><?php esc_html_e('Tick to show empty fields in the default notification email.' , 'vowels-contact-form-with-drag-and-drop'); ?></p>
                                            </td>
                                        </tr>
                                        <?php if (!isset($form['notification_from_type'])) $form['notification_from_type'] = 'static'; ?>
                                        <?php if (!isset($form['from_email'])) $form['from_email'] = get_bloginfo('admin_email'); ?>
                                        <?php if (!isset($form['from_name'])) $form['from_name'] = get_bloginfo('name'); ?>
                                        <?php if (!isset($form['notification_from_element'])) $form['notification_from_element'] = null; ?>
                                        <tr valign="top" class="<?php if (!$form['send_notification']) echo 'ifb-hidden'; ?> ifb-show-if-send-notification-on">
                                            <th scope="row">
                                                <div class="ifb-tooltip"><div class="ifb-tooltip-content"><?php esc_html_e('This is the email address that recipient(s) will see as the sender of the email.','vowels-contact-form-with-drag-and-drop'); ?></div></div>
                                                <label for="from_email"><?php esc_html_e('"From" address','vowels-contact-form-with-drag-and-drop'); ?></label>
                                            </th>
                                            <td>
                                                <div class="ifb-notification-from-type-wrap">
                                                    <select id="notification_from_type" name="notification_from_type" onchange="vowelsforminc.notificationFromTypeChanged();">
                                                        <option value="static" <?php selected('static', $form['notification_from_type']); ?>><?php esc_html_e('Static email address','vowels-contact-form-with-drag-and-drop'); ?></option>
                                                        <option value="element" <?php selected('element', $form['notification_from_type']); ?>><?php esc_html_e('Submitted email address','vowels-contact-form-with-drag-and-drop'); ?></option>
                                                    </select>
                                                </div>
                                                <div class="ifb-notification-from-static <?php if ($form['notification_from_type'] != 'static') echo 'ifb-hidden'; ?>">
                                                    <table class="ifb-from-address-headings">
                                                        <tr>
                                                            <td class="ifb-from-headings-email"><?php esc_html_e('Email address','vowels-contact-form-with-drag-and-drop'); ?></td>
                                                            <td class="ifb-from-headings-name"><?php esc_html_e('Name (optional)','vowels-contact-form-with-drag-and-drop'); ?></td>
                                                        </tr>
                                                    </table>
                                                    <input type="text" id="from_email" name="from_email" value="<?php echo esc_attr($form['from_email']); ?>" /> <input type="text" id="from_name" name="from_name" value="<?php echo esc_attr($form['from_name']); ?>" />
                                                </div>
                                                <div class="ifb-notification-from-element <?php if ($form['notification_from_type'] != 'element') echo 'ifb-hidden'; ?>">
                                                    <select class="ifb-show-if-email-element" name="notification_from_element" id="notification_from_element"><?php echo vowels_form_builder_email_elements_as_options($form, $form['notification_from_element']); ?></select>
                                                    <div class="ifb-hidden ifb-info-message ifb-show-if-no-email-element"><span class="ifb-info-message-icon"></span><?php echo esc_html_e('The form must have at least one Email element to use this feature.','vowels-contact-form-with-drag-and-drop'); ?></div>
                                                    <p class="description ifb-show-if-email-element"><?php printf(esc_html__('The From address of the notification email will be set to the email address submitted in this field.
                                                    %sImportant information%s.', 'vowels-contact-form-with-drag-and-drop'), '<a href="'.vowels_form_builder_help_link('settings-email#from-type').'" onclick="window.open(this.href); return false;">', '</a>'); ?></p>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="ifb-settings-sub-head" valign="top">
                                            <td colspan="2" scope="row"><h3><?php esc_html_e('Autoreply email settings (optional)','vowels-contact-form-with-drag-and-drop'); ?></h3></td>
                                        </tr>
                                        <?php if (!isset($form['send_autoreply'])) $form['send_autoreply'] = false; ?>
                                        <tr valign="top">
                                            <th scope="row"><label for="send_autoreply"><?php esc_html_e('Send autoreply email','vowels-contact-form-with-drag-and-drop'); ?></label></th>
                                            <td>
                                                <input type="checkbox" id="send_autoreply" name="send_autoreply" onclick="vowelsforminc.setSendAutoreply(this.checked);" <?php checked($form['send_autoreply'], true); ?> />
                                                <p class="description"><?php esc_html_e('If checked, when the user submits the form an autoreply email will be sent to them','vowels-contact-form-with-drag-and-drop'); ?></p>
                                            </td>
                                        </tr>
                                        <?php if (!isset($form['autoreply_recipient_element'])) $form['autoreply_recipient_element'] = null; ?>
                                        <tr valign="top" class="<?php if (!$form['send_autoreply']) echo 'ifb-hidden'; ?> ifb-show-if-send-autoreply-on">
                                            <th scope="row"><label for="autoreply_recipient_element"><?php esc_html_e('Recipient element','vowels-contact-form-with-drag-and-drop'); ?></label></th>
                                            <td>
                                                <div>
                                                    <select class="ifb-show-if-email-element" id="autoreply_recipient_element" name="autoreply_recipient_element"><?php echo vowels_form_builder_email_elements_as_options($form, $form['autoreply_recipient_element']); ?></select>
                                                    <div id="autoreply_recipient_no_email_element" class="ifb-hidden ifb-info-message ifb-show-if-no-email-element"><span class="ifb-info-message-icon"></span><?php echo esc_html_e('The form must have at least one Email Address element to use this feature.','vowels-contact-form-with-drag-and-drop'); ?></div>
                                                </div>
                                                <p class="description ifb-show-if-email-element"><?php esc_html_e('The autoreply email will be sent to the email address submitted in this field.','vowels-contact-form-with-drag-and-drop'); ?></p>
                                            </td>
                                        </tr>
                                        <?php if (!isset($form['autoreply_subject'])) $form['autoreply_subject'] = ''; ?>
                                        <tr valign="top" class="<?php if (!$form['send_autoreply']) echo 'ifb-hidden'; ?> ifb-show-if-send-autoreply-on">
                                            <th scope="row"><label for="autoreply_subject"><?php esc_html_e('Email subject','vowels-contact-form-with-drag-and-drop'); ?></label></th>
                                            <td>
                                                <input type="text" id="autoreply_subject" name="autoreply_subject" value="<?php echo esc_attr($form['autoreply_subject']); ?>" /> <select title="<?php esc_attr_e('Add more data to your email by inserting a variable tag','vowels-contact-form-with-drag-and-drop'); ?>" class="ifb-insert-variable" onchange="vowelsforminc.insertVariable('#autoreply_subject', this);"></select>
                                            </td>
                                        </tr>
                                        <?php if (!isset($form['autoreply_format'])) $form['autoreply_format'] = 'plain'; ?>
                                        <?php if (!isset($form['autoreply_email_content'])) $form['autoreply_email_content'] = ''; ?>
                                        <tr valign="top" class="<?php if (!$form['send_autoreply']) echo 'ifb-hidden'; ?> ifb-show-if-send-autoreply-on">
                                            <th scope="row"><label for="autoreply_email_content"><?php esc_html_e('Email content','vowels-contact-form-with-drag-and-drop'); ?></label></th>
                                            <td>
                                                <div class="ifb-email-content-options">
                                                    <?php esc_html_e('Email format','vowels-contact-form-with-drag-and-drop'); ?>
                                                    <select id="autoreply_format">
                                                        <option value="plain" <?php selected($form['autoreply_format'], 'plain'); ?>><?php esc_html_e('Plain text','vowels-contact-form-with-drag-and-drop'); ?></option>
                                                        <option value="html" <?php selected($form['autoreply_format'], 'html'); ?>><?php esc_html_e('HTML','vowels-contact-form-with-drag-and-drop'); ?></option>
                                                    </select>
                                                    <select title="<?php esc_attr_e('Add more data to your email by inserting a variable tag','vowels-contact-form-with-drag-and-drop'); ?>" class="ifb-insert-variable" onchange="vowelsforminc.insertVariable('#autoreply_email_content', this);"></select>
                                                </div>
                                                <textarea id="autoreply_email_content" name="autoreply_email_content"><?php echo _wp_specialchars($form['autoreply_email_content'], ENT_NOQUOTES, false, true); ?></textarea>
                                            </td>
                                        </tr>
                                        <?php if (!isset($form['autoreply_from_type'])) $form['autoreply_from_type'] = 'static'; ?>
                                        <?php if (!isset($form['autoreply_from_email'])) $form['autoreply_from_email'] = $form['from_email']; ?>
                                        <?php if (!isset($form['autoreply_from_name'])) $form['autoreply_from_name'] = $form['from_name']; ?>
                                        <?php if (!isset($form['autoreply_from_element'])) $form['autoreply_from_element'] = null; ?>
                                        <tr valign="top" class="<?php if (!$form['send_autoreply']) echo 'ifb-hidden'; ?> ifb-show-if-send-autoreply-on">
                                            <th scope="row">
                                                <div class="ifb-tooltip"><div class="ifb-tooltip-content"><?php esc_html_e('This is the email address that recipient will see as the sender of the email.','vowels-contact-form-with-drag-and-drop'); ?></div></div>
                                                <label for="autoreply_from_email"><?php esc_html_e('"From" address','vowels-contact-form-with-drag-and-drop'); ?></label>
                                            </th>
                                            <td>
                                                <div class="ifb-autoreply-from-type-wrap">
                                                    <select id="autoreply_from_type" name="autoreply_from_type" onchange="vowelsforminc.autoreplyFromTypeChanged();">
                                                        <option value="static" <?php selected('static', $form['autoreply_from_type']); ?>><?php esc_html_e('Static email address','vowels-contact-form-with-drag-and-drop'); ?></option>
                                                        <option value="element" <?php selected('element', $form['autoreply_from_type']); ?>><?php esc_html_e('Submitted email address','vowels-contact-form-with-drag-and-drop'); ?></option>
                                                    </select>
                                                </div>
                                                <div class="ifb-autoreply-from-static <?php if ($form['autoreply_from_type'] != 'static') echo 'ifb-hidden'; ?>">
                                                    <table class="ifb-from-address-headings">
                                                        <tr>
                                                            <td class="ifb-from-headings-email"><?php esc_html_e('Email address','vowels-contact-form-with-drag-and-drop'); ?></td>
                                                            <td class="ifb-from-headings-name"><?php esc_html_e('Name (optional)','vowels-contact-form-with-drag-and-drop'); ?></td>
                                                        </tr>
                                                    </table>
                                                    <input type="text" id="autoreply_from_email" name="autoreply_from_email" value="<?php echo esc_attr($form['autoreply_from_email']); ?>" /> <input type="text" id="autoreply_from_name" name="autoreply_from_name" value="<?php echo esc_attr($form['autoreply_from_name']); ?>" />
                                                </div>
                                                <div class="ifb-autoreply-from-element <?php if ($form['autoreply_from_type'] != 'element') echo 'ifb-hidden'; ?>">
                                                    <select class="ifb-show-if-email-element" name="autoreply_from_element" id="autoreply_from_element"><?php echo vowels_form_builder_email_elements_as_options($form, $form['autoreply_from_element']); ?></select>
                                                    <div class="ifb-hidden ifb-info-message ifb-show-if-no-email-element"><span class="ifb-info-message-icon"></span><?php echo esc_html_e('The form must have at least one Email Address element to use this feature.','vowels-contact-form-with-drag-and-drop'); ?></div>
                                                    <p class="description ifb-show-if-email-element"><?php printf(esc_html__('The From address of the autoreply email will be set to the email address submitted in this field.
                                                    %sImportant information%s.', 'vowels-contact-form-with-drag-and-drop'), '<a href="'.vowels_form_builder_help_link('settings-email#autoreply-from-type').'" onclick="window.open(this.href); return false;">', '</a>'); ?></p>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="ifb-settings-sub-head" valign="top">
                                            <td colspan="2" scope="row"><h3><?php esc_html_e('Email sending settings','vowels-contact-form-with-drag-and-drop'); ?></h3></td>
                                        </tr>
                                        <?php if (!isset($form['email_sending_method'])) $form['email_sending_method'] = 'global'; ?>
                                        <tr valign="top">
                                            <th scope="row"><label for="email_sending_method"><?php esc_html_e('Email sending method','vowels-contact-form-with-drag-and-drop'); ?></label></th>
                                            <td>
                                                <select id="email_sending_method" name="email_sending_method" onchange="vowelsforminc.setMailTransport(this);">
                                                    <option value="global" <?php selected($form['email_sending_method'], 'global'); ?>><?php esc_html_e('Use global setting','vowels-contact-form-with-drag-and-drop'); ?></option>
                                                    <option value="mail" <?php selected($form['email_sending_method'], 'mail'); ?>><?php esc_html_e('PHP mail()','vowels-contact-form-with-drag-and-drop'); ?></option>
                                                    <option value="smtp" <?php selected($form['email_sending_method'], 'smtp'); ?>><?php esc_html_e('SMTP','vowels-contact-form-with-drag-and-drop'); ?></option>
                                                </select>
                                                <p class="description"><?php esc_html_e('The global setting can be configured at Vowelsform &rarr; Settings on the WordPress menu.','vowels-contact-form-with-drag-and-drop'); ?></p>
                                            </td>
                                        </tr>
                                        <?php if (!isset($form['smtp_host'])) $form['smtp_host'] = ''; ?>
                                        <tr valign="top" class="<?php if ($form['email_sending_method'] !== 'smtp') echo 'ifb-hidden'; ?> ifb-show-if-smtp-on">
                                            <th scope="row"><label for="smtp_host"><?php esc_html_e('SMTP host','vowels-contact-form-with-drag-and-drop'); ?></label></th>
                                            <td>
                                                <input type="text" name="smtp_host" id="smtp_host" value="<?php echo esc_attr($form['smtp_host']); ?>" />
                                            </td>
                                        </tr>
                                        <?php if (!isset($form['smtp_port'])) $form['smtp_port'] = 25; ?>
                                        <tr valign="top" class="<?php if ($form['email_sending_method'] !== 'smtp') echo 'ifb-hidden'; ?> ifb-show-if-smtp-on">
                                            <th scope="row"><label for="smtp_port"><?php esc_html_e('SMTP port','vowels-contact-form-with-drag-and-drop'); ?></label></th>
                                            <td>
                                                <input type="text" name="smtp_port" id="smtp_port" value="<?php echo esc_attr($form['smtp_port']); ?>" />
                                            </td>
                                        </tr>
                                        <?php if (!isset($form['smtp_encryption'])) $form['smtp_encryption'] = ''; ?>
                                        <tr valign="top" class="<?php if ($form['email_sending_method'] !== 'smtp') echo 'ifb-hidden'; ?> ifb-show-if-smtp-on">
                                            <th scope="row"><label for="smtp_encryption"><?php esc_html_e('SMTP encryption','vowels-contact-form-with-drag-and-drop'); ?></label></th>
                                            <td>
                                                <select id="smtp_encryption" name="smtp_encryption">
                                                    <option value="" <?php selected($form['smtp_encryption'], ''); ?>><?php esc_html_e('None','vowels-contact-form-with-drag-and-drop'); ?></option>
                                                    <option value="tls" <?php selected($form['smtp_encryption'], 'tls'); ?>><?php esc_html_e('TLS','vowels-contact-form-with-drag-and-drop'); ?></option>
                                                    <option value="ssl" <?php selected($form['smtp_encryption'], 'ssl'); ?>><?php esc_html_e('SSL','vowels-contact-form-with-drag-and-drop'); ?></option>
                                                </select>
                                            </td>
                                        </tr>
                                        <?php if (!isset($form['smtp_username'])) $form['smtp_username'] = ''; ?>
                                        <tr valign="top" class="<?php if ($form['email_sending_method'] !== 'smtp') echo 'ifb-hidden'; ?> ifb-show-if-smtp-on">
                                            <th scope="row"><label for="smtp_username"><?php esc_html_e('SMTP username','vowels-contact-form-with-drag-and-drop'); ?></label></th>
                                            <td>
                                                <input type="text" name="smtp_username" id="smtp_username" value="<?php echo esc_attr($form['smtp_username']); ?>" />
                                            </td>
                                        </tr>
                                        <?php if (!isset($form['smtp_password'])) $form['smtp_password'] = ''; ?>
                                        <tr valign="top" class="<?php if ($form['email_sending_method'] !== 'smtp') echo 'ifb-hidden'; ?> ifb-show-if-smtp-on">
                                            <th scope="row"><label for="smtp_password"><?php esc_html_e('SMTP password','vowels-contact-form-with-drag-and-drop'); ?></label></th>
                                            <td>
                                                <?php if (strlen($form['smtp_password'])) : ?>
                                                    <span id="ifb-saved-smtp-password-message" class="ifb-floated-text-beside-button"><?php esc_html_e('A password is saved but hidden for security reasons.','vowels-contact-form-with-drag-and-drop'); ?></span><div class="ifb-button" id="ifb-set-new-smtp-password"><?php esc_html_e('Change password','vowels-contact-form-with-drag-and-drop'); ?></div>
                                                <?php else : ?>
                                                    <input type="password" name="smtp_password" id="smtp_password">
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="ifb-tabs-panel" id="ifb-settings-entries">
                                    <table class="ifb-form-table ifb-settings-form-table ifb-settings-database-form-table">
                                        <tr class="ifb-settings-sub-head" valign="top">
                                            <td colspan="2" scope="row"><h3><?php esc_html_e('Entry settings','vowels-contact-form-with-drag-and-drop'); ?></h3></td>
                                        </tr>
                                        <?php if (!isset($form['save_to_database'])) $form['save_to_database'] = true; ?>
                                        <tr valign="top">
                                            <th scope="row"><label for="save_to_database"><?php esc_html_e('Save submitted form data','vowels-contact-form-with-drag-and-drop'); ?></label></th>
                                            <td>
                                                <input type="checkbox" id="save_to_database" name="save_to_database" onclick="vowelsforminc.toggleSaveToDatabase(this.checked);" <?php checked($form['save_to_database'], true); ?> />
                                                <p class="description"><?php esc_html_e('If checked, the submitted form data will be saved to your database and you will be able
                                                    to view submitted entries within the WordPress admin.','vowels-contact-form-with-drag-and-drop'); ?></p>
                                            </td>
                                        </tr>
                                        <?php
                                            if (!isset($form['entries_table_layout'])) $form['entries_table_layout'] = array();
                                            if (!isset($form['entries_table_layout']['active'])) {
                                                $form['entries_table_layout']['active'] = array(
                                                    array(
                                                        'type' => 'column',
                                                        'label' => __('Date', 'vowels-contact-form-with-drag-and-drop'),
                                                        'id' => 'date_added'
                                                    )
                                                );
                                            }
                                            if (!isset($form['entries_table_layout']['inactive']))  {
                                                $form['entries_table_layout']['inactive'] = array(
                                                    array(
                                                        'type' => 'column',
                                                        'label' => __('Form URL', 'vowels-contact-form-with-drag-and-drop'),
                                                        'id' => 'form_url'
                                                    ),
                                                    array(
                                                        'type' => 'column',
                                                        'label' => __('Referring URL', 'vowels-contact-form-with-drag-and-drop'),
                                                        'id' => 'referring_url'
                                                    ),
                                                    array(
                                                        'type' => 'column',
                                                        'label' => __('Post / Page ID', 'vowels-contact-form-with-drag-and-drop'),
                                                        'id' => 'post_id'
                                                    ),
                                                    array(
                                                        'type' => 'column',
                                                        'label' => __('Post / Page Title', 'vowels-contact-form-with-drag-and-drop'),
                                                        'id' => 'post_title'
                                                    ),
                                                    array(
                                                        'type' => 'column',
                                                        'label' => __('User WP display name', 'vowels-contact-form-with-drag-and-drop'),
                                                        'id' => 'user_display_name'
                                                    ),
                                                    array(
                                                        'type' => 'column',
                                                        'label' => __('User WP login', 'vowels-contact-form-with-drag-and-drop'),
                                                        'id' => 'user_login'
                                                    ),
                                                    array(
                                                        'type' => 'column',
                                                        'label' => __('User WP email', 'vowels-contact-form-with-drag-and-drop'),
                                                        'id' => 'user_email'
                                                    ),
                                                    array(
                                                        'type' => 'column',
                                                        'label' => __('IP address', 'vowels-contact-form-with-drag-and-drop'),
                                                        'id' => 'ip'
                                                    )
                                                );
                                            }
                                        ?>
                                        <tr valign="top">
                                            <th scope="row">
                                                <div class="ifb-tooltip"><div class="ifb-tooltip-content"><?php esc_html_e('Customize what is shown in the table when viewing the list of entries for the form. Drag and drop the elements into the desired columns.','vowels-contact-form-with-drag-and-drop'); ?></div></div>
                                                <label><?php esc_html_e('List of entries table layout','vowels-contact-form-with-drag-and-drop'); ?></label>
                                            </th>
                                            <td>
                                                <table class="ifb-form-table ifb-tooltip-style-subtable">
                                                    <tr valign="top" class="ifb-subtable-heading">
                                                        <th><span><?php esc_html_e('Active columns','vowels-contact-form-with-drag-and-drop'); ?></span></th>
                                                        <th><span><?php esc_html_e('Inactive columns','vowels-contact-form-with-drag-and-drop'); ?></span></th>
                                                    </tr>
                                                    <tr valign="top">
                                                        <td>
                                                            <ul id="ifb-active-columns">
                                                                <?php foreach ($form['entries_table_layout']['active'] as $active) : ?>
                                                                    <li><div class="ifb-button" data-type="<?php echo esc_attr($active['type']); ?>" data-id="<?php echo esc_attr($active['id']); ?>"><?php echo _wp_specialchars($active['label'], ENT_NOQUOTES, false, true); ?></div></li>
                                                                <?php endforeach; ?>
                                                            </ul>
                                                        </td>
                                                        <td>
                                                            <ul id="ifb-inactive-columns">
                                                                <?php foreach ($form['entries_table_layout']['inactive'] as $inactive) : ?>
                                                                    <li><div class="ifb-button" data-type="<?php echo esc_attr($inactive['type']); ?>" data-id="<?php echo esc_attr($inactive['id']); ?>"><?php echo _wp_specialchars($inactive['label'], ENT_NOQUOTES, false, true); ?></div></li>
                                                                <?php endforeach; ?>
                                                            </ul>
                                                        </td>
                                                    </tr>
                                                </table>
                                                <p class="description"><?php esc_html_e('Customize how the listing table of entries appears for this form. This only
                                                    applies to the list of entries, all entry information will be displayed when viewing an individual entry.','vowels-contact-form-with-drag-and-drop'); ?></p>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="ifb-tabs-panel" id="ifb-settings-database">
                                    <div class="ifb-settings-database-user-note ifb-info-message"><p><span class="ifb-info-message-icon"></span><?php esc_html_e('This section enables you to save form data to a custom database.
                                        This is not related to the saving of submitted entries, you can do both at the same time.
                                        You can use this functionality to save submitted form data to the table of another
                                        plugin for example.','vowels-contact-form-with-drag-and-drop'); ?></p>
                                        <p><?php esc_html_e('This tool will not create the database table or fields for you - they should already exist. You can
                                        then choose to save a form value using the button below, just enter the name of the database field you would like to
                                        save to and choose your value from the dropdown menu.','vowels-contact-form-with-drag-and-drop'); ?></p>
                                     </div>
                                    <table class="ifb-form-table ifb-settings-form-table ifb-settings-database-form-table">
                                        <tr class="ifb-settings-sub-head" valign="top">
                                            <td colspan="2" scope="row"><h3><?php esc_html_e('Custom database settings (MySQL)','vowels-contact-form-with-drag-and-drop'); ?></h3></td>
                                        </tr>
                                        <?php if (!isset($form['use_wp_db'])) $form['use_wp_db'] = true; ?>
                                        <tr valign="top">
                                            <th scope="row"><label for="use_wp_db"><?php esc_html_e('Use WordPress database','vowels-contact-form-with-drag-and-drop'); ?></label></th>
                                            <td>
                                                <input type="checkbox" id="use_wp_db" name="use_wp_db" onclick="vowelsforminc.toggleUseWpDb(this.checked);" <?php checked($form['use_wp_db'], true); ?> />
                                                <p class="description"><?php esc_html_e('If checked, the data will be inserted into a table you specify below,
                                                inside the WordPress database. Un-tick to specify your own database credentials','vowels-contact-form-with-drag-and-drop'); ?></p>
                                            </td>
                                        </tr>
                                        <?php if (!isset($form['db_host'])) $form['db_host'] = 'localhost'; ?>
                                        <tr valign="top" class="<?php if ($form['use_wp_db']) echo 'ifb-hidden'; ?> ifb-show-if-not-wpdb">
                                            <th scope="row"><label for="db_host"><?php esc_html_e('Host','vowels-contact-form-with-drag-and-drop'); ?></label></th>
                                            <td>
                                                <input type="text" id="db_host" name="db_host" value="<?php echo esc_attr($form['db_host']); ?>" />
                                                <p class="description"><?php esc_html_e('Usually localhost','vowels-contact-form-with-drag-and-drop'); ?></p>
                                            </td>
                                        </tr>
                                        <?php if (!isset($form['db_username'])) $form['db_username'] = ''; ?>
                                        <tr valign="top" class="<?php if ($form['use_wp_db']) echo 'ifb-hidden'; ?> ifb-show-if-not-wpdb">
                                            <th scope="row"><label for="db_username"><?php esc_html_e('Username','vowels-contact-form-with-drag-and-drop'); ?></label></th>
                                            <td>
                                                <input type="text" id="db_username" name="db_username" value="<?php echo esc_attr($form['db_username']); ?>" />
                                                <p class="description"><?php esc_html_e('The user must have permission to insert data to the database','vowels-contact-form-with-drag-and-drop'); ?></p>
                                            </td>
                                        </tr>
                                        <?php if (!isset($form['db_password'])) $form['db_password'] = ''; ?>
                                        <tr valign="top" class="<?php if ($form['use_wp_db']) echo 'ifb-hidden'; ?> ifb-show-if-not-wpdb">
                                            <th scope="row"><label for="db_password"><?php esc_html_e('Password','vowels-contact-form-with-drag-and-drop'); ?></label></th>
                                            <td>
                                                <input type="text" id="db_password" name="db_password" value="<?php echo esc_attr($form['db_password']); ?>" />
                                            </td>
                                        </tr>
                                        <?php if (!isset($form['db_name'])) $form['db_name'] = ''; ?>
                                        <tr valign="top" class="<?php if ($form['use_wp_db']) echo 'ifb-hidden'; ?> ifb-show-if-not-wpdb">
                                            <th scope="row"><label for="db_name"><?php esc_html_e('Database name','vowels-contact-form-with-drag-and-drop'); ?></label></th>
                                            <td>
                                                <input type="text" id="db_name" name="db_name" value="<?php echo esc_attr($form['db_name']); ?>" />
                                            </td>
                                        </tr>
                                        <?php if (!isset($form['db_table'])) $form['db_table'] = ''; ?>
                                        <tr valign="top">
                                            <th scope="row"><label for="db_table"><?php esc_html_e('Database table','vowels-contact-form-with-drag-and-drop'); ?></label></th>
                                            <td>
                                                <input type="text" id="db_table" name="db_table" value="<?php echo esc_attr($form['db_table']); ?>" />
                                                <p class="description"><?php esc_html_e('The name of the database table to insert the data into','vowels-contact-form-with-drag-and-drop'); ?></p>
                                            </td>
                                        </tr>
                                        <tr class="ifb-settings-sub-head" valign="top">
                                            <td colspan="2" scope="row"><h3><?php esc_html_e('What to save','vowels-contact-form-with-drag-and-drop'); ?></h3></td>
                                        </tr>
                                        <?php if (!isset($form['db_fields'])) $form['db_fields'] = array(); ?>
                                        <tr valign="top">
                                            <td scope="row">
                                                <div class="ifb-add-db-field-wrap">
                                                    <a class="ifb-button" onclick="vowelsforminc.addDbField();"><?php esc_html_e('Save another form value','vowels-contact-form-with-drag-and-drop'); ?></a>
                                                </div>
                                            </td>
                                            <td>
                                                <table id="db_fields_headings" class="ifb-hidden">
                                                    <tr>
                                                        <td><?php esc_html_e('Database field','vowels-contact-form-with-drag-and-drop'); ?></td>
                                                        <td><?php esc_html_e('Value','vowels-contact-form-with-drag-and-drop'); ?></td>
                                                    </tr>
                                                </table>
                                                <ul id="db_fields" class="ifb-hidden"></ul>
                                                <div id="db_fields_empty" class="ifb-info-message"><span class="ifb-info-message-icon"></span><?php esc_html_e('You are not currently saving any submitted form values.','vowels-contact-form-with-drag-and-drop'); ?></div>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                       </div>
                    </div>
                    <div class="ifb-buttons qfb-cf">
                        <a class="ifb-grey ifb-tooltip-example" title="This is Just draft preview. Please save this form and add the shortcode in new post to see the live form" href="<?php 
						$args_vwlss = array('numberposts' => 1);
						$next_post_vowels = get_posts( $args_vwlss );
						//$next_post_vowels = get_posts("post_type=post&numberposts=1&fields=ids");
						$vowles_draft_next_id= $next_post_vowels[0]->ID+1;
						$site_urlll=get_bloginfo('siteurl');						
						echo  $site_urlll. '?p='.$vowles_draft_next_id.'&preview=true?'.time(); ?>" target="_blank"><?php esc_html_e('Preview Draft','vowels-contact-form-with-drag-and-drop'); ?></a>
                        <a class="ifb-blue" onclick="vowelsforminc.saveForm(this, '<?php echo wp_create_nonce('vowels_form_builder_save_form'); ?>'); return false;">
                            <span class="ifb-save"><?php esc_attr_e('Save','vowels-contact-form-with-drag-and-drop'); ?></span>
                            <span class="ifb-saving"></span>
                            <span class="ifb-saved"></span>
                            <span class="ifb-save-failed"></span>
                        </a>
						<a href="https://tawk.to/chat/5c04d07ffd65052a5c93795e/default" target="_blank" style="display: block;">&nbsp;&nbsp;&nbsp;Support</a>
                        <a id="ifb-scroll-top"><?php esc_html_e('Top','vowels-contact-form-with-drag-and-drop'); ?></a>
                    </div><br><br><br>
	<a href="https://wordpress.org/support/plugin/vowels-contact-form-with-drag-and-drop/reviews/?filter=5" target="_blank">Rate Us Please</a>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php
					$vowels_txt177 = __( 'Issue in creating?? Just paste [vowels id="1"] or [vowels id="2"] in ', 'vowels-contact-form-with-drag-and-drop' );	echo ''.$vowels_txt177.' '.$postlinkk.''; ?><br><br><br><br><br>
	<iframe width="560" height="315" src="https://www.youtube.com/embed/0l00jHyOE6Y" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
	
                </div> <!-- /.ifb-left-col -->
            </div>
        </div>
        </form>
        <script type="text/javascript">
        //<![CDATA[
            jQuery(document).ready(function () {
                vowelsforminc.init(<?php echo vowels_form_builder_json_encode($form); ?>);
            });
        //]]>
        </script>
		
		 <?php 
	//	 $vowles_draft_next_id= $next_post->ID;
	$formm_idd= absint($switchForm['id']);
		 $contact_post_vowels = array(
  'ID'             => $vowles_draft_next_id, 
  'post_content'   => '[vowels id="'.$formm_idd.'"]', 
  'post_title'     => 'contact form test', // The title of your post.
  'post_status'    => 'draft'
  
);  
wp_insert_post($contact_post_vowels);
  ?>
    <?php else : ?>
        <?php echo '<div class="vowels-admin-notice vowels-admin-notice-no-form error"><p><strong>' . sprintf(esc_html__('The form with that ID does not exist, %sgo back to the form list%s.', 'vowels-contact-form-with-drag-and-drop'), '<a href="' . admin_url('admin.php?page=vowels_form_builder_forms') . '">', '</a>') . '</strong></p></div>'; ?>
    <?php endif; ?>
</div>