<?php

/**
 * vowelsforminc_Validator_Abstract
 *
 * Custom validators should extend this class
 *
 * @package vowelsforminc
 * @subpackage Validator
 
 */
abstract class vowelsforminc_Validator_Abstract implements vowelsforminc_Validator_Interface
{
    /**
     * Error messages
     * @var array
     */
    protected $_messages = array();

    /**
     * Error message templates
     */
    protected $_messageTemplates = array();

    /**
     * Get all error messages
     *
     * @return array
     */
    public function getMessages()
    {
        return $this->_messages;
    }

    /**
     * Add an error message
     *
     * @param string $message
     */
    public function addMessage($message)
    {
        $this->_messages[] = $message;
    }

    /**
     * Override a message template
     *
     * @param $key The key of the message to override
     * @param $message The message
     */
    public function setMessageTemplate($key, $message)
    {
        if (array_key_exists($key, $this->_messageTemplates) && strlen($message)) {
            $this->_messageTemplates[$key] = $message;
        }
    }

    /**
     * Override multiple message templates
     *
     * @param array $messages
     */
    public function setMessageTemplates(array $messages)
    {
        foreach ($messages as $key => $message) {
            $this->setMessageTemplate($key, $message);
        }
    }

    /**
     * Get the message template with the given key
     *
     * @param string $key
     */
    public function getMessageTemplate($key)
    {
        if (array_key_exists($key, $this->_messageTemplates)) {
            return $this->_messageTemplates[$key];
        }
    }
}