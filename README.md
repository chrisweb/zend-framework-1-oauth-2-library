About:
======

Zend Framework 1 OAuth 2 Library

version 1.1.0

Examples:
=========

Zend Framework 1 OAuth 2 examples.

Jamendo API OAuth 2
-------------------

1) Add the latest Zend Framework and the Chrisweb library to the library directory.

2) Setup an Apache vhost for the example:

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

3) Update your hosts file:

127.0.0.1 www.jamendoapioauth2.dev

4) Create a Jamendi API account, then create a configuration file and add the values:

```
; application/configs/jamendo_api.ini

; http://developer.jamendo.com/v3.0/oauth2

; to get a jamendo api account visit: https://devportal.jamendo.com/

; jamendo api configuration
dialogEndpoint = https://api.jamendo.com/v3.0
oauthEndpoint = https://api.jamendo.com/v3.0
clientId = 0000000000
clientSecret = 0000000000000000000000000000
callbackUrl = http://www.jamendoapioauth2.dev/jamendocallback
oauthDialogUri = /oauth/authorize
accessTokenUri = /oauth/grant
stateSecret = afs4f4g8e4asgaas
grantType = authorization_code
requestedRights = music ; = scope
responseType = code ; = response_type
```

Facebook Open Graph API OAuth 2
-------------------------------

1) Add the latest Zend Framework and the Chrisweb library to the library directory.

2) Setup an Apache vhost for the example:

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

3) Update your hosts file:

127.0.0.1 www.facebookopengraphoauth2.dev

4) Create a Facebook API account, then create a configuration file and add the values:

```
; application/configs/facebook_api.ini

; https://developers.facebook.com/docs/howtos/login/server-side-login/

; facebook api configuration
dialogEndpoint = https://www.facebook.com
oauthEndpoint = https://graph.facebook.com
clientId = 000000000000000000
clientSecret = 000000000000000000000000000000
callbackUrl = http://www.facebookopengraphoauth2.dev/facebookcallback
responseType = code ; or token, none, signed_request
oauthDialogUri = /dialog/oauth
accessTokenUri = /oauth/access_token
stateSecret = afs4f4g8e4asgaas
; permissions https://developers.facebook.com/docs/concepts/login/permissions-login-dialog/
requestedRights = email,user_actions.music,user_likes
```

Google+ API OAuth 2
-------------------------------

1) Add the latest Zend Framework and the Chrisweb library to the library directory.

2) Setup an Apache vhost for the example:

apache vhost.conf

```
<VirtualHost *:80>

    ServerName www.googleplusoauth2.dev
    DocumentRoot /path/to/examples/GooglePlusOAuth2/public
    ErrorLog "logs/googleplusoauth2-error.log"
    CustomLog "logs/googleplusoauth2-access.log" combined
    SetEnv APPLICATION_ENV "development"
 
    <Directory /path/to/examples/GooglePlusOAuth2/public>
        DirectoryIndex index.php
        AllowOverride All
        Order allow,deny
        Allow from all
    </Directory>
	
</VirtualHost>
```

3) Update your hosts file:

127.0.0.1 www.googleplusoauth2.dev

4) Create a Google+ API account, then create a configuration file and add the values:

```
; application/configs/google_plus_api.ini

; https://developers.google.com/+/api/oauth

; google+ api configuration
dialogEndpoint = https://accounts.google.com/o/oauth2
oauthEndpoint = https://accounts.google.com/o/oauth2
clientId = 0000000000000000.apps.googleusercontent.com
clientSecret = 00000000000000000000000000000
responseType = code ; https://developers.google.com/accounts/docs/OAuth2Login#responsetypeparameter
callbackUrl = http://127.0.0.1/googlepluscallback
secretType = 
immediate = 
oauthDialogUri = /auth
accessTokenUri = /token
stateSecret = afs4f4g8e4asgaas
; google+ scopes https://developers.google.com/+/api/oauth#scopes
requestedRights = https://www.googleapis.com/auth/plus.login,https://www.googleapis.com/auth/plus.me,https://www.googleapis.com/auth/userinfo.email
```