<?php if (!defined('VOWELSFORMDRAGDROP_VERSION')) exit; ?>
<tr valign="top">
    <th scope="row">
        <div class="ifb-tooltip"><div class="ifb-tooltip-content">
            <?php esc_html_e('The default value is the value that the element is given before
            the user has entered anything','vowels-contact-form-with-drag-and-drop'); ?>
        </div></div>
        <label for="default_value_<?php echo $id; ?>"><?php esc_html_e('Default value','vowels-contact-form-with-drag-and-drop'); ?></label>
    </th>
    <td>
        <input type="text" id="default_value_<?php echo $id; ?>" name="default_value_<?php echo $id; ?>" value="<?php echo esc_attr($element['default_value']); ?>"
          onfocus="vowelsforminc.updateDefaultValue(this, vowelsforminc.getElementById(<?php echo $id; ?>));"
          onblur="vowelsforminc.updateDefaultValue(this, vowelsforminc.getElementById(<?php echo $id; ?>));"
          onkeyup="vowelsforminc.updateDefaultValue(this, vowelsforminc.getElementById(<?php echo $id; ?>));"
        />
        <?php include VOWELSFORMDRAGDROP_ADMIN_INCLUDES_DIR . '/elements/settings/_insert-variable-preprocess.php'; ?>
    </td>
</tr>
<?php include VOWELSFORMDRAGDROP_ADMIN_INCLUDES_DIR . '/elements/settings/clear-default-value.php'; ?>