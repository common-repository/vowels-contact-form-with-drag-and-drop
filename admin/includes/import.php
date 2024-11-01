<?php if (!defined('VOWELSFORMDRAGDROP_VERSION')) exit; ?><div class="wrap">
	<div class="vowels-top-right">
        <div class="vowels-information">
        	<span class="vowels-copyright"><a href="http://www.Vowelsform.com" onclick="window.open(this.href); return false;">www.Vowelsform.com</a> &copy; <?php echo date('Y'); ?></span>
        	<span class="vowels-bug-link"><a href="http://www.Vowelsform.com/support.php" onclick="window.open(this.href); return false;"><?php esc_html_e('Report a bug','vowels-contact-form-with-drag-and-drop'); ?></a></span>
        	<span class="vowels-help-link"><a href="<?php echo vowels_form_builder_help_link(); ?>" onclick="window.open(this.href); return false;"><?php esc_html_e('Help','vowels-contact-form-with-drag-and-drop'); ?></a></span>
        </div>
    </div>
    <div class="ifb-form-icon"></div>
    <h2 class="ifb-main-title"><span class="ifb-vowels-title"><?php echo esc_html(vowels_form_builder_get_plugin_name()); ?></span><?php esc_html_e('Import form','vowels-contact-form-with-drag-and-drop'); ?></h2>

    <?php vowels_form_builder_global_nav('import'); ?>

    <?php if (count($messages)) : ?>
        <?php foreach ($messages as $message) : ?>
            <?php if ($message['type'] == 'success') : ?>
                <div class="updated below-h2"><p><strong><?php echo $message['message']; ?></strong></p></div>
            <?php elseif ($message['type'] == 'error') : ?>
                <div class="error below-h2"><p><strong><?php echo $message['message']; ?></strong></p></div>
            <?php endif; ?>
        <?php endforeach; ?>
    <?php endif; ?>
    <div class="vowels-import-content">
        <h3 class="ifb-export-sub-head"><?php esc_html_e('Import form data','vowels-contact-form-with-drag-and-drop'); ?></h3>
    	<p><?php printf(esc_html__('Paste in the data generated from the Vowelsform export page into the box below to import a form.
    		Bear in mind that the email address set to receive emails will be set to the value that
    		it was in the website that the export was taken from. You can change this value after you
    		import by going to %1$sSettings &rarr; Email%2$s in the form builder.', 'vowels-contact-form-with-drag-and-drop'), '<span class="ifb-bold">', '</span>'); ?></p>
        <div class="vowels-import-form">
            <form action="" method="post">
                <div><textarea name="form_config" rows="15" cols="100"></textarea></div>
                <button class="vowels-import-button" type="submit"><span><?php esc_html_e('Import','vowels-contact-form-with-drag-and-drop'); ?></span></button>
            </form>
        </div>
    </div>
</div>