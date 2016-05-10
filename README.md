About:
======

Zend Framework 1 OAuth 2 Library

version 1.1.1

Examples:
=========

Zend Framework 1 OAuth 2 examples.

Facebook Open Graph API OAuth 2
-------------------------------

1) Add the latest "Zend" Framework linrary and the "Chrisweb" library to the library directory

2) Setup an Apache vhost for the example:

apache vhost.conf

```
<VirtualHost *:80>

    ServerName www.facebookopengraphoauth2.test
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

3) (optional) Update your hosts file:

127.0.0.1 www.facebookopengraphoauth2.test

3.1) or just use the localhost IP to access the example(s)

http://127.0.0.1

4) Create a Facebook API account at https://developers.facebook.com/apps

Don't forget to set the go to "Settings" and set the correct "App Domains" (for example www.facebookopengraphoauth2.test) and also set the "Website / Site Url" (for example www.facebookopengraphoauth2.test)

5) Finally go into "/examples/FacebookOpenGraphOAuth2/application/configs/" and rename the file "facebook_api_EXAMPLE.ini" to "facebook_api.ini" and add your own values where needed

5.1) Or if you prefer you can also create a new configuration file named "facebook_api.ini" in "/examples/FacebookOpenGraphOAuth2/application/configs/" and add the following values:

```
; documentation: https://developers.facebook.com/docs/facebook-login

; facebook OAuth api configuration
dialogEndpoint = https://www.facebook.com
oauthEndpoint = https://graph.facebook.com
clientId = 000000000000000000 ; change this with own values: clientId => Facebook App ID
clientSecret = 000000000000000000000000000000 ; change this with own values: clientSecret => Facebook App Secret
callbackUrl = http://www.facebookopengraphoauth2.test/facebookcallback
responseType = code ; or token, none, signed_request
oauthDialogUri = /dialog/oauth
accessTokenUri = /oauth/access_token
stateSecret = SOME_SECRET ; change this with own values, change the secret every time you think it could have been compromised, it is used to ensure the OAuth requests really come from your app
; permissions https://developers.facebook.com/docs/facebook-login/permissions
requestedRights = email
```

Google+ API OAuth 2
-------------------------------

1) Add the latest Zend Framework and the Chrisweb library to the library directory.

2) Setup an Apache vhost for the example:

apache vhost.conf

```
<VirtualHost *:80>

    ServerName www.googleplusoauth2.test
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

3) (optional) Update your hosts file:

127.0.0.1 www.googleplusoauth2.test

3.1) or just use the localhost IP to access the example(s)

http://127.0.0.1

4) Create a Google+ API account at https://console.developers.google.com

5) Finally go into "/examples/GooglePlusOAuth2/application/configs/" and rename the file "google_plus_api_EXAMPLE.ini" to "google_plus_api.ini" and add your own values where needed

5.1) Or if you prefer you can also create a new configuration file named "google_plus_api.ini" in "/examples/GooglePlusOAuth2/application/configs/" and add the following values:

```
; documentation: https://developers.google.com/+/web/api/rest/oauth

; google+ api configuration
dialogEndpoint = https://accounts.google.com/o/oauth2
oauthEndpoint = https://accounts.google.com/o/oauth2
clientId = 0000000000000000.apps.googleusercontent.com ; change this with own values
clientSecret = 00000000000000000000000000000 ; change this with own values
responseType = code ; https://developers.google.com/identity/protocols/OpenIDConnect#responsetypeparameter
callbackUrl = http://www.googleplusoauth2.test/googlepluscallback
secretType = 
immediate = 
oauthDialogUri = /auth
accessTokenUri = /token
stateSecret = SOME_SECRET ; change this with own values, change the secret every time you think it could have been compromised, it is used to ensure the OAuth requests really come from your app
; google+ scopes https://developers.google.com/+/web/api/rest/oauth#authorization-scopes
requestedRights = https://www.googleapis.com/auth/plus.login,https://www.googleapis.com/auth/plus.me,https://www.googleapis.com/auth/userinfo.email
```

Jamendo API OAuth 2
-------------------

1) Add the latest Zend Framework and the Chrisweb library to the library directory.

2) Setup an Apache vhost for the example:

apache vhost.conf

```
<VirtualHost *:80>

    ServerName www.jamendoapioauth2.test
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

3) (optional) Update your hosts file:

127.0.0.1 www.jamendoapioauth2.test

3.1) or just use the localhost IP to access the example(s)

http://127.0.0.1

4) Create a Jamendi API account at https://developer.jamendo.com/v3.0

5) Finally go into "/examples/JamendoApiOAuth2/application/configs/" and rename the file "jamendo_api_EXAMPLE.ini" to "jamendo_api.ini" and add your own values where needed

5.1) Or if you prefer you can also create a new configuration file named "jamendo_api.ini" in "/examples/JamendoApiOAuth2/application/configs/" and add the following values:

```
; documentation: https://developer.jamendo.com/v3.0/authentication#oauth2-authorize-request

; jamendo api configuration
dialogEndpoint = https://api.jamendo.com/v3.0
oauthEndpoint = https://api.jamendo.com/v3.0
clientId = 0000000000 ; change this with own values
clientSecret = 0000000000000000000000000000 ; change this with own values
callbackUrl = http://www.jamendoapioauth2.test/jamendocallback
oauthDialogUri = /oauth/authorize
accessTokenUri = /oauth/grant
stateSecret = SOME_SECRET ; change this with own values, change the secret every time you think it could have been compromised, it is used to ensure the OAuth requests really come from your app
grantType = authorization_code
requestedRights = music ; = scope
responseType = code ; = response_type
```