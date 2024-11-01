<?php if (!defined('VOWELSFORMDRAGDROP_VERSION')) exit; ?><table class="widefat">
    <tr>
        <th class="vowels-db-widget-name-th"><?php esc_html_e('Form','vowels-contact-form-with-drag-and-drop'); ?></th>
        <th class="vowels-db-widget-unread-th"><?php esc_html_e('Unread','vowels-contact-form-with-drag-and-drop'); ?></th>
        <th>&nbsp;</th>
    </tr>
    <?php foreach ($forms as $form) : ?>
        <?php $config = maybe_unserialize($form->config); ?>
        <tr>
            <td class="vowels-db-widget-name"><a href="<?php echo admin_url('admin.php?page=vowels_form_builder_entries&amp;id=' . $config['id']); ?>"><?php echo esc_html($config['name']); ?></a></td>
            <td class="vowels-db-widget-unread"><a href="<?php echo admin_url('admin.php?page=vowels_form_builder_entries&amp;id=' . $config['id']); ?>"><?php echo $form->entries; ?></a></td>
            <td class="vowels-db-widget-link"><a class="ifb-button" href="<?php echo admin_url('admin.php?page=vowels_form_builder_entries&amp;id=' . $config['id']); ?>"><?php esc_html_e('View entries','vowels-contact-form-with-drag-and-drop'); ?></a></td>
        </tr>
    <?php endforeach; ?>
</table>