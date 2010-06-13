<?php

/**
 * Zend Framework
 *
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://framework.zend.com/license/new-bsd
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@zend.com so we can send you a copy immediately.
 *
 * @category   Zend
 * @package    Zend_Service
 * @subpackage Facebook
 * @copyright  Copyright (c) 2005-2010 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    
 */

/**
 * @see Zend_Rest_Client
 */
require_once 'Zend/Rest/Client.php';

/**
 * @see Zend_Json
 */
require_once 'Zend/Json.php';

/**
 * @see Zend_Oauth2
 */
require_once 'Zend/Oauth2.php';

/**
 * @category   Zend
 * @package    Zend_Service
 * @subpackage Twitter
 * @copyright  Copyright (c) 2005-2010 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class Zend_Service_Facebook extends Zend_Rest_Client
{

    /**
     *
     */
    const API_URL = 'https://graph.facebook.com/';

    /**
     *
     */
    const SEARCH_URI = 'search';

    /**
     *
     * @var booleen
     */
    protected $_connectionsIntropsection = false;

    /**
     *
     * @var string
     */
    protected $_appId;

    /**
     *
     * @var string
     */
    protected $_appSecret;

    /**
     * Local HTTP Client cloned from statically set client
     * @var Zend_Http_Client
     */
    protected $_localHttpClient = null;

    /**
     *
     * @var string
     */
    protected $_objectId = 'me';

    /**
     *
     * @var string
     */
    protected $_accessToken = null;

    /**
     *
     * @var mixed
     */
    protected $_objectFields = null;

    /**
     *
     * @var mixed
     */
    protected $_objectConnections = null;

    /**
     *
     * @var int
     */
    protected $_limit = null;

    /**
     *
     * @var int
     */
    protected $_offset = null;

    /**
     *
     * @var <type>
     */
    protected $_since = null;

    /**
     *
     * @var <type> 
     */
    protected $_until = null;

    /**
     *
     * @var <type> 
     */
    protected $_searchQuery = null;

    /**
     *
     * @var <type>
     */
    protected $_searchType = 'home';

    /**
     * Constructor
     *
     * @return void
     */
    public function __construct($options = null)
    {
        // if options are instance of zend config convert them to array
        if ($options instanceof Zend_Config) {
            $options = $options->toArray();
        }

        //Zend_Debug::dump($options);
        //
        if (is_array($options)) {
            $this->setOptions($options);
        }

        // setup http (rest) client
        $this->setLocalHttpClient(clone self::getHttpClient());
        $this->setUri(self::API_URL);
        $this->_localHttpClient->setHeaders('Accept-Charset', 'ISO-8859-1,utf-8');

        //Zend_Debug::dump($this->_localHttpClient);

    }

    /**
     * Set options
     *
     * @param  $options
     * @return Zend_Service_Facebook
     */
    public function setOptions(array $options)
    {
        foreach ($options as $key => $value) {
            $method = 'set' . $key;
            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }

        return $this;
    }

    /**
     * Set local HTTP client as distinct from the static HTTP client
     * as inherited from Zend_Rest_Client.
     *
     * @param Zend_Http_Client $client
     * @return self
     */
    public function setLocalHttpClient(Zend_Http_Client $client)
    {
        $this->_localHttpClient = $client;
        return $this;
    }

    /**
     *
     * @return <type>
     */
    public function getLocalHttpClient()
    {
        return $this->_localHttpClient;
    }

    /**
     *
     * @param <type> $status
     * @return <type>
     */
    public function setConnectionsIntropsection($status)
    {
        $this->_connectionsIntropsection = (bool) $status;
        return $this;
    }

    /**
     *
     * @return <type>
     */
    public function getConnectionsIntropsection()
    {
        return $this->_connectionsIntropsection;
    }

    /**
     *
     * @param <type> $appId
     * @return <type>
     */
    public function setAppId($appId)
    {
        $this->_appId = $appId;

        //Zend_Debug::dump($this->_appId);

        return $this;
    }

    /**
     *
     * @return <type>
     */
    public function getAppId()
    {
        return $this->_appId;
    }

    /**
     *
     * @param <type> $apiSecret
     * @return <type>
     */
    public function setAppSecret($appSecret)
    {
        $this->_appSecret = $appSecret;
        return $this;
    }

    /**
     *
     * @return <type>
     */
    public function getAppSecret()
    {
        return $this->_appSecret;
    }

    /**
     *
     * @param <type> $apiSecret
     * @return <type>
     */
    public function setObjectId($objectId)
    {
        $this->_objectId = $objectId;
        return $this;
    }

    /**
     *
     * @return <type>
     */
    public function getObjectId()
    {
        return $this->_objectId;
    }

    /**
     *
     * @param <type> $apiSecret
     * @return <type>
     */
    public function setAccessToken($accessToken)
    {
        $this->_accessToken = $accessToken;
        return $this;
    }

    /**
     *
     * @return <type>
     */
    public function getAccessToken()
    {
        return $this->_accessToken;
    }

    /**
     *
     */
    public function clearAccessToken()
    {
        $this->_accessToken = null;
    }

    /**
     *
     */
    public function setObjectFields()
    {

    }

    /**
     *
     */
    public function getObjectFields()
    {
        return $this->_objectFields;
    }

    /**
     *
     */
    public function addObjectField()
    {

    }

    /**
     *
     */
    public function removeObjectField()
    {

    }

    /**
     *
     */
    public function addObjectFields()
    {

    }

    /**
     *
     */
    public function removeObjectFields()
    {

    }

    /**
     *
     */
    public function clearObjectFields()
    {
        $this->_objectFields = null;
    }

    /**
     *
     */
    public function setObjectConnections()
    {

    }

    /**
     *
     */
    public function getObjectConnections()
    {
        return $this->_objectConnections;
    }

    /**
     *
     */
    public function addObjectConnection()
    {

    }

    /**
     *
     */
    public function removeObjectConnection()
    {

    }

    /**
     *
     */
    public function addObjectConnections()
    {

    }

    /**
     *
     */
    public function removeObjectConnections()
    {

    }

    /**
     *
     */
    public function clearObjectConnections()
    {
        $this->_objectConnections = null;
    }

    /**
     *
     * @param int $limit
     * @return <type>
     */
    public function setLimit($limit)
    {
        $this->_limit = (int) $limit;
        return $this;
    }

    /**
     *
     * @return int
     */
    public function getLimit()
    {
        return $this->_limit;
    }

    /**
     *
     */
    public function clearLimit()
    {
        $this->_limit = null;
    }

    /**
     *
     * @param int $offset
     * @return <type>
     */
    public function setOffset($offset)
    {
        $this->_offset = (int) $offset;
        return $this;
    }

    /**
     *
     * @return int
     */
    public function getOffset()
    {
        return $this->_offset;
    }

    /**
     *
     */
    public function clearOffset()
    {
        $this->_offset = null;
    }
    
    /**
     *
     * @param mixed $since
     * @return <type>
     */
    public function setSince($since)
    {
        /*if (!is_numeric($since) && strtotime($since) === false) {
            require_once 'Zend/Service/Facebook/Exception.php';
            throw new Zend_Service_Facebook_Exception('wrong date / time fromat');
        }*/
        $this->_since = $since;
        return $this;
    }

    /**
     *
     * @return
     */
    public function getSince()
    {
        return $this->_since;
    }

    /**
     *
     */
    public function clearSince()
    {
        $this->_since = null;
    }
    
    /**
     *
     * @param mixed $until
     * @return <type>
     */
    public function setUntil($until)
    {
        if (!is_numeric($since) && strtotime($until) === false) {
            require_once 'Zend/Service/Facebook/Exception.php';
            throw new Zend_Service_Facebook_Exception('wrong date / time fromat');
        }
        $this->_until = $until;
        return $this;
    }

    /**
     *
     * @return 
     */
    public function getUntil()
    {
        return $this->_until;
    }

    /**
     *
     */
    public function clearUntil()
    {
        $this->_until = null;
    }

    /**
     *
     * @param string $searchQuery
     * @return <type>
     */
    public function setSearchQuery($searchQuery)
    {
        $this->_searchQuery = $searchQuery;
        return $this;
    }

    /**
     *
     * @return <type>
     */
    public function getSearchQuery()
    {
        return $this->_searchQuery;
    }

    /**
     *
     * @param <type> $searchType
     * @return <type>
     */
    public function setSearchType($searchType)
    {
        $this->_searchType = $searchType;
        return $this;
    }

    /**
     *
     * @return <type>
     */
    public function getSearchType()
    {
        return $this->_searchType;
    }

    /**
     *
     * Performs a Facebook (open) graph query
     *
     * @param <type> $objectId
     * @param <type> $accessToken
     * @param <type> $objectConnections
     * @param <type> $objectFields
     * @param <type> $connectionsIntropsection
     * @param <type> $limit
     * @param <type> $offset
     * @param <type> $since
     * @param <type> $until
     * @return <type>
     */
    public function graphQuery($objectId = null, $accessToken = null, $objectConnections = null, $objectFields = null, $connectionsIntropsection = null, $limit = null, $offset = null, $since = null, $until = null)
    {
        // set basic path
        if (is_null($objectId)) $objectId = $this->getObjectId();
        $path = $objectId;

        // check if the query limit / offset / since / until are set, if true add them to the query
        if (is_null($limit)) $limit = $this->getLimit();
        if (is_null($offset)) $offset = $this->getOffset();
        if (is_null($since)) $since = $this->getSince();
        if (is_null($until)) $until = $this->getUntil();

        // prepare the query array
        $queryAndPathArray = $this->_prepareGraphQuery($objectFields, $objectConnections, $path, $limit, $offset, $since, $until);
        $query = $queryAndPathArray[0];
        $path = $queryAndPathArray[1];

        // check if accesstoken is available
        if (is_null($accessToken)) $accessToken = $this->_accessToken;
        if (!is_null($accessToken)) $query['access_token'] = $accessToken;

        // check if connectionsIntropsection was set and is set to true
        if (is_null($connectionsIntropsection)) $connectionsIntropsection = $this->_connectionsIntropsection;
        if (!is_null($connectionsIntropsection) && $connectionsIntropsection) $query['metadata'] = '1';

        //Zend_Debug::dump($path);
        //Zend_Debug::dump($query);
        //exit;

        // retrieve response
        $response = $this->_getResponse($path, $query);

        // check if response is not empty
        if (!is_null($response)) {
            $body   = $response->getBody();
            $status = $response->getStatus();
        } else {
            require_once 'Zend/Service/Facebook/Exception.php';
            throw new Zend_Service_Facebook_Exception('the response we recieved is emtpy');
        }

        //Zend_Debug::dump($body, 'body');
        //exit;

        // convert json response into an array
        $responseAsArray = Zend_Json::decode($body);

        // if status code is different then 200 throw exception
        if ($status != '200') {
            require_once 'Zend/Oauth2/Exception.php';
            throw new Zend_Oauth2_Exception('we recieved an error ('.$status.') as response: '.$responseAsArray['error']['type'].' => '.$responseAsArray['error']['message']);
        }

        return $responseAsArray;

    }

    /**
     *
     * Performs a Facebook search query.
     *
     * @throws Zend_Http_Client_Exception
     *
     * @param <type> $searchType
     * @param <type> $searchQuery
     * @param <type> $accessToken
     * @return <type>
     */
    public function searchGraphQuery($searchQuery = null, $searchType = null, $accessToken = null)
    {

        // We support search for the following types of objects:
        // All public posts: https://graph.facebook.com/search?q=watermelon&type=post
        // People: https://graph.facebook.com/search?q=mark&type=user
        // Pages: https://graph.facebook.com/search?q=platform&type=page
        // Events: https://graph.facebook.com/search?q=conference&type=event
        // Groups: https://graph.facebook.com/search?q=programming&type=group
        // You can also search an individual user's News Feed, restricted to that
        // user's friends, by adding a q argument to the home connection URL:
        // News Feed: https://graph.facebook.com/me/home?q=facebook

        // build query array
        $query = array();
        $path = self::SEARCH_URI;

        // the search query parameter is required, check if its not null or
        // throw error
        if (is_null($searchQuery)) $searchQuery = $this->getSearchQuery();

        if (is_null($searchQuery)) {
            require_once 'Zend/Service/Facebook/Exception.php';
            throw new Zend_Service_Facebook_Exception('the search query parameter is required');
        } else {
            //$query['q'] = rawurlencode($searchQuery);
            $query['q'] = $searchQuery;
        }

        // check if search type is home, which it is by default, if its home
        // we have to use another search url
        if (is_null($searchType)) $searchType = $this->getSearchType();

        if ($searchType == 'home') {
            $path = 'me/home';
        } else {
            $query['type'] = $searchType;
        }

        // check if accesstoken is available
        if (is_null($accessToken)) $accessToken = $this->_accessToken;
        if (!is_null($accessToken)) $query['access_token'] = $accessToken;

        // retrieve response
        $response = $this->_getResponse($path, $query);

        // check if response is not empty
        if (!is_null($response)) {
            $body   = $response->getBody();
            $status = $response->getStatus();
        } else {
            require_once 'Zend/Service/Facebook/Exception.php';
            throw new Zend_Service_Facebook_Exception('the response we recieved is emtpy');
        }

        //Zend_Debug::dump($body, 'body');
        //exit;

        // convert json response into an array
        $responseAsArray = Zend_Json::decode($body);

        // if status code is different then 200 throw exception
        if ($status != '200') {
            require_once 'Zend/Oauth2/Exception.php';
            throw new Zend_Oauth2_Exception('we recieved an error ('.$status.') as response: '.$responseAsArray['error']['type'].' => '.$responseAsArray['error']['message']);
        }

        return $responseAsArray;

    }

    /**
     *
     * @param <type> $objectFields
     * @param <type> $objectConnections
     * @param <type> $path
     * @param <type> $limit
     * @param <type> $offset
     * @param <type> $since
     * @param <type> $until
     * @return <type>
     */
    protected function _prepareGraphQuery($objectFields = null, $objectConnections = null, $path = '', $limit = null, $offset = null, $since = null, $until = null)
    {

        // build query array
        $query = array();

        // if the limit / offset / since / until is not null add it to query parameters
        if (!is_null($limit)) $query['limit'] = $limit;
        if (!is_null($offset) && !is_null($limit)) $query['offset'] = $offset;
        if (!is_null($since) && !is_null($limit)) $query['since'] = $since;
        if (!is_null($until) && !is_null($limit)) $query['until'] = $until;

        // if both are null return null
        if (is_null($objectFields) && is_null($objectConnections)) return array(null, $path);

        // if only connections are null return query with fields list
        if (!is_null($objectFields) && is_null($objectConnections)) {
            // check if fields got specified
            if (is_string($objectFields)) {
                $query['fields'] = $objectFields;
            } else {
                if (count($objectFields) === 1) {
                    $query['fields'] = $objectFields[0];
                } elseif ((count($objectFields) > 1)) {
                    $query['fields'] = implode(',', $objectFields);
                }
            }
            return array($query, $path);
        }

        // if only fields are null return query with connections list
        // strange behavior
        // fields and connections dont behave the same, you can mix them and then path the whole list as parameter
        // even if you pass multiple connections to facebook you can pass then as fields list
        // but if you only need to pass one connection you must add it to the path
        // a single field is ok if you pass it in the fields query but not a single connection
        if (is_null($objectFields) && !is_null($objectConnections)) {
            // check if fields got specified
            if (is_string($objectConnections)) {
                $path .= '/'.$objectConnections;
            } else {
                if (count($objectConnections) === 1) {
                    $path .= '/'.$objectConnections[0];
                } elseif ((count($objectConnections) > 1)) {
                    $query['fields'] = implode(',', $objectConnections);
                }
            }
            return array($query, $path);
        }

        // if none is null return query with connections and fields list
        if (!is_null($objectFields) && !is_null($objectConnections)) {
            $fieldsAndConnections = array();
            if (is_string($objectFields)) $fieldsAndConnections[] = $objectFields;
            if (is_string($objectConnections)) $fieldsAndConnections[] = $objectConnections;
            if (is_array($objectFields)) $fieldsAndConnections = array_merge($fieldsAndConnections, $objectFields);
            if (is_array($objectConnections)) $fieldsAndConnections = array_merge($fieldsAndConnections, $objectConnections);
            $query['fields'] = implode(',', $fieldsAndConnections);
            return array($query, $path);
        }
    }

    /**
     * Performs an HTTP GET request to the $path.
     *
     * @param string $path
     * @param array  $query Array of GET parameters
     * @throws Zend_Http_Client_Exception
     * @return Zend_Http_Response
     */
    protected function _getResponse($path, array $query = null)
    {
        // Get the URI object and configure it
        if (!$this->_uri instanceof Zend_Uri_Http) {
            require_once 'Zend/Rest/Client/Exception.php';
            throw new Zend_Rest_Client_Exception('URI object must be set before performing call');
        }

        $uri = $this->_uri->getUri();

        if ($path[0] != '/') {
            $path = '/' . $path;
        }

        $this->_uri->setPath($path);

        /**
         * Get the HTTP client and configure it for the endpoint URI.  Do this each time
         * because the Zend_Http_Client instance is shared among all Zend_Service_Abstract subclasses.
         */
        $this->_localHttpClient ->resetParameters()
                                ->setUri($this->_uri)
                                ->setParameterGet($query);
        return $this->_localHttpClient->request('GET');
    }

}
