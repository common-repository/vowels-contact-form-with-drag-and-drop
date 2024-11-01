<?php

/**
 * vowelsforminc_Filter_Filename
 *
 * Sanitises a filename
 *
 * @package vowelsforminc
 * @subpackage Filter
 
 */
class vowelsforminc_Filter_Filename implements vowelsforminc_Filter_Interface
{
    /**
     * Sanitise a filename
     *
     * @param string $value The value to filter
     * @return string The filtered value
     */
    public function filter($value)
    {
        return sanitize_file_name($value);
    }
}