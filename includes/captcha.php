<?php

if (!isset($_GET['c'])) {
    exit;
}

/**
 * Starts a PHP session
 *
 * If the session ID given by the browser contains invalid characters, a session is not started
 *
 * @return bool True if a session is successfully started
 */
function vowels_form_builder_secure_session_start()
{
    if (session_id() !== '' || headers_sent()) {
        // Session already exists or headers are already sent
        return false;
    }

    $sessionName = session_name();

    if (isset($_COOKIE[$sessionName])) {
        $sessionId = $_COOKIE[$sessionName];
    } else if (isset($_GET[$sessionName])) {
        $sessionId = $_GET[$sessionName];
    } else {
        return session_start();
    }

    if (!is_string($sessionId) || !preg_match('/^[a-zA-Z0-9,\-]{1,128}$/', $sessionId)) {
        return false;
    }

    return session_start();
}

vowels_form_builder_secure_session_start();

defined('VOWELSFORMDRAGDROP_INCLUDES_DIR') || define('VOWELSFORMDRAGDROP_INCLUDES_DIR', realpath(dirname(__FILE__ )));
require_once VOWELSFORMDRAGDROP_INCLUDES_DIR . '/vowelsforminc/Captcha.php';

$config = base64_decode(stripslashes($_GET['c']));
$config = json_decode($config, true);

if (is_array($config) && array_key_exists('options', $config)) {
    $captchaOptions = $config['options'];

    if (array_key_exists('length', $captchaOptions) && is_numeric($captchaOptions['length'])) {
        $captchaOptions['length'] = abs(intval($captchaOptions['length']));
        $captchaOptions['length'] = min($captchaOptions['length'], 32);
        $captchaOptions['length'] = max($captchaOptions['length'], 2);
    } else {
        $captchaOptions['length'] = 5;
    }

    if (array_key_exists('width', $captchaOptions) && is_numeric($captchaOptions['width'])) {
        $captchaOptions['width'] = abs(intval($captchaOptions['width']));
        $captchaOptions['width'] = min($captchaOptions['width'], 300);
        $captchaOptions['width'] = max($captchaOptions['width'], 20);
    } else {
        $captchaOptions['width'] = 115;
    }

    if (array_key_exists('height', $captchaOptions) && is_numeric($captchaOptions['height'])) {
        $captchaOptions['height'] = abs(intval($captchaOptions['height']));
        $captchaOptions['height'] = min($captchaOptions['height'], 300);
        $captchaOptions['height'] = max($captchaOptions['height'], 10);
    } else {
        $captchaOptions['height'] = 40;
    }

    if (!array_key_exists('bgColour', $captchaOptions) || ($captchaOptions['bgColour'] = hex2RGB_Vowels_form($captchaOptions['bgColour'])) === false) {
        $captchaOptions['bgColour'] = array(
            'red' => 255,
            'green' => 255,
            'blue' => 255
        );
    }

    if (!array_key_exists('textColour', $captchaOptions) || ($captchaOptions['textColour'] = hex2RGB_Vowels_form($captchaOptions['textColour'])) === false) {
        $captchaOptions['textColour'] = array(
            'red' => 10,
            'green' => 10,
            'blue' => 10
        );
    }

    if (array_key_exists('font', $captchaOptions) && file_exists(VOWELSFORMDRAGDROP_INCLUDES_DIR . '/fonts/' . $captchaOptions['font'])) {
        $captchaOptions['font'] = VOWELSFORMDRAGDROP_INCLUDES_DIR . '/fonts/' . $captchaOptions['font'];
    } else {
        $captchaOptions['font'] = VOWELSFORMDRAGDROP_INCLUDES_DIR . '/fonts/Typist.ttf';
    }

    if (array_key_exists('minFontSize', $captchaOptions) && is_numeric($captchaOptions['minFontSize'])) {
        $captchaOptions['minFontSize'] = abs(intval($captchaOptions['minFontSize']));
        $captchaOptions['minFontSize'] = min($captchaOptions['minFontSize'], 72);
        $captchaOptions['minFontSize'] = max($captchaOptions['minFontSize'], 5);
    } else {
        $captchaOptions['minFontSize'] = 12;
    }

    if (array_key_exists('maxFontSize', $captchaOptions) && is_numeric($captchaOptions['maxFontSize'])) {
        $captchaOptions['maxFontSize'] = abs(intval($captchaOptions['maxFontSize']));
        $captchaOptions['maxFontSize'] = min($captchaOptions['maxFontSize'], 72);
        $captchaOptions['maxFontSize'] = max($captchaOptions['maxFontSize'], 5);
    } else {
        $captchaOptions['maxFontSize'] = 19;
    }

    if (array_key_exists('minAngle', $captchaOptions) && is_numeric($captchaOptions['minAngle'])) {
        $captchaOptions['minAngle'] = abs(intval($captchaOptions['minAngle']));
        $captchaOptions['minAngle'] = min($captchaOptions['minAngle'], 360);
    } else {
        $captchaOptions['minAngle'] = 0;
    }

    if (array_key_exists('maxAngle', $captchaOptions) && is_numeric($captchaOptions['maxAngle'])) {
        $captchaOptions['maxAngle'] = abs(intval($captchaOptions['maxAngle']));
        $captchaOptions['maxAngle'] = min($captchaOptions['maxAngle'], 360);
    } else {
        $captchaOptions['maxAngle'] = 20;
    }

    if ($captchaOptions['minFontSize'] > $captchaOptions['maxFontSize']) {
        $tmp = $captchaOptions['maxFontSize'];
        $captchaOptions['maxFontSize'] = $captchaOptions['minFontSize'];
        $captchaOptions['minFontSize'] = $tmp;
    }

    if ($captchaOptions['minAngle'] > $captchaOptions['maxAngle']) {
        $tmp = $captchaOptions['maxAngle'];
        $captchaOptions['maxAngle'] = $captchaOptions['minAngle'];
        $captchaOptions['minAngle'] = $tmp;
    }

    $captchaOptions['uniqId'] = $config['uniqId'];
    $captchaOptions['tmpDir'] = $config['tmpDir'];
    $captcha = new vowelsforminc_Captcha($captchaOptions);
    $captcha->display();
}

/**
 * Convert a hexadecimal color code to its RGB equivalent
 *
 * @param string $hexStr (hexadecimal color value)
 * @param boolean $returnAsString (if set true, returns the value separated by the separator character. Otherwise returns associative array)
 * @param string $seperator (to separate RGB values. Applicable only if second parameter is true.)
 * @return array or string (depending on second parameter. Returns False if invalid hex color value)
 */
function hex2RGB_Vowels_form($hexStr, $returnAsString = false, $seperator = ',')
{
    $hexStr = preg_replace("/[^0-9A-Fa-f]/", '', $hexStr); // Gets a proper hex string
    $rgbArray = array();
    if (strlen($hexStr) == 6) { //If a proper hex code, convert using bitwise operation. No overhead... faster
        $colorVal = hexdec($hexStr);
        $rgbArray['red'] = 0xFF & ($colorVal >> 0x10);
        $rgbArray['green'] = 0xFF & ($colorVal >> 0x8);
        $rgbArray['blue'] = 0xFF & $colorVal;
    } elseif (strlen($hexStr) == 3) { //if shorthand notation, need some string manipulations
        $rgbArray['red'] = hexdec(str_repeat(substr($hexStr, 0, 1), 2));
        $rgbArray['green'] = hexdec(str_repeat(substr($hexStr, 1, 1), 2));
        $rgbArray['blue'] = hexdec(str_repeat(substr($hexStr, 2, 1), 2));
    } else {
        return false; //Invalid hex color code
    }
    return $returnAsString ? implode($seperator, $rgbArray) : $rgbArray; // returns the rgb string or the associative array
}

/**
 * Recursive directory creation based on full path.
 *
 * Will attempt to set permissions on folders.
 *
 * @since 2.0.1
 *
 * @param string $target Full path to attempt to create.
 * @return bool Whether the path was created. True if path already exists.
 */
function wp_mkdir_p( $target ) {
    // from php.net/mkdir user contributed notes
    $target = str_replace( '//', '/', $target );

    // safe mode fails with a trailing slash under certain PHP versions.
    $target = rtrim($target, '/'); // Use rtrim() instead of untrailingslashit to avoid formatting.php dependency.
    if ( empty($target) )
        $target = '/';

    if ( file_exists( $target ) )
        return @is_dir( $target );

    // Attempting to create the directory may clutter up our display.
    if ( @mkdir( $target ) ) {
        $stat = @stat( dirname( $target ) );
        $dir_perms = $stat['mode'] & 0007777;  // Get the permission bits.
        @chmod( $target, $dir_perms );
        return true;
    } elseif ( is_dir( dirname( $target ) ) ) {
            return false;
    }

    // If the above failed, attempt to create the parent node, then try again.
    if ( ( $target != '/' ) && ( wp_mkdir_p( dirname( $target ) ) ) )
        return wp_mkdir_p( $target );

    return false;
}