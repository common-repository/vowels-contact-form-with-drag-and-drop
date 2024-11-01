<?php

/**
 * vowelsforminc_Element_Recaptcha
 *
 * ReCAPTCHA element
 *
 * @package vowelsforminc
 * @subpackage Element
 
 */
class vowelsforminc_Element_Recaptcha extends vowelsforminc_Element
{
    /**
     * Is the element hidden from the notification email?
     * @var boolean
     */
    protected $_isHidden = true;

    /**
     * The reCAPTCHA theme to use
     * @var string
     */
    protected $_recaptchaTheme = 'light';

    /**
     * The CAPTCHA type
     * @var string
     */
    protected $_recaptchaType = 'image';

    /**
     * The language to use
     * @var string
     */
    protected $_recaptchaLang = 'en';

    /**
     * The size option
     * @var string
     */
    protected $_recaptchaSize = 'normal';

    /**
     * The badge position option
     * @var string
     */
    protected $_recaptchaBadgePosition = 'bottomright';

    /**
     * Constructor
     *
     * @param array $config
     */
    public function __construct($config = null)
    {
        if (is_array($config)) {

            $recaptchaValidator = new vowelsforminc_Validator_Recaptcha(array(
                'secretKey' => get_option('vowels_form_builder_recaptcha_secret_key')
            ));

            if (array_key_exists('recaptcha_theme', $config)) {
                $this->setRecaptchaTheme($config['recaptcha_theme']);
                unset($config['recaptcha_theme']);
            }

            if (array_key_exists('recaptcha_type', $config)) {
                $this->setRecaptchaType($config['recaptcha_type']);
                unset($config['recaptcha_type']);
            }

            if (array_key_exists('recaptcha_lang', $config)) {
                $this->setRecaptchaLang($config['recaptcha_lang']);
                unset($config['recaptcha_lang']);
            }

            if (array_key_exists('recaptcha_size', $config)) {
                $this->setRecaptchaSize($config['recaptcha_size']);
                unset($config['recaptcha_size']);
            }

            if (array_key_exists('recaptcha_badge_position', $config)) {
                $this->setRecaptchaBadgePosition($config['recaptcha_badge_position']);
                unset($config['recaptcha_badge_position']);
            }

            if (array_key_exists('messages', $config) && is_array($config['messages'])) {
                $recaptchaValidator->setMessageTemplates($config['messages']);
                unset($config['messages']);
            }

            $config['name'] = 'g-recaptcha-response';
            parent::__construct($config);

            $this->addValidator($recaptchaValidator);
        }
    }

    /**
     * Set the reCAPTCHA theme
     *
     * @param string $recaptchaTheme
     */
    public function setRecaptchaTheme($recaptchaTheme)
    {
        $this->_recaptchaTheme = $recaptchaTheme;
    }

    /**
     * Get the reCAPTCHA theme
     *
     * @return string
     */
    public function getRecaptchaTheme()
    {
        return $this->_recaptchaTheme;
    }

    /**
     * Set the reCAPTCHA type
     *
     * @param string $recaptchaType
     */
    public function setRecaptchaType($recaptchaType)
    {
        $this->_recaptchaType = $recaptchaType;
    }

    /**
     * Get the reCAPTCHA type
     *
     * @return string
     */
    public function getRecaptchaType()
    {
        return $this->_recaptchaType;
    }

    /**
     * Set the reCAPTCHA language
     *
     * @param string $recaptchaLang
     */
    public function setRecaptchaLang($recaptchaLang)
    {
        $this->_recaptchaLang = $recaptchaLang;
    }

    /**
     * Get the reCAPTCHA language
     *
     * @return string
     */
    public function getRecaptchaLang()
    {
        return $this->_recaptchaLang;
    }

    /**
     * Set the reCAPTCHA size
     *
     * @param string $recaptchaSize
     */
    public function setRecaptchaSize($recaptchaSize)
    {
        $this->_recaptchaSize = $recaptchaSize;
    }

    /**
     * Get the reCAPTCHA size
     *
     * @return string
     */
    public function getRecaptchaSize()
    {
        return $this->_recaptchaSize;
    }

    /**
     * Set the reCAPTCHA badge position
     *
     * @param string $recaptchaBadgePosition
     */
    public function setRecaptchaBadgePosition($recaptchaBadgePosition)
    {
        $this->_recaptchaBadgePosition = $recaptchaBadgePosition;
    }

    /**
     * Get the reCAPTCHA badge position
     *
     * @return string
     */
    public function getRecaptchaBadgePosition()
    {
        return $this->_recaptchaBadgePosition;
    }

    /**
     * Get the reCAPTCHA config array
     *
     * @return array
     */
    public function getRecaptchaConfig()
    {
        return array(
            'sitekey' => get_option('vowels_form_builder_recaptcha_site_key'),
            'theme' => $this->getRecaptchaTheme(),
            'type' => $this->getRecaptchaType(),
            'size' => $this->getRecaptchaSize(),
            'badge' => $this->getRecaptchaBadgePosition()
        );
    }
}