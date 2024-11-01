<?php
if (!defined('VOWELSFORMDRAGDROP_VERSION')) exit;
$id = absint($element['id']);

if (!isset($element['label'])) $element['label'] = __('Click to Edit','vowels-contact-form-with-drag-and-drop');
if (!isset($element['default_value'])) $element['default_value'] = '';
$helpUrl = vowels_form_builder_help_link('element-hidden');
?>
<div id="ifb-element-wrap-<?php echo $id; ?>" class="ifb-element-wrap ifb-element-wrap-hidden <?php echo "ifb-label-placement-{$form['label_placement']}"; ?>">
	<div class="ifb-top-element-wrap qfb-cf">
        <?php include VOWELSFORMDRAGDROP_ADMIN_INCLUDES_DIR . '/elements/_actions.php'; ?>
        <div class="ifb-element-preview ifb-element-preview-hidden">
            <label class="ifb-preview-label <?php if (!strlen($element['label'])) echo 'ifb-hidden'; ?>" for="ifb_element_<?php echo $id; ?>"><?php echo $element['label']; ?><span class="ifb-hidden-preview"><?php esc_html_e('(hidden)','vowels-contact-form-with-drag-and-drop'); ?></span></label>
            <div class="ifb-preview-input">
                <input type="text" name="ifb_element_<?php echo $id; ?>" id="ifb_element_<?php echo $id; ?>" class="preview_form" value="<?php echo esc_attr($element['default_value']); ?>" disabled="disabled" />
            </div>
            <span class="ifb-handle"></span>
        </div>
    </div>
    <div class="ifb-element-settings ifb-element-settings-hidden">
        <div class="ifb-element-settings-tabs" id="ifb-element-settings-tabs-<?php echo $id; ?>">
            <ul class="ifb-tabs-nav">
                <li><a href="#ifb-element-settings-tab-settings-<?php echo $id; ?>"><?php esc_html_e('Settings','vowels-contact-form-with-drag-and-drop'); ?></a></li>
            </ul>
            <div class="ifb-tabs-panel" id="ifb-element-settings-tab-settings-<?php echo $id; ?>">
                <div class="ifb-element-settings-inner">
                    <table class="ifb-form-table ifb-element-settings-form-table ifb-element-settings-settings-form-table">
                        <tr valign="top">
                            <th scope="row">
                                <div class="ifb-tooltip"><div class="ifb-tooltip-content">
                                    <?php esc_html_e('This label will be shown throughout the form builder, in the notification email and when viewing submitted form entries.','vowels-contact-form-with-drag-and-drop'); ?>
                                </div></div>
                                <label for="label_<?php echo $id; ?>"><?php esc_html_e('Label','vowels-contact-form-with-drag-and-drop'); ?></label>
                            </th>
                            <td><input type="text" id="label_<?php echo $id; ?>" name="label_<?php echo $id; ?>" value="<?php echo esc_attr($element['label']); ?>" onkeyup="vowelsforminc.updateHiddenPreviewLabel(this, vowelsforminc.getElementById(<?php echo $id; ?>));" /></td>
                        </tr>
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
                        <?php include 'settings/hide-from-email.php'; ?>
                        <?php include 'settings/save-to-database.php'; ?>
                        <?php include 'settings/dynamic-default-value.php'; ?>
                        <?php include 'settings/unique-id.php'; ?>
                        <?php include '_save.php'; ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>