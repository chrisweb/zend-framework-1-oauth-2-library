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
 * @see Chrisweb_Oauth2_Config
 */
require_once 'Chrisweb/Oauth2/Config.php';

/**
 * @see Zend_Rest_Client
 */
require_once 'Zend/Rest/Client.php';

/**
 * @see Zend_Json
 */
require_once 'Zend/Json.php';

/**
 * Chrisweb OAuth 2
 */
class Chrisweb_Oauth2
{

    /**
     *
     * @var string
     */
    protected $_verificationCode = null;

    /**
     *
     * @varmixed
     */
    protected $_config = null;

    /**
     *
     * @var <type>
     */
    protected static $_localHttpClient = null;

    public function __construct($options = null)
    {
        $this->_config = new Chrisweb_Oauth2_Config();
        if (!is_null($options)) {
            if ($options instanceof Zend_Config) {
                $options = $options->toArray();
            }
            $this->_config->setOptions($options);
        }
    }

    /**
     * 
     * redirecting the end user's user-agent to the authorization page
     *
     * after accepting or denying user will be redirected to callback page
     * if user accepts url will include a parameter "code" and optional a parameter "state"
     * if user denies url will include a parameter "error" set to "user_denied"
     * and an optional parameter "state"
     *
     * - response_type REQUIRED (The type of user delegation authorization flow)
     *
     * - client_id REQUIRED (The client identifier)
     *
     * - redirect_uri REQUIRED (An absolute URI to which the authorization server will
     * redirect the user-agent to when the end user authorization step is completed)
     *
     * - state OPTIONAL (An opaque value used by the client to maintain state between
     * the request and callback)
     *
     * - immediate OPTIONAL (The parameter value must be set to "true" or "false"
     * (case sensitive).  If set to "true", the authorization server MUST NOT prompt
     * the end user to authenticate or approve access. Instead, the authorization
     * server attempts to establish the end user's identity via other means (e.g.
     * browser cookies) and checks if the end user has previously approved an
     * identical access request by the same client and if that access grant is
     * still active.  If the authorization server does not support an immediate
     * check or if it is unable to establish the end user's identity or approval
     * status, it MUST deny the request without prompting the end user. Defaults
     * to "false" if omitted.)
     * 
     * @param string $dialogEndpoint
     * @param string $callbackUrl
     * @param string $clientId
     * @param string $type
     * @param string $state
     * @param string $immediate
     * @param string $requestedRights
     * @param string $dialogUri
     * @throws Chrisweb_Oauth2_Exception
     */
    public function authorizationRedirect($dialogEndpoint = null, $callbackUrl = null, $clientId = null, $responseType = null, $state = null, $immediate = null, $requestedRights = null, $dialogUri = null)
    {
        if (is_null($dialogEndpoint)) $dialogEndpoint = $this->_config->getDialogEndpoint();
        if (is_null($callbackUrl)) $callbackUrl = $this->_config->getCallbackUrl();
        if (is_null($clientId)) $clientId = $this->_config->getClientId();
        if (is_null($responseType)) $responseType = $this->_config->getResponseType();
        if (is_null($state)) $state = $this->_config->getState();
        if (is_null($immediate)) $immediate = $this->_config->getImmediate();
        if (is_null($requestedRights)) $requestedRights = $this->_config->getRequestedRights();
        if (is_null($dialogUri)) $dialogUri = $this->_config->getDialogUri();

        $requiredValuesArray = array('dialogEndpoint', 'callbackUrl', 'clientId', 'dialogUri');

        // throw exception if one of the required values is missing
        foreach($requiredValuesArray as $requiredValue) {
            if (is_null($$requiredValue)) {
                require_once 'Chrisweb/Oauth2/Exception.php';
                throw new Chrisweb_Oauth2_Exception('value '. $requiredValue.' is empty, pass '.ucfirst($requiredValue).' as parameter when calling the '.__METHOD__.' method or add it to the options array you pass when creating an instance of the '.get_class($this).' class');
            }
        }

        // convert rights array to string
        $scope = '';
        if (is_array($requestedRights)) {
            $requestedRightsString = implode(',', $requestedRights);
            $scope = $requestedRightsString;
        } else {
            $scope = $requestedRights;
        }

        // construct request url and its parameters with required values
        if (substr($dialogEndpoint, -1) == '/') $dialogEndpoint = substr($dialogEndpoint, 0, strlen($dialogEndpoint) - 1);

        $baseUrl = $dialogEndpoint . $dialogUri;

        // Build array of parameters
        $baseUrlParams = array('client_id' => $clientId, 'redirect_uri' => $callbackUrl);

        // add optional values to request url
        if (!empty($responseType)) $baseUrlParams['response_type'] = $responseType;
        if (!empty($scope)) $baseUrlParams['scope'] = $scope;
        if (!empty($state)) $baseUrlParams['state'] = $state;
        if (!empty($immediate)) $baseUrlParams['immediate'] = $immediate;

        $baseUrlParams = http_build_query($baseUrlParams, null, '&', PHP_QUERY_RFC3986);
        $finalUrl = $baseUrl.'?'.$baseUrlParams;

        header('Location: ' . $finalUrl);
        exit(1);

    }

    /**
     *
     * @param string $right
     */
    public function addRequestedRight($right) {

        $rights = $this->getRequestedRights();

        if (is_array($rights)) {
            $rights[] = $right;
        } elseif (is_string($rights)) {
            $rightsArray = array();
            $rightsArray[] = $rights;
            $rightsArray[] = $right;
            $rights = $rightsArray;
        } else {
            $rights = $right;
        }

        $this->setRequestedRights($rights);
    }

    /**
     *
     * @param string $right
     */
    public function removeRequestedRight($right) {

        $rights = $this->getRequestedRights();

        $key = array_search($right, $rights);
        
        if ($key !== false) { 
            unset($rights[$key]);
        }
        
        $this->setRequestedRights($rights);

    }

    /**
     * Set verification code
     *
     * @param  string $verificationCode
     * @return Chrisweb_Oauth2
     */
    public function setVerificationCode($verificationCode)
    {
        $this->_verificationCode = $verificationCode;
        return $this;
    }

    /**
     * Get verification code
     *
     * @return string
     */
    public function getVerificationCode()
    {
        return $this->_verificationCode;
    }

    /**
     * Set local HTTP client as distinct from the static HTTP client
     * as inherited from Zend_Rest_Client.
     *
     * @param Zend_Http_Client $client
     * @return self
     */
    public static function setLocalHttpClient(Zend_Http_Client $httpClient)
    {
        self::$_localHttpClient = $httpClient;
    }

    /**
     *
     * @return <type>
     */
    public static function getLocalHttpClient()
    {
        if (!isset(self::$_localHttpClient)) {
            self::$_localHttpClient = new Zend_Http_Client;
        }

        return self::$_localHttpClient;
    }

    /**
     * Simple mechanism to delete the entire singleton HTTP Client instance
     * which forces an new instantiation for subsequent requests.
     *
     * @return void
     */
    public static function clearHttpClient()
    {
        self::$httpClient = null;
    }
    
    /**
     * 
     * requests an access token from the authorization server
     * 
     * The client obtains an access token from the authorization server by
     * making an HTTP "POST" request to the token endpoint. The client
     * constructs a request URI by adding the following parameters to the
     * request:
     *
     * - type REQUIRED (The type of user delegation authorization flow)
     *
     * - client_id REQUIRED (The client identifier)
     *
     * - client_secret REQUIRED (The matching client secret)
     *
     * - code REQUIRED (The verification code received from the authorization server)
     *
     * - redirect_uri REQUIRED (The redirection URI used in the initial request)
     *
     * - secret_type OPTIONAL (The access token secret type. If omitted, the authorization
     * server will issue a bearer token (an access token without a matching secret))
     * 
     * @param string $verificationCode
     * @param string $oauthEndpoint
     * @param string $callbackUrl
     * @param string $clientId
     * @param string $clientSecret
     * @param string $type
     * @param string $secretTtype
     * @param string $accessTokenUri
     * @return array
     * @throws Chrisweb_Oauth2_Exception
     */
    public function requestAccessToken($verificationCode = null, $oauthEndpoint = null, $callbackUrl = null, $clientId = null, $clientSecret = null, $grantType = null, $accessTokenUri = null)
    {
        if (is_null($verificationCode)) $verificationCode = $this->getVerificationCode();
        if (is_null($oauthEndpoint)) $oauthEndpoint = $this->_config->getOauthEndpoint();
        if (is_null($callbackUrl)) $callbackUrl = $this->_config->getCallbackUrl();
        if (is_null($clientId)) $clientId = $this->_config->getClientId();
        if (is_null($clientSecret)) $clientSecret = $this->_config->getClientSecret();
        if (is_null($grantType)) $grantType = $this->_config->getGrantType();
        if (is_null(self::$_localHttpClient)) $this->setLocalHttpClient($this->getLocalHttpClient());
        if (is_null($accessTokenUri)) $accessTokenUri = $this->_config->getAccessTokenUri();

        $requiredValuesArray = array('verificationCode', 'clientId', 'clientSecret', 'callbackUrl', 'accessTokenUri', 'oauthEndpoint');

        // throw exception if one of the required values is missing
        foreach($requiredValuesArray as $requiredValue) {
            if (is_null($$requiredValue)) {
                require_once 'Chrisweb/Oauth2/Exception.php';
                throw new Chrisweb_Oauth2_Exception('value '. $requiredValue.' is empty, pass the '.ucfirst($requiredValue).' as parameter when calling the '.__METHOD__.' method or add it to the options array you pass when creating an instance of the '.get_class($this).' class');
            }
        }

        if (substr($oauthEndpoint, -1) == '/') $oauthEndpoint = substr($oauthEndpoint, 0, strlen($oauthEndpoint)-1);
        
        $postParametersArray = array(
            'client_id'   => $clientId,
            'client_secret' => $clientSecret,
            'code' => $verificationCode,
            'redirect_uri' => $callbackUrl
        );

        if (!empty($grantType) && !is_null($grantType)) {
            $postParametersArray['grant_type'] = $grantType;
        }

        self::$_localHttpClient ->resetParameters()
                                ->setHeaders('Accept-Charset', 'ISO-8859-1,utf-8')
                                ->setUri($oauthEndpoint.$accessTokenUri)
                                ->setParameterPost($postParametersArray);

        //Zend_Debug::dump(self::$_localHttpClient->getUri());
        //exit;

        $response = self::$_localHttpClient->request('POST');

        if (!is_null($response)) {
            
            $body   = $response->getBody();
            $status = $response->getStatus();
            
        } else {

            require_once 'Chrisweb/Oauth2/Exception.php';
            throw new Chrisweb_Oauth2_Exception('the response we recieved is emtpy');

        }

        //Zend_Debug::dump($body, 'body');
        //exit;

        if ($status != '200') {
            
            $errorArray = Zend_Json::decode($body);
            
            //Zend_Debug::dump($errorArray);
            //exit;
            
            $errorMessage = '';
            
            $errorMessage .= 'we recieved an error ('.$status.') as response';
            
            if (array_key_exists('error', $errorArray)) {
                
                if (is_array($errorArray['error'])) {
                
                    foreach($errorArray['error'] as $errorKey => $errorValue) {

                        $errorMessage .= ', '.$errorKey.': '.$errorValue; 

                    }
                    
                } else if (is_string($errorArray['error'])) {
                    
                    $errorMessage .= ', error message: '.$errorArray['error'];
                    
                }
                
            }
            
            if (array_key_exists('error_description', $errorArray)) {
                
                $errorMessage .= ', description: '.$errorArray['error_description'];

            }
            
            
            if (array_key_exists('error_uri', $errorArray)) {
                
                $errorMessage .= ', error uri: '.$errorArray['error_uri'];

            }

            require_once 'Chrisweb/Oauth2/Exception.php';
            throw new Chrisweb_Oauth2_Exception($errorMessage);

        } else {
            
            $oauthResponse = array();
            
            // is it a json string or just a string
            try {
            
                $oauthResponse = Zend_Json::decode($body);

            } catch (Exception $e) {

                // not a json string
                $explodedBody = explode('&', $body);

                //Zend_Debug::dump($explodedBody, '$explodedBody');
                //exit;

                if (count($explodedBody) > 1) {

                    foreach($explodedBody as $explodedBodyPart) {

                        $responseParts = explode('=', $explodedBodyPart);

                        switch ($responseParts[0]) {
                            case 'access_token':
                                $oauthResponse['access_token'] = $responseParts[1];
                                break;
                            case 'expires':
                                $oauthResponse['expires'] = $responseParts[1];
                                break;
                        }

                    }

                }

            }

        }

        return $oauthResponse;
        
    }

}
