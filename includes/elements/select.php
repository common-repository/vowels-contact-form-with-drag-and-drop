<?php
if (!defined('VOWELSFORMDRAGDROP_VERSION')) exit;
$value = (array) $element->getValue();
?>
<div class="vowels-element-wrap vowels-element-wrap-select <?php echo $name; ?>-element-wrap vowels-clearfix vowels-labels-<?php echo $labelPlacement; ?> <?php echo ($element->getRequired()) ? 'vowels-element-required' : 'vowels-element-optional'; ?>" <?php echo $element->getCss('outer'); ?>>
    <div class="vowels-element-spacer vowels-element-spacer-select <?php echo $name; ?>-element-spacer"><?php echo $paratexxt_start; ?>
        <?php echo $element->getLabelHtml($tooltipType, $tooltipEvent, $labelCss); ?>
        <div class="vowels-input-wrap vowels-input-wrap-select <?php echo $name; ?>-input-wrap" <?php echo $element->getCss('inner', $leftMarginCss); ?>>
            <select class="vowels-element-select <?php echo $tooltipInputClass; ?> <?php echo $name; ?>" name="<?php echo $name; ?>" id="<?php echo esc_attr($uniqueId); ?>" <?php echo $tooltipTitle; ?> <?php echo $element->getCss('select'); ?>>
                <?php
                    $options = $element->getOptions();
                    foreach ($options as $option) : ?>
                    <option value="<?php echo _wp_specialchars($option['value'], ENT_COMPAT, false, true); ?>" <?php echo (in_array($option['value'], $value)) ? 'selected="selected"' : ''; ?>><?php echo _wp_specialchars($option['label'], ENT_NOQUOTES, false, true); ?></option>
                <?php endforeach; ?>
            </select>
            <?php include VOWELSFORMDRAGDROP_INCLUDES_DIR . '/elements/_description.php'; ?>
        </div><?php echo $paratexxt_end; ?>
        <?php include VOWELSFORMDRAGDROP_INCLUDES_DIR . '/elements/_errors.php'; ?>
    </div>
</div>