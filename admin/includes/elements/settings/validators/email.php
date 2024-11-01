<?php if (!defined('VOWELSFORMDRAGDROP_VERSION')) exit; ?><div id="ifb-validator-wrap-<?php echo $validator['element_id']; ?>-<?php echo $validator['id']; ?>" class="ifb-validator ifb-validator-email">
    <div class="ifb-validator-actions">
        <a class="ifb-validator-close-link" title="<?php esc_attr_e('Hide validator settings','vowels-contact-form-with-drag-and-drop'); ?>" href="#" onclick="vowelsforminc.hideValidatorSettings(<?php echo $validator['element_id']; ?>, <?php echo $validator['id']; ?>); return false;"><span></span><?php esc_html_e('Hide','vowels-contact-form-with-drag-and-drop'); ?></a>
        <a class="ifb-validator-settings-link" title="<?php esc_attr_e('Settings','vowels-contact-form-with-drag-and-drop'); ?>" href="#" onclick="vowelsforminc.showValidatorSettings(<?php echo $validator['element_id']; ?>, <?php echo $validator['id']; ?>); return false;"><span></span><?php esc_html_e('Settings','vowels-contact-form-with-drag-and-drop'); ?></a>
        <a class="ifb-validator-delete-link" title="<?php esc_attr_e('Delete this validator','vowels-contact-form-with-drag-and-drop'); ?>" href="#" onclick="vowelsforminc.deleteValidator(vowelsforminc.getElementById(<?php echo $validator['element_id']; ?>), <?php echo $validator['id']; ?>); return false;"><?php esc_html_e('Delete','vowels-contact-form-with-drag-and-drop'); ?></a>
    </div>
    <?php if (!isset($validator['name'])) $validator['name'] = _x('Email Address', 'the name of the email address validator','vowels-contact-form-with-drag-and-drop'); ?>
    <div class="ifb-validator-title"><?php echo esc_html($validator['name']); ?></div>
    <div class="ifb-validator-settings">
        <h3><?php esc_html_e('Translate error message','vowels-contact-form-with-drag-and-drop'); ?></h3>
        <table class="ifb-form-table ifb-validator-settings-form-table">
            <?php
                $emailValidator = new vowelsforminc_Validator_Email();
                if (!isset($validator['messages']['invalid'])) $validator['messages']['invalid'] = '';
            ?>
            <tr valign="top">
                <th><?php esc_html_e('Default','vowels-contact-form-with-drag-and-drop'); ?></th>
                <th><?php esc_html_e('Translation','vowels-contact-form-with-drag-and-drop'); ?></th>
            </tr>
            <tr valign="top">
                <th scope="row"><label for="v_invalid_<?php echo $validator['element_id']; ?>_<?php echo $validator['id']; ?>"><?php echo esc_html($emailValidator->getMessageTemplate('invalid')); ?></label></th>
                <td><input type="text" id="v_invalid_<?php echo $validator['element_id']; ?>_<?php echo $validator['id']; ?>" name="v_invalid_<?php echo $validator['element_id']; ?>_<?php echo $validator['id']; ?>" value="<?php echo esc_attr($validator['messages']['invalid']); ?>" /></td>
            </tr>
        </table>
    </div>
</div>