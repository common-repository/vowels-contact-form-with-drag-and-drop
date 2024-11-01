<?php if (!defined('VOWELSFORMDRAGDROP_VERSION')) exit; ?><div class="vowels-element-wrap vowels-element-wrap-password <?php echo $name; ?>-element-wrap vowels-clearfix vowels-labels-<?php echo $labelPlacement; ?> <?php echo ($element->getRequired()) ? 'vowels-element-required' : 'vowels-element-optional'; ?>" <?php echo $element->getCss('outer'); ?>>
    <div class="vowels-element-spacer vowels-element-spacer-password <?php echo $name; ?>-element-spacer"><?php echo $paratexxt_start; ?>
        <?php echo $element->getLabelHtml($tooltipType, $tooltipEvent, $labelCss); ?>
        <div class="vowels-input-wrap vowels-input-wrap-password <?php echo $name; ?>-input-wrap" <?php echo $element->getCss('inner', $leftMarginCss); ?>>
            <input size="40" class="vowels-element-password <?php echo $tooltipInputClass; ?> <?php echo $name; ?>" id="<?php echo esc_attr($uniqueId); ?>" type="password" name="<?php echo $name; ?>"<?php echo strlen($placeholder = $element->getPlaceholder()) ? ' placeholder="' . vowels_form_builder_escape($placeholder) . '"' : ''; ?> <?php echo $tooltipTitle; ?> <?php echo $element->getCss('input'); ?> />
            <?php include VOWELSFORMDRAGDROP_INCLUDES_DIR . '/elements/_description.php'; ?>
        </div><?php echo $paratexxt_end; ?>
        <?php include VOWELSFORMDRAGDROP_INCLUDES_DIR . '/elements/_errors.php'; ?>
    </div>
</div>