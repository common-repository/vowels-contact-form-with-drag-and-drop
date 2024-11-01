<?php
if (!defined('VOWELSFORMDRAGDROP_VERSION')) exit;
$errors = $element->getErrors();
$count = count($errors);
?>
<div class="vowels-errors-wrap <?php if (!$count) echo 'vowels-hidden'; ?>" <?php echo $element->getCss(null, $leftMarginCss); ?>>
    <?php if ($count) :?>
    <div class="vowels-errors-list">
        <?php foreach ($errors as $error) : ?>
            <div class="vowels-error"><?php echo esc_html($error); ?></div>
            <?php break; ?>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>
</div>