<?php

/**
 * vowelsforminc_Element_Email
 *
 * Email element
 *
 * @package vowelsforminc
 * @subpackage Element
 
 */
class vowelsforminc_Element_Email extends vowelsforminc_Element
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

    /**
     * Get the value formatted in HTML
     *
     * @return string
     */
    public function getValueHtml($separator = '<br />')
    {
        $filteredValue = (string) $this->getValue();
        $value = '';

        if (strlen($filteredValue)) {
            $value = '<a href="mailto:' . $filteredValue . '">' . $filteredValue . '</a>';
        }

        return $value;
    }
}