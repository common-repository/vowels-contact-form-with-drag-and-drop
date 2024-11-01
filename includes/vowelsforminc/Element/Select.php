<?php

/**
 * vowelsforminc_Element_Select
 *
 * Select element
 *
 * @package vowelsforminc
 * @subpackage Element
 
 */
class vowelsforminc_Element_Select extends vowelsforminc_Element_Multi
{
    /**
     * Constructor
     *
     * @param array $config
     */
    public function __construct($config = null)
    {
        parent::__construct($config);

        if (is_array($config)) {
            if (array_key_exists('options', $config) && is_array($config['options'])) {
                $this->addOptions($config['options']);
            }
        }
    }
}