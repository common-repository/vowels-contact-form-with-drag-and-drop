<?php if (!defined('VOWELSFORMDRAGDROP_VERSION')) exit; ?><div class="wrap">
	<div class="vowels-top-right">
        <div class="vowels-information">
        	<span class="vowels-copyright"><a href="http://www.Vowelsform.com" onclick="window.open(this.href); return false;">www.Vowelsform.com</a> &copy; <?php echo date('Y'); ?></span>
        	<span class="vowels-bug-link"><a href="http://www.Vowelsform.com/support.php" onclick="window.open(this.href); return false;"><?php esc_html_e('Report a bug','vowels-contact-form-with-drag-and-drop'); ?></a></span>
        	<span class="vowels-help-link"><a href="<?php echo vowels_form_builder_help_link(); ?>" onclick="window.open(this.href); return false;"><?php esc_html_e('Help','vowels-contact-form-with-drag-and-drop'); ?></a></span>
        </div>
    </div>
    <div class="ifb-form-icon"></div>
    <h2 class="ifb-main-title">
        <span class="ifb-vowels-title"><?php echo esc_html(vowels_form_builder_get_plugin_name()); ?></span><span class="ifb-vowels-title-forms"><?php esc_html_e('Forms','vowels-contact-form-with-drag-and-drop'); ?></span>
        <?php if (current_user_can('vowels_form_builder_build_form')) : ?>
            <a href="admin.php?page=vowels_form_builder_form_builder" class="ifb-add-new-form-button"><?php esc_html_e('Add New','vowels-contact-form-with-drag-and-drop'); ?><span class="ifb-add-icon"></span></a>
        <?php endif; ?>
    </h2>
    <?php if (strlen($message)) : ?>
        <div id="message" class="updated below-h2">
            <p><?php echo $message; ?></p>
        </div>
    <?php endif; ?>
    <form method="post" action="">

    <?php vowels_form_builder_global_nav('forms'); ?>
	<div class="vowels-global-sub-nav-wrap qfb-cf">
        <ul class="vowels-global-sub-nav-ul">
            <li><a href="admin.php?page=vowels_form_builder_forms" class="<?php echo $active === null ? 'current' : ''; ?>"><?php esc_html_e('All','vowels-contact-form-with-drag-and-drop'); ?> <span class="count">(<?php echo vowels_form_builder_get_form_count(); ?>)</span></a></li>
            <li><a href="admin.php?page=vowels_form_builder_forms&amp;active=1" class="<?php echo $active === 1 ? 'current' : ''; ?>"><?php esc_html_e('Active','vowels-contact-form-with-drag-and-drop'); ?> <span class="count">(<?php echo vowels_form_builder_get_form_count(1); ?>)</span></a></li>
            <li><a href="admin.php?page=vowels_form_builder_forms&amp;active=0" class="<?php echo $active === 0 ? 'current' : ''; ?>"><?php esc_html_e('Inactive','vowels-contact-form-with-drag-and-drop'); ?> <span class="count">(<?php echo vowels_form_builder_get_form_count(0); ?>)</span></a></li>
        </ul>
    </div>

    <div class="tablenav top">
        <div class="alignleft actions">
            <select id="vowels-bulk-action" name="bulk_action">
                <option selected="selected" value="-1"><?php esc_html_e('Bulk Actions','vowels-contact-form-with-drag-and-drop'); ?></option>
                <?php if (current_user_can('vowels_form_builder_build_form')) : ?>
                    <option value="activate"><?php esc_html_e('Activate','vowels-contact-form-with-drag-and-drop'); ?></option>
                    <option value="deactivate"><?php esc_html_e('Deactivate','vowels-contact-form-with-drag-and-drop'); ?></option>
                <?php endif; ?>
                <?php if (current_user_can('vowels_form_builder_delete_form')) : ?>
                    <option value="delete"><?php esc_html_e('Delete','vowels-contact-form-with-drag-and-drop'); ?></option>
                <?php endif; ?>
            </select>
            <input type="submit" value="<?php esc_attr_e('Apply','vowels-contact-form-with-drag-and-drop'); ?>" class="button-secondary action vowels-bulk-delete-go" id="doaction" name="" />
        </div>
        <br class="clear" />
    </div> <!-- /.tablenav top -->

    <table cellspacing="0" class="wp-list-table widefat fixed vowels-list-table">
        <thead>
            <tr>
                <td class="manage-column column-cb check-column" id="cb" scope="col">
                    <label class="screen-reader-text" for="cb-select-all-1"><?php esc_html_e('Select All','vowels-contact-form-with-drag-and-drop'); ?></label>
                    <input id="cb-select-all-1" type="checkbox" />
                </td>
                <th class="manage-column column-id" id="id" scope="col">
                    <?php esc_html_e('ID','vowels-contact-form-with-drag-and-drop'); ?>
                </th>
                <th class="manage-column column-name" id="name" scope="col">
                    <?php esc_html_e('Name','vowels-contact-form-with-drag-and-drop'); ?>
                </th>
                <th class="manage-column column-entries" id="entries" scope="col">
                    <?php esc_html_e('Entries','vowels-contact-form-with-drag-and-drop'); ?>
                </th>
                <th class="manage-column column-active" id="active" scope="col">
                    <?php esc_html_e('Active','vowels-contact-form-with-drag-and-drop'); ?>
                </th>
            </tr>
        </thead>

        <tfoot>
            <tr>
                <td class="manage-column column-cb check-column" scope="col">
                    <label class="screen-reader-text" for="cb-select-all-2"><?php esc_html_e('Select All','vowels-contact-form-with-drag-and-drop'); ?></label>
                    <input id="cb-select-all-2" type="checkbox" />
                </td>
                <th class="manage-column column-id" scope="col">
                    <?php esc_html_e('ID','vowels-contact-form-with-drag-and-drop'); ?>
                </th>
                <th class="manage-column column-name" scope="col">
                    <?php esc_html_e('Name','vowels-contact-form-with-drag-and-drop'); ?>
                </th>
                <th class="manage-column column-entries" scope="col">
                    <?php esc_html_e('Entries','vowels-contact-form-with-drag-and-drop'); ?>
                </th>
                <th class="manage-column column-active" scope="col">
                    <?php esc_html_e('Active','vowels-contact-form-with-drag-and-drop'); ?>
                </th>
            </tr>
        </tfoot>

        <tbody id="the-list">
            <?php if (count($forms)) : ?>
                <?php $i = 1; ?>
                <?php foreach ($forms as $row) : ?>
                    <?php $config = unserialize($row->config); ?>
                    <tr valign="top" class="<?php echo (++$i % 2 == 1) ? 'alternate' : ''; ?>" id="vowels-<?php echo $row->id; ?>">
                        <th class="check-column" scope="row">
                            <input type="checkbox" value="<?php echo $row->id; ?>" name="form[]" />
                        </th>
                        <td class="vowels-id">
                            <?php echo esc_html($row->id); ?>
                        </td>
                        <td class="vowels-name">
                            <?php if (current_user_can('vowels_form_builder_build_form')) : ?>
                                <strong><a title="<?php echo esc_attr($config['name']); ?>" href="admin.php?page=vowels_form_builder_form_builder&amp;id=<?php echo $row->id; ?>"><?php echo esc_html($config['name']); ?></a></strong>
                            <?php else : ?>
                                <strong><?php echo esc_html($config['name']); ?></strong>
                            <?php endif; ?>
                            <div class="row-actions">
                                <?php if (current_user_can('vowels_form_builder_build_form')) : ?>
                                    <span class="edit"><a href="admin.php?page=vowels_form_builder_form_builder&amp;id=<?php echo $row->id; ?>" title="<?php esc_attr_e('Edit this form','vowels-contact-form-with-drag-and-drop'); ?>"><?php esc_html_e('Edit','vowels-contact-form-with-drag-and-drop'); ?></a> |</span>
                                <?php endif; ?>
                                <?php if (current_user_can('vowels_form_builder_preview_form')) : ?>
                                    <span class="view"><a href="?vowels_form_builder_preview=1&amp;id=<?php echo $row->id; ?>" title="<?php esc_attr_e('Preview this form','vowels-contact-form-with-drag-and-drop'); ?>"><?php esc_html_e('Preview','vowels-contact-form-with-drag-and-drop'); ?></a> |</span>
                                <?php endif; ?>
                                <?php if (current_user_can('vowels_form_builder_view_entries')) : ?>
                                    <span class="entries"><a href="admin.php?page=vowels_form_builder_entries&amp;id=<?php echo $row->id; ?>" title="<?php esc_attr_e('View submitted form entries','vowels-contact-form-with-drag-and-drop'); ?>"><?php esc_html_e('Entries','vowels-contact-form-with-drag-and-drop'); ?></a> |</span>
                                <?php endif; ?>
                                <?php if (current_user_can('vowels_form_builder_build_form')) : ?>
                                    <?php if ($row->active == 1) : ?>
                                        <span class="deactivate"><a href="admin.php?page=vowels_form_builder_forms&amp;action=deactivate&amp;id=<?php echo $row->id; ?>&amp;_wpnonce=<?php echo wp_create_nonce('vowels_form_builder_deactivate_form_' . $row->id); ?>" title="<?php esc_attr_e('Deactivate this form','vowels-contact-form-with-drag-and-drop'); ?>"><?php esc_html_e('Deactivate','vowels-contact-form-with-drag-and-drop'); ?></a> |</span>
                                    <?php else : ?>
                                        <span class="activate"><a href="admin.php?page=vowels_form_builder_forms&amp;action=activate&amp;id=<?php echo $row->id; ?>&amp;_wpnonce=<?php echo wp_create_nonce('vowels_form_builder_activate_form_' . $row->id); ?>" title="<?php esc_attr_e('Activate this form','vowels-contact-form-with-drag-and-drop'); ?>"><?php esc_html_e('Activate','vowels-contact-form-with-drag-and-drop'); ?></a> |</span>
                                    <?php endif; ?>
                                    <span class="duplicate"><a href="admin.php?page=vowels_form_builder_forms&amp;action=duplicate&amp;id=<?php echo $row->id; ?>&amp;_wpnonce=<?php echo wp_create_nonce('vowels_form_builder_duplicate_form_' . $row->id); ?>" title="<?php esc_attr_e('Duplicate this form','vowels-contact-form-with-drag-and-drop'); ?>"><?php esc_html_e('Duplicate','vowels-contact-form-with-drag-and-drop'); ?></a> |</span>
                                <?php endif; ?>
                                <?php if (current_user_can('vowels_form_builder_export')) : ?>
                                    <span class="export"><a href="admin.php?page=vowels_form_builder_export&amp;action=form&amp;id=<?php echo $row->id; ?>" title="<?php esc_attr_e('Export this form','vowels-contact-form-with-drag-and-drop'); ?>"><?php esc_html_e('Export','vowels-contact-form-with-drag-and-drop'); ?></a> |</span>
                                <?php endif; ?>
                                <?php if (current_user_can('vowels_form_builder_delete_form')) : ?>
                                    <span class="trash"><a class="submitdelete vowels-delete-form" title="<?php esc_attr_e('Delete this form','vowels-contact-form-with-drag-and-drop'); ?>" href="admin.php?page=vowels_form_builder_forms&amp;action=delete&amp;id=<?php echo $row->id; ?>&amp;_wpnonce=<?php echo wp_create_nonce('vowels_form_builder_delete_form_' . $row->id); ?>"><?php esc_html_e('Delete','vowels-contact-form-with-drag-and-drop'); ?></a></span>
                                <?php endif; ?>
                            </div>
                        </td>
                        <td class="vowels-entries">
                            <?php
                                $unreadCount = vowels_form_builder_get_form_entry_count($row->id, 1);
                                if ($unreadCount > 0) {
                                    $entryCellOutput = '<span class="vowels-forms-num-unread">' . sprintf(esc_html__('%d unread', 'vowels-contact-form-with-drag-and-drop'), $unreadCount) . '</span>';
                                } else {
                                	$count = vowels_form_builder_get_form_entry_count($row->id);
                                    $entryCellOutput = esc_html(sprintf(_n('%d entry', '%d entries', $count, 'vowels-contact-form-with-drag-and-drop'), $count));
                                }
                            ?>
                            <?php if (current_user_can('vowels_form_builder_view_entries')) : ?>
                                <a href="<?php echo admin_url('admin.php?page=vowels_form_builder_entries&amp;id=' . $row->id); ?>"><?php echo $entryCellOutput; ?></a>
                            <?php else : ?>
                                <?php echo $entryCellOutput; ?>
                            <?php endif; ?>
                        </td>
                        <td class="vowels-active">
                            <?php if ($row->active == 1) : ?>
                                <?php esc_html_e('Yes','vowels-contact-form-with-drag-and-drop'); ?>
                            <?php else : ?>
                                <?php esc_html_e('No','vowels-contact-form-with-drag-and-drop'); ?>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr class="no-items">
                    <td colspan="4" class="colspanchange"><p><?php printf(esc_html__('No forms found, %sclick here to create one%s.', 'vowels-contact-form-with-drag-and-drop'), '<a href="admin.php?page=vowels_form_builder_form_builder">', '</a>'); ?></p></td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table> <!-- /.wp-list-table -->

    <div class="tablenav bottom">
        <div class="alignleft actions">
            <select id="vowels-bulk-action2" name="bulk_action2">
                <option selected="selected" value="-1"><?php esc_html_e('Bulk Actions','vowels-contact-form-with-drag-and-drop'); ?></option>
                <?php if (current_user_can('vowels_form_builder_build_form')) : ?>
                    <option value="activate"><?php esc_html_e('Activate','vowels-contact-form-with-drag-and-drop'); ?></option>
                    <option value="deactivate"><?php esc_html_e('Deactivate','vowels-contact-form-with-drag-and-drop'); ?></option>
                <?php endif; ?>
                <?php if (current_user_can('vowels_form_builder_delete_form')) : ?>
                    <option value="delete"><?php esc_html_e('Delete','vowels-contact-form-with-drag-and-drop'); ?></option>
                <?php endif; ?>
            </select>
            <input type="submit" value="<?php esc_attr_e('Apply','vowels-contact-form-with-drag-and-drop'); ?>" class="button-secondary action vowels-bulk-delete-go2" id="doaction2" name="" />
        </div>
        <br class="clear" />
    </div> <!-- /.tablenav bottom -->

    </form>
</div> <!-- /.wrap -->