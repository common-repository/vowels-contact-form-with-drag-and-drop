<?php
if (!defined('VOWELSFORMDRAGDROP_VERSION')) exit;
if ($element->getEnableWrapper()) : ?>
<div class="vowels-element-wrap vowels-element-wrap-html <?php echo $name; ?>-element-wrap vowels-clearfix">
    <div class="vowels-element-spacer vowels-element-spacer-html <?php echo $name; ?>-element-spacer"><?php echo $paratexxt_start; ?>
        <?php echo do_shortcode($element->getContent()); ?><?php echo $paratexxt_end; ?>
    </div>
</div>
<?php else :
    echo do_shortcode($element->getContent());
endif; ?>