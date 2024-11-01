<?php

/**
 * vowelsforminc_Validator_Date
 *
 * Validates that the value is a valid date
 *
 * @package vowelsforminc
 * @subpackage Validator
 
 */
class vowelsforminc_Validator_Date extends vowelsforminc_Validator_Abstract
{
    /**
     * Constructor
     *
     * @param array $options
     */
    public function __construct($options = null)
    {
        $this->_messageTemplates = array(
            'invalid' => __('This is not a valid date',  'vowels')
        );

        if (is_array($options)) {
            if (array_key_exists('messages', $options)) {
                $this->setMessageTemplates($options['messages']);
            }
        }
    }

    /**
     * Returns true if the value is a valid date, false otherwise
     *
     * @param array $value
     * @return boolean
     */
    public function isValid($value)
    {
        if (is_array($value) && isset($value['day']) && isset($value['month']) && isset($value['year'])) {
            $day = (int) $value['day'];
            $month = (int) $value['month'];
            $year = (int) $value['year'];

            if (checkdate($month, $day, $year)) {
                return true;
            }
        }

        $this->addMessage($this->_messageTemplates['invalid']);
        return false;
    }
}