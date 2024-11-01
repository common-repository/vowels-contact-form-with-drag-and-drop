<?php

if (!defined('VOWELSFORMDRAGDROP_VERSION')) exit;

if (!class_exists('vowelsformincWidget')) {
    require_once VOWELSFORMDRAGDROP_INCLUDES_DIR . '/widget.php';
}
if (!class_exists('TCRCSSParser')) {
    require_once VOWELSFORMDRAGDROP_INCLUDES_DIR . '/CSSParser/CSSParser.php';
}
if (!class_exists('vowelsforminc')) {
    require_once VOWELSFORMDRAGDROP_INCLUDES_DIR . '/vowelsforminc.php';
    vowelsforminc::registerAutoload();
}

/**
 * Get the URL to the plugin folder
 *
 * @return  string
 */
function vowels_form_builder_plugin_url()
{
    return plugins_url(VOWELSFORMDRAGDROP_PLUGIN_NAME);
}

/**
 * Get the URL to the plugin admin folder
 *
 * @return  string
 */
function vowels_form_builder_admin_url()
{
    return vowels_form_builder_plugin_url() . '/admin';
}

/**
 * Load the plugin translated strings
 */
function vowels_form_builder_load_textdomain()
{
    load_plugin_textdomain('vowels', false, VOWELSFORMDRAGDROP_PLUGIN_NAME . '/languages/');
}
add_action('plugins_loaded', 'vowels_form_builder_load_textdomain');

/**
 * Start a PHP session if necessary
 *
 * We need to start a session:
 *
 * 1. On the frontend when showing the form
 * 2. When displaying the form via Ajax
 */
function vowels_form_builder_session_start()
{
    if (!is_admin()) {
        // We're on the front end so we need a session
        vowels_form_builder_secure_session_start();
    } elseif (defined('DOING_AJAX') && DOING_AJAX === true && isset($_GET['action']) && $_GET['action'] === 'vowels_form_builder_show_form_ajax') {
        // We are displaying the form via Ajax
        vowels_form_builder_secure_session_start();
    }
}
add_action('plugins_loaded', 'vowels_form_builder_session_start');

/**
 * Starts a PHP session
 *
 * If the session ID given by the browser contains invalid characters, a session is not started
 *
 * @return bool True if a session is successfully started
 */
function vowels_form_builder_secure_session_start()
{
    if (session_id() !== '' || headers_sent()) {
        // Session already exists or headers are already sent
        return false;
    }

    $sessionName = session_name();

    if (isset($_COOKIE[$sessionName])) {
        $sessionId = $_COOKIE[$sessionName];
    } else if (isset($_GET[$sessionName])) {
        $sessionId = $_GET[$sessionName];
    } else {
        return session_start();
    }

    if (!is_string($sessionId) || !preg_match('/^[a-zA-Z0-9,\-]{1,128}$/', $sessionId)) {
        return false;
    }

    return session_start();
}

/**
 * Get the name of the vowelsforminc forms table including the wpdb prefix
 *
 * @return string
 */
function vowels_form_builder_get_form_table_name()
{
    global $wpdb;

    return $wpdb->prefix . 'vowels_form_builder_forms';
}

/**
 * Get the name of the vowelsforminc submitted entries table including the wpdb prefix
 *
 * @return string
 */
function vowels_form_builder_get_form_entries_table_name()
{
    global $wpdb;

    return $wpdb->prefix . 'vowels_form_builder_form_entries';
}

/**
 * Get the name of the vowelsforminc submitted entries data including the wpdb prefix
 *
 * @return string
 */
function vowels_form_builder_get_form_entry_data_table_name()
{
    global $wpdb;

    return $wpdb->prefix . 'vowels_form_builder_form_entry_data';
}

/**
 * Get the count of the forms
 *
 * @param int $active Filter by active 1 or 0
 */
function vowels_form_builder_get_form_count($active = null)
{
    global $wpdb;

    $sql = "SELECT COUNT(id) FROM " . vowels_form_builder_get_form_table_name();

    if ($active !== null) {
        $active = absint($active);
        $sql .= " WHERE active = $active";
    }

    return absint($wpdb->get_var($sql));
}

/**
 * Get all the form rows from the database
 *
 * @param   int     $active  1 or 0 to get only active or inactive forms
 * @param   int     $limit   Limit to this number of forms
 * @return  object           The result object
 */
function vowels_form_builder_get_all_form_rows($active = null, $limit = null)
{
    global $wpdb;

    $sql = "SELECT * FROM " . vowels_form_builder_get_form_table_name();

    if ($active !== null) {
        $active = absint($active);
        $sql .= " WHERE active = $active";
    }

    $sql .= " ORDER BY id ASC";

    if ($limit !== null) {
        $sql .= " LIMIT " . $limit;
    }

    return $wpdb->get_results($sql);
}

/**
 * Get all the forms from the database
 *
 * @param   int    $active  1 or 0 to get only active or inactive forms
 * @param   int    $limit   Limit to this number of forms
 * @return  array           An array of form configs
 */
function vowels_form_builder_get_all_forms($active = null, $limit = null)
{
    $forms = array();
    $rows = vowels_form_builder_get_all_form_rows($active, $limit);

    if (count($rows)) {
        foreach ($rows as $row) {
            $forms[] = maybe_unserialize($row->config);
        }
    }

    return $forms;
}

/**
 * Checks if the form with the given ID exists
 *
 * @param int $id
 * @return boolean
 */
function vowels_form_builder_form_exists($id)
{
    global $wpdb;

    $sql = "SELECT id FROM " . vowels_form_builder_get_form_table_name() . " WHERE id = " . absint($id);

    if ($wpdb->get_var($sql) === null) {
        return false;
    } else {
        return true;
    }
}

/**
 * Encodes the given value in JSON
 *
 * @param   mixed   $value  The data to encode
 * @return  string          The encoded string
 */
function vowels_form_builder_json_encode($value)
{
    if (!function_exists('wp_json_encode')) {
        return json_encode($value);
    }

    return wp_json_encode($value);
}

/**
 * Decode the given value from JSON
 *
 * @deprecated 1.8.0 Use json_decode instead
 *
 * @param   string   $value  The string to decode
 * @param   boolean  $assoc  Decodes to associative array if true
 * @return  mixed            The decoded data
 */
function vowels_form_builder_json_decode($value, $assoc = false)
{
    return json_decode($value, $assoc);
}

/**
 * Get the form row from the database with the given ID
 *
 * @param int $id
 * @return stdClass|null
 */
function vowels_form_builder_get_form_row($id)
{
    global $wpdb;
    $id = absint($id);

    $sql = "SELECT * FROM " . vowels_form_builder_get_form_table_name() . " WHERE id = %d";

    return $wpdb->get_row($wpdb->prepare($sql, $id));
}

/**
 * Get the form config with the given ID
 *
 * @param int $id
 * @return array|null
 */
function vowels_form_builder_get_form_config($id)
{
    global $wpdb;
    $id = absint($id);

    $sql = "SELECT config FROM " . vowels_form_builder_get_form_table_name() . " WHERE id = %d";

    $config = $wpdb->get_var($wpdb->prepare($sql, $id));

    return maybe_unserialize($config);
}

/**
 * Get the form object with the given ID
 *
 * @param int $id
 * @param string $uid
 * @return vowelsforminc
 */
function vowels_form_builder_get_form($id, $uid = '', $values = '')
{
    $config = vowels_form_builder_get_form_config($id);

    if ($config !== null) {
        if (strlen($uid)) {
            $config['uniq_id'] = preg_replace('/[^A-Za-z0-9]/', '', $uid);
        }

        $config['dynamic_values'] = $values;

        $form = new vowelsforminc($config);

        return $form;
    } else {
        return null;
    }
}





/**
 * Display (returns) the HTML of the given form
 *
 * @param vowelsforminc $form
 */
function vowels_form_builder_display_form(vowelsforminc $form)
{
    do_action('vowels_form_builder_pre_display', $form);
    do_action('vowels_form_builder_pre_display_' . $form->getId(), $form);

    ob_start();

    include VOWELSFORMDRAGDROP_INCLUDES_DIR . '/form.php';

    return ob_get_clean();
}

/**
 * Get all the months in the year
 *
 * @return array
 */
function vowels_form_builder_get_all_months()
{
    return array(


        1 => __('January', 'vowels-contact-form-with-drag-and-drop'),
        2 => __('February', 'vowels-contact-form-with-drag-and-drop'),
        3 => __('March', 'vowels-contact-form-with-drag-and-drop'),
        4 => __('April', 'vowels-contact-form-with-drag-and-drop'),
        5 => __('May', 'vowels-contact-form-with-drag-and-drop'),
        6 => __('June', 'vowels-contact-form-with-drag-and-drop'),
        7 => __('July', 'vowels-contact-form-with-drag-and-drop'),
        8 => __('August', 'vowels-contact-form-with-drag-and-drop'),
        9 => __('September', 'vowels-contact-form-with-drag-and-drop'),
        10 => __('October', 'vowels-contact-form-with-drag-and-drop'),
        11 => __('November', 'vowels-contact-form-with-drag-and-drop'),
        12 => __('December','vowels-contact-form-with-drag-and-drop')
    );
}

/**
 * Get the replaced year for date element Year select,
 * with any placeholder tags replaced
 *
 * @param mixed $year The string placeholder or number of the year
 * @return int
 */
function vowels_form_builder_get_year($year = null)
{
    if ($year === '' || $year === null) {
        return null;
    } else if ($year == '{year}') {
        $y = (int) date('Y');
    } else if (preg_match('/^{year\|([+|-])(\d+)}$/', $year, $matches)) {
        $y = (int) date('Y');
        if ($matches[1] == '+') {
            $y += $matches[2];
        } else {
            $y -= $matches[2];
        }
    } else {
        $y = (int) $year;
    }

    return $y;
}

/**
 * Get the replaced start year of date element Year select,
 * with any placeholder tags replaced. Returns the default start
 * year of {current_date}+4 if the year is not specified.
 *
 * @param mixed $year The string placeholder or number of the year
 * @return int
 */
function vowels_form_builder_get_start_year($year = null)
{
    $startYear = vowels_form_builder_get_year($year);

    return $startYear === null ? ((int) date('Y') + 4) : $startYear;
}

/**
 * Get the replaced end year of date element Year select,
 * with any placeholder tags replaced. Returns the default end
 * year of 1900 if the year is not specified.
 *
 * @param mixed $year The string placeholder or number of the year
 * @return int
 */
function vowels_form_builder_get_end_year($year = null)
{
    $endYear = vowels_form_builder_get_year($year);

    return $endYear === null ? 1900 : $endYear;
}

/**
 * Get the list of available date formats, the key
 * is the format string passed to date() and the value
 * is an example formatted date.
 *
 * @return array
 */
function vowels_form_builder_get_date_formats()
{
    $testDate = strtotime('25 December 2024 17:35');
    $dateFormats = array();
    $formats = array(
        'l, jS F Y',
        'D, jS M Y',
        'jS F Y',
        'jS M Y',
        'l, j F Y',
        'l, F j, Y',
        'D, j M Y',
        'D, M j, Y',
        'j F Y',
        'F j, Y',
        'j M Y',
        'd/m/Y',
        'm/d/Y',
        'Y/m/d',
        'Y-m-d',
        'd-m-Y',
        'd.m.Y'
    );

    foreach ($formats as $format) {
        $dateFormats[$format] = date_i18n($format, $testDate);
    }

    return apply_filters('vowels_form_builder_date_formats', $dateFormats);
}

/**
 * Get the list of available time formats, the key
 * is the format string passed to date() and the value
 * is an example formatted time.
 *
 * @return array
 */
function vowels_form_builder_get_time_formats()
{
    $testDate = strtotime('25 December 2024 17:35');
    $timeFormats = array();
    $formats = array(
        'g:i a',
        'g:ia',
        'g:i A',
        'g:iA',
        'H:i'
    );

    foreach ($formats as $format) {
        $timeFormats[$format] = date_i18n($format, $testDate);
    }

    return apply_filters('vowels_form_builder_time_formats', $timeFormats);
}

/**
 * Get the absolute path to the WordPress upload directory. If the
 * path is not writable it will return false.
 *
 * @return string|false
 */
function vowels_form_builder_get_wp_uploads_dir()
{
    $uploadDir = wp_upload_dir();
    if ($uploadDir['error'] == false) {
        return $uploadDir['basedir'];
    }

    return false;
}

/**
 * Get the full URL to the WordPress upload directory.
 *
 * @return string|false
 */
function vowels_form_builder_get_wp_uploads_url()
{
    $uploadDir = wp_upload_dir();
    return $uploadDir['baseurl'];
}


/**
 * Frontend JavaScript localisation
 */
function vowels_form_builder_js_l10n()
{
    return array(
        'error_submitting_form' => __('An error occurred submitting the form', 'vowels-contact-form-with-drag-and-drop'),
        'upload_too_many' => __('You have attempted to queue too many files', 'vowels-contact-form-with-drag-and-drop'),
        'upload_file_type_not_allowed' => __('This file type is not allowed', 'vowels-contact-form-with-drag-and-drop'),
        'upload_file_too_big' => __('This file exceeds the maximum upload size', 'vowels-contact-form-with-drag-and-drop'),
        'invalid_response' => __('The response from the server was invalid or malformed', 'vowels-contact-form-with-drag-and-drop'),
        'ajax_error' => __('Ajax error', 'vowels-contact-form-with-drag-and-drop'),
        'plugin_url' => vowels_form_builder_plugin_url(),
        'ajax_url' => admin_url('admin-ajax.php'),
        'preview_no_submit' => __('The form cannot be submitted in the preview','vowels-contact-form-with-drag-and-drop')
    );
}

add_action('wp_loaded', 'vowels_form_builder_process_form_ajax');

/**
 * Hook for processing the forms submitted via Ajax
 */
function vowels_form_builder_process_form_ajax()
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['vowels_form_builder_ajax']) && $_POST['vowels_form_builder_ajax'] == 1) {
        @header('Content-Type: text/html; charset=' . get_option('blog_charset'));
        echo vowels_form_builder_process_form();
        exit;
    }
}

/**
 * Process the form and returns the response
 *
 * @return string
 */
function vowels_form_builder_process_form()
{
    $ajax = isset($_POST['vowels_form_builder_ajax']) && $_POST['vowels_form_builder_ajax'] == 1;

    if (isset($_POST['vowels_form_builder_id']) && isset($_POST['vowels_form_builder_uid']) && (($form = vowels_form_builder_get_form($_POST['vowels_form_builder_id'], $_POST['vowels_form_builder_uid'])) instanceof vowelsforminc) && $form->getActive()) {
        // Strip slashes from the submitted data (WP adds them automatically)
        $_POST = stripslashes_deep($_POST);

        // Pre-process action hooks
        do_action('vowels_form_builder_pre_process', $form);
        do_action('vowels_form_builder_pre_process_' . $form->getId(), $form);

        $response = '';

        // If we have files uploaded via Ajax previously, merge them into $_FILES
        if (isset($_SESSION['vowels-' . $form->getUniqId()])) {
            $_FILES = array_merge($_FILES, $_SESSION['vowels-' . $form->getUniqId()]);
        }

        // Set the form element values
        $form->setValues($_POST);

        // Calculate which elements are hidden by conditional logic and which groups are empty
        $form->calculateElementStatus();

        // Pre-validate action hooks
        do_action('vowels_form_builder_pre_validate', $form);
        do_action('vowels_form_builder_pre_validate_' . $form->getId(), $form);

        if ($form->isValid()) {
            // Post-validate action hooks
            do_action('vowels_form_builder_post_validate', $form);
            do_action('vowels_form_builder_post_validate_' . $form->getId(), $form);

            // Process any uploads first
            $attachments = array();
            $elements = $form->getElements();

            foreach ($elements as $element) {
                if ($element instanceof vowelsforminc_Element_File) {
                    $elementName = $element->getName();
                    if (array_key_exists($elementName, $_FILES) && is_array($_FILES[$elementName])) {
                        $file = $_FILES[$elementName];
                        if (is_array($file['error'])) {
                            // Process multiple upload field
                            foreach ($file['error'] as $key => $error) {
                                if ($error === UPLOAD_ERR_OK) {
                                    $pathInfo = pathinfo($file['name'][$key]);
                                    $extension = isset($pathInfo['extension']) ? $pathInfo['extension'] : '';

                                    $filenameFilter = new vowelsforminc_Filter_Filename();
                                    $filename = strlen($extension) ? str_replace(".$extension", '', $pathInfo['basename']) : $pathInfo['basename'];
                                    $filename = $filenameFilter->filter($filename);
                                    $filename = apply_filters('vowels_form_builder_filename_' . $element->getName(), $filename, $element, $form);
                                    if (strlen($extension)) {
                                        $filename = (strlen($filename)) ? "$filename.$extension" : "upload.$extension";
                                    } else {
                                        $filename = (strlen($filename)) ? $filename : 'upload';
                                    }

                                    $fullPath = $file['tmp_name'][$key];
                                    $value = array('text' => $filename);

                                    if ($element->getSaveToServer()) {
                                        $result = vowels_form_builder_save_uploaded_file($fullPath, $filename, $element, $form->getId());

                                        if ($result !== false) {
                                            $fullPath = $result['fullPath'];
                                            $filename = $result['filename'];

                                            $value = array(
                                                'url' => vowels_form_builder_get_wp_uploads_url() . '/' . $result['path'] . $filename,
                                                'text' => $filename,
                                                'fullPath' => $fullPath
                                            );
                                        }
                                    }

                                    if ($element->getAddAsAttachment()) {
                                        $attachments[] = array(
                                            'fullPath' => $fullPath,
                                            'type' => $file['type'][$key],
                                            'filename' => $filename
                                        );
                                    }

                                    $element->addFile($value);
                                }
                            }
                        } else {
                            // Process single upload field
                            if ($file['error'] === UPLOAD_ERR_OK) {
                                $pathInfo = pathinfo($file['name']);
                                $extension = isset($pathInfo['extension']) ? $pathInfo['extension'] : '';

                                $filenameFilter = new vowelsforminc_Filter_Filename();
                                $filename = strlen($extension) ? str_replace(".$extension", '', $pathInfo['basename']) : $pathInfo['basename'];
                                $filename = $filenameFilter->filter($filename);
                                $filename = apply_filters('vowels_form_builder_filename_' . $element->getName(), $filename, $element, $form);
                                if (strlen($extension)) {
                                    $filename = (strlen($filename)) ? "$filename.$extension" : "upload.$extension";
                                } else {
                                    $filename = (strlen($filename)) ? $filename : 'upload';
                                }

                                $fullPath = $file['tmp_name'];
                                $value = array('text' => $filename);

                                if ($element->getSaveToServer()) {
                                    $result = vowels_form_builder_save_uploaded_file($fullPath, $filename, $element, $form->getId());

                                    if (is_array($result)) {
                                        $fullPath = $result['fullPath'];
                                        $filename = $result['filename'];

                                        $value = array(
                                            'url' => vowels_form_builder_get_wp_uploads_url() . '/' . $result['path'] . $filename,
                                            'text' => $filename,
                                            'fullPath' => $fullPath
                                        );
                                    }
                                }

                                if ($element->getAddAsAttachment()) {
                                    $attachments[] = array(
                                        'fullPath' => $fullPath,
                                        'type' => $file['type'],
                                        'filename' => $filename
                                    );
                                }

                                $element->addFile($value);
                            }
                        }
                    } // end in $_FILES
                } // end instanceof file
            } // end foreach element

            // Save the entry to the database
            if ($form->getSaveToDatabase()) {
                global $wpdb;

                $currentUser = wp_get_current_user();


              $entry = array(
                    'form_id' => $form->getId(),
                    'date_added' => gmdate('Y-m-d H:i:s'),
                    'ip' => mb_substr(sanitize_text_field(vowels_form_builder_get_user_ip()), 0, 32),
                    'form_url' => isset($_POST['form_url']) ? mb_substr(esc_url($_POST['form_url']), 0, 512) : '',
                    'referring_url' => isset($_POST['referring_url']) ? mb_substr(esc_url($_POST['referring_url']), 0, 512) : '',
                    'post_id' => isset($_POST['post_id']) ? mb_substr((int)$_POST['post_id'], 0, 32) : '',
                    'post_title' => isset($_POST['post_title']) ? mb_substr(sanitize_text_field($_POST['post_title']), 0, 128) : '',
                    'user_display_name' => sanitize_text_field(mb_substr(vowels_form_builder_get_current_userinfo('display_name'), 0, 128)),
                    'user_email' => sanitize_text_field(mb_substr(vowels_form_builder_get_current_userinfo('user_email'), 0, 128)),
                    'user_login' => sanitize_text_field(mb_substr(vowels_form_builder_get_current_userinfo('user_login'), 0, 128))
                );

                $wpdb->insert(vowels_form_builder_get_form_entries_table_name(), $entry);
                $entryId = $wpdb->insert_id;
                $form->setEntryId($entryId);
                $entryDataTableName = vowels_form_builder_get_form_entry_data_table_name();

                foreach ($elements as $element) {
                    if ($element->getSaveToDatabase() && !$element->isConditionallyHidden()) {
                        $entryData = array(
                            'entry_id' => $entryId,
                            'element_id' => $element->getId(),
                            'value' => $element->getValueHtml()
                        );
                        $wpdb->insert($entryDataTableName, $entryData);
                    }
                }
            }

            // Check if we need to send any emails
            if ($form->getSendNotification() || $form->getSendAutoreply()) {
                // Get a new PHP mailer instance
                $mailer = vowels_form_builder_new_phpmailer($form);

                // Create an email address validator, we'll need to use it later
                $emailValidator = new vowelsforminc_Validator_Email();

                // Check if we should send the notification email
                if ($form->getSendNotification() && count($form->getRecipients())) {
                    // Set the from address
                    $notificationFromInfo = $form->getNotificationFromInfo();
                    $mailer->From = $notificationFromInfo['email'];
                    $mailer->FromName = $notificationFromInfo['name'];

                    // Set the BCC
                    if (count($bcc = $form->getBcc())) {
                        foreach ($bcc as $bccEmail) {
                            $mailer->AddBCC($bccEmail);
                        }
                    }

                    // Set the Reply-To header
                    if (($replyToElement = $form->getNotificationReplyToElement()) instanceof vowelsforminc_Element_Email
                    && $emailValidator->isValid($replyToEmail = $replyToElement->getValue())) {
                        $mailer->AddReplyTo($replyToEmail);
                    }

                    // Set the subject
                    $mailer->Subject = $form->replacePlaceholderValues($form->getSubject());

                    // Check for conditional recipient rules
                    if (count($form->getConditionalRecipients())) {
                        $recipients = array();
                        foreach ($form->getConditionalRecipients() as $rule) {
                            if (isset($rule['element'], $rule['value'], $rule['operator'], $rule['recipient'])
                                && ($rElement = $form->getElementById($rule['element'])) instanceof vowelsforminc_Element_Multi) {
                                if ($rule['operator'] == 'eq') {
                                    if ($rElement->getValue() == $rule['value']) {
                                        $recipients[] = $rule['recipient'];
                                    }
                                } else {
                                    if ($rElement->getValue() != $rule['value']) {
                                        $recipients[] = $rule['recipient'];
                                    }
                                }
                            }
                        }

                        if (count($recipients)) {
                            foreach ($recipients as $recipient) {
                                $mailer->AddAddress($form->replacePlaceholderValues($recipient));
                            }
                        } else {
                            // No conditional recipient rules were matched, use default recipients
                            foreach ($form->getRecipients() as $recipient) {
                                $mailer->AddAddress($form->replacePlaceholderValues($recipient));
                            }
                        }
                    } else {
                        // Set the recipients
                        foreach ($form->getRecipients() as $recipient) {
                            $mailer->AddAddress($form->replacePlaceholderValues($recipient));
                        }
                    }

                    // Set the message content
                    $emailHTML = '';
                    $emailPlain = '';
                    if ($form->getCustomiseEmailContent()) {
                        if ($form->getNotificationFormat() == 'html') {
                            $emailHTML = $form->getNotificationEmailContent();
                        } else {
                            $emailPlain = $form->getNotificationEmailContent();
                        }

                        // Replace any placeholder values
                        $emailHTML = $form->replacePlaceholderValues($emailHTML, 'html', '<br />');
                        $emailPlain = $form->replacePlaceholderValues($emailPlain, 'plain', vowels_form_builder_get_email_newline());
                    } else {
                        ob_start();
                        include VOWELSFORMDRAGDROP_INCLUDES_DIR . '/emails/email-html.php';
                        $emailHTML = ob_get_clean();

                        ob_start();
                        include VOWELSFORMDRAGDROP_INCLUDES_DIR . '/emails/email-plain.php';
                        $emailPlain = ob_get_clean();
                    }

                    if (strlen($emailHTML)) {
                        $mailer->MsgHTML($emailHTML);
                        if (strlen($emailPlain)) {
                            $mailer->AltBody = $emailPlain;
                        }
                    } else {
                       $mailer->Body = $emailPlain;
                    }

                    // Attachments
                    foreach ($attachments as $file) {
                        $mailer->AddAttachment($file['fullPath'], $file['filename'], 'base64', $file['type']);
                    }

                    $mailer = apply_filters('vowels_form_builder_pre_send_notification_email', $mailer, $form, $attachments);
                    $mailer = apply_filters('vowels_form_builder_pre_send_notification_email_' . $form->getId(), $mailer, $form, $attachments);

                    try {
                        // Send the message
                        $mailer->Send();
                    } catch (Exception $e) {
                        if (WP_DEBUG) {
                            throw $e;
                        }
                    }
                }

                // Check if we should send the autoreply email
                if ($form->getSendAutoreply()
                && ($recipientElement = $form->getAutoreplyRecipientElement()) instanceof vowelsforminc_Element_Email
                && strlen($recipientEmailAddress = $recipientElement->getValue())
                && $emailValidator->isValid($recipientEmailAddress)) {
                    // Get a new PHP mailer instance
                    $mailer = vowels_form_builder_new_phpmailer($form);

                    // Set the subject
                    $mailer->Subject = $form->replacePlaceholderValues($form->getAutoreplySubject());

                    // Set the from name/email
                    $autoreplyFromInfo = $form->getAutoreplyFromInfo();
                    $mailer->From = $autoreplyFromInfo['email'];
                    $mailer->FromName = $autoreplyFromInfo['name'];

                    // Add the recipient address
                    $mailer->AddAddress($recipientEmailAddress);

                    // Build the email content
                    $emailHTML = '';
                    $emailPlain = '';
                    if (strlen($autoreplyEmailContent = $form->getAutoreplyEmailContent())) {
                        if ($form->getAutoreplyFormat() == 'html') {
                            $emailHTML = $form->replacePlaceholderValues($autoreplyEmailContent, 'html', '<br />');
                        } else {
                            $emailPlain = $form->replacePlaceholderValues($autoreplyEmailContent, 'plain', vowels_form_builder_get_email_newline());
                        }
                    }

                    if (strlen($emailHTML)) {
                        $mailer->MsgHTML($emailHTML);
                    } else {
                        $mailer->Body = $emailPlain;
                    }

                    $mailer = apply_filters('vowels_form_builder_pre_send_autoreply_email', $mailer, $form, $attachments);
                    $mailer = apply_filters('vowels_form_builder_pre_send_autoreply_email_' . $form->getId(), $mailer, $form, $attachments);

                    try {
                        // Send the autoreply
                        $mailer->Send();
                    } catch (Exception $e) {
                        if (WP_DEBUG) {
                            throw $e;
                        }
                    }
                }
            }

            // Okay, so now we can save form data to the custom database table if configured
            if (count($fields = $form->getDbFields())) {
                foreach ($fields as $key => $value) {
                    $fields[$key] = $form->replacePlaceholderValues($value);
                }

                if ($form->getUseWpDb()) {
                    global $wpdb;
                    $wpdb->insert($form->getDbTable(), $fields);
                } else {
                    $cwpdb = new wpdb($form->getDbUsername(), $form->getDbPassword(), $form->getDbName(), $form->getDbHost());
                    $cwpdb->insert($form->getDbTable(), $fields);
                }
            }

            // Delete uploaded files and unset file upload info from session
            if (isset($_SESSION['vowels-' . $form->getUniqId()])) {
                if (is_array($_SESSION['vowels-' . $form->getUniqId()])) {
                    foreach ($_SESSION['vowels-' . $form->getUniqId()] as $file) {
                        if (isset($file['tmp_name'])) {
                            if (is_array($file['tmp_name'])) {
                                foreach ($file['tmp_name'] as $multiFile) {
                                    if (is_string($multiFile) && strlen($multiFile) && file_exists($multiFile)) {
                                        unlink($multiFile);
                                    }
                                }
                            } else if (is_string($file['tmp_name']) && strlen($file['tmp_name']) && file_exists($file['tmp_name'])) {
                                unlink($file['tmp_name']);
                            }
                        }
                    }
                }
                unset($_SESSION['vowels-' . $form->getUniqId()]);
            }

            // Unset CAPTCHA info from session
            if (isset($_SESSION['vowels-captcha-' . $form->getUniqId()])) {
                unset($_SESSION['vowels-captcha-' . $form->getUniqId()]);
            }

            // Post-process action hooks
            do_action('vowels_form_builder_post_process', $form);
            do_action('vowels_form_builder_post_process_' . $form->getId(), $form);

            $result = array('type' => 'success', 'data' => $form->getSuccessMessage());

            if ($form->getSuccessType() == 'redirect') {
                $result['redirect'] = $form->getSuccessRedirectURL();
            }

            if (!$ajax) {
                // Reset the form for non-JavaScript submit
                $successMessage = $form->getSuccessMessage();
                $form->setSubmitted(true);
                $form->reset();
            } else {
                // This counteracts the fact that wrapping the JSON response in a textarea decodes HTML entities
                if (isset($result['redirect'])) {
                    $result['redirect'] = htmlspecialchars($result['redirect'], ENT_NOQUOTES);
                }

                $result['data'] = htmlspecialchars($result['data'], ENT_NOQUOTES);
            }
        } else {
            $result = array('type' => 'error', 'data' => $form->getErrors());
        }

        if ($ajax) {
            $response = '<textarea>' . vowels_form_builder_json_encode($result) . '</textarea>';
        } else {
            // Redirect if successful
            if (isset($result['type'], $result['redirect']) && $result['type'] == 'success') {
                return '<meta http-equiv="refresh" content="0;URL=\'' . esc_url($result['redirect']) . '\'">';
            }

            // Displays the form again
            do_action('vowels_form_builder_pre_display', $form);
            do_action('vowels_form_builder_pre_display_' . $form->getId(), $form);

            ob_start();
            include VOWELSFORMDRAGDROP_INCLUDES_DIR . '/form.php';
            $response = ob_get_clean();
        }

        return $response;
    }
}

/**
 * Get a new PHPMailer instance
 *
 * @param vowelsforminc $form
 * @return PHPMailer
 */
function vowels_form_builder_new_phpmailer(vowelsforminc $form)
{
    if (!class_exists('PHPMailer')) {
        require_once ABSPATH . WPINC . '/class-phpmailer.php';
    }

    // Create the mailer and set the charset to match the blog charset
    $mailer = new PHPMailer(true);
    $mailer->CharSet = get_bloginfo('charset');

    $emailReturnPath = get_option('vowels_form_builder_email_returnpath');
    if ($emailReturnPath) {
        $mailer->Sender = $emailReturnPath;
    }

    // Set up SMTP settings if required
    if ($form->getEmailSendingMethod() == 'global' && get_option('vowels_form_builder_email_sending_method') == 'smtp') {
        $smtpSettings = get_option('vowels_form_builder_smtp_settings');
        $mailer->IsSMTP();
        $mailer->SMTPAutoTLS = false;

        if (isset($smtpSettings['host']) && strlen($smtpSettings['host'])) {
            $mailer->Host = $smtpSettings['host'];
        }

        if (isset($smtpSettings['port'])) {
            $mailer->Port = absint($smtpSettings['port']);
        }

        if (isset($smtpSettings['username']) && strlen($smtpSettings['username'])) {
            $mailer->SMTPAuth = true;
            $mailer->Username = $smtpSettings['username'];
        }

        if (isset($smtpSettings['password']) && strlen($smtpSettings['password'])) {
            $mailer->Password = $smtpSettings['password'];
        }

        if (isset($smtpSettings['encryption']) && in_array($smtpSettings['encryption'], array('tls', 'ssl'))) {
            $mailer->SMTPSecure = $smtpSettings['encryption'];
        }
    } else if ($form->getEmailSendingMethod() == 'smtp') {
        $mailer->IsSMTP();
        $mailer->SMTPAutoTLS = false;

        if (strlen($form->getSmtpHost())) {
            $mailer->Host = $form->getSmtpHost();
        }

        if (absint($form->getSmtpPort())) {
            $mailer->Port = $form->getSmtpPort();
        }

        if (strlen($form->getSmtpUsername())) {
            $mailer->SMTPAuth = true;
            $mailer->Username = $form->getSmtpUsername();
        }

        if (strlen($form->getSmtpPassword())) {
            $mailer->Password = $form->getSmtpPassword();
        }

        if (in_array($form->getSmtpEncryption(), array('tls', 'ssl'))) {
            $mailer->SMTPSecure = $form->getSmtpEncryption();
        }
    }

    return $mailer;
}

/**
 * Save the uploaded file
 *
 * @param string $currentPath The path to the uploaded file
 * @param string $filename Desired filename
 * @param vowelsforminc_Element_File $element The vowelsforminc file element
 * @param int $formId  The ID of the form
 */
function vowels_form_builder_save_uploaded_file($currentPath, $filename, vowelsforminc_Element_File $element, $formId)
{
    if (($wpUploadsDir = vowels_form_builder_get_wp_uploads_dir()) !== false) {
        // Get the save path
        $path = $element->getSavePath() == '' ? 'vowels/{form_id}/{year}/{month}/' : $element->getSavePath();

        // Replace placeholders
        $path = str_replace(array('{form_id}', '{year}', '{month}', '{day}'), array($formId, date('Y'), date('m'), date('d')), $path);

        // Apply any filter hooks to the path
        $path = apply_filters('vowels_form_builder_upload_path', $path, $element);
        $path = apply_filters("vowels_form_builder_upload_path_$formId", $path, $element);

        // Join the path with the WP uploads directory
        $absolutePath = rtrim($wpUploadsDir, '/') . '/' . ltrim($path, '/');

        // Apply filters to the absolute path
        $absolutePath = apply_filters('vowels_form_builder_upload_absolute_path', $absolutePath, $element);
        $absolutePath = apply_filters("vowels_form_builder_upload_absolute_path_$formId", $absolutePath, $element);

        // Add a trailing slash
        $absolutePath = trailingslashit($absolutePath);

        // Make the upload directory if it's not set
        if (!is_dir($absolutePath)) {
            wp_mkdir_p($absolutePath);
        }

        // Check if the file name already exists, if so generate a new one
        if (file_exists($absolutePath . $filename)) {
            $count = 1;
            $newFilenamePath = $absolutePath . $filename;

            while (file_exists($newFilenamePath)) {
                $newFilename = $count++ . '_' . $filename;
                $newFilenamePath = $absolutePath . $newFilename;
            }

            $filename = $newFilename;
        }

        // Move the file
        if (rename($currentPath, $absolutePath . $filename) !== false) {
            chmod($absolutePath . $filename, 0644);

            return array(
                'path' => $path,
                'fullPath' => $absolutePath . $filename,
                'filename' => $filename
            );
        } else {
            return false;
        }
    } else {
        // Uploads dir is not writable
        return false;
    }
}

/**
 * Handle the request to upload a file via Ajax
 */
function vowels_form_builder_process_upload_ajax()
{
    if (!vowels_form_builder_is_post_request()) {
        return;
    }

    if (!isset($_POST['vowels_form_builder_ajax_uploading']) || $_POST['vowels_form_builder_ajax_uploading'] != 1) {
        return;
    }

    // Validate the request data
    if (!isset($_POST['vowels_form_builder_id'], $_POST['vowels_form_builder_uid'], $_POST['vowels_form_builder_element_id']) ||
        !is_numeric($_POST['vowels_form_builder_id']) ||
        !is_string($_POST['vowels_form_builder_uid']) ||
        $_POST['vowels_form_builder_uid'] === '' ||
        !is_numeric($_POST['vowels_form_builder_element_id'])
    ) {
        vowels_form_builder_send_json(array(
            'type' => 'error',
            'message' => __('Bad request','vowels-contact-form-with-drag-and-drop')
        ));
    }

   // $uid = preg_replace('/[^A-Za-z0-9]/', '', (int)$_POST['vowels_form_builder_uid']);
    // $form = vowels_form_builder_get_form((int)$_POST['vowels_form_builder_id'], $uid);
  $uid = preg_replace('/[^A-Za-z0-9]/', '', $_POST['vowels_form_builder_uid']);
    $form = vowels_form_builder_get_form($_POST['vowels_form_builder_id'], $uid);

    if (!($form instanceof vowelsforminc)) {
        vowels_form_builder_send_json(array(
            'type' => 'error',
            'message' => __('Could not find the form','vowels-contact-form-with-drag-and-drop')
        ));
    }

    if (!$form->getActive()) {
        vowels_form_builder_send_json(array(
            'type' => 'error',
            'message' => __('This form is not currently active','vowels-contact-form-with-drag-and-drop')
        ));
    }

    $element = $form->getElementById($_POST['vowels_form_builder_element_id']);

    if (!($element instanceof vowelsforminc_Element_File)) {
        vowels_form_builder_send_json(array(
            'type' => 'error',
            'message' => __('Could not find the element','vowels-contact-form-with-drag-and-drop')
        ));
    }

    if (!isset($_FILES[$element->getName()])) {
        vowels_form_builder_send_json(array(
            'type' => 'error',
            'message' => __('File data not found','vowels-contact-form-with-drag-and-drop')
        ));
    }

    $vowelsTmpDir = untrailingslashit(vowels_form_builder_get_temp_dir()) . '/vowels';
    if (!is_dir($vowelsTmpDir)) {
        wp_mkdir_p($vowelsTmpDir);
    }

    if (!is_writable($vowelsTmpDir)) {
        vowels_form_builder_send_json(array(
            'type' => 'error',
            'message' => __('Temporary uploads directory is not writable','vowels-contact-form-with-drag-and-drop')
        ));
    }

    if ($element->isValid('')) {
        $sessionKey = 'vowels-' . $uid;
        $file = $_FILES[$element->getName()];

        $filename = tempnam($vowelsTmpDir, 'vowels');

        if ($element->getIsMultiple()) {
            move_uploaded_file($file['tmp_name'][0], $filename);
            $file['tmp_name'][0] = $filename;

            $files = isset($_SESSION[$sessionKey][$element->getName()]) ? $_SESSION[$sessionKey][$element->getName()] : array();

            foreach (array('name', 'type', 'tmp_name', 'error', 'size') as $key) {
                $files[$key][] = $file[$key][0];
            }

            $_SESSION[$sessionKey][$element->getName()] = $files;
        } else {
            move_uploaded_file($file['tmp_name'], $filename);
            $file['tmp_name'] = $filename;

            $_SESSION[$sessionKey][$element->getName()] = $file;
        }

        vowels_form_builder_send_json(array(
            'type' => 'success'
        ));
    } else {
        $errors = $element->getErrors();

        vowels_form_builder_send_json(array(
            'type' => 'error',
            'message' => $errors[0]
        ));
    }
}
add_action('init', 'vowels_form_builder_process_upload_ajax');

/**
 * Has the file been uploaded via PHP or the Ajax uploader?
 *
 * @param string $filename The path to the file
 */
function vowels_form_builder_is_uploaded_file($filename)
{
    if (is_uploaded_file($filename)) {
        return true;
    } else {
        $filename = realpath($filename);

        if (preg_match('#[/|\\\]vowels[/|\\\]vow#', $filename)) {
            return true;
        }
    }

    return false;
}

add_action('vowels_form_builder_upload_cleanup', 'vowels_form_builder_do_upload_cleanup');

/**
 * Deletes any files uploaded via SWFUpload that were temporarily
 * stored in the system temp directory but were never used.
 */
function vowels_form_builder_do_upload_cleanup()
{
    $vowelsTmpDir = untrailingslashit(vowels_form_builder_get_temp_dir()) . '/vowels/';

    if (is_dir($vowelsTmpDir) && $handle = opendir($vowelsTmpDir)) {
        clearstatcache();
        $keepUntil = time() - 21600; // Delete anything older than six hours (60 * 60 * 6)
        while (false !== ($file = readdir($handle))) {
            $mtime = filemtime($vowelsTmpDir . $file);
            if ($file != '.' && $file != '..' && $mtime < $keepUntil) {
                @unlink($vowelsTmpDir . $file);
            }
        }

        closedir($handle);
    }
}

/**
 * Get the IP address of the visitor
 *
 * @return string
 */
function vowels_form_builder_get_user_ip()
{
    $ip = $_SERVER['REMOTE_ADDR'];

    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }

    return $ip;
}

/**
 * Get the user agent string
 *
 * @return string
 */
function vowels_form_builder_get_user_agent()
{
    return isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '';
}

/**
 * Get the current URL
 *
 * @return string
 */
function vowels_form_builder_get_current_url()
{
    $url = 'http';
    if (is_ssl()) {
        $url .= 's';
    }
    $url .= '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

    return $url;
}

/**
 * Get the HTTP referer
 *
 * @return string
 */
function vowels_form_builder_get_http_referer()
{
    $referer = '';

    if (isset($_SERVER['HTTP_REFERER'])) {
        $referer = $_SERVER['HTTP_REFERER'];
    }

    return $referer;
}

/**
 * Get the current Post ID
 *
 * Returns the empty string if there is no current post
 *
 * @return int|string
 */
function vowels_form_builder_get_current_post_id()
{
    global $wp_query;
    $id = '';

    if ($wp_query instanceof WP_Query) {
        if (isset($wp_query->post) && isset($wp_query->post->ID)) {
            $id = $wp_query->post->ID;
        }
    }

    return $id;
}

/**
 * Get the current Post title
 *
 * @return string
 */
function vowels_form_builder_get_current_post_title()
{
    global $wp_query;
    $title = '';

    if ($wp_query instanceof WP_Query) {
        if (isset($wp_query->post) && isset($wp_query->post->post_title)) {
            $title = $wp_query->post->post_title;
        }
    }

    return $title;
}

/**
 * Get information on the current user
 *
 * @param   string  $which  Which property to get
 * @return  string
 */
function vowels_form_builder_get_current_userinfo($which)
{
    $info = '';

    $currentUser = wp_get_current_user();
    if ($currentUser->ID != 0 && strlen($which) && isset($currentUser->{$which}) && is_string($currentUser->{$which})) {
        $info = $currentUser->{$which};
    }

    return $info;
}

/**
 * Display/process the given form
 *
 * @param int|vowelsforminc $form
 * @param string|array $values
 */
function vowels($form, $values = '')
{
    if (is_string($values)) {
        $values = join('&', explode('&amp;', $values));
    }

    $id = $form instanceof vowelsforminc ? $form->getId() : absint($form);
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['vowels_form_builder_id']) && $_POST['vowels_form_builder_id'] == $id) {
        return vowels_form_builder_process_form();
    }

    if (($form instanceof vowelsforminc || ($form = vowels_form_builder_get_form(absint($form), null, $values)) instanceof vowelsforminc) && $form->getActive()) {
        return vowels_form_builder_display_form($form);
    }
}

add_shortcode('vowels', 'vowels_form_builder_shortcode');

/**
 * Process the vowelsforminc shortcode
 *
 * @param array $atts
 */
function vowels_form_builder_shortcode($atts)
{
    extract(shortcode_atts(array(
        'id' => 0,
        'values' => ''
    ), $atts ));

    if (vowels_form_builder_needs_raw_tag()) {
        return '[raw]' . vowels($id, $values) . '[/raw]';
    }

    return vowels($id, $values);
}

add_shortcode('vowels_form_builder_popup', 'vowels_form_builder_popup_shortcode');

/**
 * Process the vowelsforminc popup shortcode
 *
 * @param array $atts
 * @param string $content Trigger content/HTML
 */
function vowels_form_builder_popup_shortcode($atts, $content = null)
{
    extract(shortcode_atts(array(
        'id' => 0,
        'options' => '',
        'values' => ''
    ), $atts ));

    if (vowels_form_builder_needs_raw_tag()) {
        return '[raw]' . vowels_form_builder_popup($id, $content, $options, $values) . '[/raw]';
    }

    return vowels_form_builder_popup($id, $content, $options, $values);
}

/**
 * Displays the trigger code to display a form in Fancybox
 *
 * @param vowelsforminc|int $form The form object or form ID
 * @param string $content The trigger content/HTML
 * @param string $options Fancybox options as a JSON string
 * @param string|array $values Dynamic default values in key/value URL format or array
 */
function vowels_form_builder_popup($form, $content = '', $options = '', $values = '')
{
    if (is_string($values)) {
        $values = join('&', explode('&amp;', $values));
    }

    if (($form instanceof vowelsforminc || ($form = vowels_form_builder_get_form(absint($form), null, $values)) instanceof vowelsforminc) && $form->getActive()) {
        $form = apply_filters('vowels_form_builder_pre_display_popup', apply_filters('vowels_form_builder_pre_display_popup_' . $form->getId(), $form));
        if (!strlen($options)) $options = '{}';
        $options = apply_filters('vowels_form_builder_pre_display_popup_options', apply_filters('vowels_form_builder_pre_display_popup_options_' . $form->getId(), $options));
        $linkId = 'vowels_form_builder_fancybox_' . uniqid();
        $fancyboxWrapClass = 'vowels-fancybox-wrap' . ($form->isResponsive() ? ' vowels-fancybox-wrap-responsive' : '');

        ob_start();
        ?>
<a id="<?php echo esc_attr($linkId); ?>" class="vowels-fancybox-link vowels-fancybox-link-<?php echo $form->getId(); ?>" href="#"><?php echo do_shortcode($content); ?></a>
<script type="text/javascript">
    jQuery(document).ready(function ($) {
        var $link = $('#<?php echo esc_js($linkId); ?>');
        if ($.isFunction($.fn.fancybox) && !$link.data('vowels-initialised')) {
            $link.fancybox($.extend({
                inline: true,
                fixed: false,
                href: '#vowels-outer-<?php echo esc_js($form->getUniqId()); ?>',
                onStart: function () {
                    $('#fancybox-outer').css('opacity', 0);
                    $('#fancybox-wrap').addClass('<?php echo esc_js($fancyboxWrapClass); ?>');
                },
                onComplete: function () {
                    if (!!window.grecaptcha) {
                        $('#fancybox-content .vowels-recaptcha').each(function () {
                            try {
                                window.grecaptcha.reset($(this).data('vowels-recaptcha-id'));
                            } catch (e) {}
                        });
                    }
                    $('#fancybox-wrap, #fancybox-content').css({width: 'auto'});
                    $.fancybox.center(0);
                    setTimeout(function () {
                        $('#fancybox-outer').animate({opacity: 1}, <?php echo apply_filters('vowels_form_builder_fancybox_animate_speed_' . $form->getId(), apply_filters('vowels_form_builder_fancybox_animate_speed', 20)); ?>);
                        $('#fancybox-overlay').css({height: $(document).height()});
                    }, 1);
                },
                onClosed: function () {
                    $('#fancybox-wrap').removeClass('<?php echo esc_js($fancyboxWrapClass); ?>');
                }
            }, <?php echo $options; ?>)).data('vowels-initialised', true);
        }
		
    });
</script>
<div style="display: none;">
<?php echo vowels_form_builder_display_form($form); ?>
</div>
        <?php
        return ob_get_clean();
    }
}

add_action('wp_enqueue_scripts', 'vowels_form_builder_enqueue_styles');

/**
 * Enqueue the frontend styles
 */
function vowels_form_builder_enqueue_styles()
{
    if (!apply_filters('vowels_form_builder_enqueue_styles', true)) {
        return;
    }

    wp_enqueue_style('vowels', vowels_form_builder_plugin_url() . '/css/styles.css', array(), VOWELSFORMDRAGDROP_VERSION);

    if (!get_option('vowels_form_builder_disable_qtip_output')) {
        wp_enqueue_style('qtip', vowels_form_builder_plugin_url() . '/js/qtip2/jquery.qtip.min.css', array(), '2.2.1');
    }

    if (get_option('vowels_form_builder_fancybox_requested') && !get_option('vowels_form_builder_disable_fancybox_output')) {
        wp_enqueue_style('vowels-fancybox', vowels_form_builder_plugin_url() . '/js/fancybox/jquery.fancybox-1.3.4.css', array(), '1.3.4');
    }

    if (!get_option('vowels_form_builder_disable_uniform_output')) {
        // Check which uniform themes are active and enqueue them
        $activeUniformThemes = maybe_unserialize(get_option('vowels_form_builder_active_uniform_themes'));
        $activeUniformThemes = is_array($activeUniformThemes) ? array_unique($activeUniformThemes) : array();
        foreach ($activeUniformThemes as $key => $activeUniformTheme) {
            wp_enqueue_style('vowels-uniform-theme-' . $key, vowels_form_builder_plugin_url() . "/js/uniform/themes/$activeUniformTheme/$activeUniformTheme.css", array(), VOWELSFORMDRAGDROP_VERSION);
        }
    }

    // Check which themes are active and enqueue them
    $activeThemes = maybe_unserialize(get_option('vowels_form_builder_active_themes'));
    $activeThemes = is_array($activeThemes) ? array_unique($activeThemes) : array();
    foreach ($activeThemes as $key => $activeTheme) {
        $themeInfo = explode('|', $activeTheme);
        wp_enqueue_style('vowels-theme-' . $key, vowels_form_builder_plugin_url() . "/themes/" . $themeInfo[0] . "/" . $themeInfo[1] . ".css", array(), VOWELSFORMDRAGDROP_VERSION);
    }

    // Enqueue user custom stylesheet
    if (file_exists(VOWELSFORMDRAGDROP_PLUGIN_DIR . '/css/custom.css')) {
        wp_enqueue_style('vowels-custom', vowels_form_builder_plugin_url() . '/css/custom.css');
    }
}

add_action('wp_enqueue_scripts', 'vowels_form_builder_enqueue_scripts');

/**
 * Enqueue the frontend scripts
 */
function vowels_form_builder_enqueue_scripts()
{
    if (!apply_filters('vowels_form_builder_enqueue_scripts', true)) {
        return;
    }

    wp_enqueue_script('vowels', vowels_form_builder_plugin_url() . '/js/vowels.js', array('jquery'), VOWELSFORMDRAGDROP_VERSION, false); // jQuery is not a dependency but this will force it to the head

    if (!get_option('vowels_form_builder_disable_fileupload_output')) {
        wp_enqueue_script('blueimp-file-upload', vowels_form_builder_plugin_url() . '/js/jquery.fileupload.min.js', array('jquery-ui-widget'), '9.18.0', true);
    }

    wp_enqueue_script('vowels-plugin', vowels_form_builder_plugin_url() . '/js/jquery.vowels.js', array('jquery'), VOWELSFORMDRAGDROP_VERSION, true);

    wp_deregister_script('jquery-form');
    wp_enqueue_script('jquery-form', vowels_form_builder_plugin_url() . '/js/jquery.form.min.js', array('jquery'), '3.5.1', true);

    if (!get_option('vowels_form_builder_disable_smoothscroll_output')) {
        wp_enqueue_script('jquery-smooth-scroll', vowels_form_builder_plugin_url() . '/js/jquery.smooth-scroll.min.js', array('jquery'), '1.7.2', true);
    }

    if (!get_option('vowels_form_builder_disable_qtip_output')) {
        wp_enqueue_script('qtip', vowels_form_builder_plugin_url() . '/js/qtip2/jquery.qtip.min.js', array('jquery'), '2.2.1', true);
    }

    if (get_option('vowels_form_builder_fancybox_requested') && !get_option('vowels_form_builder_disable_fancybox_output')) {
        wp_enqueue_script('fancybox', vowels_form_builder_plugin_url() . '/js/fancybox/jquery.fancybox-1.3.4.pack.js', array('jquery'), '1.3.4', true);
    }

    $activeUniformThemes = maybe_unserialize(get_option('vowels_form_builder_active_uniform_themes'));
    if (!get_option('vowels_form_builder_disable_uniform_output') && (is_array($activeUniformThemes) && count($activeUniformThemes))) {
        wp_enqueue_script('uniform', vowels_form_builder_plugin_url() . '/js/uniform/jquery.uniform.min.js', array('jquery'), '2.1.2', true);
    }

    if (!get_option('vowels_form_builder_disable_infieldlabels_output')) {
        wp_enqueue_script('infield-label', vowels_form_builder_plugin_url() . '/js/jquery.infieldlabel.min.js', array('jquery'), '0.1', true);
    }

    $activeDatepickers = maybe_unserialize(get_option('vowels_form_builder_active_datepickers'));
    if (!get_option('vowels_form_builder_disable_jqueryui_output') && (is_array($activeDatepickers) && count($activeDatepickers))) {
        wp_enqueue_script('jquery-ui-datepicker');
    }

    $activeThemes = maybe_unserialize(get_option('vowels_form_builder_active_themes'));
    $activeThemes = is_array($activeThemes) ? array_unique($activeThemes) : array();
    foreach ($activeThemes as $key => $activeTheme) {
        $themeInfo = explode('|', $activeTheme);
        if (file_exists(VOWELSFORMDRAGDROP_PLUGIN_DIR . "/themes/" . $themeInfo[0] . "/" . $themeInfo[1] . ".js")) {
            wp_enqueue_script('vowels-theme-' . $key, vowels_form_builder_plugin_url() . "/themes/" . $themeInfo[0] . "/" . $themeInfo[1] . ".js", array(), VOWELSFORMDRAGDROP_VERSION, true);
        }
    }

    wp_localize_script('vowels-plugin', 'vowelsL10n', vowels_form_builder_js_l10n());
}

add_action('wp_ajax_nopriv_vowels_form_builder_show_form_ajax', 'vowels_form_builder_show_form_ajax');
add_action('wp_ajax_vowels_form_builder_show_form_ajax', 'vowels_form_builder_show_form_ajax');

/**
 * Displays the form via an Ajax call, for Lightboxes etc.
 *
 * @deprecated 1.3 Use vowels_form_builder_display_form_ajax()
 */
function vowels_form_builder_show_form_ajax()
{
    $id = isset($_REQUEST['id']) ? absint($_REQUEST['id']) : 0;
    $_GET['vowels_form_builder_display_form_ajax'] = $id;
    vowels_form_builder_display_form_ajax();
}

add_action('wp_loaded', 'vowels_form_builder_display_form_ajax');

/**
 * Show only the form HTML, for Lightboxes etc.
 */
function vowels_form_builder_display_form_ajax()
{
    if (isset($_GET['vowels_form_builder_display_form_ajax'])) {
        $id = absint($_GET['vowels_form_builder_display_form_ajax']);
        if (vowels_form_builder_form_exists($id)) {
            $form = vowels_form_builder_get_form($id);
            $xhtml = vowels_form_builder_display_form($form);

            header('Content-Type: text/html');
            echo $xhtml;
            exit;
        }
    }
}

/**
 * Log arguments to the PHP error log
 */
function vowels_form_builder_error_log()
{
    foreach (func_get_args() as $arg) {
        ob_start();
        var_dump($arg);
        error_log(ob_get_clean());
    }
}

/**
 * Get the list of IDs of all elements in the given group
 *
 * @param vowelsforminc $form
 * @param vowelsforminc_Element_Groupstart $group
 * @return array
 */
function vowels_form_builder_get_group_element_ids($form, $group) {
    $groupElementIds = array();
    $startCapture = false;
    $depth = 0;
    $elements = $form->getElements();

    foreach ($elements as $element) {
        if ($element instanceof vowelsforminc_Element_Groupstart) {
            if ($element->getId() == $group->getId()) {
                // We've found ths group, so start capturing element IDs
                $startCapture = true;
                $depth++;
                continue;
            } else {
                if ($startCapture) {
                    // This is another group inside it, so increment depth
                    $depth++;
                }
            }
        } elseif ($element instanceof vowelsforminc_Element_Groupend) {
            // This is a group end element so decrement depth
            if ($startCapture) {
                if (--$depth == 0) {
                    // This is the group end for our target group so we're done
                    break;
                }
            }
        } else {
            if ($startCapture) {
                $groupElementIds[] = $element->getId();
            }
        }
    }

    return $groupElementIds;
}

/**
 * Get a writable temporary directory
 *
 * This is a duplicate of the WP function get_temp_dir() because there was an issue with one
 * popular plugin manually firing the wp_ajax_* hooks before WordPress does,
 * causing this plugin to fatal error since this function was not available
 * at that time. So we'll just use the function below in all cases instead of the
 * WP function.
 *
 * @return string
 */
function vowels_form_builder_get_temp_dir()
{
    if (function_exists('get_temp_dir')) {
        return get_temp_dir();
    } else {
        static $temp;
        if ( defined('WP_TEMP_DIR') )
            return trailingslashit(WP_TEMP_DIR);

        if ( $temp )
            return trailingslashit($temp);

        $temp = WP_CONTENT_DIR . '/';
        if ( is_dir($temp) && @is_writable($temp) )
            return $temp;

        if  ( function_exists('sys_get_temp_dir') ) {
            $temp = sys_get_temp_dir();
            if ( @is_writable($temp) )
                return trailingslashit($temp);
        }

        $temp = ini_get('upload_tmp_dir');
        if ( is_dir($temp) && @is_writable($temp) )
            return trailingslashit($temp);

        $temp = '/tmp/';
        return $temp;
    }
}

if (!get_option('vowels_form_builder_disable_raw_detection')) {
    add_action('wp_loaded', 'vowels_form_builder_detect_raw_tag');
}

/**
 * Does the theme have a [raw] tag function?
 */
function vowels_form_builder_detect_raw_tag()
{
    define('VOWELSFORMDRAGDROP_RAW_TAG', trim(apply_filters('the_content', '[raw]a[/raw]')) == 'a');
}

/**
 * Checks if the the form shortcode should be wrapped in [raw] tags, specifically checks all of
 * the following are true:
 *
 * 1. The [raw] tag content filter is available in the current theme
 * 2. We are currently in the 'the_content' filter
 * 3. The form shortcode isn't already wrapped in [raw] tags
 *
 * @return boolean
 */
function vowels_form_builder_needs_raw_tag()
{
    global $post, $wp_current_filter;

    $result = defined('VOWELSFORMDRAGDROP_RAW_TAG')
              && VOWELSFORMDRAGDROP_RAW_TAG
              && isset($wp_current_filter[0], $post->post_content)
              && $wp_current_filter[0] == 'the_content'
              && !preg_match('/\[raw\].*?\[vowels.*?\[\/raw\]/', $post->post_content);

    return apply_filters('vowels_form_builder_needs_raw_tag', $result);
}

/**
 * Get the string to use as newline in the plain text emails
 *
 * @return string
 */
function vowels_form_builder_get_email_newline()
{
    return apply_filters('vowels_form_builder_email_newline', "\r\n");
}

/**
 * Escaping for strings in HTML
 *
 * @param  string $value
 * @return string
 */
function vowels_form_builder_escape($value)
{
    return _wp_specialchars($value, ENT_QUOTES, false, true);
}

/**
 * Is the current request a POST request
 *
 * @return bool
 */
function vowels_form_builder_is_post_request()
{
    return isset($_SERVER['REQUEST_METHOD']) && strtoupper($_SERVER['REQUEST_METHOD']) === 'POST';
}



/**
 * Send a JSON response
 *
 * @return mixed
 */
function vowels_form_builder_send_json($response)
{
    @header('Content-Type: application/json; charset=' . get_option('blog_charset'));

    echo vowels_form_builder_json_encode($response);
    exit;
}

// Include the admin functions if we're in the WordPress admin
if (is_admin()) {
    require_once VOWELSFORMDRAGDROP_ADMIN_DIR . '/admin.php';
}