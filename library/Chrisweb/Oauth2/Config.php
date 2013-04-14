<?php

/**
 * Chrisweb OAuth 2 for Zend Framework 1
 *
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 *
 */

/**
 * Chrisweb OAuth 2 Config
 */
class Chrisweb_Oauth2_Config
{

    /**
     * The URL root to preprend when redirecting to the oauth dialog
     *
     * @var string
     */
    protected $_dialogEndpoint = null;
    
    /**
     * The URL root preprend when doing oauth requests
     *
     * @var string
     */
    protected $_oauthEndpoint = null;

    /**
     * This optional value is used to define where the user is redirected to
     *
     * @var string
     */
    protected $_callbackUrl = null;

    /**
     * An OAuth application's client id
     *
     * @var string
     */
    protected $_clientId = null;

    /**
     * An OAuth application's client secret
     *
     * @var string
     */
    protected $_clientSecret = null;

    /**
     *
     * @var string
     */
    protected $_type = 'web_server';

    /**
     * the secret type
     *
     * @var string
     */
    protected $_secretType = null;
    
    /**
     * the grant type
     *
     * @var string
     */
    protected $_grantType = null;

    /**
     *
     * @var string
     */
    protected $_state = null;

    /**
     *
     * @var string
     */
    protected $_immediate = null;

    /**
     * rights that the application wants to get from website, can be string (single) or array (multiple)
     *
     * @var string|array
     */
    protected $_requestedRights = null;
    
    /**
     *
     * facebook oauth 2 dialog url
     * 
     * @var string
     */
    protected $_dialogUri = null;
    
    /**
     *
     * facebook get the access token uri
     * 
     * @var string
     */
    protected $_accessTokenUri = null;

    /**
     * Constructor; create a new object with an optional array|Zend_Config
     * instance containing initialising options.
     *
     * @param  array|Zend_Config $options
     * @return void
     */
    public function __construct($options = null)
    {
        if (!is_null($options)) {
            if ($options instanceof Zend_Config) {
                $options = $options->toArray();
            }
            $this->setOptions($options);
        }
    }

    /**
     * Parse option array or Zend_Config instance and setup options using their
     * relevant mutators.
     *
     * @param  array|Zend_Config $options
     * @return Zend_Oauth_Config
     */
    public function setOptions(array $options)
    {
        foreach ($options as $key => $value) {
            switch ($key) {
                case 'dialogEndpoint':
                    $this->setDialogEndpoint($value);
                    break;
                case 'oauthEndpoint':
                    $this->setOauthEndpoint($value);
                    break;
                case 'callbackUrl':
                    $this->setCallbackUrl($value);
                    break;
                case 'clientId':
                    $this->setClientId($value);
                    break;
                case 'clientSecret':
                    $this->setClientSecret($value);
                    break;
                case 'type':
                    $this->setType($value);
                    break;
                case 'secretType':
                    $this->setSecretType($value);
                    break;
                case 'grantType':
                    $this->setGrantType($value);
                    break;
                case 'state':
                    $this->setState($value);
                    break;
                case 'immediate':
                    $this->setImmediate($value);
                    break;
                case 'requestedRights':
                    $this->setRequestedRights($value);
                    break;
                case 'oauthDialogUri':
                    $this->setDialogUri($value);
                    break;
                case 'accessTokenUri':
                    $this->setAccessTokenUri($value);
                    break;
            }
        }

        return $this;
    }

    /**
     * Set dialog url
     *
     * @param  string $key
     * @return Zend_Oauth2_Config
     */
    public function setDialogEndpoint($dialogEndpoint)
    {
        $this->_dialogEndpoint = $dialogEndpoint;
        return $this;
    }

    /**
     * Get dialog url
     *
     * @return string
     */
    public function getDialogEndpoint()
    {
        return $this->_dialogEndpoint;
    }
    
    /**
     * Set oauth url
     *
     * @param  string $key
     * @return Zend_Oauth2_Config
     */
    public function setOauthEndpoint($oauthEndpoint)
    {
        $this->_oauthEndpoint = $oauthEndpoint;
        return $this;
    }

    /**
     * Get oauth url
     *
     * @return string
     */
    public function getOauthEndpoint()
    {
        return $this->_oauthEndpoint;
    }

    /**
     * Set callback url
     *
     * @param  string $callbackUrl
     * @return Zend_Oauth2_Config
     */
    public function setCallbackUrl($callbackUrl)
    {
        $this->_callbackUrl = $callbackUrl;
        return $this;
    }

    /**
     * Get callback url
     *
     * @return string
     */
    public function getCallbackUrl()
    {
        return $this->_callbackUrl;
    }

    /**
     * Set client id
     *
     * @param  string $id
     * @return Zend_Oauth2_Config
     */
    public function setClientId($clientId)
    {
        $this->_clientId = $clientId;
        return $this;
    }

    /**
     * Get client id
     *
     * @return string
     */
    public function getClientId()
    {
        return $this->_clientId;
    }

    /**
     * Set client secret
     *
     * @param  string $id
     * @return Zend_Oauth2_Config
     */
    public function setClientSecret($clientSecret)
    {
        $this->_clientSecret = $clientSecret;
        return $this;
    }

    /**
     * Get client secret
     *
     * @return string
     */
    public function getClientSecret()
    {
        return $this->_clientSecret;
    }

    /**
     * Set type
     *
     * @param  array rights
     * @return Zend_Oauth2_Config
     */
    public function setType($type)
    {
        $this->_type = $type;
        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->_type;
    }

    /**
     * Set secret type
     *
     * @param  array rights
     * @return Zend_Oauth2_Config
     */
    public function setSecretType($secretType)
    {
        $this->_secretType = $secretType;
        return $this;
    }

    /**
     * Get secret type
     *
     * @return string
     */
    public function getSecretType()
    {
        return $this->_secretType;
    }
    
    /**
     * 
     * Set grant type
     * 
     * @param string $grantType
     * @return \Chrisweb_Oauth2_Config
     */
    public function setGrantType($grantType)
    {
        $this->_grantType = $grantType;
        return $this;
    }

    /**
     * Get secret type
     *
     * @return string
     */
    public function getGrantType()
    {
        return $this->_grantType;
    }

    /**
     * Set state
     *
     * @param  string
     * @return Zend_Oauth2_Config
     */
    public function setState($state)
    {
        $this->_state = $state;
        return $this;
    }

    /**
     * Get state
     *
     * @return string
     */
    public function getState()
    {
        return $this->_state;
    }

    /**
     * Set immediate
     *
     * @param  string
     * @return Zend_Oauth2_Config
     */
    public function setImmediate($immediate)
    {
        $this->_immediate = $immediate;
        return $this;
    }

    /**
     * Get immediate
     *
     * @return string
     */
    public function getImmediate()
    {
        return $this->_immediate;
    }

    /**
     * Set requested rights
     *
     * @param  string|array
     * @return Zend_Oauth2_Config
     */
    public function setRequestedRights($rights)
    {
        $this->_requestedRights = $rights;
        return $this;
    }

    /**
     * Get requested rights
     *
     * @return string|array
     */
    public function getRequestedRights()
    {
        return $this->_requestedRights;
    }
    
    /**
     * 
     * Set the facebook dialog uri
     * 
     * @param string $accessTokenUri
     * @return \Chrisweb_Oauth2_Config
     */
    public function setDialogUri($oauthDialogUri)
    {
        $this->_dialogUri = $oauthDialogUri;
        return $this;
    }
    
    /**
     * 
     * Get the facebook dialog uri
     * 
     * @return string
     */
    public function getDialogUri()
    {
        return $this->_dialogUri;
    }
    
    /**
     * 
     * Set the facebook access token uri
     * 
     * @param string $accessTokenUri
     * @return \Chrisweb_Oauth2_Config
     */
    public function setAccessTokenUri($accessTokenUri)
    {
        $this->_accessTokenUri = $accessTokenUri;
        return $this;
    }
    
    /**
     * 
     * Get the facebook access token uri
     * 
     * @return string
     */
    public function getAccessTokenUri()
    {
        return $this->_accessTokenUri;
    }

}
