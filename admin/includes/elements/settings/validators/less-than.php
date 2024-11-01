<?php if (!defined('VOWELSFORMDRAGDROP_VERSION')) exit; ?><div id="ifb-validator-wrap-<?php echo $validator['element_id']; ?>-<?php echo $validator['id']; ?>" class="ifb-validator ifb-validator-lessthan">
    <div class="ifb-validator-actions">
        <a class="ifb-validator-close-link" title="<?php esc_attr_e('Hide validator settings','vowels-contact-form-with-drag-and-drop'); ?>" href="#" onclick="vowelsforminc.hideValidatorSettings(<?php echo $validator['element_id']; ?>, <?php echo $validator['id']; ?>); return false;"><span></span><?php esc_html_e('Hide','vowels-contact-form-with-drag-and-drop'); ?></a>
        <a class="ifb-validator-settings-link" title="<?php esc_attr_e('Settings','vowels-contact-form-with-drag-and-drop'); ?>" href="#" onclick="vowelsforminc.showValidatorSettings(<?php echo $validator['element_id']; ?>, <?php echo $validator['id']; ?>); return false;"><span></span><?php esc_html_e('Settings','vowels-contact-form-with-drag-and-drop'); ?></a>
        <a class="ifb-validator-delete-link" title="<?php esc_attr_e('Delete this validator','vowels-contact-form-with-drag-and-drop'); ?>" href="#" onclick="vowelsforminc.deleteValidator(vowelsforminc.getElementById(<?php echo $validator['element_id']; ?>), <?php echo $validator['id']; ?>); return false;"><?php esc_html_e('Delete','vowels-contact-form-with-drag-and-drop'); ?></a>
    </div>
    <?php if (!isset($validator['name'])) $validator['name'] = _x('Less Than', 'the name of the less than validator which validates that the value is less than a number','vowels-contact-form-with-drag-and-drop'); ?>
    <div class="ifb-validator-title"><?php echo esc_html($validator['name']); ?></div>
    <div class="ifb-validator-settings">
        <h3><?php esc_html_e('Settings','vowels-contact-form-with-drag-and-drop'); ?></h3>
        <table class="ifb-form-table ifb-validator-settings-form-table">
            <?php if (!isset($validator['max'])) $validator['max'] = 10; ?>
            <tr valign="top">
                <th scope="row">
                    <div class="ifb-tooltip">
                        <div class="ifb-tooltip-content">
                            <?php esc_html_e('The submitted value must be numerically less than this value, or the error message shown below will be displayed to the user','vowels-contact-form-with-drag-and-drop'); ?>
                        </div>
                    </div>
                    <label for="v_max_<?php echo $validator['element_id']; ?>_<?php echo $validator['id']; ?>"><?php esc_html_e('Maximum','vowels-contact-form-with-drag-and-drop'); ?></label>
                </th>
                <td><input type="text" id="v_max_<?php echo $validator['element_id']; ?>_<?php echo $validator['id']; ?>" name="v_max_<?php echo $validator['element_id']; ?>_<?php echo $validator['id']; ?>" value="<?php echo esc_attr($validator['max']); ?>" /></td>
            </tr>
        </table>
        <h3><?php esc_html_e('Translate error message','vowels-contact-form-with-drag-and-drop'); ?></h3>
        <table class="ifb-form-table ifb-validator-settings-form-table">
            <?php
                $lessThanValidator = new vowelsforminc_Validator_LessThan(array('max' => 1));
                if (!isset($validator['messages']['not_less_than'])) $validator['messages']['not_less_than'] = '';
            ?>
            <tr valign="top">
                <th><?php esc_html_e('Default','vowels-contact-form-with-drag-and-drop'); ?></th>
                <th><?php esc_html_e('Translation','vowels-contact-form-with-drag-and-drop'); ?></th>
            </tr>
            <tr valign="top">
                <th scope="row">
                    <div class="ifb-tooltip">
                        <div class="ifb-tooltip-content">
                            <div class="ifb-tooltip-title"><?php esc_html_e('Placeholders','vowels-contact-form-with-drag-and-drop'); ?></div>
                            <code>%1$s = <?php esc_html_e('the submitted value','vowels-contact-form-with-drag-and-drop'); ?></code><br />
                            <code>%2$s = <?php esc_html_e('the maximum allowed value','vowels-contact-form-with-drag-and-drop'); ?></code><br />
                            <?php esc_html_e('You can enter the placeholder code in your custom message to display their values.','vowels-contact-form-with-drag-and-drop'); ?>
                        </div>
                    </div>
                    <label for="v_not_less_than_<?php echo $validator['element_id']; ?>_<?php echo $validator['id']; ?>"><?php echo esc_html($lessThanValidator->getMessageTemplate('not_less_than')); ?></label></th>
                <td><input type="text" id="v_not_less_than_<?php echo $validator['element_id']; ?>_<?php echo $validator['id']; ?>" name="v_not_less_than_<?php echo $validator['element_id']; ?>_<?php echo $validator['id']; ?>" value="<?php echo esc_attr($validator['messages']['not_less_than']); ?>" /></td>
            </tr>
        </table>
    </div>
</div>