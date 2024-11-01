<?php
if (!defined('VOWELSFORMDRAGDROP_VERSION')) exit;
if (!isset($element['clear_default_value'])) $element['clear_default_value'] = false;
?>
<tr valign="top">
    <th scope="row"><label for="clear_default_value_<?php echo $id; ?>"><?php esc_html_e('Clear default value on focus','vowels-contact-form-with-drag-and-drop'); ?></label></th>
    <td>
        <input type="checkbox" id="clear_default_value_<?php echo $id; ?>" name="clear_default_value_<?php echo $id; ?>" <?php checked(true, $element['clear_default_value']); ?> onclick="vowelsforminc.toggleClearDefaultValue(vowelsforminc.getElementById(<?php echo $id; ?>));" />
        <p class="description"><?php esc_html_e('If checked, the default value will be removed when the user clicks on the field.','vowels-contact-form-with-drag-and-drop'); ?></p>
    </td>
</tr>
<?php if (!isset($element['reset_default_value'])) $element['reset_default_value'] = true; ?>
<tr valign="top" class="ifb-show-if-clear-default-value <?php if (!$element['clear_default_value']) echo 'ifb-hidden'; ?>">
    <th scope="row"><label for="reset_default_value_<?php echo $id; ?>"><?php esc_html_e('Show default value on blur if empty','vowels-contact-form-with-drag-and-drop'); ?></label></th>
    <td>
        <input type="checkbox" id="reset_default_value_<?php echo $id; ?>" name="reset_default_value_<?php echo $id; ?>" <?php checked(true, $element['reset_default_value']); ?> />
        <p class="description"><?php esc_html_e('If checked, when the user clicks off the field and leaves it empty, the default
         value will show again.','vowels-contact-form-with-drag-and-drop'); ?></p>
    </td>
</tr>