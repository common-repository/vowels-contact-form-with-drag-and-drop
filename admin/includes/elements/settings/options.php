<?php
if (!defined('VOWELSFORMDRAGDROP_VERSION')) exit;
if (!isset($element['customise_values'])) $element['customise_values'] = false;
?>
<tr valign="top">
    <th scope="row">
        <div class="ifb-tooltip"><div class="ifb-tooltip-content">
            <?php esc_html_e('These are the choices that the user will be able to choose from.','vowels-contact-form-with-drag-and-drop'); ?>
            <br /><br />
            <?php printf(esc_html__('The %sCustomize values%s setting allows you to have a different value being submitted, than the value that is displayed to the user.', 'vowels-contact-form-with-drag-and-drop'), '<span class="ifb-bold">', '</span>'); ?>
        </div></div>
        <label><?php esc_html_e('Options','vowels-contact-form-with-drag-and-drop'); ?></label>
    </th>
    <td id="options_td_<?php echo $id; ?>" <?php if ($element['customise_values']) echo 'class="ifb-customise-values"'; ?>>
        <div class="ifb-options-heading qfb-cf">
            <span class="ifb-small-delete-button ifb-clear-default-options <?php if (!count($element['default_value'])) echo 'ifb-invisible'; ?>" onclick="vowelsforminc.clearDefaultOptions(vowelsforminc.getElementById(<?php echo $id; ?>));" title="<?php esc_attr_e('Clear default option','vowels-contact-form-with-drag-and-drop'); ?>"></span>
            <div class="ifb-options-heading-option"><?php esc_html_e('Label','vowels-contact-form-with-drag-and-drop'); ?></div>
            <div class="ifb-options-heading-value"><?php esc_html_e('Value','vowels-contact-form-with-drag-and-drop'); ?></div>
        </div>
        <ul class="ifb-options-list" id="ifb_options_<?php echo $id; ?>">
            <?php $i = 0; foreach ($element['options'] as $option) : ?>
                <li class="ifb-option-wrap">
                    <input class="ifb-default-option" name="default_option_<?php echo $id; ?>" type="radio" onclick="vowelsforminc.updateOptions(vowelsforminc.getElementById(<?php echo $id; ?>));" <?php echo in_array($option['value'], $element['default_value'], true) ? 'checked="checked"' : ''; ?> />
                    <input class="ifb-option-label" type="text" value="<?php echo _wp_specialchars($option['label'], ENT_COMPAT, false, true); ?>" onkeyup="vowelsforminc.updateOptions(vowelsforminc.getElementById(<?php echo $id; ?>));" onclick="vowelsforminc.maybeSelectOptionText(this);" onblur="vowelsforminc.updateLogicOptions(vowelsforminc.getElementById(<?php echo $id; ?>));" />
                    <input class="ifb-option-value" type="text" value="<?php echo _wp_specialchars($option['value'], ENT_COMPAT, false, true); ?>" onkeyup="vowelsforminc.updateOptions(vowelsforminc.getElementById(<?php echo $id; ?>));" onblur="vowelsforminc.updateLogicOptions(vowelsforminc.getElementById(<?php echo $id; ?>));" />
                    <span class="ifb-add-option" onclick="vowelsforminc.addOption(this, vowelsforminc.getElementById(<?php echo $id; ?>));">+</span>
                    <span class="ifb-remove-option" onclick="vowelsforminc.removeOption(this, vowelsforminc.getElementById(<?php echo $id; ?>));">x</span>
                </li>
            <?php $i++; endforeach; ?>
        </ul>
        <div class="ifb-customise-values-wrap"><label for="customise_values_<?php echo $id; ?>"><input id="customise_values_<?php echo $id; ?>" name="customise_values_<?php echo $id; ?>" type="checkbox" onclick="vowelsforminc.toggleCustomiseValues(this.checked, vowelsforminc.getElementById(<?php echo $id; ?>));" <?php echo checked($element['customise_values'], true); ?> /> <?php esc_html_e('Customize values','vowels-contact-form-with-drag-and-drop'); ?></label></div>
        <?php include VOWELSFORMDRAGDROP_ADMIN_INCLUDES_DIR . '/elements/settings/options-bulk.php'; ?>
    </td>
</tr>
