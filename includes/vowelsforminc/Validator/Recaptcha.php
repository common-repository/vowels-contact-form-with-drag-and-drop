<?php

/**
 * vowelsforminc_Validator_Recaptcha
 *
 * Validates the reCAPTCHA solution
 *
 * @package vowelsforminc
 * @subpackage Validator
 
 */
class vowelsforminc_Validator_Recaptcha extends vowelsforminc_Validator_Abstract
{
    /**
     * reCAPTCHA secret key
     * @var string
     */
    protected $_secretKey;

    /**
     * Constructor
     *
     * @param array $options
     */
    public function __construct($options = null)
    {
        $this->_messageTemplates = array(
            'missing-input-secret' => __('The secret parameter is missing',  'vowels'),
            'invalid-input-secret' => __('The secret parameter is invalid or malformed',  'vowels'),
            'missing-input-response' => __('The response parameter is missing',  'vowels'),
            'invalid-input-response' => __('The response parameter is invalid or malformed',  'vowels'),
            'error' => __('An error occurred, please try again',  'vowels')
        );

        if (is_array($options)) {
            if (array_key_exists('secretKey', $options)) {
                $this->_secretKey = $options['secretKey'];
            }
            if (array_key_exists('messages', $options)) {
                $this->setMessageTemplates($options['messages']);
            }
        }
    }

    /**
     * Checks the reCAPTCHA answer
     *
     * @param   string   $value  The value to check
     * @return  boolean          True if valid false otherwise
     */
    public function isValid($value)
    {
        $params = array(
            'secret' => $this->_secretKey,
            'response' => isset($_POST['g-recaptcha-response']) ? $_POST['g-recaptcha-response'] : '',
            'remoteip' => vowels_form_builder_get_user_ip()
        );

        $qs = http_build_query($params, '', '&');
        $response = wp_remote_get('https://www.google.com/recaptcha/api/siteverify?' . $qs);
        $response = wp_remote_retrieve_body($response);
        $response = json_decode($response, true);

        if (!is_array($response) || !isset($response['success'])) {
            $this->addMessage($this->_messageTemplates['error']);
            return false;
        }

        if (!$response['success']) {
            if (isset($response['error-codes']) && is_array($response['error-codes']) && count($response['error-codes'])) {
                foreach ($response['error-codes'] as $error) {
                    if (array_key_exists($error, $this->_messageTemplates)) {
                        $message = $this->_messageTemplates[$error];
                    } else {
                        $message = $this->_messageTemplates['invalid-input-response'];
                    }

                    $this->addMessage($message);
                    return false;
                }
            } else {
                $this->addMessage($this->_messageTemplates['error']);
                return false;
            }
        }

        return true;
    }
}