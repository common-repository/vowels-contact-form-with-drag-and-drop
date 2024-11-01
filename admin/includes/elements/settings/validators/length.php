<?php if (!defined('VOWELSFORMDRAGDROP_VERSION')) exit; ?><div id="ifb-validator-wrap-<?php echo $validator['element_id']; ?>-<?php echo $validator['id']; ?>" class="ifb-validator ifb-validator-length">
    <div class="ifb-validator-actions">
        <a class="ifb-validator-close-link" title="<?php esc_attr_e('Hide validator settings','vowels-contact-form-with-drag-and-drop'); ?>" href="#" onclick="vowelsforminc.hideValidatorSettings(<?php echo $validator['element_id']; ?>, <?php echo $validator['id']; ?>); return false;"><span></span><?php esc_html_e('Hide','vowels-contact-form-with-drag-and-drop'); ?></a>
        <a class="ifb-validator-settings-link" title="<?php esc_attr_e('Settings','vowels-contact-form-with-drag-and-drop'); ?>" href="#" onclick="vowelsforminc.showValidatorSettings(<?php echo $validator['element_id']; ?>, <?php echo $validator['id']; ?>); return false;"><span></span><?php esc_html_e('Settings','vowels-contact-form-with-drag-and-drop'); ?></a>
        <a class="ifb-validator-delete-link" title="<?php esc_attr_e('Delete this validator','vowels-contact-form-with-drag-and-drop'); ?>" href="#" onclick="vowelsforminc.deleteValidator(vowelsforminc.getElementById(<?php echo $validator['element_id']; ?>), <?php echo $validator['id']; ?>); return false;"><?php esc_html_e('Delete','vowels-contact-form-with-drag-and-drop'); ?></a>
    </div>
    <?php if (!isset($validator['name'])) $validator['name'] = _x('Length', 'the name of the length validator which validates that the value is of a certain length','vowels-contact-form-with-drag-and-drop'); ?>
    <div class="ifb-validator-title"><?php echo esc_html($validator['name']); ?></div>
    <div class="ifb-validator-settings">
        <h3><?php esc_html_e('Settings','vowels-contact-form-with-drag-and-drop'); ?></h3>
        <table class="ifb-form-table ifb-validator-settings-form-table">
            <?php if (!isset($validator['min'])) $validator['min'] = 0; ?>
            <tr valign="top">
                <th scope="row">
                    <div class="ifb-tooltip">
                        <div class="ifb-tooltip-content">
                            <?php esc_html_e('The length of the submitted value must be greater than or equal to the minimum, if not the error message shown below will be displayed to the user','vowels-contact-form-with-drag-and-drop'); ?>
                        </div>
                    </div>
                    <label for="v_min_<?php echo $validator['element_id']; ?>_<?php echo $validator['id']; ?>"><?php esc_html_e('Minimum length','vowels-contact-form-with-drag-and-drop'); ?></label>
                </th>
                <td><input type="text" id="v_min_<?php echo $validator['element_id']; ?>_<?php echo $validator['id']; ?>" name="v_min_<?php echo $validator['element_id']; ?>_<?php echo $validator['id']; ?>" value="<?php echo esc_attr($validator['min']); ?>" /></td>
            </tr>
            <?php if (!isset($validator['max'])) $validator['max'] = ''; ?>
            <tr valign="top">
                <th scope="row">
                    <div class="ifb-tooltip">
                        <div class="ifb-tooltip-content">
                            <?php esc_html_e('The length of the submitted value must be less than or equal to the maximum, if not the error message shown below will be displayed to the user','vowels-contact-form-with-drag-and-drop'); ?>
                        </div>
                    </div>
                    <label for="v_max_<?php echo $validator['element_id']; ?>_<?php echo $validator['id']; ?>"><?php esc_html_e('Maximum length','vowels-contact-form-with-drag-and-drop'); ?></label>
                </th>
                <td><input type="text" id="v_max_<?php echo $validator['element_id']; ?>_<?php echo $validator['id']; ?>" name="v_max_<?php echo $validator['element_id']; ?>_<?php echo $validator['id']; ?>" value="<?php echo esc_attr($validator['max']); ?>" /></td>
            </tr>
        </table>
        <h3><?php esc_html_e('Translate error messages','vowels-contact-form-with-drag-and-drop'); ?></h3>
        <table class="ifb-form-table ifb-validator-settings-form-table">
            <?php
                $lengthValidator = new vowelsforminc_Validator_Length();
                if (!isset($validator['messages']['too_short'])) $validator['messages']['too_short'] = '';
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
                            <code>%2$s = <?php esc_html_e('the minumum allowed length','vowels-contact-form-with-drag-and-drop'); ?></code><br />
                            <code>%3$s = <?php esc_html_e('the length of the submitted value','vowels-contact-form-with-drag-and-drop'); ?></code><br />
                            <?php esc_html_e('You can enter the placeholder code in your custom message to display their values.','vowels-contact-form-with-drag-and-drop'); ?>
                        </div>
                    </div>
                    <label for="v_too_short_<?php echo $validator['element_id']; ?>_<?php echo $validator['id']; ?>"><?php echo esc_html($lengthValidator->getMessageTemplate('too_short')); ?></label></th>
                <td><input type="text" id="v_too_short_<?php echo $validator['element_id']; ?>_<?php echo $validator['id']; ?>" name="v_too_short_<?php echo $validator['element_id']; ?>_<?php echo $validator['id']; ?>" value="<?php echo esc_attr($validator['messages']['too_short']); ?>" /></td>
            </tr>
            <?php if (!isset($validator['messages']['too_long'])) $validator['messages']['too_long'] = ''; ?>
            <tr valign="top">
                <th scope="row">
                    <div class="ifb-tooltip">
                        <div class="ifb-tooltip-content">
                            <div class="ifb-tooltip-title"><?php esc_html_e('Placeholders','vowels-contact-form-with-drag-and-drop'); ?></div>
                            <code>%1$s = <?php esc_html_e('the submitted value','vowels-contact-form-with-drag-and-drop'); ?></code><br />
                            <code>%2$s = <?php esc_html_e('the maximum allowed length','vowels-contact-form-with-drag-and-drop'); ?></code><br />
                            <code>%3$s = <?php esc_html_e('the length of the submitted value','vowels-contact-form-with-drag-and-drop'); ?></code><br />
                            <?php esc_html_e('You can enter the placeholder code in your custom message to display their values.','vowels-contact-form-with-drag-and-drop'); ?>
                        </div>
                    </div>
                    <label for="v_too_long_<?php echo $validator['element_id']; ?>_<?php echo $validator['id']; ?>"><?php echo esc_attr($lengthValidator->getMessageTemplate('too_long')); ?></label></th>
                <td><input type="text" id="v_too_long_<?php echo $validator['element_id']; ?>_<?php echo $validator['id']; ?>" name="v_too_long_<?php echo $validator['element_id']; ?>_<?php echo $validator['id']; ?>" value="<?php echo esc_attr($validator['messages']['too_long']); ?>" /></td>
            </tr>
        </table>
    </div>
</div>