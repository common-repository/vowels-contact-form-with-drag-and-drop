<?php
if (!defined('VOWELSFORMDRAGDROP_VERSION')) exit;
$value = $element->getValue();
$months = vowels_form_builder_get_all_months();
$sy = $element->getStartYear();
$ey = $element->getEndYear();
$showDateHeadings = $element->getShowDateHeadings();
if ($sy > $ey) {
    $dpMinYear = $ey;
    $dpMaxYear = $sy;
} else {
    $dpMinYear = $sy;
    $dpMaxYear = $ey;
}
?>
<div class="vowels-element-wrap vowels-element-wrap-date <?php echo $name; ?>-element-wrap vowels-clearfix vowels-labels-<?php echo $labelPlacement; ?> <?php echo ($element->getRequired()) ? 'vowels-element-required' : 'vowels-element-optional'; ?>" <?php echo $element->getCss('outer'); ?>>
    <div class="vowels-element-spacer vowels-element-spacer-date <?php echo $name; ?>-element-spacer"><?php echo $paratexxt_start; ?>
        <?php echo $element->getLabelHtml($tooltipType, $tooltipEvent, $labelCss, false, $uniqueId . '_date_label'); ?>
        <div id="<?php echo esc_attr($uniqueId); ?>" class="vowels-input-wrap vowels-input-wrap-date <?php echo $name; ?>-input-wrap" <?php echo $element->getCss('inner', $leftMarginCss); ?>>
        	<div class="vowels-clearfix">
                <div class="vowels-input-wrap-date-select-wrap">
                    <?php ob_start(); ?>
                    <label id="<?php echo esc_attr($uniqueId); ?>_day_label" class="vowels-screen-reader-text"><?php esc_html_e('Day','vowels-contact-form-with-drag-and-drop'); ?></label>
                    <select id="<?php echo esc_attr($uniqueId); ?>_day" name="<?php echo $name; ?>[day]" class="<?php echo $name; ?>-input-day" aria-labelledby="<?php echo esc_attr($uniqueId); ?>_date_label <?php echo esc_attr($uniqueId); ?>_day_label" <?php echo $element->getCss('dateDay'); ?>>
                        <?php if ($showDateHeadings) : ?><option value=""><?php echo esc_html($element->getDayHeading()); ?></option><?php endif; ?>
                        <?php foreach (range(1, 31) as $day) : ?>
                            <option value="<?php echo $day; ?>" <?php selected($value['day'], $day); ?>><?php echo $day; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <?php $daySelect = ob_get_clean(); ?>
                    <?php ob_start(); ?>
                    <label id="<?php echo esc_attr($uniqueId); ?>_month_label" class="vowels-screen-reader-text"><?php esc_html_e('Month','vowels-contact-form-with-drag-and-drop'); ?></label>
                    <select id="<?php echo esc_attr($uniqueId); ?>_month" name="<?php echo $name; ?>[month]" class="<?php echo $name; ?>-input-month" aria-labelledby="<?php echo esc_attr($uniqueId); ?>_date_label <?php echo esc_attr($uniqueId); ?>_month_label" <?php echo $element->getCss('dateMonth'); ?>>
                        <?php if ($showDateHeadings) : ?><option value=""><?php echo esc_html($element->getMonthHeading()); ?></option><?php endif; ?>
                        <?php foreach ($months as $key => $month) : ?>
                            <option value="<?php echo $key; ?>" <?php selected($value['month'], $key); ?>><?php echo esc_html($element->getMonthLabel($key, $month)); ?></option>
                        <?php endforeach; ?>
                    </select>
                    <?php $monthSelect = ob_get_clean(); ?>
                    <?php
                    if ($element->getFieldOrder() != 'us') {
                        echo $daySelect, $monthSelect;
                    } else {
                        echo $monthSelect, $daySelect;
                    }
                    ?>
                    <label id="<?php echo esc_attr($uniqueId); ?>_year_label" class="vowels-screen-reader-text"><?php esc_html_e('Year','vowels-contact-form-with-drag-and-drop'); ?></label>
                    <select id="<?php echo esc_attr($uniqueId); ?>_year" name="<?php echo $name; ?>[year]" class="<?php echo $name; ?>-input-year" aria-labelledby="<?php echo esc_attr($uniqueId); ?>_date_label <?php echo esc_attr($uniqueId); ?>_year_label" <?php echo $element->getCss('dateYear'); ?>>
                        <?php if ($showDateHeadings) : ?><option value=""><?php echo esc_html($element->getYearHeading()); ?></option><?php endif; ?>
                        <?php if ($sy > $ey) : ?>
                            <?php for ($i = $sy; $i >= $ey; $i--) : ?>
                                <option value="<?php echo $i; ?>" <?php selected($value['year'], $i); ?>><?php echo $i; ?></option>
                            <?php endfor; ?>
                        <?php else : ?>
                            <?php for ($i = $sy; $i <= $ey; $i++) : ?>
                                <option value="<?php echo $i; ?>" <?php selected($value['year'], $i); ?>><?php echo $i; ?></option>
                            <?php endfor; ?>
                        <?php endif; ?>
                    </select>
                </div>
                <?php if ($element->getShowDatepicker()) : ?>
                    <input type="hidden" class="vowels-datepicker" name="vowels_form_builder_datepicker_<?php echo esc_attr($uniqueId); ?>" value="" />
                    <div class="vowels-datepicker-icon"></div>
                    <script type="text/javascript">
                    jQuery(document).ready(function ($) {
                        vowelsforminc.instance.addDatepicker('<?php echo esc_js($uniqueId); ?>', <?php echo apply_filters('vowels_form_builder_datepicker_options_' . $element->getName(), "{
                            minDate: new Date($dpMinYear, 1 - 1, 1),
                            maxDate: new Date($dpMaxYear, 12 - 1, 31)
                        }", $dpMinYear, $dpMaxYear, $element); ?>);
                    });
                    </script>
                <?php endif; ?>
            </div>
            <?php include VOWELSFORMDRAGDROP_INCLUDES_DIR . '/elements/_description.php'; ?>
        </div><?php echo $paratexxt_end; ?>
        <?php include VOWELSFORMDRAGDROP_INCLUDES_DIR . '/elements/_errors.php'; ?>
    </div>
</div>