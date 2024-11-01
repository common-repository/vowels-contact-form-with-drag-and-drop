<?php

/**
 * vowelsforminc_Validator_Honeypot
 *
 * Validates that the value is empty
 *
 * @package vowelsforminc
 * @subpackage Validator
 
 */
class vowelsforminc_Validator_Honeypot extends vowelsforminc_Validator_Abstract
{
    /**
     * Returns true if the given value is empty, false otherwise.
     *
     * @param string $value
     * @return boolean
     */
    public function isValid($value)
    {
        $value = (string) $value;

        if (strlen($value) === 0) {
            return true;
        }

        return false;
    }
}