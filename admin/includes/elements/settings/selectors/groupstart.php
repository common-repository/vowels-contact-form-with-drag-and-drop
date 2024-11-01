<?php if (!defined('VOWELSFORMDRAGDROP_VERSION')) exit; ?><div class="ifb-info-box ifb-info-message"><span class="ifb-info-message-icon"></span><?php esc_html_e('You can use the CSS selectors below in your stylesheet to style this group individually.','vowels-contact-form-with-drag-and-drop'); ?></div>
<h4><?php esc_html_e('Group wrapper','vowels-contact-form-with-drag-and-drop'); ?></h4>
<pre>.vowels_form_builder_<span class="ifb-update-form-id"><?php echo $form['id']; ?></span>_<?php echo $element['id']; ?>-group-wrap { }</pre>
<h4><?php esc_html_e('Title','vowels-contact-form-with-drag-and-drop'); ?></h4>
<pre>.vowels_form_builder_<span class="ifb-update-form-id"><?php echo $form['id']; ?></span>_<?php echo $element['id']; ?>-group-wrap .vowels-group-title { }</pre>
<h4><?php esc_html_e('Description','vowels-contact-form-with-drag-and-drop'); ?></h4>
<pre>.vowels_form_builder_<span class="ifb-update-form-id"><?php echo $form['id']; ?></span>_<?php echo $element['id']; ?>-group-wrap .vowels-group-description { }</pre>
<h4><?php esc_html_e('Group elements wrapper','vowels-contact-form-with-drag-and-drop'); ?></h4>
<pre>.vowels_form_builder_<span class="ifb-update-form-id"><?php echo $form['id']; ?></span>_<?php echo $element['id']; ?>-group-wrap .vowels-group-elements { }</pre>