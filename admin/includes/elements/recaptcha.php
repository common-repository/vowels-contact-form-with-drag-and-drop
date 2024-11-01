<?php
if (!defined('VOWELSFORMDRAGDROP_VERSION')) exit;
$id = absint($element['id']);

if (!isset($element['required'])) $element['required'] = true;
if (!isset($element['label'])) $element['label'] = __('Are you human?','vowels-contact-form-with-drag-and-drop');
if (!isset($element['description'])) $element['description'] = '';
if (!isset($element['recaptcha_theme'])) $element['recaptcha_theme'] = 'light';
$helpUrl = vowels_form_builder_help_link('element-recaptcha');
?>
<div id="ifb-element-wrap-<?php echo $id; ?>" class="ifb-element-wrap ifb-element-wrap-recaptcha <?php echo "ifb-label-placement-{$form['label_placement']}"; ?>">
	<div class="ifb-top-element-wrap qfb-cf">
        <?php include VOWELSFORMDRAGDROP_ADMIN_INCLUDES_DIR . '/elements/_actions.php'; ?>
        <div class="ifb-element-preview ifb-element-preview-recaptcha">
            <?php if (get_option('vowels_form_builder_recaptcha_secret_key') == null || get_option('vowels_form_builder_recaptcha_site_key') == null) : ?>
                <div class="ifb-recaptcha-empty ifb-info-message"><span class="ifb-info-message-icon"></span><?php printf(esc_html__('You must enter your reCAPTCHA API keys on the %sVowelsform settings page%s to use this element.', 'vowels-contact-form-with-drag-and-drop'), '<a href="' . admin_url('admin.php?page=vowels_form_builder_settings') . '">', '</a>'); ?></div>
            <?php else : ?>
                <label class="ifb-preview-label <?php if (!strlen($element['label'])) echo 'ifb-hidden'; ?>"><span class="ifb-preview-label-content"><?php echo $element['label']; ?></span><span class="ifb-required"><?php echo esc_html($form['required_text']); ?></span></label>
                <div id="ifb_element_<?php echo $id; ?>" class="ifb-preview-input">
                    <img class="ifb-recaptcha-sample ifb-recaptcha-sample-light<?php if ($element['recaptcha_theme'] != 'light') echo ' ifb-hidden'; ?>" src="<?php echo vowels_form_builder_admin_url() . '/images/reCAPTCHA-light.png' ?>" alt="reCAPTCHA light theme sample" />
                    <img class="ifb-recaptcha-sample ifb-recaptcha-sample-dark<?php if ($element['recaptcha_theme'] != 'dark') echo ' ifb-hidden'; ?>" src="<?php echo vowels_form_builder_admin_url() . '/images/reCAPTCHA-dark.png' ?>" alt="reCAPTCHA dark theme sample" />
                    <p class="ifb-preview-description <?php if (!strlen($element['description'])) echo 'ifb-hidden'; ?>"><?php echo $element['description']; ?></p>
                </div>
            <?php endif; ?>
            <span class="ifb-handle"></span>
        </div>
    </div>
    <div class="ifb-element-settings ifb-element-settings-recaptcha">
        <div class="ifb-element-settings-tabs" id="ifb-element-settings-tabs-<?php echo $id; ?>">
            <ul class="ifb-tabs-nav">
                <li><a href="#ifb-element-settings-tab-settings-<?php echo $id; ?>"><?php esc_html_e('Settings','vowels-contact-form-with-drag-and-drop'); ?></a></li>
                <li><a href="#ifb-element-settings-tab-more-<?php echo $id; ?>"><?php esc_html_e('Optional','vowels-contact-form-with-drag-and-drop'); ?></a></li>
                <li><a href="#ifb-element-settings-tab-advanced-<?php echo $id; ?>"><?php esc_html_e('Advanced','vowels-contact-form-with-drag-and-drop'); ?></a></li>
            </ul>
            <div class="ifb-tabs-panel" id="ifb-element-settings-tab-settings-<?php echo $id; ?>">
                <div class="ifb-element-settings-inner">
                    <table class="ifb-form-table ifb-element-settings-form-table ifb-element-settings-settings-form-table">
                        <?php include 'settings/label.php'; ?>
                        <?php include 'settings/description.php'; ?>
                        <tr valign="top">
                            <th scope="row"><label for="recaptcha_theme_<?php echo $id; ?>"><?php esc_html_e('Theme','vowels-contact-form-with-drag-and-drop'); ?></label></th>
                            <td>
                                <select id="recaptcha_theme_<?php echo $id; ?>" name="recaptcha_theme_<?php echo $id; ?>" onchange="vowelsforminc.setRecaptchaTheme(vowelsforminc.getElementById(<?php echo $id; ?>), this);">
                                    <option value="light" <?php selected($element['recaptcha_theme'], 'light'); ?>><?php esc_html_e('Light','vowels-contact-form-with-drag-and-drop'); ?></option>
                                    <option value="dark" <?php selected($element['recaptcha_theme'], 'dark'); ?>><?php esc_html_e('Dark','vowels-contact-form-with-drag-and-drop'); ?></option>
                                </select>
                            </td>
                        </tr>
                        <?php if (!isset($element['recaptcha_type'])) $element['recaptcha_type'] = 'image'; ?>
                        <tr valign="top">
                            <th scope="row"><label for="recaptcha_type_<?php echo $id; ?>"><?php esc_html_e('CAPTCHA type','vowels-contact-form-with-drag-and-drop'); ?></label></th>
                            <td>
                                <select id="recaptcha_type_<?php echo $id; ?>" name="recaptcha_type_<?php echo $id; ?>">
                                    <option value="image" <?php selected($element['recaptcha_type'], 'image'); ?>><?php esc_html_e('Image','vowels-contact-form-with-drag-and-drop'); ?></option>
                                    <option value="audio" <?php selected($element['recaptcha_type'], 'audio'); ?>><?php esc_html_e('Audio','vowels-contact-form-with-drag-and-drop'); ?></option>
                                </select>
                            </td>
                        </tr>
                        <?php if (!isset($element['recaptcha_size'])) $element['recaptcha_size'] = 'normal'; ?>
                        <tr valign="top">
                            <th scope="row"><label for="recaptcha_size_<?php echo $id; ?>"><?php esc_html_e('Size','vowels-contact-form-with-drag-and-drop'); ?></label></th>
                            <td>
                                <select id="recaptcha_size_<?php echo $id; ?>" name="recaptcha_size_<?php echo $id; ?>">
                                    <option value="normal" <?php selected($element['recaptcha_size'], 'normal'); ?>><?php esc_html_e('Normal','vowels-contact-form-with-drag-and-drop'); ?></option>
                                    <option value="compact" <?php selected($element['recaptcha_size'], 'compact'); ?>><?php esc_html_e('Compact','vowels-contact-form-with-drag-and-drop'); ?></option>
                                    <option value="invisible" <?php selected($element['recaptcha_size'], 'invisible'); ?>><?php esc_html_e('Invisible','vowels-contact-form-with-drag-and-drop'); ?></option>
                                </select>
                            </td>
                        </tr>
                        <?php if (!isset($element['recaptcha_badge_position'])) $element['recaptcha_badge_position'] = 'bottomright'; ?>
                        <tr valign="top">
                            <th scope="row"><label for="recaptcha_badge_position_<?php echo $id; ?>"><?php esc_html_e('Badge position','vowels-contact-form-with-drag-and-drop'); ?></label></th>
                            <td>
                                <select id="recaptcha_badge_position_<?php echo $id; ?>" name="recaptcha_badge_position_<?php echo $id; ?>">
                                    <option value="bottomright" <?php selected($element['recaptcha_badge_position'], 'bottomright'); ?>><?php esc_html_e('Bottom right','vowels-contact-form-with-drag-and-drop'); ?></option>
                                    <option value="bottomleft" <?php selected($element['recaptcha_badge_position'], 'bottomleft'); ?>><?php esc_html_e('Bottom left','vowels-contact-form-with-drag-and-drop'); ?></option>
                                    <option value="inline" <?php selected($element['recaptcha_badge_position'], 'inline'); ?>><?php esc_html_e('Inline','vowels-contact-form-with-drag-and-drop'); ?></option>
                                </select>
                            </td>
                        </tr>
                        <?php
                        if (!isset($element['recaptcha_lang'])) $element['recaptcha_lang'] = '';
                        $langs = array(
                            '' => 'Autodetect',
                            'ar' => 'Arabic',
                            'bn' => 'Bengali',
                            'bg' => 'Bulgarian',
                            'ca' => 'Catalan',
                            'zh-CN' => 'Chinese (Simplified)',
                            'zh-TW' => 'Chinese (Traditional)',
                            'hr' => 'Croatian',
                            'cs' => 'Czech',
                            'da' => 'Danish',
                            'nl' => 'Dutch',
                            'en-GB' => 'English (UK)',
                            'en' => 'English',
                            'et' => 'Estonian',
                            'fil' => 'Filipino',
                            'fi' => 'Finnish',
                            'fr' => 'French',
                            'fr-CA' => 'French (Canadian)',
                            'de' => 'German',
                            'gu' => 'Gujarati',
                            'de-AT' => 'German (Austria)',
                            'de-CH' => 'German (Switzerland)',
                            'el' => 'Greek',
                            'iw' => 'Hebrew',
                            'hi' => 'Hindi',
                            'hu' => 'Hungarian',
                            'id' => 'Indonesian',
                            'it' => 'Italian',
                            'ja' => 'Japanese',
                            'kn' => 'Kannada',
                            'ko' => 'Korean',
                            'lv' => 'Latvian',
                            'lt' => 'Lithuanian',
                            'ms' => 'Malay',
                            'ml' => 'Malayalam',
                            'mr' => 'Marathi',
                            'no' => 'Norwegian',
                            'fa' => 'Persian',
                            'pl' => 'Polish',
                            'pt' => 'Portuguese',
                            'pt-BR' => 'Portuguese (Brazil)',
                            'pt-PT' => 'Portuguese (Portugal)',
                            'ro' => 'Romanian',
                            'ru' => 'Russian',
                            'sr' => 'Serbian',
                            'sk' => 'Slovak',
                            'sl' => 'Slovenian',
                            'es' => 'Spanish',
                            'es-419' => 'Spanish (Latin America)',
                            'sv' => 'Swedish',
                            'ta' => 'Tamil',
                            'te' => 'Telugu',
                            'th' => 'Thai',
                            'tr' => 'Turkish',
                            'uk' => 'Ukrainian',
                            'ur' => 'Urdu',
                            'vi' => 'Vietnamese'
                        );
                        ?>
                        <tr valign="top">
                            <th scope="row"><label for="recaptcha_lang_<?php echo $id; ?>"><?php esc_html_e('Language','vowels-contact-form-with-drag-and-drop'); ?></label></th>
                            <td>
                                <select id="recaptcha_lang_<?php echo $id; ?>" name="recaptcha_lang_<?php echo $id; ?>">
                                    <?php foreach ($langs as $key => $lang) : ?>
                                        <option value="<?php echo esc_attr($key); ?>" <?php selected($element['recaptcha_lang'], $key); ?>><?php echo esc_html($lang); ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </td>
                        </tr>
                        <?php include 'settings/tooltip.php'; ?>
                        <?php include '_save.php'; ?>
                    </table>
                </div>
            </div>
            <div class="ifb-tabs-panel" id="ifb-element-settings-tab-more-<?php echo $id; ?>">
                <div class="ifb-element-settings-inner">
                    <table class="ifb-form-table ifb-element-settings-form-table ifb-element-settings-more-form-table">
                        <?php include 'settings/required-message.php'; ?>
                        <?php include 'settings/label-placement.php'; ?>
                        <?php include 'settings/tooltip-type.php'; ?>
                        <?php include 'settings/conditional-logic.php'; ?>
                    </table>
                    <h3 class="ifb-translate-h3"><?php esc_html_e('Translate error messages','vowels-contact-form-with-drag-and-drop'); ?></h3>
                    <table class="ifb-form-table translate-error-messages-table">
                        <?php
                            if (!isset($element['messages'])) $element['messages'] = array();

                            // key => tooltip
                            $customisableMessages = array(
                                'missing-input-secret' => '',
                                'invalid-input-secret' => '',
                                'missing-input-response' => '',
                                'invalid-input-response' => '',
                                'error' => ''
                            );

                            foreach ($customisableMessages as $key => $tooltip) {
                                if (!isset($element['messages'][$key])) {
                                    $element['messages'][$key] = '';
                                }
                            }

                            $recaptchaValidator = new vowelsforminc_Validator_Recaptcha();
                        ?>
                        <tr valign="top">
                            <th><?php esc_html_e('Default','vowels-contact-form-with-drag-and-drop'); ?></th>
                            <th><?php esc_html_e('Translation','vowels-contact-form-with-drag-and-drop'); ?></th>
                        </tr>
                        <?php foreach ($customisableMessages as $key => $tooltip) : ?>
                            <tr valign="top">
                                <th scope="row">
                                    <label for="<?php echo $key; ?>_<?php echo $id; ?>"><?php echo esc_html($recaptchaValidator->getMessageTemplate($key)); ?></label>
                                </th>
                                <td>
                                    <input type="text" id="recaptcha_<?php echo $key; ?>_<?php echo $id; ?>" name="recaptcha_<?php echo $key; ?>_<?php echo $id; ?>" value="<?php echo (isset($element['messages'][$key])) ? esc_attr($element['messages'][$key]) : ''; ?>" />
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        <?php include '_save.php'; ?>
                    </table>
                </div>
            </div>
            <div class="ifb-tabs-panel" id="ifb-element-settings-tab-advanced-<?php echo $id; ?>">
                <div class="ifb-element-settings-inner">
                    <table class="ifb-form-table ifb-element-settings-form-table ifb-element-settings-advanced-form-table">
                        <?php include 'settings/styles.php'; ?>
                        <?php include 'settings/unique-id.php'; ?>
                        <?php include 'settings/selectors.php'; ?>
                        <?php include '_save.php'; ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>