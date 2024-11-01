<?php if (!defined('VOWELSFORMDRAGDROP_VERSION')) exit; ?><div class="vowels-element-wrap vowels-element-wrap-textarea <?php echo $name; ?>-element-wrap vowels-clearfix vowels-labels-<?php echo $labelPlacement; ?> <?php echo ($element->getRequired()) ? 'vowels-element-required' : 'vowels-element-optional'; ?>" <?php echo $element->getCss('outer'); ?>>
    <div class="vowels-element-spacer vowels-element-spacer-textarea <?php echo $name; ?>-element-spacer"><?php echo $paratexxt_start; ?>
        <?php echo $element->getLabelHtml($tooltipType, $tooltipEvent, $labelCss); ?>
        <div class="vowels-input-wrap vowels-input-wrap-textarea <?php echo $name; ?>-input-wrap" <?php echo $element->getCss('inner', $leftMarginCss); ?>>
            <textarea class="vowels-element-textarea <?php echo $tooltipInputClass; ?> <?php echo $name; ?>" id="<?php echo esc_attr($uniqueId); ?>" name="<?php echo $name; ?>" <?php echo $tooltipTitle; ?> <?php echo $element->getCss('textarea'); ?> rows="10" cols="40"<?php echo strlen($placeholder = $element->getPlaceholder()) ? ' placeholder="' . vowels_form_builder_escape($placeholder) . '"' : ''; ?>><?php echo esc_html($element->getValue()); ?></textarea>
            <?php include VOWELSFORMDRAGDROP_INCLUDES_DIR . '/elements/_description.php'; ?>
        </div><?php echo $paratexxt_end; ?>
        <?php include VOWELSFORMDRAGDROP_INCLUDES_DIR . '/elements/_errors.php'; ?>
		
		  <script type="text/javascript">
        jQuery(document).ready(function ($) {
          // auto width for textbox starts here		
var textwidth = $(".vowels-element-text").prop("id"); 
var textareawidth = $(".vowels-element-textarea").prop("id"); 
$("#"+textareawidth).css({"width": $("#"+textwidth).innerWidth()});
//$("#"+textareawidth).css({"margin-top": ($("input[type='email']").height()-16)/2});
//$("#"+textareawidth).css({"margin-top": $("input[type='email']").height()-16});
// auto width for textbox ends here
        });
        </script>
		
    </div>
    <?php include VOWELSFORMDRAGDROP_INCLUDES_DIR . '/elements/_clear-default-value.php'; ?>
</div>