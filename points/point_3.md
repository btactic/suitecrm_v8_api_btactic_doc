## 3.- Api requirements.

In order to prevent man-in-the-middle attacks, the authorization server MUST require the use of TLS with server authentication as defined by RFC2818 for any request sent to the authorization and token endpoints. The client MUST validate the authorization server’s TLS certificate as defined by RFC6125 and in accordance with its requirements for server identity authentication.

SuiteCRM uses key cryptography in order to encrypt and decrypt, as well as verify the integrity of signatures.

<b>Please ensure that you have the following:</b>

   1. OpenSSL PHP Extension installed and configured

   2. The SuiteCRM instance must be configured to use HTTPS/SSL

   3. You need to have PHP version 5.5.9, or 7.0 and above
   
Also you need to install composer packages:
    
`composer install`
    

<b>Generate private and public.key for OAUTH2</b>


SuiteCRM Api uses OAuth2 protocol, which needs public and private keys.

First, open a terminal and go to {{your-SuiteCRM-root}}/Api/V8/OAuth2

Generate a private key:

`openssl genrsa -out private.key 2048`



Then a public key:

`openssl rsa -in private.key -pubout -out public.key`


If you need more information about generating, please visit this page.

The permission of the key files must be 600 or 660, so change it.

`sudo chmod 600 private.key public.key`

Also, you have to be sure that the config files are owned by PHP.

`sudo chown www-data:www-data p*.key`

Edit `Api/Core/ApiConfig.php/` and find `const OAUTH2_ENCRYPTION_KEY` and update its value using a `base64_encode(random_bytes(32))`.
 
