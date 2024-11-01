<?php
if (!defined('VOWELSFORMDRAGDROP_VERSION')) exit;
$siteKey = get_option('vowels_form_builder_recaptcha_site_key');
$secretKey = get_option('vowels_form_builder_recaptcha_secret_key');
wp_enqueue_script('vowels-recaptcha', 'https://www.google.com/recaptcha/api.js?onload=vowelsformincRecaptchaLoaded&render=explicit&hl=' . $element->getRecaptchaLang(), array(), false, true);
$wrapClass = $name . '-element-wrap vowels_form_builder_' . $form->getId() . '_' . $element->getId() . '-element-wrap vowels-recaptcha-size-' .  $element->getRecaptchaSize() . ' vowels-recaptcha-badge-' . $element->getRecaptchaBadgePosition();
?>
<div class="vowels-element-wrap vowels-element-wrap-recaptcha <?php echo esc_attr($wrapClass); ?> vowels-clearfix vowels-labels-<?php echo $labelPlacement; ?> <?php echo ($element->getRequired()) ? 'vowels-element-required' : 'vowels-element-optional'; ?>" <?php echo $element->getCss('outer'); ?>>
    <div class="vowels-element-spacer vowels-element-spacer-captcha <?php echo esc_attr($name); ?>-element-spacer"><?php echo $paratexxt_start; ?>
        <?php echo $element->getLabelHtml($tooltipType, $tooltipEvent, $labelCss, false); ?>
        <div class="vowels-input-wrap vowels-input-wrap-recaptcha <?php echo $name; ?>-input-wrap" <?php echo $element->getCss('inner', $leftMarginCss); ?>>
            <?php if (!strlen($siteKey) || !strlen($secretKey)) : ?>
                <?php esc_html_e('To use reCAPTCHA you must enter your API keys in the Vowelsform settings page.','vowels-contact-form-with-drag-and-drop'); ?>
            <?php else : ?>
                <div id="<?php echo esc_attr($uniqueId); ?>" class="vowels-recaptcha" data-unique-id="<?php echo esc_attr($uniqueId); ?>" data-config="<?php echo _wp_specialchars(vowels_form_builder_json_encode($element->getRecaptchaConfig()), ENT_QUOTES, false, true); ?>"></div>
                <?php if ($element->getRecaptchaSize() == 'invisible') : ?>
                  <noscript><?php esc_html_e('Please enable JavaScript to submit this form.','vowels-contact-form-with-drag-and-drop'); ?></noscript>
                <?php else : ?>
                  <noscript>
                    <div>
                      <div style="width: 302px; height: 422px; position: relative;">
                        <div style="width: 302px; height: 422px; position: absolute;">
                          <iframe src="https://www.google.com/recaptcha/api/fallback?k=<?php echo esc_attr($siteKey); ?>"
                                  frameborder="0" scrolling="no"
                                  style="width: 302px; height:422px; border-style: none;">
                          </iframe>
                        </div>
                      </div>
                      <div style="width: 300px; height: 60px; border-style: none;
                                     bottom: 12px; left: 25px; margin: 0px; padding: 0px; right: 25px;
                                     background: #f9f9f9; border: 1px solid #c1c1c1; border-radius: 3px;">
                        <textarea id="g-recaptcha-response" name="g-recaptcha-response"
                                     class="g-recaptcha-response"
                                     style="width: 250px; height: 40px; border: 1px solid #c1c1c1;
                                            margin: 10px 25px; padding: 0px; resize: none;" >
                        </textarea>
                      </div>
                    </div>
                  </noscript>
                <?php endif; ?>
            <?php endif; ?>
            <?php include VOWELSFORMDRAGDROP_INCLUDES_DIR . '/elements/_description.php'; ?>
        </div><?php echo $paratexxt_end; ?>
        <?php include VOWELSFORMDRAGDROP_INCLUDES_DIR . '/elements/_errors.php'; ?>
    </div>
</div>