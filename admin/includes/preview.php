<?php if (!defined('VOWELSFORMDRAGDROP_VERSION')) exit; ?><!DOCTYPE html>
<html lang="en-US">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title><?php echo esc_html(vowels_form_builder_get_plugin_name()); ?> <?php esc_html_e('Preview','vowels-contact-form-with-drag-and-drop'); ?></title>

<link rel="stylesheet" href="<?php echo vowels_form_builder_admin_url() . '/css/preview.css'; ?>" type="text/css" />
<link rel="stylesheet" href="<?php echo vowels_form_builder_plugin_url() . '/css/styles.css'; ?>" type="text/css" />
<?php if (!get_option('vowels_form_builder_disable_qtip_output')) : ?>
<link rel="stylesheet" href="<?php echo vowels_form_builder_plugin_url() . '/js/qtip2/jquery.qtip.min.css'; ?>" type="text/css" />
<?php endif; ?>
<?php
if (!get_option('vowels_form_builder_disable_uniform_output')) {
    $allUniformThemes = vowels_form_builder_get_all_uniform_themes();
    foreach ($allUniformThemes as $uniformTheme) {
        echo '<link rel="stylesheet" href="' . vowels_form_builder_plugin_url() . "/js/uniform/themes/" . $uniformTheme['Folder'] . "/". $uniformTheme['Folder'] . '.css" type="text/css" />' . PHP_EOL;
    }
}
$allThemes = vowels_form_builder_get_all_themes();
foreach ($allThemes as $theme) {
    echo '<link rel="stylesheet" href="' . vowels_form_builder_plugin_url() . "/themes/" . $theme['Folder'] . "/" . $theme['Filename'] . '.css" type="text/css" />' . PHP_EOL;
}
if (file_exists(VOWELSFORMDRAGDROP_PLUGIN_DIR . '/css/custom.css')) {
    echo '<link rel="stylesheet" href="' . vowels_form_builder_plugin_url() . '/css/custom.css" type="text/css" />' . PHP_EOL;
}
?>

<?php wp_print_scripts(array('jquery', 'json2')); ?>
<script type="text/javascript" src="<?php echo vowels_form_builder_plugin_url() . '/js/vowels.js'; ?>"></script>
</head>
<body>
<div class="ip-outside">
    <div class="ip-header"><span class="ifb-info-message-icon"></span><?php esc_html_e('The preview does not include your WordPress theme CSS
    so it may look different when viewed on a page on your website.','vowels-contact-form-with-drag-and-drop'); ?>
    <a class="vowels-refresh-preview-window" href="javascript:;" onclick="window.location.reload()"><?php esc_html_e('Refresh','vowels-contact-form-with-drag-and-drop'); ?></a></div>
    <div class="ip-loading">
        <?php esc_html_e('Loading form preview...','vowels-contact-form-with-drag-and-drop'); ?>
    </div>
    <div class="ip-sorry">
        <h3><?php esc_html_e('Sorry, there was a problem','vowels-contact-form-with-drag-and-drop'); ?></h3>
        <p><?php esc_html_e('The form preview could not be loaded, this could be due to one
        of the reasons below.','vowels-contact-form-with-drag-and-drop'); ?></p>
        <ul>
            <li><?php esc_html_e('The preview requires the form builder page to be open','vowels-contact-form-with-drag-and-drop'); ?></li>
            <li><?php esc_html_e('The form has been deleted','vowels-contact-form-with-drag-and-drop'); ?></li>
        </ul>
        <p><?php esc_html_e('Please address these issues and load the preview again.','vowels-contact-form-with-drag-and-drop'); ?></p>
    </div>
    <div class="ip-form-wrap"></div>
</div>
<?php if ($form != null) : ?>
<script type="text/javascript">
//<![CDATA[
var form = <?php echo vowels_form_builder_json_encode($form); ?>;
//]]>
</script>
<?php endif; ?>
<script type="text/javascript">
//<![CDATA[
var vowelsPreviewL10n = <?php echo vowels_form_builder_json_encode($previewL10n); ?>;
//]]>
</script>
<script type="text/javascript">
//<![CDATA[
var vowelsL10n = <?php echo vowels_form_builder_json_encode(vowels_form_builder_js_l10n()); ?>;
//]]>
</script>
<script type="text/javascript" src="<?php echo vowels_form_builder_admin_url() . '/js/vowels-preview.js'; ?>"></script>
<script type="text/javascript" src="<?php echo vowels_form_builder_plugin_url() . '/js/jquery.form.min.js'; ?>"></script>
<?php if (!get_option('vowels_form_builder_disable_fileupload_output')) : ?>
    <script type="text/javascript" src="<?php echo site_url() . '/wp-includes/js/jquery/ui/widget.min.js'; ?>"></script>
    <script type="text/javascript" src="<?php echo vowels_form_builder_plugin_url() . '/js/jquery.fileupload.min.js'; ?>"></script>
<?php endif; ?>
<script type="text/javascript" src="<?php echo vowels_form_builder_plugin_url() . '/js/jquery.vowels.js'; ?>"></script>
<?php if (!get_option('vowels_form_builder_disable_smoothscroll_output')) : ?>
<script type="text/javascript" src="<?php echo vowels_form_builder_plugin_url() . '/js/jquery.smooth-scroll.min.js'; ?>"></script>
<?php endif; ?>
<?php if (!get_option('vowels_form_builder_disable_qtip_output')) : ?>
<script type="text/javascript" src="<?php echo vowels_form_builder_plugin_url() . '/js/qtip2/jquery.qtip.min.js'; ?>"></script>
<?php endif; ?>
<?php if (!get_option('vowels_form_builder_disable_uniform_output')) : ?>
<script type="text/javascript" src="<?php echo vowels_form_builder_plugin_url() . '/js/uniform/jquery.uniform.min.js'; ?>"></script>
<?php endif; ?>
<?php if (!get_option('vowels_form_builder_disable_infieldlabels_output')) : ?>
<script type="text/javascript" src="<?php echo vowels_form_builder_plugin_url() . '/js/jquery.infieldlabel.min.js'; ?>"></script>
<?php endif; ?>
<?php
if (!get_option('vowels_form_builder_disable_jqueryui_output')) {
    wp_print_scripts(array('jquery-ui-datepicker'));
}
$allThemes = vowels_form_builder_get_all_themes();
foreach ($allThemes as $theme) {
    if (file_exists(VOWELSFORMDRAGDROP_PLUGIN_DIR . "/themes/" . $theme['Folder'] . "/" . $theme['Filename'] . ".js")) {
        echo '<script type="text/javascript" src="' . vowels_form_builder_plugin_url() . "/themes/" . $theme['Folder'] . "/" . $theme['Filename'] . '.js"></script>' . PHP_EOL;
	}
}
?>
</body>
</html>