<?php

/**
 * vowelsforminc_Filter_Digits
 *
 * Filters any non-digit characters
 *
 * @package vowelsforminc
 * @subpackage Filter
 
 */
class vowelsforminc_Filter_Digits implements vowelsforminc_Filter_Interface
{
    /**
     * Whether to allow white space characters; off by default
     * @var boolean
     */
    protected $_allowWhiteSpace = false;

    /**
     * Constructor
     *
     * @param array $options
     */
    public function __construct($options = null)
    {
        if (is_array($options)) {
            if (array_key_exists('allow_white_space', $options)) {
                $this->_allowWhiteSpace = (bool) $options['allow_white_space'];
            }
        }
    }

    /**
     * Filter everything from the given value except digits
     *
     * @param string $value The value to filter
     * @return string The filtered value
     */
    public function filter($value)
    {
        $whiteSpace = $this->_allowWhiteSpace ? '\s' : '';

        $pattern = '/[^0-9' . $whiteSpace . ']/';

        return preg_replace($pattern, '', (string) $value);
    }

    /**
     * Set whether to allow white space
     *
     * @param boolean $flag
     */
    public function setAllowWhiteSpace($flag)
    {
        $this->_allowWhiteSpace = (bool) $flag;
    }

    /**
     * Get whether to allow white space
     *
     * @return boolean
     */
    public function getAllowWhiteSpace()
    {
        return $this->_allowWhiteSpace;
    }
}