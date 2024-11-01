<?php
if (!defined('VOWELSFORMDRAGDROP_VERSION')) exit;
if (!isset($element['filters'])) $element['filters'] = array();
$invalidFilters = vowels_form_builder_get_invalid_filter_types($element);
?>
<tr valign="top">
    <th scope="row">
        <div class="ifb-tooltip"><div class="ifb-tooltip-content">
            <?php esc_html_e('Filters allow you to strip various characters from the submitted form data','vowels-contact-form-with-drag-and-drop'); ?>
        </div></div>
        <label><?php esc_html_e('Filters','vowels-contact-form-with-drag-and-drop'); ?></label>
    </th>
    <td>
        <div id="ifb-filters-<?php echo $id; ?>">
            <?php if (count($element['filters'])) : ?>
                <?php foreach ($element['filters'] as $filter) : ?>
                    <?php
                        switch ($filter['type']) {
                            case 'alpha':
                                include VOWELSFORMDRAGDROP_ADMIN_INCLUDES_DIR . '/elements/settings/filters/alpha.php';
                                break;
                            case 'alphaNumeric':
                                include VOWELSFORMDRAGDROP_ADMIN_INCLUDES_DIR . '/elements/settings/filters/alpha-numeric.php';
                                break;
                            case 'digits':
                                include VOWELSFORMDRAGDROP_ADMIN_INCLUDES_DIR . '/elements/settings/filters/digits.php';
                                break;
                            case 'stripTags':
                                include VOWELSFORMDRAGDROP_ADMIN_INCLUDES_DIR . '/elements/settings/filters/strip-tags.php';
                                break;
                            case 'trim':
                                include VOWELSFORMDRAGDROP_ADMIN_INCLUDES_DIR . '/elements/settings/filters/trim.php';
                                break;
                            case 'regex':
                                include VOWELSFORMDRAGDROP_ADMIN_INCLUDES_DIR . '/elements/settings/filters/regex.php';
                                break;
                        }
                    ?>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        <div class="ifb-filters-empty ifb-info-message" id="ifb-filters-empty-<?php echo $id; ?>" <?php if (count($element['filters'])) echo 'style="display: none;"'; ?>><span class="ifb-info-message-icon"></span><?php esc_html_e('No filters.','vowels-contact-form-with-drag-and-drop'); ?></div>
    </td>
</tr>
<tr valign="top">
    <th scope="row"><label><?php esc_html_e('Add a filter','vowels-contact-form-with-drag-and-drop'); ?></label></th>
    <td class="ifb-add-filter-list">
        <?php if (!in_array('alpha', $invalidFilters)) : ?>
            <a class="ifb-button ifb-simple-tooltip" title="<?php esc_attr_e('Removes any non-alphabet characters','vowels-contact-form-with-drag-and-drop'); ?>" onclick="vowelsforminc.addFilter(vowelsforminc.getElementById(<?php echo $id; ?>), 'alpha');"><?php esc_html_e('Alpha','vowels-contact-form-with-drag-and-drop'); ?></a>
        <?php endif; ?>
        <?php if (!in_array('alphaNumeric', $invalidFilters)) : ?>
            <a class="ifb-button ifb-simple-tooltip" title="<?php esc_attr_e('Removes any non-alphabet characters and non-digits','vowels-contact-form-with-drag-and-drop'); ?>" onclick="vowelsforminc.addFilter(vowelsforminc.getElementById(<?php echo $id; ?>), 'alphaNumeric');"><?php esc_html_e('Alpha Numeric','vowels-contact-form-with-drag-and-drop'); ?></a>
        <?php endif; ?>
        <?php if (!in_array('digits', $invalidFilters)) : ?>
            <a class="ifb-button ifb-simple-tooltip" title="<?php esc_attr_e('Removes any non-digits','vowels-contact-form-with-drag-and-drop'); ?>" onclick="vowelsforminc.addFilter(vowelsforminc.getElementById(<?php echo $id; ?>), 'digits');"><?php esc_html_e('Digits','vowels-contact-form-with-drag-and-drop'); ?></a>
        <?php endif; ?>
        <?php if (!in_array('stripTags', $invalidFilters)) : ?>
            <a class="ifb-button ifb-simple-tooltip" title="<?php esc_attr_e('Removes any HTML tags','vowels-contact-form-with-drag-and-drop'); ?>" onclick="vowelsforminc.addFilter(vowelsforminc.getElementById(<?php echo $id; ?>), 'stripTags');"><?php esc_html_e('Strip Tags','vowels-contact-form-with-drag-and-drop'); ?></a>
        <?php endif; ?>
        <?php if (!in_array('trim', $invalidFilters)) : ?>
            <a class="ifb-button ifb-simple-tooltip" title="<?php esc_attr_e('Removes white space from the start and end','vowels-contact-form-with-drag-and-drop'); ?>" onclick="vowelsforminc.addFilter(vowelsforminc.getElementById(<?php echo $id; ?>), 'trim');"><?php esc_html_e('Trim','vowels-contact-form-with-drag-and-drop'); ?></a>
        <?php endif; ?>
        <?php if (!in_array('regex', $invalidFilters)) : ?>
            <a class="ifb-button ifb-simple-tooltip" title="<?php esc_attr_e('Removes characters matching the given regular expression','vowels-contact-form-with-drag-and-drop'); ?>" onclick="vowelsforminc.addFilter(vowelsforminc.getElementById(<?php echo $id; ?>), 'regex');"><?php esc_html_e('Regex','vowels-contact-form-with-drag-and-drop'); ?></a>
        <?php endif; ?>
    </td>
</tr>