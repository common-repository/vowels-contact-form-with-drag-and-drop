<?php

/**
 * vowelsforminc_Element_Hidden
 *
 * Hidden element
 *
 * @package vowelsforminc
 * @subpackage Element
 
 */
class vowelsforminc_Element_Hidden extends vowelsforminc_Element
{
    /**
     * Set the default value
     *
     * Replaces placeholder tags
     *
     * @param string $value
     */
    public function setDefaultValue($value)
    {
        $this->_defaultValue = vowelsforminc::replacePlaceholderValues2($value);
    }
}