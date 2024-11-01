<?php if (!defined('VOWELSFORMDRAGDROP_VERSION')) exit; ?><div class="vowels-element-wrap vowels-element-wrap-text <?php echo $name; ?>-element-wrap vowels-clearfix vowels-labels-<?php echo $labelPlacement; ?> <?php echo ($element->getRequired()) ? 'vowels-element-required' : 'vowels-element-optional'; ?>" <?php echo $element->getCss('outer'); ?>>
    <div class="vowels-element-spacer vowels-element-spacer-text <?php echo $name; ?>-element-spacer"><?php echo $paratexxt_start; ?>
        <?php echo $element->getLabelHtml($tooltipType, $tooltipEvent, $labelCss); ?>
        <div class="vowels-input-wrap vowels-input-wrap-text <?php echo $name; ?>-input-wrap" <?php echo $element->getCss('inner', $leftMarginCss); ?>>
            <input size="40" class="vowels-element-text <?php echo $tooltipInputClass; ?> <?php echo $name; ?>" id="<?php echo esc_attr($uniqueId); ?>" type="text" name="<?php echo $name; ?>" <?php echo $tooltipTitle; ?> value="<?php echo esc_attr($element->getValue()); ?>"<?php echo strlen($placeholder = $element->getPlaceholder()) ? ' placeholder="' . vowels_form_builder_escape($placeholder) . '"' : ''; ?> <?php echo $element->getCss('input'); ?> />
            <?php include VOWELSFORMDRAGDROP_INCLUDES_DIR . '/elements/_description.php'; ?>
        </div><?php echo $paratexxt_end; ?>
        <?php include VOWELSFORMDRAGDROP_INCLUDES_DIR . '/elements/_errors.php'; ?>
		 <script type="text/javascript">
        jQuery(document).ready(function ($) {
	//	var textwidth2 = $(".vowels-element-text").prop("id"); 
		// $("#"+textwidth2).css({"margin-top": $("input[type='email']").height()-16});
		$(".vowelsmtop<?php echo $class_marginyesno;?>").css({"margin-top": ($("input[type='email']").outerHeight()-16)/2});

        });
        </script>
		
    </div>
    <?php include VOWELSFORMDRAGDROP_INCLUDES_DIR . '/elements/_clear-default-value.php'; ?>
</div>