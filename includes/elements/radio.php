<?php
if (!defined('VOWELSFORMDRAGDROP_VERSION')) exit;
$value = (array) $element->getValue();
?>
<div class="vowels-element-wrap vowels-element-wrap-radio <?php echo $name; ?>-element-wrap vowels-clearfix vowels-labels-<?php echo $labelPlacement; ?> <?php echo ($element->getRequired()) ? 'vowels-element-required' : 'vowels-element-optional'; ?>" <?php echo $element->getCss('outer'); ?>>
    <div class="vowels-element-spacer vowels-element-spacer-radio <?php echo $name; ?>-element-spacer"><?php echo $paratexxt_start; ?>
        <?php echo $element->getLabelHtml($tooltipType, $tooltipEvent, $labelCss, false); ?>
        <div class="vowels-input-wrap vowels-input-wrap-radio <?php echo $name; ?>-input-wrap" <?php echo $element->getCss('inner', $leftMarginCss); ?>>
            <div class="vowels-input-ul vowels-input-radio-ul <?php echo $name; ?>-input-radio-ul vowels-options-<?php echo $element->getOptionsLayout(); ?> vowels-clearfix" <?php echo $element->getCss('optionUl'); ?>>
            <?php
                $i = 1;
                $options = $element->getOptions();
                foreach ($options as $option) : ?>
                <div class="vowels-input-li vowels-input-radio-li <?php echo $name; ?>-input-li" <?php echo $element->getCss('optionLi'); ?>>
                    <label for="<?php echo esc_attr($uniqueId) . "_$i"; ?>" <?php echo $element->getCss('optionLabel'); ?> class="<?php echo $name . '_' . $i . '_label'; ?>">
                        <input size="40" class="vowels-element-radio <?php echo $name; ?> <?php echo $name . '_' . $i; ?>" type="radio" name="<?php echo $name; ?>" id="<?php echo esc_attr($uniqueId) . "_$i"; ?>" value="<?php echo _wp_specialchars($option['value'], ENT_COMPAT, false, true); ?>" <?php echo (in_array($option['value'], $value)) ? 'checked="checked"' : ''; ?> />
                        <?php echo $option['label']; ?>
                    </label>
                </div>
            <?php $i++; endforeach; ?>
            </div>
            <?php include VOWELSFORMDRAGDROP_INCLUDES_DIR . '/elements/_description.php'; ?>
        </div><?php echo $paratexxt_end; ?>
        <?php include VOWELSFORMDRAGDROP_INCLUDES_DIR . '/elements/_errors.php'; ?>
    </div>
</div>