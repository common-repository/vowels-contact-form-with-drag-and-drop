<?php

/**
 * vowelsforminc_Element_Captcha
 *
 * CAPTCHA element
 *
 * @package vowelsforminc
 * @subpackage Element
 
 */
class vowelsforminc_Element_Captcha extends vowelsforminc_Element
{
    /**
     * Is the element hidden from the notification email?
     * @var boolean
     */
    protected $_isHidden = true;

    /**
     * CAPTCHA image options
     * @var array
     */
    protected $_options = array(
        'length' => 5,
        'width' => 115,
        'height' => 40,
        'bgColour' => '#FFFFFF',
        'textColour' => '#222222',
        'font' => 'Typist.ttf',
        'minFontSize' => 12,
        'maxFontSize' => 19,
        'minAngle' => 0,
        'maxAngle' => 20
    );

    /**
     * Constructor
     *
     * @param array $config
     */
    public function __construct($config = null)
    {
        parent::__construct($config);

        $validator = new vowelsforminc_Validator_Captcha();

        if (is_array($config)) {
            if (array_key_exists('options', $config)) {
                $this->setOptions($config['options']);
            }
            if (array_key_exists('invalid_message', $config)) {
                $validator->setMessageTemplate('not_match', $config['invalid_message']);
            }
        }

        $this->addValidator($validator);
    }

    /**
     * Set the CAPTCHA image options
     *
     * @param array $options
     */
    public function setOptions(array $options)
    {
        $this->_options = $options;
    }

    /**
     * Get the CAPTCHA image options
     *
     * @return array
     */
    public function getOptions()
    {
        return $this->_options;
    }
}