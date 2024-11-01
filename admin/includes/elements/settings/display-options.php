<?php
if (!defined('VOWELSFORMDRAGDROP_VERSION')) exit;
if (!isset($element['options_layout'])) $element['options_layout'] = 'block';
?>
<tr valign="top">
    <th scope="row">
        <div class="ifb-tooltip"><div class="ifb-tooltip-content">
            <?php esc_html_e('You can have your options all on the same line or have one option
            per line using this setting.','vowels-contact-form-with-drag-and-drop'); ?>
        </div></div>
        <label for="options_layout_<?php echo $id; ?>"><?php esc_html_e('Options layout','vowels-contact-form-with-drag-and-drop'); ?></label>
    </th>
    <td>
        <select name="options_layout_<?php echo $id; ?>" id="options_layout_<?php echo $id; ?>" onchange="vowelsforminc.updateOptionsLayout(vowelsforminc.getElementById(<?php echo $id; ?>)); ">
            <option value="block" <?php selected($element['options_layout'], 'block'); ?>><?php esc_html_e('One option per line','vowels-contact-form-with-drag-and-drop'); ?></option>
            <option value="inline" <?php selected($element['options_layout'], 'inline'); ?>><?php esc_html_e('Inline','vowels-contact-form-with-drag-and-drop'); ?></option>
        </select>
    </td>
</tr>