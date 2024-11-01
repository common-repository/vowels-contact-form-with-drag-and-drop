<?php if (!defined('VOWELSFORMDRAGDROP_VERSION')) exit; ?><tr class="ifb-element-description-tr" valign="top">
    <th scope="row"><label for="description_<?php echo $id; ?>"><?php esc_html_e('Description','vowels-contact-form-with-drag-and-drop'); ?></label></th>
    <td><textarea id="description_<?php echo $id; ?>" name="description_<?php echo $id; ?>" onkeyup="vowelsforminc.updatePreviewDescription(vowelsforminc.getElementById(<?php echo $id; ?>));"><?php echo _wp_specialchars($element['description'], ENT_NOQUOTES, false, true); ?></textarea></td>
</tr>