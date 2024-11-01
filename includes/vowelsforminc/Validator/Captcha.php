<?php

/**
 * vowelsforminc_Validator_Captcha
 *
 * Validates the value against the saved CAPTCHA code
 *
 * @package vowelsforminc
 * @subpackage Validator
 
 */
class vowelsforminc_Validator_Captcha extends vowelsforminc_Validator_Abstract
{
    /**
     * Constructor
     *
     * @param array $options
     */
    public function __construct($options = null)
    {
        $this->_messageTemplates = array(
            'not_match' => __('The value does not match',  'vowels')
        );

        if (is_array($options)) {
            if (array_key_exists('messages', $options)) {
                $this->setMessageTemplates($options['messages']);
            }
        }
    }

    /**
     * Compares the given value with the captcha value
     * saved in session. Also sets the error message.
     *
     * @param $value The value to check
     * @return boolean True if valid false otherwise
     */
    public function isValid($value)
    {
        if (isset($_POST['vowels_form_builder_uid'])) {
         //   $uniqId = (string) $_POST['vowels_form_builder_uid'];
      $uniqId = sanitize_text_field($_POST['vowels_form_builder_uid']);
            if (isset($_SESSION['vowels-captcha-' . $uniqId]) && strtolower($_SESSION['vowels-captcha-' . $uniqId]) == strtolower($value)) {
                return true;
            }
        }

        $message = sprintf($this->_messageTemplates['not_match'], $value);
        $this->addMessage($message);
        return false;
    }
}