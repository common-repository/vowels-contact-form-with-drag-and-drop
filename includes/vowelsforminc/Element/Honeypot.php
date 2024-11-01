<?php

/**
 * vowelsforminc_Element_Honeypot
 *
 * Honeypot element
 *
 * @package vowelsforminc
 * @subpackage Element
 
 */
class vowelsforminc_Element_Honeypot extends vowelsforminc_Element
{
    /**
     * Whether or not the element should be hidden from the notification email
     * @var boolean
     */
    protected $_isHidden = true;

    /**
     * Constructor
     *
     * @param array $config
     */
    public function __construct($config = null)
    {
        parent::__construct($config);

        $honeypotValidator = new vowelsforminc_Validator_Honeypot();
        $this->addValidator($honeypotValidator);
    }
}