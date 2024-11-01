<?php if (!defined('VOWELSFORMDRAGDROP_VERSION')) exit; ?><div id="ifb-style-wrap-<?php echo $style['element_id']; ?>-<?php echo $style['id']; ?>" class="ifb-style ifb-element-style">
    <div class="ifb-style-actions">
        <a class="ifb-style-close-link" title="<?php esc_attr_e('Hide CSS settings','vowels-contact-form-with-drag-and-drop'); ?>" href="#" onclick="vowelsforminc.hideStyleSettings(<?php echo $style['element_id']; ?>, <?php echo $style['id']; ?>); return false;"><span></span><?php esc_html_e('Hide','vowels-contact-form-with-drag-and-drop'); ?></a>
        <a class="ifb-style-settings-link" title="<?php esc_attr_e('Edit CSS','vowels-contact-form-with-drag-and-drop'); ?>" href="#" onclick="vowelsforminc.showStyleSettings(<?php echo $style['element_id']; ?>, <?php echo $style['id']; ?>); return false;"><span></span><?php esc_html_e('CSS','vowels-contact-form-with-drag-and-drop'); ?></a>
        <a class="ifb-style-delete-link" title="<?php esc_attr_e('Delete this style','vowels-contact-form-with-drag-and-drop'); ?>" href="#" onclick="vowelsforminc.deleteStyle(vowelsforminc.getElementById(<?php echo $style['element_id']; ?>), <?php echo $style['id']; ?>); return false;"><?php esc_html_e('Delete','vowels-contact-form-with-drag-and-drop'); ?></a>
    </div>
    <div class="ifb-style-title"><?php echo esc_html($style['name']); ?></div>
    <div class="ifb-style-settings">
        <table class="ifb-form-table ifb-style-settings-form-table">
            <?php if (!isset($style['css'])) $style['css'] = ''; ?>
            <tr valign="top">
                <th scope="row"><label for="s_css_<?php echo $style['element_id']; ?>_<?php echo $style['id']; ?>"><?php esc_html_e('CSS','vowels-contact-form-with-drag-and-drop'); ?></label></th>
                <td><textarea id="s_css_<?php echo $style['element_id']; ?>_<?php echo $style['id']; ?>" name="s_css_<?php echo $style['element_id']; ?>_<?php echo $style['id']; ?>"><?php echo esc_html($style['css']); ?></textarea></td>
            </tr>
        </table>
    </div>
</div>