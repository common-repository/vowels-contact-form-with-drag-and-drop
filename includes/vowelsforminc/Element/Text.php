<?php

/**
 * vowelsforminc_Element_Text
 *
 * Text element
 *
 * @package vowelsforminc
 * @subpackage Element
 
 */
class vowelsforminc_Element_Text extends vowelsforminc_Element
{
    /**
     * Set the default value
     *
     * Replaces placeholder tags
     *
     * @param string $value
     * @param boolean $replacePlaceholders Whether or not to replace placeholder values
     */
    public function setDefaultValue($value, $replacePlaceholders = true)
    {
        $this->_defaultValue = $replacePlaceholders ? vowelsforminc::replacePlaceholderValues2($value) : $value;
    }
}