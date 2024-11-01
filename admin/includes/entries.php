<?php if (!defined('VOWELSFORMDRAGDROP_VERSION')) exit; ?><div class="wrap">
	<div class="vowels-top-right">
        <div class="vowels-information">
        	<span class="vowels-copyright"><a href="http://www.Vowelsform.com" onclick="window.open(this.href); return false;">www.Vowelsform.com</a> &copy; <?php echo date('Y'); ?></span>
        	<span class="vowels-bug-link"><a href="http://www.Vowelsform.com/support.php" onclick="window.open(this.href); return false;"><?php esc_html_e('Report a bug','vowels-contact-form-with-drag-and-drop'); ?></a></span>
        	<span class="vowels-help-link"><a href="<?php echo vowels_form_builder_help_link(); ?>" onclick="window.open(this.href); return false;"><?php esc_html_e('Help','vowels-contact-form-with-drag-and-drop'); ?></a></span>
        </div>
    </div>
    <div class="ifb-form-icon"></div>
    <?php if ($id > 0) : ?>
        <h2 class="ifb-main-title"><span class="ifb-vowels-title"><?php echo esc_html(vowels_form_builder_get_plugin_name()); ?></span><span class="ifb-vowels-title-entries"><?php esc_html_e('Entries','vowels-contact-form-with-drag-and-drop'); ?></span><?php echo esc_html($config['name']); ?>
        <?php if (strlen($search))
            printf('<span class="subtitle">' . __('Search results for &#8220;%s&#8221;') . '</span>', esc_html($search)); ?></h2>
        <?php if (strlen($message)) : ?>
            <div id="message" class="updated below-h2">
                <p><?php echo $message; ?></p>
            </div>
        <?php endif; ?>
        <div class="vowels-global-nav-wrap qfb-cf">
        	<ul class="vowels-global-nav-ul">
                <?php if (current_user_can('vowels_form_builder_list_forms')) : ?>
                	<li><a href="admin.php?page=vowels_form_builder_forms"><span class="ifb-no-arrow"><?php esc_html_e('All Forms','vowels-contact-form-with-drag-and-drop'); ?></span></a></li>
                <?php endif; ?>
                <li>
                <div class="vowels-form-switcher">
                    <a id="vowels-form-switcher-trigger" class="ifb-form-switcher-closed"><span class="ifb-arrow-down"><?php esc_html_e('Switch Form','vowels-contact-form-with-drag-and-drop'); ?></span></a>
                        <div class="vowels-form-switcher-list">
                            <ul class="qfb-cf">
                                <?php if (current_user_can('vowels_form_builder_build_form')) : ?>
                                    <li class="vowels-create-new qfb-cf"><a title="<?php esc_attr_e('Create a new form','vowels-contact-form-with-drag-and-drop'); ?>" href="admin.php?page=vowels_form_builder_form_builder"><?php esc_html_e('Create a new form','vowels-contact-form-with-drag-and-drop'); ?><span class="ifb-add-icon"></span></a></li>
                                <?php endif; ?>
                                <?php if (count($switchForms)) : ?>
                                    <?php foreach ($switchForms as $switchForm) : ?>
                                        <li class="qfb-cf"><a title="<?php echo esc_attr($switchForm['name']); ?>" href="<?php echo esc_url(admin_url('admin.php?page=vowels_form_builder_entries&id=' . absint($switchForm['id']))); ?>"><?php echo esc_html($switchForm['name']); ?><span class="ifb-fade-overflow"></span></a></li>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </div>
                </li>
                <?php if (current_user_can('vowels_form_builder_build_form')) : ?>
                    <li>
                        <a id="vowels-builder-to-entries-link" class="ifb-hide-if-new-form" href="<?php echo admin_url('admin.php?page=vowels_form_builder_form_builder&amp;id=' . $id); ?>"><span class="ifb-no-arrow"><?php esc_html_e('Edit Form','vowels-contact-form-with-drag-and-drop'); ?></span></a>
                    </li>
                    <li>
                        <a href="<?php echo admin_url('admin.php?page=vowels_form_builder_form_builder&amp;id=' . $id . '#ifb-settings-entries'); ?>"><span class="ifb-no-arrow"><?php esc_attr_e('Edit Table Layout','vowels-contact-form-with-drag-and-drop'); ?></span></a>
                	</li>
            	<?php endif; ?>
            </ul>
             <div class="vowels-current-form">
                <span class="ifb-update-form-name"><?php echo esc_html($config['name']); ?></span><span class="ifb-update-form-id">(<?php echo esc_html($id); ?>)</span>
            </div>
        </div>

        <form id="vowels-entries-filter" method="get" action="">
        <input type="hidden" name="id" value="<?php echo $id; ?>" />
        <input type="hidden" name="page" value="vowels_form_builder_entries" />
        <ul class="subsubsub">
            <li><a href="admin.php?page=vowels_form_builder_entries&amp;id=<?php echo $id; ?>" class="<?php if (!strlen($search) && $unread === null) echo 'current'; ?>"><?php esc_html_e('All','vowels-contact-form-with-drag-and-drop'); ?> (<?php echo $allItems; ?>)</a></li>
            <li>| <a href="admin.php?page=vowels_form_builder_entries&amp;id=<?php echo $id; ?>&amp;unread=1" class="<?php if (!strlen($search) && $unread === 1) echo 'current'; ?>"><?php esc_html_e('Unread','vowels-contact-form-with-drag-and-drop'); ?> (<?php echo $unreadItems; ?>)</a></li>
            <li>| <a href="admin.php?page=vowels_form_builder_entries&amp;id=<?php echo $id; ?>&amp;unread=0" class="<?php if (!strlen($search) && $unread === 0) echo 'current'; ?>"><?php esc_html_e('Read','vowels-contact-form-with-drag-and-drop'); ?> (<?php echo $readItems; ?>)</a></li>
            <?php if (strlen($search)) : ?>
                <li>| <a href="admin.php?page=vowels_form_builder_entries&amp;id=<?php echo $id; ?>" class="<?php echo 'current'; ?>"><?php esc_html_e('Search results','vowels-contact-form-with-drag-and-drop'); ?> (<?php echo $totalItems; ?>)</a></li>
            <?php endif; ?>
        </ul>
        <p class="search-box entry-search-box-wrap">
            <input class="entry-search-box" type="text" value="<?php _admin_search_query(); ?>" name="s" />
            <input type="submit" value="<?php esc_attr_e('Search Entries','vowels-contact-form-with-drag-and-drop'); ?>" class="button entry-search-submit" name="" />
        </p>
        <div class="tablenav top">
            <div class="alignleft actions">
                <select id="vowels-bulk-action" name="bulk_action">
                    <option selected="selected" value="-1"><?php esc_html_e('Bulk Actions','vowels-contact-form-with-drag-and-drop'); ?></option>
                    <option value="read"><?php esc_html_e('Mark as read','vowels-contact-form-with-drag-and-drop'); ?></option>
                    <option value="unread"><?php esc_html_e('Mark as unread','vowels-contact-form-with-drag-and-drop'); ?></option>
                    <?php if (current_user_can('vowels_form_builder_delete_entry')) : ?>
                        <option value="delete"><?php esc_html_e('Delete','vowels-contact-form-with-drag-and-drop'); ?></option>
                    <?php endif; ?>
                </select>
                <input type="submit" value="<?php esc_attr_e('Apply','vowels-contact-form-with-drag-and-drop'); ?>" class="button-secondary action vowels-bulk-delete-entry-go" id="doaction" name="" />
                <select id="vowels-filter-epp" name="epp">
                    <option value="10" <?php selected($limit, 10); ?>>10</option>
                    <option value="20" <?php selected($limit, 20); ?>>20</option>
                    <option value="40" <?php selected($limit, 40); ?>>40</option>
                    <option value="60" <?php selected($limit, 60); ?>>60</option>
                    <option value="80" <?php selected($limit, 80); ?>>80</option>
                    <option value="100" <?php selected($limit, 100); ?>>100</option>
                    <option value="1000000" <?php selected($limit, 1000000); ?>><?php esc_html_e('All','vowels-contact-form-with-drag-and-drop'); ?></option>
                </select>
                <span class="vowels-entries-per-page"><?php esc_html_e('per page','vowels-contact-form-with-drag-and-drop'); ?></span>
            </div>
            <?php echo $topPagination; ?>
            <br class="clear" />
        </div> <!-- /.tablenav top -->

        <table cellspacing="0" class="wp-list-table widefat fixed vowels-entries-list-table">
            <thead>
                <tr>
                    <td class="manage-column column-cb check-column" id="cb" scope="col">
                        <label class="screen-reader-text" for="cb-select-all-1"><?php esc_html_e('Select All','vowels-contact-form-with-drag-and-drop'); ?></label>
                        <input id="cb-select-all-1" type="checkbox" />
                    </td>
                    <?php ob_start(); ?>
                        <?php foreach ($columns as $column) :
                                $columnId = ($column['type'] == 'element') ? 'element_'.$column['id'] : $column['id'];
                            ?>
                            <?php if ($columnId == $orderby) : ?>
                                <th class="manage-column column-<?php echo $columnId; ?> sorted <?php echo $order; ?>" scope="col">
                                    <a href="<?php echo esc_url(add_query_arg(array('orderby' => $columnId, 'order' => strtolower($reverseOrder)))); ?>">
                            <?php else : ?>
                                <th class="manage-column column-<?php echo $columnId; ?> sortable desc" scope="col">
                                    <a href="<?php echo esc_url(add_query_arg(array('orderby' => $columnId, 'order' => 'asc'))); ?>">
                            <?php endif; ?>
                                    <span><?php echo esc_html($column['label']); ?></span>
                                    <span class="sorting-indicator"></span>
                                    </a>
                                </th>

                        <?php endforeach; ?>
                    <?php echo $headings = ob_get_clean(); ?>
                </tr>
            </thead>

            <tfoot>
                <tr>
                    <td class="manage-column column-cb check-column" scope="col">
                        <label class="screen-reader-text" for="cb-select-all-2"><?php esc_html_e('Select All','vowels-contact-form-with-drag-and-drop'); ?></label>
                        <input id="cb-select-all-2" type="checkbox" />
                    </td>
                    <?php echo $headings; ?>
                </tr>
            </tfoot>

            <tbody id="the-list">
                <?php if (count($entries)) : ?>
                    <?php $i = 1; ?>
                    <?php foreach ($entries as $entry) : ?>
                        <tr valign="top" class="<?php echo (++$i % 2 == 1) ? 'alternate' : ''; ?> <?php if ($entry->unread == 1) echo 'vowels-unread-entry'; ?>" id="vowels-<?php echo $entry->id; ?>">
                            <th class="check-column" scope="row">
                                <input type="checkbox" value="<?php echo $entry->id; ?>" name="entry[]" />
                            </th>
                            <?php $j = 0; foreach ($columns as $column) : ?>
                                <td class="vowels-entry-cell vowels-entry-cell-<?php echo $column['id']; ?>">
                                    <?php if ($j == 1) : ?>
                                        <a class="vowels-row-title" title="<?php esc_attr_e('View this entry','vowels-contact-form-with-drag-and-drop'); ?>" href="<?php echo esc_url(add_query_arg(array('action' => 'entry', 'entry_id' => $entry->id, 'id' => $id))); ?>">
                                    <?php endif; ?>
                                    <?php
                                        if ($column['type'] == 'element') {
                                            $key = 'element_' . $column['id'];
                                            echo $entry->$key;
                                        } else {
                                            switch ($column['id']) {
                                                case 'date_added':
                                                    echo vowels_form_builder_format_date($entry->date_added, true);
                                                    break;
                                                case 'user_email':
                                                    if (strlen($entry->user_email)) {
                                                        echo '<a href="mailto:' . esc_attr($entry->user_email) . '">' . esc_html($entry->user_email) . '</a>';
                                                    }
                                                    break;
                                                default:
                                                    echo $entry->{$column['id']};
                                                    break;
                                            }
                                        }
                                    ?>
                                    <?php if ($j == 1) : ?>
                                        </a>
                                        <div class="row-actions">
                                            <span class="view"><a href="<?php echo esc_url(add_query_arg(array('action' => 'entry', 'entry_id' => $entry->id, 'id' => $id), $currentUrl)); ?>" title="<?php esc_attr_e('View this entry','vowels-contact-form-with-drag-and-drop'); ?>"><?php esc_html_e('View','vowels-contact-form-with-drag-and-drop'); ?></a> |</span>
                                            <?php if ($entry->unread == 1) : ?>
                                                <span class="mark-read"><a href="<?php echo esc_url(add_query_arg(array('action' => 'read', 'entry_id' => $entry->id, 'id' => $id, '_wpnonce' => wp_create_nonce('vowels_form_builder_entry_read_' . $entry->id)), $currentUrl)); ?>" title="<?php esc_attr_e('Mark as read','vowels-contact-form-with-drag-and-drop'); ?>"><?php esc_html_e('Mark as read','vowels-contact-form-with-drag-and-drop'); ?></a></span>
                                            <?php else : ?>
                                                <span class="mark-unread"><a href="<?php echo esc_url(add_query_arg(array('action' => 'unread', 'entry_id' => $entry->id, 'id' => $id, '_wpnonce' => wp_create_nonce('vowels_form_builder_entry_unread_' . $entry->id)), $currentUrl)); ?>" title="<?php esc_attr_e('Mark as unread','vowels-contact-form-with-drag-and-drop'); ?>"><?php esc_html_e('Mark as unread','vowels-contact-form-with-drag-and-drop'); ?></a></span>
                                            <?php endif; ?>
                                            <?php if (current_user_can('vowels_form_builder_delete_entry')) : ?>
                                                <span class="trash">| <a class="submitdelete vowels-delete-entry" title="<?php esc_attr_e('Delete this entry','vowels-contact-form-with-drag-and-drop'); ?>" href="<?php echo esc_url(add_query_arg(array('action' => 'delete', 'entry_id' => $entry->id, 'id' => $id, '_wpnonce' => wp_create_nonce('vowels_form_builder_entry_delete_' . $entry->id)), $currentUrl)); ?>"><?php esc_html_e('Delete','vowels-contact-form-with-drag-and-drop'); ?></a></span>
                                            <?php endif; ?>
                                        </div>
                                    <?php endif; ?>
                                </td>
                            <?php $j++; endforeach; ?>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr class="no-items">
                        <td colspan="<?php echo (count($columns) + 1); ?>" class="colspanchange"><p><?php esc_html_e('No entries found.','vowels-contact-form-with-drag-and-drop'); ?></p></td>
                    </tr>
                <?php endif; ?>
                </tbody>
        </table> <!-- /.wp-list-table -->

        <div class="tablenav bottom">
            <div class="alignleft actions">
                <select id="vowels-bulk-action2" name="bulk_action2">
                    <option selected="selected" value="-1"><?php esc_html_e('Bulk Actions','vowels-contact-form-with-drag-and-drop'); ?></option>
                    <option value="read"><?php esc_html_e('Mark as read','vowels-contact-form-with-drag-and-drop'); ?></option>
                    <option value="unread"><?php esc_html_e('Mark as unread','vowels-contact-form-with-drag-and-drop'); ?></option>
                    <?php if (current_user_can('vowels_form_builder_delete_entry')) : ?>
                        <option value="delete"><?php esc_html_e('Delete','vowels-contact-form-with-drag-and-drop'); ?></option>
                    <?php endif; ?>
                </select>
                <input type="submit" value="<?php esc_attr_e('Apply','vowels-contact-form-with-drag-and-drop'); ?>" class="button-secondary action vowels-bulk-delete-entry-go2" id="doaction2" name="" />
            </div>
            <?php echo $bottomPagination; ?>
            <br class="clear" />
        </div> <!-- /.tablenav bottom -->

        </form>
    <?php else : ?>
        <h2 class="ifb-main-title"><span class="ifb-vowels-title">Vowelsform</span><?php esc_html_e('Entries','vowels-contact-form-with-drag-and-drop'); ?></h2>
        <?php echo '<div class="vowels-admin-notice error"><p><strong>' . sprintf(esc_html__('I couldn\'t find any forms, do you want to %screate one%s?', 'vowels-contact-form-with-drag-and-drop'), '<a href="' . admin_url('admin.php?page=vowels_form_builder_form_builder') . '">', '</a>') . '</strong></p></div>'; ?>
    <?php endif; ?>
</div>