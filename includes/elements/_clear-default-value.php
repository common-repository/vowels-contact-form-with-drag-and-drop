<?php
if (!defined('VOWELSFORMDRAGDROP_VERSION')) exit;
if ($element->getClearDefaultValue()) : ?>
<script type="text/javascript">
jQuery(document).ready(function ($) {
	$('#<?php echo esc_js($uniqueId); ?>').focus(function () {
		vowelsforminc.instance.clearDefaultValue.call(this, <?php echo ($element->getResetDefaultValue()) ? 'true' : 'false'; ?>);
	});
});
</script>
<?php endif; ?>