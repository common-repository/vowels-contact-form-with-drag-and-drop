<?php
if (!defined('VOWELSFORMDRAGDROP_VERSION')) exit;
if (strlen($description = $element->getDescription())) : ?>
    <p class="vowels-description" <?php echo $element->getCss('elementDescription'); ?>><?php echo do_shortcode($description); ?></p>
<?php endif; ?>
