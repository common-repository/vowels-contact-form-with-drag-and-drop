<?php
if (!defined('VOWELSFORMDRAGDROP_VERSION')) exit;
$title = $element->getTitle();
$description = $element->getDescription();
?>
<div class="vowels-group-wrap <?php echo $name; ?>-group-wrap vowels-clearfix vowels-labels-<?php echo $labelPlacement; ?> vowels-group-style-<?php echo $element->getGroupStyle(); ?> vowels-group-alignment-<?php echo $element->getColumnAlignment(); ?>" <?php echo $element->getCss('group'); ?>>
    <div class="vowels-group-elements" <?php echo $element->getCss('groupElements'); ?>>
        <?php if (strlen($title) || strlen($description)) : ?>
        	<div class="vowels-group-title-description-wrap vowels-clearfix">
    			<?php if (strlen($title)) : ?>
                <div class="vowels-group-title" <?php echo $element->getCss('groupTitle'); ?>><?php echo do_shortcode($title); ?></div>
                <?php endif; ?>
                <?php if (strlen($description)) : ?>
                    <p class="vowels-group-description" <?php echo $element->getCss('description'); ?>><?php echo do_shortcode($description); ?></p>
                <?php endif; ?>
            </div>
        <?php endif; ?>
        <div class="vowels-group-row vowels-clearfix vowels-group-row-<?php echo $element->getNumberOfColumns(); ?>cols">