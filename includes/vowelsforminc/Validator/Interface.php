<?php

/**
 * vowelsforminc_Validator_Interface
 *
 * @package vowelsforminc
 * @subpackage Validator
 
 */
interface vowelsforminc_Validator_Interface
{
    public function isValid($value);
    public function getMessages();
}