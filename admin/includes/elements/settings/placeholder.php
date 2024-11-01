<?php if (!defined('VOWELSFORMDRAGDROP_VERSION')) exit; ?><tr valign="top">
    <th scope="row">
        <div class="ifb-tooltip"><div class="ifb-tooltip-content">
            <?php esc_html_e('The placeholder text will appear inside the field until the user starts to type.','vowels-contact-form-with-drag-and-drop'); ?>
        </div></div>
        <label for="placeholder_<?php echo $id; ?>"><?php esc_html_e('Placeholder','vowels-contact-form-with-drag-and-drop'); ?></label>
    </th>
    <td>
        <input type="text" id="placeholder_<?php echo $id; ?>" name="placeholder_<?php echo $id; ?>" value="<?php echo vowels_form_builder_escape($element['placeholder']); ?>" onkeyup="vowelsforminc.updatePlaceholder(vowelsforminc.getElementById(<?php echo $id; ?>));" onblur="vowelsforminc.updatePlaceholder(vowelsforminc.getElementById(<?php echo $id; ?>));" />
    </td>
</tr>