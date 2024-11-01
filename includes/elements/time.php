<?php
if (!defined('VOWELSFORMDRAGDROP_VERSION')) exit;
$time1224 = $element->getTime1224();
$value = $element->getValue();
$minuteGranularity = $element->getMinuteGranularity();
$sh = $element->getStartHour();
$eh = $element->getEndHour();
?>
<div class="vowels-element-wrap vowels-element-wrap-time <?php echo $name; ?>-element-wrap vowels-clearfix vowels-labels-<?php echo $labelPlacement; ?> <?php echo ($element->getRequired()) ? 'vowels-element-required' : 'vowels-element-optional'; ?>" <?php echo $element->getCss('outer'); ?>>
    <div class="vowels-element-spacer vowels-element-spacer-time <?php echo $name; ?>-element-spacer"><?php echo $paratexxt_start; ?>
        <?php echo $element->getLabelHtml($tooltipType, $tooltipEvent, $labelCss, false, $uniqueId . '_time_label'); ?>
        <div class="vowels-input-wrap vowels-input-wrap-date <?php echo $name; ?>-input-wrap" <?php echo $element->getCss('inner', $leftMarginCss); ?>>
            <label id="<?php echo esc_attr($uniqueId); ?>_hour_label" class="vowels-screen-reader-text"><?php esc_html_e('Hour','vowels-contact-form-with-drag-and-drop'); ?></label>
            <select id="<?php echo esc_attr($uniqueId); ?>_hour"  name="<?php echo $name; ?>[hour]" class="<?php echo $name; ?>-input-hour" aria-labelledby="<?php echo esc_attr($uniqueId); ?>_time_label <?php echo esc_attr($uniqueId); ?>_hour_label" <?php echo $element->getCss('timeHour'); ?>>
                <?php if ($element->getShowTimeHeadings()) : ?><option value=""><?php echo esc_html($element->getHhString()); ?></option><?php endif; ?>
                <?php if ($sh > $eh) : ?>
                    <?php for ($i = $sh; $i >= $eh; $i--) : ?>
                        <?php $i = str_pad($i, 2, '0', STR_PAD_LEFT); ?>
                        <option value="<?php echo $i; ?>" <?php selected($value['hour'], $i); ?>><?php echo $i; ?></option>
                    <?php endfor; ?>
                <?php else : ?>
                    <?php for ($i = $sh; $i <= $eh; $i++) : ?>
                        <?php $i = str_pad($i, 2, '0', STR_PAD_LEFT); ?>
                        <option value="<?php echo $i; ?>" <?php selected($value['hour'], $i); ?>><?php echo $i; ?></option>
                    <?php endfor; ?>
                <?php endif; ?>
            </select>
            <label id="<?php echo esc_attr($uniqueId); ?>_minute_label" class="vowels-screen-reader-text"><?php esc_html_e('Minute','vowels-contact-form-with-drag-and-drop'); ?></label>
            <select id="<?php echo esc_attr($uniqueId); ?>_minute" name="<?php echo $name; ?>[minute]" class="<?php echo $name; ?>-input-minute" aria-labelledby="<?php echo esc_attr($uniqueId); ?>_time_label <?php echo esc_attr($uniqueId); ?>_minute_label" <?php echo $element->getCss('timeMinute'); ?>>
                <?php if ($element->getShowTimeHeadings()) : ?><option value=""><?php echo esc_html($element->getMmString()); ?></option><?php endif; ?>
                <?php foreach (range(0, 59) as $min) : ?>
                    <?php if ($min % $minuteGranularity == 0) : ?>
                        <?php $min = str_pad($min, 2, '0', STR_PAD_LEFT); ?>
                        <option value="<?php echo $min; ?>" <?php selected($value['minute'], $min); ?>><?php echo $min; ?></option>
                    <?php endif; ?>
                <?php endforeach; ?>
            </select>
            <?php if ($time1224 == '12') : ?>
            <label id="<?php echo esc_attr($uniqueId); ?>_ampm_label" class="vowels-screen-reader-text"><?php esc_html_e('am/pm','vowels-contact-form-with-drag-and-drop'); ?></label>
            <select id="<?php echo esc_attr($uniqueId); ?>_ampm" name="<?php echo $name; ?>[ampm]" class="<?php echo $name; ?>-input-ampm" aria-labelledby="<?php echo esc_attr($uniqueId); ?>_time_label <?php echo esc_attr($uniqueId); ?>_ampm_label" <?php echo $element->getCss('timeAmPm'); ?>>
                <?php if ($element->getShowTimeHeadings()) : ?><option value=""><?php echo esc_html($element->getAmpmString()); ?></option><?php endif; ?>
                <option value="am" <?php selected($value['ampm'], 'am'); ?>><?php echo esc_html($element->getAmString()); ?></option>
                <option value="pm" <?php selected($value['ampm'], 'pm'); ?>><?php echo esc_html($element->getPmString()); ?></option>
            </select>
            <?php else : ?>
                <input type="hidden" name="<?php echo $name; ?>[ampm]" value="" />
            <?php endif; ?>
            <?php include VOWELSFORMDRAGDROP_INCLUDES_DIR . '/elements/_description.php'; ?>
        </div><?php echo $paratexxt_end; ?>
        <?php include VOWELSFORMDRAGDROP_INCLUDES_DIR . '/elements/_errors.php'; ?>
    </div>
</div>