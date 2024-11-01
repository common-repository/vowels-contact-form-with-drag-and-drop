<?php
if (!defined('VOWELSFORMDRAGDROP_VERSION')) exit;
$id = absint($element['id']);

if (!isset($element['label'])) $element['label'] = __('File upload','vowels-contact-form-with-drag-and-drop');
if (!isset($element['description'])) $element['description'] = __('Maximum size 10MB','vowels-contact-form-with-drag-and-drop');
if (!isset($element['required'])) $element['required'] = false;
$helpUrl = vowels_form_builder_help_link('element-file');
?>
<div id="ifb-element-wrap-<?php echo $id; ?>" class="ifb-element-wrap ifb-element-wrap-file <?php if (!$element['required']) echo 'ifb-element-optional'; ?> <?php echo "ifb-label-placement-{$form['label_placement']}"; ?>">
    <div class="ifb-top-element-wrap qfb-cf">
        <?php include VOWELSFORMDRAGDROP_ADMIN_INCLUDES_DIR . '/elements/_actions.php'; ?>
        <div class="ifb-element-preview ifb-element-preview-file">
            <label class="ifb-preview-label <?php if (!strlen($element['label'])) echo 'ifb-hidden'; ?>" for="ifb_element_<?php echo $id; ?>"><span class="ifb-preview-label-content"><?php echo $element['label']; ?></span><span class="ifb-required"><?php echo esc_html($form['required_text']); ?></span></label>
            <div class="ifb-preview-input">
                <input type="file" name="ifb_element_<?php echo $id; ?>" id="ifb_element_<?php echo $id; ?>" class="preview_form" disabled="disabled" />
                <p class="ifb-preview-description <?php if (!strlen($element['description'])) echo 'ifb-hidden'; ?>"><?php echo $element['description']; ?></p>
            </div>
            <span class="ifb-handle"></span>
        </div>
    </div>
    <div class="ifb-element-settings ifb-element-settings-file">
        <div class="ifb-element-settings-tabs" id="ifb-element-settings-tabs-<?php echo $id; ?>">
            <ul class="ifb-tabs-nav">
                <li><a href="#ifb-element-settings-tab-settings-<?php echo $id; ?>"><?php esc_html_e('Settings','vowels-contact-form-with-drag-and-drop'); ?></a></li>
                <li><a href="#ifb-element-settings-tab-more-<?php echo $id; ?>"><?php esc_html_e('Optional','vowels-contact-form-with-drag-and-drop'); ?></a></li>
                <li><a href="#ifb-element-settings-tab-advanced-<?php echo $id; ?>"><?php esc_html_e('Advanced','vowels-contact-form-with-drag-and-drop'); ?></a></li>
            </ul>
            <div class="ifb-tabs-panel" id="ifb-element-settings-tab-settings-<?php echo $id; ?>">
            	<div class="ifb-element-settings-inner">
                <table class="ifb-form-table ifb-element-settings-form-table ifb-element-settings-settings-form-table">
                    <?php include 'settings/label.php'; ?>
                    <?php include 'settings/description.php'; ?>
                    <?php include 'settings/required.php'; ?>
                    <?php include 'settings/tooltip.php'; ?>
                    <?php include '_save.php'; ?>
                </table>
                </div>
            </div>
            <div class="ifb-tabs-panel" id="ifb-element-settings-tab-more-<?php echo $id; ?>">
            	<div class="ifb-element-settings-inner">
                <table class="ifb-form-table ifb-element-settings-form-table ifb-element-settings-more-form-table">
                    <?php include 'settings/admin-label.php'; ?>
                    <?php include 'settings/hide-from-email.php'; ?>
                    <?php include 'settings/save-to-database.php'; ?>
                    <?php include 'settings/label-placement.php'; ?>
                    <?php if (!isset($element['enable_swf_upload'])) $element['enable_swf_upload'] = true; ?>
                    <tr valign="top">
                        <th scope="row"><label for="enable_swf_upload_<?php echo $id; ?>"><?php esc_html_e('Enable enhanced uploader','vowels-contact-form-with-drag-and-drop'); ?></label></th>
                        <td>
                            <input type="checkbox" id="enable_swf_upload_<?php echo $id; ?>" name="enable_swf_upload_<?php echo $id; ?>" <?php checked($element['enable_swf_upload'], true); ?> />
                            <p class="description"><?php esc_html_e('Enables the enhanced file uploader which shows the progress of file uploads, for modern browsers that support it.','vowels-contact-form-with-drag-and-drop'); ?></p>
                        </td>
                    </tr>
                    <?php if (!isset($element['allow_multiple_uploads'])) $element['allow_multiple_uploads'] = false; ?>
                    <tr valign="top">
                        <th scope="row"><label for="allow_multiple_uploads_<?php echo $id; ?>"><?php esc_html_e('Allow multiple file uploads','vowels-contact-form-with-drag-and-drop'); ?></label></th>
                        <td>
                            <input type="checkbox" id="allow_multiple_uploads_<?php echo $id; ?>" name="allow_multiple_uploads_<?php echo $id; ?>" <?php checked($element['allow_multiple_uploads'], true); ?> onclick="vowelsforminc.toggleAllowMultipleUploads(vowelsforminc.getElementById(<?php echo $id; ?>));" />
                            <p class="description"><?php esc_html_e('Enables you to show more than one upload field, so that the user can upload more files.','vowels-contact-form-with-drag-and-drop'); ?></p>
                        </td>
                    </tr>
                    <?php if (!isset($element['upload_num_fields'])) $element['upload_num_fields'] = 1; ?>
                    <tr valign="top" class="<?php if (!$element['allow_multiple_uploads']) echo 'ifb-hidden'; ?> show-if-allow-multiple-uploads">
                        <th scope="row">
                            <div class="ifb-tooltip"><div class="ifb-tooltip-content">
                                <?php esc_html_e('If you are using the enhanced uploader the user will only ever see one field, but they will be able to queue as many files as they want.','vowels-contact-form-with-drag-and-drop'); ?>
                            </div></div>
                            <label for="upload_num_fields_<?php echo $id; ?>"><?php esc_html_e('Number of file upload fields to show','vowels-contact-form-with-drag-and-drop'); ?></label></th>
                        <td><input class="ifb-small-input" type="text" id="upload_num_fields_<?php echo $id; ?>" name="upload_num_fields_<?php echo $id; ?>" value="<?php echo esc_attr($element['upload_num_fields']);?>" /></td>
                    </tr>
                    <?php if (!isset($element['upload_user_add_more'])) $element['upload_user_add_more'] = false; ?>
                    <tr valign="top" class="<?php if (!$element['allow_multiple_uploads']) echo 'ifb-hidden'; ?> show-if-allow-multiple-uploads">
                        <th scope="row">
                            <div class="ifb-tooltip"><div class="ifb-tooltip-content">
                                <?php esc_html_e('This will not appear if you are using the enhanced uploader, as the user can queue as many files as they want.','vowels-contact-form-with-drag-and-drop'); ?>
                            </div></div>
                            <label for="upload_user_add_more_<?php echo $id; ?>"><?php esc_html_e('Allow the user to add more upload fields','vowels-contact-form-with-drag-and-drop'); ?></label></th>
                        <td>
                            <input type="checkbox" id="upload_user_add_more_<?php echo $id; ?>" name="upload_user_add_more_<?php echo $id; ?>" <?php checked($element['upload_user_add_more'], true); ?> onclick="vowelsforminc.toggleAddAnotherUpload(vowelsforminc.getElementById(<?php echo $id; ?>));" />
                            <p class="description"><?php esc_html_e('If checked, a link appears allowing the user to add more upload fields if they want to upload more files','vowels-contact-form-with-drag-and-drop'); ?></p>
                        </td>
                    </tr>
                    <?php if (!isset($element['upload_add_another_text'])) $element['upload_add_another_text'] = ''; ?>
                    <tr valign="top" class="<?php if (!$element['allow_multiple_uploads'] || !$element['upload_user_add_more']) echo 'ifb-hidden'; ?> show-if-upload-user-add-more">
                        <th scope="row"><label for="upload_add_another_text_<?php echo $id; ?>"><?php esc_html_e('Add another upload link text','vowels-contact-form-with-drag-and-drop'); ?></label></th>
                        <td>
                            <input type="text" id="upload_add_another_text_<?php echo $id; ?>" name="upload_add_another_text_<?php echo $id; ?>" value="<?php echo esc_attr($element['upload_add_another_text']); ?>" />
                            <p class="description"><?php esc_html_e('Override the default text on the link to add other upload which is "Upload another"','vowels-contact-form-with-drag-and-drop'); ?></p>
                        </td>
                    </tr>
                    <?php if (!isset($element['upload_allowed_extensions'])) $element['upload_allowed_extensions'] = 'jpg, jpeg, png, gif'; ?>
                    <tr valign="top">
                        <th scope="row"><label for="upload_allowed_extensions_<?php echo $id; ?>"><?php esc_html_e('Allowed file extensions','vowels-contact-form-with-drag-and-drop'); ?></label></th>
                        <td>
                            <input type="text" id="upload_allowed_extensions_<?php echo $id; ?>" name="upload_allowed_extensions_<?php echo $id; ?>" value="<?php echo esc_attr($element['upload_allowed_extensions']); ?>" />
                            <p class="description"><?php esc_html_e('Enter the file extension excluding the dots and separated by commas e.g. jpg, jpeg, png, gif','vowels-contact-form-with-drag-and-drop'); ?></p>
                        </td>
                    </tr>
                    <?php if (!isset($element['upload_maximum_size'])) $element['upload_maximum_size'] = 10; ?>
                    <tr valign="top">
                        <th scope="row"><label for="upload_maximum_size_<?php echo $id; ?>"><?php esc_html_e('Maximum allowed file size','vowels-contact-form-with-drag-and-drop'); ?></label></th>
                        <td>
                            <input class="ifb-small-input" type="text" id="upload_maximum_size_<?php echo $id; ?>" name="upload_maximum_size_<?php echo $id; ?>" value="<?php echo esc_attr($element['upload_maximum_size']); ?>" /><?php esc_html_e('MB','vowels-contact-form-with-drag-and-drop'); ?>
                            <p class="description"><?php esc_html_e('Enter the maximum size of a file in MB.','vowels-contact-form-with-drag-and-drop'); ?> <a href="<?php echo vowels_form_builder_help_link('element-file#upload-maximum-size'); ?>" onclick="window.open(this.href); return false;"><?php esc_html_e('Important information','vowels-contact-form-with-drag-and-drop'); ?></a>.</p>
                        </td>
                    </tr>
                    <?php if (!isset($element['add_as_attachment'])) $element['add_as_attachment'] = false; ?>
                    <tr valign="top">
                        <th scope="row"><label for="add_as_attachment_<?php echo $id; ?>"><?php esc_html_e('Attach uploaded files to the notification email','vowels-contact-form-with-drag-and-drop'); ?></label></th>
                        <td><input type="checkbox" id="add_as_attachment_<?php echo $id; ?>" name="add_as_attachment_<?php echo $id; ?>" <?php checked($element['add_as_attachment'], true); ?> /></td>
                    </tr>
                    <?php if (!isset($element['save_to_server'])) $element['save_to_server'] = true; ?>
                    <tr valign="top">
                        <th scope="row"><label for="save_to_server_<?php echo $id; ?>"><?php esc_html_e('Save uploaded files to the server','vowels-contact-form-with-drag-and-drop'); ?></label></th>
                        <td><input type="checkbox" id="save_to_server_<?php echo $id; ?>" name="save_to_server_<?php echo $id; ?>" <?php checked($element['save_to_server'], true); ?> onclick="vowelsforminc.setSaveToServer(vowelsforminc.getElementById(<?php echo $id; ?>), this.checked);" /></td>
                    </tr>
                    <?php if (!isset($element['save_path'])) $element['save_path'] = 'vowels/{form_id}/{year}/{month}/'; ?>
                    <tr valign="top" class="show-if-save-to-server <?php if (!$element['save_to_server']) echo 'ifb-hidden'; ?>">
                        <th scope="row">
                            <div class="ifb-tooltip">
                                <div class="ifb-tooltip-content">
                                    <div class="ifb-tooltip-title"><?php esc_html_e('Placeholders','vowels-contact-form-with-drag-and-drop'); ?></div>
                                    <code>{form_id} = <?php esc_html_e('the unique ID of the form','vowels-contact-form-with-drag-and-drop'); ?></code><br />
                                    <code>{year} = <?php esc_html_e('the current year','vowels-contact-form-with-drag-and-drop'); ?></code><br />
                                    <code>{month} = <?php esc_html_e('the current month','vowels-contact-form-with-drag-and-drop'); ?></code><br />
                                    <code>{day} = <?php esc_html_e('the current day','vowels-contact-form-with-drag-and-drop'); ?></code><br />
                                    <?php esc_html_e('You can enter the placeholder code in your path to display their values.','vowels-contact-form-with-drag-and-drop'); ?>
                                </div>
                            </div>
                            <label for="save_path_<?php echo $id; ?>"><?php esc_html_e('Path to save uploaded files','vowels-contact-form-with-drag-and-drop'); ?></label>
                        </th>
                        <td>
                            <input class="ifb-save-path-input" type="text" id="save_path_<?php echo $id; ?>" name="save_path_<?php echo $id; ?>" value="<?php echo esc_attr($element['save_path']); ?>" />
                            <p class="description"><?php esc_html_e('The path to save the files inside the WordPress uploads directory.','vowels-contact-form-with-drag-and-drop'); ?></p>
                        </td>
                    </tr>
                    <?php if (!isset($element['browse_text'])) $element['browse_text'] = ''; ?>
                    <tr valign="top">
                        <th scope="row">
                            <label for="browse_text_<?php echo $id; ?>"><?php esc_html_e('Browse button text','vowels-contact-form-with-drag-and-drop'); ?></label>
                        </th>
                        <td>
                            <input type="text" id="browse_text_<?php echo $id; ?>" name="browse_text_<?php echo $id; ?>" value="<?php echo esc_attr($element['browse_text']); ?>" />
                            <p class="description"><?php printf(esc_html__('Override the text for the browse button which is "%s", this only applies if you are using Uniform or the enhanced uploader', 'vowels-contact-form-with-drag-and-drop'), _x('Browse...', 'for a file to upload','vowels-contact-form-with-drag-and-drop')); ?></p>
                        </td>
                    </tr>
                    <?php if (!isset($element['default_text'])) $element['default_text'] = ''; ?>
                    <tr valign="top">
                        <th scope="row">
                            <label for="default_text_<?php echo $id; ?>"><?php esc_html_e('Default text','vowels-contact-form-with-drag-and-drop'); ?></label>
                        </th>
                        <td>
                            <input type="text" id="default_text_<?php echo $id; ?>" name="default_text_<?php echo $id; ?>" value="<?php echo esc_attr($element['default_text']); ?>" />
                            <p class="description"><?php printf(esc_html__('Override the default text for the file input which is "%s", this only applies if you are using
                            Uniform', 'vowels-contact-form-with-drag-and-drop'), __('No file selected','vowels-contact-form-with-drag-and-drop')); ?></p>
                        </td>
                    </tr>
                    <?php include 'settings/tooltip-type.php'; ?>
                    <?php include 'settings/conditional-logic.php'; ?>
                </table>
                <h3 class="ifb-translate-h3"><?php esc_html_e('Translate error messages','vowels-contact-form-with-drag-and-drop'); ?></h3>
                <table class="ifb-form-table translate-error-messages-table">
                    <?php
                        if (!isset($element['messages'])) $element['messages'] = array();

                        // key => tooltip
                        $customisableMessages = array(
                            'not_uploaded_with_filename' => '<div class="ifb-tooltip-title">' . esc_html__('Placeholders','vowels-contact-form-with-drag-and-drop') . '</div><code>%s = ' . esc_html__('the filename','vowels-contact-form-with-drag-and-drop') . '</code>',
                            'not_uploaded' => '',
                            'too_big_with_filename' => '<div class="ifb-tooltip-title">' . esc_html__('Placeholders','vowels-contact-form-with-drag-and-drop') . '</div><code>%s = ' . esc_html__('the filename','vowels-contact-form-with-drag-and-drop') . '</code>',
                            'too_big' => '',
                            'not_allowed_type_with_filename' => '<div class="ifb-tooltip-title">' . esc_html__('Placeholders','vowels-contact-form-with-drag-and-drop') . '</div><code>%s = ' . esc_html__('the filename','vowels-contact-form-with-drag-and-drop') . '</code>',
                            'not_allowed_type' => '',
                            'field_required' => '',
                            'only_partial_with_filename' => '<div class="ifb-tooltip-title">' . esc_html__('Placeholders','vowels-contact-form-with-drag-and-drop') . '</div><code>%s = ' . esc_html__('the filename','vowels-contact-form-with-drag-and-drop') . '</code>',
                            'only_partial' => '',
                            'no_file' => '',
                            'missing_temp_folder' => '',
                            'failed_to_write' => '',
                            'stopped_by_extension' => '',
                            'unknown_error' => ''
                        );

                        foreach ($customisableMessages as $key => $tooltip) {
                            if (!isset($element['messages'][$key])) {
                                $element['messages'][$key] = '';
                            }
                        }

                        $fileUploadValidator = new vowelsforminc_Validator_FileUpload('name');
                    ?>
                    <tr valign="top">
                        <th><?php esc_html_e('Default','vowels-contact-form-with-drag-and-drop'); ?></th>
                        <th><?php esc_html_e('Translation','vowels-contact-form-with-drag-and-drop'); ?></th>
                    </tr>
                    <?php foreach ($customisableMessages as $key => $tooltip) : ?>
                        <tr valign="top">
                            <th scope="row">
                                <?php if (strlen($tooltip)) : ?>
                                    <div class="ifb-tooltip"><div class="ifb-tooltip-content"><?php echo $tooltip; ?></div></div>
                                <?php endif; ?>
                                <label for="<?php echo $key; ?>_<?php echo $id; ?>"><?php echo esc_html($fileUploadValidator->getMessageTemplate($key)); ?></label>
                            </th>
                            <td>
                                <input type="text" id="<?php echo $key; ?>_<?php echo $id; ?>" name="<?php echo $key; ?>_<?php echo $id; ?>" value="<?php echo (isset($element['messages'][$key])) ? esc_attr($element['messages'][$key]) : ''; ?>" />
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    <?php include '_save.php'; ?>
                </table>
                </div>
            </div>
            <div class="ifb-tabs-panel" id="ifb-element-settings-tab-advanced-<?php echo $id; ?>">
                <div class="ifb-element-settings-inner">
                    <table class="ifb-form-table ifb-element-settings-form-table ifb-element-settings-advanced-form-table">
                        <?php include 'settings/styles.php'; ?>
                        <?php include 'settings/unique-id.php'; ?>
                        <?php include 'settings/selectors.php'; ?>
                        <?php include '_save.php'; ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>