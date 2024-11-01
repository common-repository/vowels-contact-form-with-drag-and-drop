<?php
if (!defined('VOWELSFORMDRAGDROP_VERSION')) exit;
if (!isset($element['is_hidden'])) $element['is_hidden'] = false;
?>
<tr valign="top">
    <th scope="row">
        <div class="ifb-tooltip"><div class="ifb-tooltip-content">
            <?php esc_html_e('If checked, the submitted element data will not be shown in the default notification email','vowels-contact-form-with-drag-and-drop'); ?>
        </div></div>
        <label for="is_hidden_<?php echo $id; ?>"><?php esc_html_e('Do not show in the email','vowels-contact-form-with-drag-and-drop'); ?></label>
    </th>
    <td><input type="checkbox" id="is_hidden_<?php echo $id; ?>" name="is_hidden_<?php echo $id; ?>" <?php checked($element['is_hidden'], true); ?> /></td>
</tr>