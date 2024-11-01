<?php if (!defined('VOWELSFORMDRAGDROP_VERSION')) exit; ?><div id="top" class="wrap">
	<div class="vowels-top-right">
        <div class="vowels-information">
        	<span class="vowels-copyright"><a href="http://www.Vowelsform.com" onclick="window.open(this.href); return false;">www.Vowelsform.com</a> &copy; <?php echo date('Y'); ?></span>
        	<span class="vowels-bug-link"><a href="http://www.Vowelsform.com/support.php" onclick="window.open(this.href); return false;"><?php esc_html_e('Report a bug','vowels-contact-form-with-drag-and-drop'); ?></a></span>
        	<span class="vowels-help-link"><a href="<?php echo vowels_form_builder_help_link(); ?>" onclick="window.open(this.href); return false;"><?php esc_html_e('Help','vowels-contact-form-with-drag-and-drop'); ?></a></span>
        </div>
    </div>
    <div class="ifb-form-icon"></div>
    <h2 class="ifb-main-title"><span class="ifb-vowels-title"><?php echo esc_html(vowels_form_builder_get_plugin_name()); ?></span><span class="ifb-vowels-entries"><?php esc_html_e('View entry','vowels-contact-form-with-drag-and-drop'); ?></span></h2>
    <?php if (isset($entry->id)) : ?>
        <div class="vowels-global-nav-wrap qfb-cf">
        	<ul class="vowels-global-nav-ul">
            	<li><a href="<?php echo esc_url(remove_query_arg(array('action', 'entry_id'))); ?>"><span class="ifb-arrow-left"><?php esc_html_e('Back to entries list','vowels-contact-form-with-drag-and-drop'); ?></span></a></li>
            </ul>
        </div>
        <div class="vowels-entry-wrap">
            <div class="vowels-entry-right">
                <div class="vowels-entry-additional">
                	<h3 class="vowels-entry-heading"><?php esc_html_e('Additional information','vowels-contact-form-with-drag-and-drop'); ?></h3>
                    <table class="vowels-entry-table vowels-entry-table-right">
                        <tr>
                            <th scope="row"><?php esc_html_e('Date','vowels-contact-form-with-drag-and-drop'); ?></th>
                            <td><?php echo vowels_form_builder_format_date($entry->date_added); ?></td>
                        </tr>
                        <tr>
                            <th><?php esc_html_e('Form','vowels-contact-form-with-drag-and-drop'); ?></th>
                            <td><?php echo esc_html($config['name']); ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?php esc_html_e('Entry ID','vowels-contact-form-with-drag-and-drop'); ?></th>
                            <td><?php echo $entry->id; ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?php esc_html_e('Form URL','vowels-contact-form-with-drag-and-drop'); ?></th>
                            <td>
                                <?php if (strlen($entry->form_url)) : ?>
                                    <a href="<?php echo esc_attr($entry->form_url); ?>" onclick="window.open(this.href); return false;"><?php echo esc_html($entry->form_url); ?></a>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><?php esc_html_e('Referring URL','vowels-contact-form-with-drag-and-drop'); ?></th>
                            <td>
                                <?php if (strlen($entry->referring_url)) : ?>
                                    <a href="<?php echo esc_attr($entry->referring_url); ?>" onclick="window.open(this.href); return false;"><?php echo esc_html($entry->referring_url); ?></a>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><?php esc_html_e('IP address','vowels-contact-form-with-drag-and-drop'); ?></th>
                            <td><?php echo esc_html($entry->ip); ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?php esc_html_e('Post / page ID','vowels-contact-form-with-drag-and-drop'); ?></th>
                            <td><?php echo esc_html($entry->post_id); ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?php esc_html_e('Post / page title','vowels-contact-form-with-drag-and-drop'); ?></th>
                            <td><?php echo esc_html($entry->post_title); ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?php esc_html_e('User WordPress display name','vowels-contact-form-with-drag-and-drop'); ?></th>
                            <td><?php echo esc_html($entry->user_display_name); ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?php esc_html_e('User WordPress email','vowels-contact-form-with-drag-and-drop'); ?></th>
                            <td>
                                <?php if (strlen($entry->user_email)) : ?>
                                    <a href="mailto:<?php echo esc_attr($entry->user_email); ?>"><?php echo esc_html($entry->user_email); ?></a>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><?php esc_html_e('User WordPress login','vowels-contact-form-with-drag-and-drop'); ?></th>
                            <td><?php echo esc_html($entry->user_login); ?></td>
                        </tr>
                    </table>
                </div>
            </div> <!-- /.vowels-entry-right -->
            <div class="vowels-entry-left">
                <div class="vowels-entry-show-empty-wrap"><form><label><input type="checkbox" value="1" <?php checked($showEmptyFields, '1'); ?> name="show_empty_fields" id="vowels-entry-show-empty-fields" /> <?php esc_html_e('Show empty fields','vowels-contact-form-with-drag-and-drop'); ?></label></form></div>
                <h3 class="vowels-entry-heading"><?php esc_html_e('Submitted form data','vowels-contact-form-with-drag-and-drop'); ?></h3>
                <div class="vowels-entry-data">
                    <?php if (count($columns)) : ?>
                        <table class="vowels-entry-table vowels-entry-table-left">
                            <?php foreach ($columns as $key => $element) : ?>
                                <?php if (property_exists($entry, $key)) :
                                    $value = $entry->{$key};
                                    $isEmpty = $value === '' || $value === null;
                                    if (!$isEmpty || ($isEmpty && $showEmptyFields)) : ?>
                                        <tr>
                                            <th><?php echo esc_html(vowels_form_builder_get_element_admin_label($element)); ?></th>
                                            <td><?php echo $entry->{$key}; ?></td>
                                        </tr>
                                    <?php endif; ?>
                                <?php elseif ($element['type'] == 'html') : ?>
                                    <tr>
                                        <td colspan="2"><?php echo $element['content']; ?></td>
                                    </tr>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </table>
                    <?php else : ?>

                    <?php endif; ?>
                </div>
            </div> <!-- /.vowels-entry-left -->
        </div> <!-- /.vowels-entry-wrap -->
    <?php else : ?>
        <div class="vowels-admin-notice error"><p><strong>
            <?php esc_html_e('Sorry, I couldn\'t find that entry. Perhaps it was deleted?','vowels-contact-form-with-drag-and-drop'); ?>
        </strong></p></div>
    <?php endif; ?>
</div>