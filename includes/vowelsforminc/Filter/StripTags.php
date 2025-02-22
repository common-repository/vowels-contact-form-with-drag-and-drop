<?php

/**
 * vowelsforminc_Filter_StripTags
 *
 * Filters HTML tags
 *
 * @package vowelsforminc
 * @subpackage Filter
 
 */
class vowelsforminc_Filter_StripTags implements vowelsforminc_Filter_Interface
{
    /**
     * HTML tags that will not be stripped
     * @var string
     */
    protected $_allowableTags = '';

    /**
     * Constructor
     *
     * @param array $options
     */
    public function __construct($options = null)
    {
        if (is_array($options)) {
            if (array_key_exists('allowable_tags', $options)) {
                $this->_allowableTags = $options['allowable_tags'];
            }
        }
    }

    /**
     * Strips all HTML tags from the given value.
     *
     * @param string $value The value to filter
     * @return string The filtered value
     */
    public function filter($value)
    {
        return strip_tags($value, $this->_allowableTags);
    }
}