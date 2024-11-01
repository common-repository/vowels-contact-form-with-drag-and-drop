<?php
/*
 * Plugin Name: Contact Form X - The Drag and Drop Contact Form Builder
 * Plugin URI: http://www.vowelsform.com
 * Description: contant form X with drag and drop feature. easily make any type of forms.
 * Version: 3.2
 * Author: vowelsform
 * Author URI: http://www.vowelsform.com/
 * Text Domain: vowels-contact-form-with-drag-and-drop
 */

defined('VOWELSFORMDRAGDROP_VERSION')
    || define('VOWELSFORMDRAGDROP_VERSION', '3.2');

defined('VOWELSFORMDRAGDROP_DB_VERSION')
    || define('VOWELSFORMDRAGDROP_DB_VERSION', 11);

defined('VOWELSFORMDRAGDROP_PLUGIN_NAME')
    || define('VOWELSFORMDRAGDROP_PLUGIN_NAME', basename(dirname(__FILE__)));

defined('VOWELSFORMDRAGDROP_PLUGIN_BASENAME')
    || define('VOWELSFORMDRAGDROP_PLUGIN_BASENAME', VOWELSFORMDRAGDROP_PLUGIN_NAME . '/' . basename(__FILE__));

defined('VOWELSFORMDRAGDROP_PLUGIN_DIR')
    || define('VOWELSFORMDRAGDROP_PLUGIN_DIR', untrailingslashit(plugin_dir_path(__FILE__)));

defined('VOWELSFORMDRAGDROP_INCLUDES_DIR')
    || define('VOWELSFORMDRAGDROP_INCLUDES_DIR', VOWELSFORMDRAGDROP_PLUGIN_DIR . '/includes');

defined('VOWELSFORMDRAGDROP_ADMIN_DIR')
    || define('VOWELSFORMDRAGDROP_ADMIN_DIR', VOWELSFORMDRAGDROP_PLUGIN_DIR . '/admin');

defined('VOWELSFORMDRAGDROP_ADMIN_INCLUDES_DIR')
    || define('VOWELSFORMDRAGDROP_ADMIN_INCLUDES_DIR', VOWELSFORMDRAGDROP_ADMIN_DIR . '/includes');

defined('VOWELSFORMDRAGDROP_API_URL')
       || define('VOWELSFORMDRAGDROP_API_URL', 'http://www.vowelsform.com/api/');

defined('VOWELSFORMDRAGDROP_LANGUAGE_FILES') || define('VOWELSFORMDRAGDROP_LANGUAGE_FILES', serialize(array(
    'vowels-nl_NL.mo',
    'vowels-nl_NL.po',
    'vowels-de_DE.mo',
    'vowels-de_DE.po',
    'vowels-ru_RU.mo',
    'vowels-ru_RU.po',
    'vowels-uk.mo',
    'vowels-uk.po',
    'vowels-it_IT.mo',
    'vowels-it_IT.po',
    'vowels-bg_BG.mo',
    'vowels-bg_BG.po',
    'vowels-pt_BR.mo',
    'vowels-pt_BR.po',
    'vowels-fa_IR.po',
    'vowels-fa_IR.mo',
    'vowels-fr_FR.po',
    'vowels-fr_FR.mo',
    'vowels-hr.po',
    'vowels-hr.mo',
    'vowels-sv_SE.po',
    'vowels-sv_SE.mo',
    'vowels-hu_HU.po',
    'vowels-hu_HU.mo',
    'vowels-zh_CN.mo',
    'vowels-zh_CN.po',
    'vowels-es_ES.mo',
    'vowels-es_ES.po',
    'vowels-tr_TR.mo',
    'vowels-tr_TR.po'
)));

require_once VOWELSFORMDRAGDROP_INCLUDES_DIR . '/common.php';