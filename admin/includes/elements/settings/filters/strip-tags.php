<?php if (!defined('VOWELSFORMDRAGDROP_VERSION')) exit; ?><div id="ifb-filter-wrap-<?php echo $filter['element_id']; ?>-<?php echo $filter['id']; ?>" class="ifb-filter ifb-filter-striptags">
    <div class="ifb-filter-actions">
        <a class="ifb-filter-close-link" title="<?php esc_attr_e('Hide filter settings','vowels-contact-form-with-drag-and-drop'); ?>" href="#" onclick="vowelsforminc.hideFilterSettings(<?php echo $filter['element_id']; ?>, <?php echo $filter['id']; ?>); return false;"><span></span><?php esc_html_e('Hide','vowels-contact-form-with-drag-and-drop'); ?></a>
        <a class="ifb-filter-settings-link" title="<?php esc_attr_e('Settings','vowels-contact-form-with-drag-and-drop'); ?>" href="#" onclick="vowelsforminc.showFilterSettings(<?php echo $filter['element_id']; ?>, <?php echo $filter['id']; ?>); return false;"><span></span><?php esc_html_e('Settings','vowels-contact-form-with-drag-and-drop'); ?></a>
        <a class="ifb-filter-delete-link" title="<?php esc_attr_e('Delete this filter','vowels-contact-form-with-drag-and-drop'); ?>" href="#" onclick="vowelsforminc.deleteFilter(vowelsforminc.getElementById(<?php echo $filter['element_id']; ?>), <?php echo $filter['id']; ?>); return false;"><?php esc_html_e('Delete','vowels-contact-form-with-drag-and-drop'); ?></a>
    </div>
    <?php if (!isset($filter['name'])) $filter['name'] = _x('Strip Tags', 'the name of strip tags filter which filters out HTML tags','vowels-contact-form-with-drag-and-drop'); ?>
    <div class="ifb-filter-title"><?php echo esc_html($filter['name']); ?></div>
    <div class="ifb-filter-settings">
        <table class="ifb-form-table ifb-filter-settings-form-table">
            <?php if (!isset($filter['allowable_tags'])) $filter['allowable_tags'] = ''; ?>
            <tr valign="top">
                <th scope="row">
                    <div class="ifb-tooltip">
                        <div class="ifb-tooltip-content">
                            <?php esc_html_e('Enter allowable tags, one after the other, for example:','vowels-contact-form-with-drag-and-drop'); ?>
                            <pre>&lt;p&gt;&lt;br&gt;&lt;span&gt;</pre>
                        </div>
                    </div>
                    <label for="f_allowable_tags_<?php echo $filter['element_id']; ?>_<?php echo $filter['id']; ?>"><?php esc_html_e('Allowable tags','vowels-contact-form-with-drag-and-drop'); ?></label>
                </th>
                <td>
                    <input type="text" id="f_allowable_tags_<?php echo $filter['element_id']; ?>_<?php echo $filter['id']; ?>" name="allowable_tags_<?php echo $filter['element_id']; ?>_<?php echo $filter['id']; ?>" value="<?php echo esc_attr($filter['allowable_tags']); ?>" />
                </td>
            </tr>
        </table>
    </div>
</div>