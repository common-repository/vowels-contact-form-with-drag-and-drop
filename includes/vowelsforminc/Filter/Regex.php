<?php

/**
 * vowelsforminc_Filter_Regex
 *
 * Filters any characters not matching the regex pattern
 *
 * @package vowelsforminc
 * @subpackage Filter
 
 */
class vowelsforminc_Filter_Regex implements vowelsforminc_Filter_Interface
{
    /**
     * The pattern to match
     * @var string
     */
    protected $_pattern = '';

    /**
     * Constructor
     *
     * @param array $options
     */
    public function __construct($options = null)
    {
        if (is_array($options)) {
            if (array_key_exists('pattern', $options)) {
                $this->_pattern = (string) $options['pattern'];
            }
        }
    }

    /**
     * Filter any characters matched by the set regular expression
     * pattern
     *
     * @param string $value The value to filter
     * @return string The filtered value
     */
    public function filter($value)
    {
        if (strlen($this->_pattern)) {
            $value = preg_replace($this->_pattern, '', (string) $value);
        }

        return $value;
    }

    /**
     * Set the regular expression pattern
     *
     * @param string $pattern
     */
    public function setPattern($pattern)
    {
        $this->_pattern = $pattern;
    }

    /**
     * Get the regular expression pattern
     *
     * @return string
     */
    public function getPattern()
    {
        return $this->_pattern;
    }
}