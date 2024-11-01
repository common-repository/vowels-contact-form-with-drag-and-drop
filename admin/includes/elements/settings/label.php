<?php if (!defined('VOWELSFORMDRAGDROP_VERSION')) exit; ?><tr valign="top">
    <th scope="row"><label for="label_<?php echo $id; ?>"><?php esc_html_e('Label','vowels-contact-form-with-drag-and-drop'); ?></label></th>
    <td><input type="text" id="label_<?php echo $id; ?>" name="label_<?php echo $id; ?>" value="<?php echo _wp_specialchars($element['label'], ENT_COMPAT, false, true); ?>" onkeyup="vowelsforminc.updatePreviewLabel(vowelsforminc.getElementById(<?php echo $id; ?>));" onblur="vowelsforminc.updateElementLabel(vowelsforminc.getElementById(<?php echo $id; ?>));" /></td>
</tr>