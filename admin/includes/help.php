<?php if (!defined('VOWELSFORMDRAGDROP_VERSION')) exit; ?><div id="top" class="wrap">
	<div class="vowels-top-right">
        <div class="vowels-information">
        	<span class="vowels-copyright"><a href="http://www.Vowelsform.com" onclick="window.open(this.href); return false;">www.Vowelsform.com</a> &copy; <?php echo date('Y'); ?></span>
        	<span class="vowels-bug-link"><a href="http://www.Vowelsform.com/support.php" onclick="window.open(this.href); return false;"><?php esc_html_e('Report a bug','vowels-contact-form-with-drag-and-drop'); ?></a></span>
        	<span class="vowels-help-link"><a href="<?php echo vowels_form_builder_help_link(); ?>" onclick="window.open(this.href); return false;"><?php esc_html_e('Help','vowels-contact-form-with-drag-and-drop'); ?></a></span>
        </div>
    </div>
    <div class="ifb-form-icon"></div>
    <h2 class="ifb-main-title"><span class="ifb-vowels-title"><?php echo esc_html(vowels_form_builder_get_plugin_name()); ?></span><?php esc_html_e('Help','vowels-contact-form-with-drag-and-drop'); ?></h2>
    <?php if (strlen(get_option('vowels_form_builder_licence_key'))) : ?>
        <div class="vowels-help-wrap qfb-cf">
            <?php vowels_form_builder_global_nav('help'); ?>

        	<div class="vowels-global-sub-nav-wrap qfb-cf">
            	<ul class="vowels-global-sub-nav-ul">
                	<li><a href="<?php echo vowels_form_builder_help_link(); ?>"><span class="ifb-no-arrow"><?php esc_html_e('Basics','vowels-contact-form-with-drag-and-drop'); ?></span></a></li>
                    <li><a href="<?php echo vowels_form_builder_help_link('elements'); ?>"><span class="ifb-no-arrow"><?php esc_html_e('Elements','vowels-contact-form-with-drag-and-drop'); ?></span></a></li>
                    <li><a href="<?php echo vowels_form_builder_help_link('settings'); ?>"><span class="ifb-no-arrow"><?php esc_html_e('Settings','vowels-contact-form-with-drag-and-drop'); ?></span></a></li>
                    <li><a href="<?php echo vowels_form_builder_help_link('faq'); ?>" title="<?php esc_attr_e('Frequently asked questions','vowels-contact-form-with-drag-and-drop'); ?>"><span class="ifb-no-arrow"><?php esc_html_e('FAQ','vowels-contact-form-with-drag-and-drop'); ?></span></a></li>
                </ul>
            </div>
            <?php
                switch ($section) {
                    case 'basics':
                    default:
                        include VOWELSFORMDRAGDROP_ADMIN_INCLUDES_DIR . '/help/basics.php';
                        break;
                    case 'elements':
                        include VOWELSFORMDRAGDROP_ADMIN_INCLUDES_DIR . '/help/elements.php';
                        break;
                    case 'settings':
                        include VOWELSFORMDRAGDROP_ADMIN_INCLUDES_DIR . '/help/settings.php';
                        break;
                    case 'faq':
                        include VOWELSFORMDRAGDROP_ADMIN_INCLUDES_DIR . '/help/faq.php';
                        break;
                    case 'element-text':
                        include VOWELSFORMDRAGDROP_ADMIN_INCLUDES_DIR . '/help/element-text.php';
                        break;
                    case 'element-textarea':
                        include VOWELSFORMDRAGDROP_ADMIN_INCLUDES_DIR . '/help/element-textarea.php';
                        break;
                    case 'element-email':
                        include VOWELSFORMDRAGDROP_ADMIN_INCLUDES_DIR . '/help/element-email.php';
                        break;
                    case 'element-select':
                        include VOWELSFORMDRAGDROP_ADMIN_INCLUDES_DIR . '/help/element-select.php';
                        break;
                    case 'element-checkbox':
                        include VOWELSFORMDRAGDROP_ADMIN_INCLUDES_DIR . '/help/element-checkbox.php';
                        break;
                    case 'element-radio':
                        include VOWELSFORMDRAGDROP_ADMIN_INCLUDES_DIR . '/help/element-radio.php';
                        break;
                    case 'element-captcha':
                        include VOWELSFORMDRAGDROP_ADMIN_INCLUDES_DIR . '/help/element-captcha.php';
                        break;
                    case 'element-captcha':
                        include VOWELSFORMDRAGDROP_ADMIN_INCLUDES_DIR . '/help/element-captcha.php';
                        break;
                    case 'element-group':
                        include VOWELSFORMDRAGDROP_ADMIN_INCLUDES_DIR . '/help/element-group.php';
                        break;
                    case 'element-file':
                        include VOWELSFORMDRAGDROP_ADMIN_INCLUDES_DIR . '/help/element-file.php';
                        break;
                    case 'element-recaptcha':
                        include VOWELSFORMDRAGDROP_ADMIN_INCLUDES_DIR . '/help/element-recaptcha.php';
                        break;
                    case 'element-html':
                        include VOWELSFORMDRAGDROP_ADMIN_INCLUDES_DIR . '/help/element-html.php';
                        break;
                    case 'element-date':
                        include VOWELSFORMDRAGDROP_ADMIN_INCLUDES_DIR . '/help/element-date.php';
                        break;
                    case 'element-time':
                        include VOWELSFORMDRAGDROP_ADMIN_INCLUDES_DIR . '/help/element-time.php';
                        break;
                    case 'element-hidden':
                        include VOWELSFORMDRAGDROP_ADMIN_INCLUDES_DIR . '/help/element-hidden.php';
                        break;
                    case 'element-password':
                        include VOWELSFORMDRAGDROP_ADMIN_INCLUDES_DIR . '/help/element-password.php';
                        break;
                    case 'settings-global':
                        include VOWELSFORMDRAGDROP_ADMIN_INCLUDES_DIR . '/help/settings-global.php';
                        break;
                    case 'settings-general':
                        include VOWELSFORMDRAGDROP_ADMIN_INCLUDES_DIR . '/help/settings-general.php';
                        break;
                    case 'settings-email':
                        include VOWELSFORMDRAGDROP_ADMIN_INCLUDES_DIR . '/help/settings-email.php';
                        break;
                    case 'settings-style':
                        include VOWELSFORMDRAGDROP_ADMIN_INCLUDES_DIR . '/help/settings-style.php';
                        break;
                    case 'settings-entries':
                        include VOWELSFORMDRAGDROP_ADMIN_INCLUDES_DIR . '/help/settings-entries.php';
                        break;
                    case 'settings-database':
                        include VOWELSFORMDRAGDROP_ADMIN_INCLUDES_DIR . '/help/settings-database.php';
                        break;
                }
            ?>
        </div>
    <?php else : ?>
        <?php echo '<div class="error"><p><strong>' . sprintf(esc_html__('You are using an unlicensed version. Please %senter your license key%s or %spurchase a license key%s.', 'vowels-contact-form-with-drag-and-drop'), '<a href="' . admin_url('admin.php?page=vowels_form_builder_settings') .'">', '</a>', '<a href="http://www.Vowelsform.com/vowels-form-builder/buy.php" onclick="window.open(this.href); return false;">', '</a>') . '</strong></p></div>'; ?>
        <p><?php esc_html_e('Help is not available in the unlicensed version.','vowels-contact-form-with-drag-and-drop'); ?></p>
    <?php endif; ?>
</div>