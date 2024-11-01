<?php

/**
 * vowelsforminc_Validator_Duplicate
 *
 * Checks that the submitted value has not already been submitted to
 * the WordPress database for this element.
 *
 * @package vowelsforminc
 * @subpackage Validator
 
 */
class vowelsforminc_Validator_Duplicate extends vowelsforminc_Validator_Abstract
{
    /**
     * Whether to allow white space characters; off by default
     * @var vowelsforminc_Element
     */
    protected $_element;

    /**
     * Constructor
     *
     * @param array $options
     */
    public function __construct($options = null)
    {
        $this->_messageTemplates = array(
            'duplicate' => __('This value is a duplicate of a previously submitted form',  'vowels')
        );

        if (is_array($options)) {
            if (array_key_exists('element', $options)) {
                $this->setElement($options['element']);
            }
        }

        if (!$this->getElement() instanceof vowelsforminc_Element) {
            throw new Exception('Element must be an instance of vowelsforminc_Element');
        }
    }

    /**
     * Returns true if the value has not been previously submitted.
     * Return false otherwise.
     *
     * @param $value
     * @return boolean
     */
    public function isValid($value)
    {
        global $wpdb;

        $sql = "SELECT `e`.`id` FROM " . vowels_form_builder_get_form_entry_data_table_name() . " ed LEFT JOIN " .
        vowels_form_builder_get_form_entries_table_name() . " e ON `ed`.`entry_id` = `e`.`id`
        WHERE `e`.`form_id` = %d
        AND `ed`.`element_id` = %d
        AND `ed`.`value` = '%s';";

        $result = $wpdb->get_row($wpdb->prepare($sql,
            $this->_element->getForm()->getId(),
            $this->_element->getId(),
            $this->_element->getValueHtml()
        ));

        if ($result != null) {
            $this->addMessage($this->_messageTemplates['duplicate']);
            return false;
        }

        return true;
    }

    /**
     * Set the element
     *
     * @param vowelsforminc_Element $element
     */
    public function setElement($element)
    {
        $this->_element = $element;
    }

    /**
     * Get the element
     *
     * @return vowelsforminc_Element
     */
    public function getElement()
    {
        return $this->_element;
    }
}