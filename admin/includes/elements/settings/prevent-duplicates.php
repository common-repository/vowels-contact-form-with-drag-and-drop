<?php
if (!defined('VOWELSFORMDRAGDROP_VERSION')) exit;
if (!isset($element['prevent_duplicates'])) $element['prevent_duplicates'] = false;
?>
<tr valign="top">
    <th scope="row">
        <div class="ifb-tooltip"><div class="ifb-tooltip-content">
            <?php esc_html_e('Prevents the form being submitted if a form has previously been submitted with the same value','vowels-contact-form-with-drag-and-drop'); ?>
        </div></div>
        <label for="prevent_duplicates_<?php echo $id; ?>"><?php esc_html_e('Prevent duplicates','vowels-contact-form-with-drag-and-drop'); ?></label>
    </th>
    <td>
        <input type="checkbox" id="prevent_duplicates_<?php echo $id; ?>" name="prevent_duplicates_<?php echo $id; ?>" <?php checked(true, $element['prevent_duplicates']); ?> onclick="vowelsforminc.togglePreventDuplicates(vowelsforminc.getElementById(<?php echo $id; ?>));" />
    </td>
</tr>
<?php if (!isset($element['duplicate_found_message'])) $element['duplicate_found_message'] = ''; ?>
<tr valign="top" class="ifb-show-if-prevent-duplicates <?php if (!$element['prevent_duplicates']) echo 'ifb-hidden'; ?>">
    <th scope="row">
        <label for="duplicate_found_message_<?php echo $id; ?>"><?php esc_html_e('Error message if duplicate found','vowels-contact-form-with-drag-and-drop'); ?></label>
    </th>
    <td>
        <input type="text" id="duplicate_found_message_<?php echo $id; ?>" name="duplicate_found_message_<?php echo $id; ?>" value="<?php echo esc_attr($element['duplicate_found_message']); ?>" />
        <p class="description"><?php
            $duplicateValidator = new vowelsforminc_Validator_Duplicate(array('element' => new vowelsforminc_Element_Text(array('name' => 'temp'))));
            printf(esc_html__('Translate or override the error message shown under a field when a
            duplicate value is found. The default is "%s".', 'vowels-contact-form-with-drag-and-drop'), '<span class="ifb-bold">' . $duplicateValidator->getMessageTemplate('duplicate') . '</span>'); ?></p>
    </td>
</tr>