<?php if (!defined('VOWELSFORMDRAGDROP_VERSION')) exit; ?><tr class="ifb-save-element-tr" valign="top">
    <td colspan="2">
        <div class="ifb-save-element-wrap qfb-cf">
            <?php if (isset($helpUrl)) : ?>
                <a class="ifb-help-element" href="<?php echo esc_attr($helpUrl); ?>"><?php esc_html_e('Help','vowels-contact-form-with-drag-and-drop'); ?></a>
            <?php endif; ?>
            <a class="ifb-save-element" onclick="vowelsforminc.saveElementSettings(this, '<?php echo wp_create_nonce('vowels_form_builder_save_form'); ?>'); return false;"><?php esc_html_e('Save','vowels-contact-form-with-drag-and-drop'); ?></a>
            <a class="ifb-close-element" onclick="vowelsforminc.hideSettings(<?php echo $id; ?>); return false;"><?php esc_html_e('Hide','vowels-contact-form-with-drag-and-drop'); ?></a>
            <a class="ifb-save-close-element" onclick="vowelsforminc.saveAndCloseElementSettings('<?php echo wp_create_nonce('vowels_form_builder_save_form'); ?>', <?php echo $id; ?>); return false;"><?php esc_html_e('Save & Hide','vowels-contact-form-with-drag-and-drop'); ?></a>
        </div>
    </td>
</tr>