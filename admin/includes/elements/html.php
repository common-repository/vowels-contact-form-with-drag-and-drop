<?php
if (!defined('VOWELSFORMDRAGDROP_VERSION')) exit;
$id = absint($element['id']);
$helpUrl = vowels_form_builder_help_link('element-hidden');
?>
<div id="ifb-element-wrap-<?php echo $id; ?>" class="ifb-element-wrap ifb-element-wrap-html">
	<div class="ifb-top-element-wrap qfb-cf">
        <?php include VOWELSFORMDRAGDROP_ADMIN_INCLUDES_DIR . '/elements/_actions.php'; ?>
        <div class="ifb-element-preview ifb-element-preview-html">
            <?php esc_html_e('This block of HTML is only visible when viewing or previewing the form.','vowels-contact-form-with-drag-and-drop'); ?>
            <span class="ifb-handle"></span>
        </div>
    </div>
    <div class="ifb-element-settings ifb-element-settings-html">
        <div class="ifb-element-settings-tabs" id="ifb-element-settings-tabs-<?php echo $id; ?>">
            <ul class="ifb-tabs-nav">
                <li><a href="#ifb-element-settings-tab-settings-<?php echo $id; ?>"><?php esc_html_e('Settings','vowels-contact-form-with-drag-and-drop'); ?></a></li>
            </ul>
            <div class="ifb-tabs-panel" id="ifb-element-settings-tab-settings-<?php echo $id; ?>">
                <div class="ifb-element-settings-inner">
                    <table class="ifb-form-table ifb-element-settings-form-table ifb-element-settings-settings-form-table">
                        <?php if (!isset($element['content'])) $element['content'] = ''; ?>
                        <tr valign="top">
                            <th scope="row"><label for="content_<?php echo $id; ?>"><?php esc_html_e('HTML','vowels-contact-form-with-drag-and-drop'); ?></label></th>
                            <td><textarea id="content_<?php echo $id; ?>" name="content_<?php echo $id; ?>"><?php echo _wp_specialchars($element['content'], ENT_NOQUOTES, false, true); ?></textarea></td>
                        </tr>
                        <?php if (!isset($element['enable_wrapper'])) $element['enable_wrapper'] = false; ?>
                        <tr valign="top">
                            <th scope="row">
                                <label for="enable_wrapper_<?php echo $id; ?>"><?php esc_html_e('Enable element wrapper','vowels-contact-form-with-drag-and-drop'); ?></label>
                            </th>
                            <td>
                                <input type="checkbox" id="enable_wrapper_<?php echo $id; ?>" name="enable_wrapper_<?php echo $id; ?>" <?php checked($element['enable_wrapper'], true); ?> />
                                <p class="description"><?php esc_html_e("Allows this block of HTML to behave like an normal form element - it will
                                    allow conditional logic to be applied to it and if it's inside a group it will behave like other elements.", 'vowels-contact-form-with-drag-and-drop'); ?></p>
                            </td>
                        </tr>
                        <?php if (!isset($element['show_in_entry'])) $element['show_in_entry'] = false; ?>
                        <tr valign="top">
                            <th scope="row">
                                <label for="show_in_entry_<?php echo $id; ?>"><?php esc_html_e('Show in entry','vowels-contact-form-with-drag-and-drop'); ?></label>
                            </th>
                            <td>
                                <input type="checkbox" id="show_in_entry_<?php echo $id; ?>" name="show_in_entry_<?php echo $id; ?>" <?php checked($element['show_in_entry'], true); ?> />
                                <p class="description"><?php esc_html_e('Show the HTML when viewing the form entry.','vowels-contact-form-with-drag-and-drop'); ?></p>
                            </td>
                        </tr>
                        <?php include 'settings/conditional-logic.php'; ?>
                        <?php include '_save.php'; ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>