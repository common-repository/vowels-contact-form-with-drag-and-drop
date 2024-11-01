<?php
if (!defined('VOWELSFORMDRAGDROP_VERSION')) exit;
if (!isset($element['required_message'])) $element['required_message'] = '';
$requiredValidator = new vowelsforminc_Validator_Required();
?>
<tr valign="top">
    <th scope="row"><label for="required_message_<?php echo $id; ?>"><?php esc_html_e('Error message if required','vowels-contact-form-with-drag-and-drop'); ?></label></th>
    <td>
        <input type="text" id="required_message_<?php echo $id; ?>" name="required_message_<?php echo $id; ?>" value="<?php echo esc_attr($element['required_message']); ?>" />
        <p class="description"><?php printf(esc_html__('Translate or override the error message shown under the field
        when the element is required. The default is "%s".', 'vowels-contact-form-with-drag-and-drop'), '<span class="ifb-bold">' . $requiredValidator->getMessageTemplate('required') . '</span>'); ?></p>
    </td>
</tr>