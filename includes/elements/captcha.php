<?php
if (!defined('VOWELSFORMDRAGDROP_VERSION')) exit;
$value = $element->getValue();
$captchaOptions = $element->getOptions();
$captchaConfig = array(
    'uniqId' => $formUniqueId,
    'tmpDir' => vowels_form_builder_get_temp_dir(),
    'options' => $captchaOptions
);
$captchaConfig = base64_encode(vowels_form_builder_json_encode($captchaConfig));
?>
<div class="vowels-element-wrap vowels-element-wrap-captcha <?php echo $name; ?>-element-wrap vowels-clearfix vowels-labels-<?php echo $labelPlacement; ?> <?php echo ($element->getRequired()) ? 'vowels-element-required' : 'vowels-element-optional'; ?>" <?php echo $element->getCss('outer'); ?>>
    <div class="vowels-element-spacer vowels-element-spacer-captcha <?php echo $name; ?>-element-spacer"><?php echo $paratexxt_start; ?>
        <?php echo $element->getLabelHtml($tooltipType, $tooltipEvent, $labelCss); ?>
        <div class="vowels-input-wrap vowels-input-wrap-captcha <?php echo $name; ?>-input-wrap" <?php echo $element->getCss('inner', $leftMarginCss); ?>>
            <input size="40" class="vowels-element-captcha <?php echo $tooltipInputClass; ?> <?php echo $name; ?>" id="<?php echo esc_attr($uniqueId); ?>" type="text" name="<?php echo $name; ?>" <?php echo $tooltipTitle; ?> value="<?php echo esc_attr($value); ?>"<?php echo strlen($placeholder = $element->getPlaceholder()) ? ' placeholder="' . vowels_form_builder_escape($placeholder) . '"' : ''; ?> <?php echo $element->getCss('input'); ?> />
            <?php include VOWELSFORMDRAGDROP_INCLUDES_DIR . '/elements/_description.php'; ?>
        </div>
        <div class="vowels-captcha-image-wrap vowels-clearfix <?php echo $name; ?>-captcha-image-wrap" <?php echo $element->getCss(null, $leftMarginCss); ?>>
            <div class="ifb-captcha-image-inner">
                <img width="<?php echo esc_attr($captchaOptions['width']); ?>" height="<?php echo esc_attr($captchaOptions['height']); ?>" id="vowels-captcha-image-<?php echo esc_attr($uniqueId); ?>" class="vowels-captcha-image" src="<?php echo vowels_form_builder_plugin_url() . '/includes/captcha.php?c=' . urlencode($captchaConfig) . '&amp;t=' . microtime(true); ?>" alt="CAPTCHA" />
            </div>
        </div><?php echo $paratexxt_end; ?>

        <script type="text/javascript">
        jQuery(document).ready(function ($) {
            $('#vowels-captcha-image-<?php echo esc_js($uniqueId); ?>').hover(function () {
                $(this).stop().fadeTo('slow', '0.3');
            }, function () {
                $(this).stop().fadeTo('slow', '1.0');
            }).click(function () {
                var newSrc = $(this).attr('src').replace(/&t=.+/, '&t=' + new Date().getTime());
                $(this).attr('src', newSrc);
            });
        });
        </script>
        <?php include VOWELSFORMDRAGDROP_INCLUDES_DIR . '/elements/_errors.php'; ?>
    </div>
</div>