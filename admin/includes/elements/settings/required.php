<?php if (!defined('VOWELSFORMDRAGDROP_VERSION')) exit; ?><tr valign="top">
    <th scope="row">
        <div class="ifb-tooltip"><div class="ifb-tooltip-content">
            <?php esc_html_e('If checked, the user must fill out this field','vowels-contact-form-with-drag-and-drop'); ?>
        </div></div>
        <label for="required_<?php echo $id; ?>"><?php esc_html_e('Required','vowels-contact-form-with-drag-and-drop'); ?></label>
    </th>
    <td><input type="checkbox" id="required_<?php echo $id; ?>" name="required_<?php echo $id; ?>" <?php checked($element['required'], true); ?> onclick="vowelsforminc.toggleElementRequired(vowelsforminc.getElementById(<?php echo $id; ?>), this.checked);" /></td>
</tr>