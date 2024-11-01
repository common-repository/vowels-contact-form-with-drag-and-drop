<?php if (!defined('VOWELSFORMDRAGDROP_VERSION')) exit; ?><div class="wrap">
	<div class="vowels-top-right">
        <div class="vowels-information">
        	<span class="vowels-copyright"><a href="http://www.Vowelsform.com" onclick="window.open(this.href); return false;">www.Vowelsform.com</a> &copy; <?php echo date('Y'); ?></span>
        	<span class="vowels-bug-link"><a href="http://www.Vowelsform.com/support.php" onclick="window.open(this.href); return false;"><?php esc_html_e('Report a bug','vowels-contact-form-with-drag-and-drop'); ?></a></span>
        	<span class="vowels-help-link"><a href="<?php echo vowels_form_builder_help_link(); ?>" onclick="window.open(this.href); return false;"><?php esc_html_e('Help','vowels-contact-form-with-drag-and-drop'); ?></a></span>
        </div>
    </div>
    <div class="ifb-form-icon"></div>
    <h2 class="ifb-main-title"><span class="ifb-vowels-title"><?php echo esc_html(vowels_form_builder_get_plugin_name()); ?></span>
    <?php
    if ($action === 'form') {
        esc_html_e('Export form','vowels-contact-form-with-drag-and-drop');
    } else {
        esc_html_e('Export entries','vowels-contact-form-with-drag-and-drop');
    }
    ?>
    </h2>

    <?php vowels_form_builder_global_nav('export'); ?>

    <div class="vowels-global-sub-nav-wrap qfb-cf">
        <ul class="vowels-global-sub-nav-ul">
            <li><a href="admin.php?page=vowels_form_builder_export&amp;action=entries" class="<?php if ($action === 'entries') echo 'current'; ?>"><span class="ifb-no-arrow"><?php esc_html_e('Export Entries','vowels-contact-form-with-drag-and-drop'); ?></span></a></li>
            <li><a href="admin.php?page=vowels_form_builder_export&amp;action=form" class="<?php if ($action === 'form') echo 'current'; ?>"><span class="ifb-no-arrow"><?php esc_html_e('Export Form','vowels-contact-form-with-drag-and-drop'); ?></span></a></li>
        </ul>
    </div>

    <div class="vowels-export-content">
        <?php if ($action === 'entries') : ?>
            <div class="vowels-export-entries">
                <form action="" method="post">
                    <input type="hidden" name="page" value="vowels_form_builder_export" />
                    <input type="hidden" name="action" value="entries" />
                    <?php if (count($switchForms)) : ?>
                        <div class="vowels-export-entries-inner qfb-cf">
                        	<div class="vowels-export-entries-left">
                                <h3 class="ifb-export-sub-head"><?php esc_html_e('Select a form to export entries from','vowels-contact-form-with-drag-and-drop'); ?></h3>
                                <div class="qfb-cf">
                                    <select id="export_entries_form_id" name="form_id">
                                        <option value=""><?php esc_html_e('Please select','vowels-contact-form-with-drag-and-drop'); ?></option>
                                        <?php foreach ($switchForms as $switchForm) : ?>
                                            <option value="<?php echo absint($switchForm['id']); ?>"><?php echo esc_html($switchForm['name']); ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="vowels-export-entries-loading"></div>
                                </div>
                                <div id="vowels-export-entries-fields-wrap">
                                    <h3 class="ifb-export-sub-head"><?php esc_html_e('Choose which fields to export','vowels-contact-form-with-drag-and-drop'); ?></h3>
                                    <div class="vowels-export-all-fields"><label for="export_all_fields"><input type="checkbox" id="export_all_fields" /> <?php esc_html_e('Tick all','vowels-contact-form-with-drag-and-drop'); ?></label></div>
                                    <div id="vowels-export-entries-fields"></div>
                                    <div class="vowels-export-entries-date-wrap">
                                        <h3 class="ifb-export-sub-head"><?php esc_html_e('Date range (optional)','vowels-contact-form-with-drag-and-drop'); ?></h3>
                                        <label for="from"><?php esc_html_e('From','vowels-contact-form-with-drag-and-drop'); ?></label>
                                        <div><input type="text" name="from" id="from" /></div>
                                        <label for="to"><?php esc_html_e('To','vowels-contact-form-with-drag-and-drop'); ?></label>
                                        <div><input type="text" name="to" id="to" /></div>
                                        <p class="description"><?php esc_html_e('Click the fields to show a calendar','vowels-contact-form-with-drag-and-drop'); ?></p>
                                    </div>
                                    <div class="vowels-export-entries-buttons">
                                        <button class="vowels-export-entries-button" type="submit" name="vowels_form_builder_do_entries_export" value="1"><span><?php esc_html_e('Download','vowels-contact-form-with-drag-and-drop'); ?></span></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php else : ?>
                        <div id="message" class="updated below-h2">
                            <p><?php printf(esc_html__('No forms found, %sclick here to create one%s.', 'vowels-contact-form-with-drag-and-drop'), '<a href="admin.php?page=vowels_form_builder_form_builder">', '</a>'); ?></p>
                        </div>
                    <?php endif; ?>
                </form>
            </div>
        <?php elseif ($action === 'form') : ?>
            <div class="vowels-export-form">
                <form action="" method="get">
                    <input type="hidden" name="page" value="vowels_form_builder_export" />
                    <input type="hidden" name="action" value="form" />
                    <?php if (count($switchForms)) : ?>
                        <h3 class="ifb-export-sub-head"><?php esc_html_e('Select a form to export','vowels-contact-form-with-drag-and-drop'); ?></h3>
                        <p>
                            <select name="id">
                                <?php $id = isset($_GET['id']) ? absint($_GET['id']) : 0; ?>
                                <?php foreach ($switchForms as $switchForm) : ?>
                                    <option value="<?php echo absint($switchForm['id']); ?>" <?php selected($id, $switchForm['id']); ?>><?php echo esc_html($switchForm['name']); ?></option>
                                <?php endforeach; ?>
                            </select>
                            <button class="vowels-export-button" type="submit"><span><?php esc_html_e('Export','vowels-contact-form-with-drag-and-drop'); ?></span></button>
                        </p>
                    <?php else : ?>
                        <div id="message" class="updated below-h2">
                            <p><?php printf(esc_html__('No forms found, %sclick here to create one%s.', 'vowels-contact-form-with-drag-and-drop'), '<a href="admin.php?page=vowels_form_builder_form_builder">', '</a>'); ?></p>
                        </div>
                    <?php endif; ?>
                </form>
            </div>
            <?php if (strlen($exportData)) : ?>
                <h3 class="ifb-export-sub-head"><?php esc_html_e('Form export data','vowels-contact-form-with-drag-and-drop'); ?></h3>
                <div class="vowels-export-data">
                    <ul>
                        <li><?php esc_html_e('Click inside the box to select all text','vowels-contact-form-with-drag-and-drop'); ?></li>
                        <li><?php esc_html_e('Copy the text inside the box and paste it into the box on the Vowelsform Import page on another website','vowels-contact-form-with-drag-and-drop'); ?></li>
                    </ul>
                    <div><textarea rows="15" cols="100"><?php echo esc_html($exportData); ?></textarea></div>
                </div>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</div>