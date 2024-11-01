<?php

/**
 * vowelsforminc_Validator_Required
 *
 * Validates that the value is not empty
 *
 * @package vowelsforminc
 * @subpackage Validator
 
 */
class vowelsforminc_Validator_Required extends vowelsforminc_Validator_Abstract
{
    /**
     * Constructor
     *
     * @param array $options
     */
    public function __construct($options = null)
    {
        $this->_messageTemplates = array(
            'required' => __('This field is required',  'vowels')
        );

        if (is_array($options)) {
            if (array_key_exists('messages', $options)) {
                $this->setMessageTemplates($options['messages']);
            }
        }
    }

    /**
     * Checks whether the given value is not empty. Also sets
     * the error message if value is empty.
     *
     * @param $value The value to check
     * @return boolean True if valid false otherwise
     */
    public function isValid($value)
    {
        $valid = true;

        if (is_array($value)) {
            $valid = false;
            foreach (array_values($value) as $val) {
                if ($val != null) {
                    $valid = true;
                }
            }
        } else if ($value === null || $value === '') {
            $valid = false;
        }

        if ($valid == false) {
            $this->addMessage($this->_messageTemplates['required']);
        }

        return $valid;
    }
}