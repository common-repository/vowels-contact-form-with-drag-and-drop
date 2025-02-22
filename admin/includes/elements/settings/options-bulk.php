<?php if (!defined('VOWELSFORMDRAGDROP_VERSION')) exit; ?><div class="ifb-button ifb-add-bulk-options-button" onclick="vowelsforminc.showBulkOptions(vowelsforminc.getElementById(<?php echo $id; ?>));"><?php esc_html_e('Add bulk options','vowels-contact-form-with-drag-and-drop'); ?></div>
<div id="ifb-bulk-options-<?php echo $id; ?>" class="ifb-bulk-options qfb-cf">
    <p class="ifb-bulk-options-instructions"><?php esc_html_e('Click a category on the left hand side to insert predefined options. You can edit the options on the right hand side or enter your own options, one per line.','vowels-contact-form-with-drag-and-drop'); ?></p>
    <div class="qfb-cf bulk-options-wrap">
        <div class="ifb-bulk-options-right">
            <textarea id="bulk_options_textarea_<?php echo $id; ?>"></textarea>
        </div>
        <div class="ifb-bulk-options-left">
            <ul>
                <li><div onclick="vowelsforminc.loadBulkExistingOptions(vowelsforminc.getElementById(<?php echo $id; ?>));" class="ifb-button ifb-add-bulk-option-button"><?php esc_html_e('Existing Options','vowels-contact-form-with-drag-and-drop'); ?></div></li>
                <?php
                $bulkOptions = array_keys(vowels_form_builder_get_bulk_options());
                foreach ($bulkOptions as $key) : ?>
                    <li><div onclick="vowelsforminc.loadBulkOptions('<?php echo esc_js($key); ?>', vowelsforminc.getElementById(<?php echo $id; ?>));" class="ifb-button ifb-add-bulk-option-button"><?php echo esc_html($key); ?></div></li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
    <div class="ifb-bulk-options-clear qfb-cf">
    	<div class="ifb-bulk-options-clear-inner">
            <label for="bulk_options_clear_<?php echo $id; ?>"><input type="checkbox" name="bulk_options_clear_<?php echo $id; ?>" id="bulk_options_clear_<?php echo $id; ?>" /> <?php esc_html_e('Overwrite existing options','vowels-contact-form-with-drag-and-drop'); ?></label>
            <div class="ifb-tooltip"><div class="ifb-tooltip-content">
                <?php esc_html_e('Removes any existing options before adding','vowels-contact-form-with-drag-and-drop'); ?>
            </div></div>
        </div>
    </div>
    <div class="ifb-bulk-options-buttons-wrap qfb-cf">
        <div onclick="vowelsforminc.insertBulkOptions(vowelsforminc.getElementById(<?php echo $id; ?>));" class="ifb-button-blue"><?php esc_html_e('Add options','vowels-contact-form-with-drag-and-drop'); ?></div>
        <div onclick="tb_remove();" class="ifb-button-grey"><?php esc_html_e('Cancel','vowels-contact-form-with-drag-and-drop'); ?></div>
    </div>
</div>