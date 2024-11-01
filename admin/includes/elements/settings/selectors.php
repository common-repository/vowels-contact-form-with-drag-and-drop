<?php if (!defined('VOWELSFORMDRAGDROP_VERSION')) exit; ?><tr valign="top">
    <th scope="row">
        <div class="ifb-tooltip"><div class="ifb-tooltip-content">
            <?php esc_html_e('You can use these selectors in your CSS stylesheet to style this element individually.','vowels-contact-form-with-drag-and-drop'); ?>
        </div></div>
        <label><?php esc_html_e('CSS selectors','vowels-contact-form-with-drag-and-drop'); ?></label>
    </th>
    <td>
        <div class="ifb-hide-if-new-form">
            <?php
                switch ($element['type']) {
                    case 'text':
                    case 'email':
                    case 'file':
                    case 'captcha':
                    case 'password':
                    case 'textarea':
                        include VOWELSFORMDRAGDROP_ADMIN_INCLUDES_DIR . '/elements/settings/selectors/text.php';
                        break;
                    case 'select':
                        include VOWELSFORMDRAGDROP_ADMIN_INCLUDES_DIR . '/elements/settings/selectors/select.php';
                        break;
                    case 'checkbox':
                    case 'radio':
                        include VOWELSFORMDRAGDROP_ADMIN_INCLUDES_DIR . '/elements/settings/selectors/checkbox.php';
                        break;
                    case 'recaptcha':
                        include VOWELSFORMDRAGDROP_ADMIN_INCLUDES_DIR . '/elements/settings/selectors/recaptcha.php';
                        break;
                    case 'groupstart':
                        include VOWELSFORMDRAGDROP_ADMIN_INCLUDES_DIR . '/elements/settings/selectors/groupstart.php';
                        break;
                    case 'date':
                        include VOWELSFORMDRAGDROP_ADMIN_INCLUDES_DIR . '/elements/settings/selectors/date.php';
                        break;
                    case 'time':
                        include VOWELSFORMDRAGDROP_ADMIN_INCLUDES_DIR . '/elements/settings/selectors/time.php';
                        break;

                }
            ?>
        </div>
        <div class="ifb-show-if-new-form">
            <div class="ifb-info-message"><span class="ifb-info-message-icon"></span><?php esc_html_e('Please save the form to see the CSS selectors.','vowels-contact-form-with-drag-and-drop'); ?></div>
        </div>
    </td>
</tr>