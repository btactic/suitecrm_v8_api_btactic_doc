In order to prevent man-in-the-middle attacks, the authorization server MUST require the use of TLS with server authentication as defined by RFC2818 for any request sent to the authorization and token endpoints. The client MUST validate the authorization server’s TLS certificate as defined by RFC6125 and in accordance with its requirements for server identity authentication.

SuiteCRM uses key cryptography in order to encrypt and decrypt, as well as verify the integrity of signatures.

# Initial requirements

   1. OpenSSL PHP Extension installed and configured

   2. The SuiteCRM instance must be configured to use HTTPS/SSL

   3. You need to have PHP version 5.5.9, or 7.0 and above

# Also you need to install composer packages:

You might need to install composer package here before using composer command.

```
cd {{your-SuiteCRM-root}}
composer install
```

If there are errors please correct them. E.g. Installing *php-intl* package and running again the composer command.

# Generate private and public.key for OAUTH2

SuiteCRM Api uses OAuth2 protocol, which needs public and private keys.

First, open a terminal and go to {{your-SuiteCRM-root}}/Api/V8/OAuth2

Generate a private key:

   `openssl genrsa -out private.key 2048`

Then you need to generate a public key:

   `openssl rsa -in private.key -pubout -out public.key`

The permission of the key files must be 600 or 660, so change it.

   `sudo chmod 600 private.key public.key`

Make also sure that the config files are owned by PHP.

   `sudo chown www-data:www-data p*.key`

Finally make sure that the setting `oauth2_encryption_key` is properly set in your config.php file. It should be autofilled in the installation.

If you ever have to generate a random key for this setting you can use the following command:

`php -r 'echo (base64_encode(random_bytes(32)));echo("\n");'`

.
