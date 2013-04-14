About:
======

Zend Framework 1 OAuth 2 Library

version 1.1.0

Examples:
=========

Zend Framework 1 OAuth 2 examples.

Jamendo API OAuth 2
-------------------

1. Add the latest Zend Framework and the Chrisweb library to the library directory.

2. Setup an Apache vhost for the example:

apache vhost.conf

```
<VirtualHost *:80>

    ServerName www.jamendoapioauth2.dev
    DocumentRoot /path/to/examples/JamendoApiOAuth2/public
    ErrorLog "logs/jamendoapioauth2-error.log"
    CustomLog "logs/jamendoapioauth2-access.log" combined
    SetEnv APPLICATION_ENV "development"
 
    <Directory /path/to/examples/JamendoApiOAuth2/public>
        DirectoryIndex index.php
        AllowOverride All
        Order allow,deny
        Allow from all
    </Directory>
	
</VirtualHost>
```

3. Update your hosts file:

127.0.0.1 www.jamendoapioauth2.dev

4. Create a Jamendi API account, then create a configuration file and add the values:

```
; application/configs/jamendo_api.ini

; to get a jamendo api account visit: https://devportal.jamendo.com/

; jamendo api configuration
dialogEndpoint = https://api.jamendo.com/v3.0
oauthEndpoint = https://api.jamendo.com/v3.0
clientId = 000000000
clientSecret = 00000000000000000000000000000000
callbackUrl = http://www.mywebsite.dev/jamendocallback
oauthDialogUri = /oauth/authorize
accessTokenUri = /oauth/grant
stateSecret = a_secret_phrase
grantType = authorization_code
```

Facebook Open Graph API OAuth 2
-------------------------------

1. Add the latest Zend Framework and the Chrisweb library to the library directory.

2. Setup an Apache vhost for the example:

apache vhost.conf

```
<VirtualHost *:80>

    ServerName www.facebookopengraphoauth2.dev
    DocumentRoot /path/to/examples/FacebookOpenGraphOAuth2/public
    ErrorLog "logs/facebookopengraphoauth2-error.log"
    CustomLog "logs/facebookopengraphoauth2-access.log" combined
    SetEnv APPLICATION_ENV "development"
 
    <Directory /path/to/examples/FacebookOpenGraphOAuth2/public>
        DirectoryIndex index.php
        AllowOverride All
        Order allow,deny
        Allow from all
    </Directory>
	
</VirtualHost>
```

3. Update your hosts file:

127.0.0.1 www.facebookopengraphoauth2.dev

4. Create a Facebook API account, then create a configuration file and add the values:

```
; application/configs/facebook_api.ini

; facebook api configuration
dialogEndpoint = https://www.facebook.com
oauthEndpoint = https://graph.facebook.com
clientId = 0000000000000
clientSecret = 000000000000000000000000000000
callbackUrl = http://www.facebookopengraphoauth2.dev/facebookcallback
oauthDialogUri = /dialog/oauth
accessTokenUri = /oauth/access_token
stateSecret = a_secret_phrase
```