# Main Htaccess issue

You might need to add these lines
```
    RewriteRule ^Api/(.*)$ - [env=HTTP_AUTHORIZATION:%{HTTP:Authorization}]
    RewriteRule ^Api/access_token$ Api/index.php/access_token [L]
    RewriteRule ^Api/V8/(.*?)$ Api/index.php/V8/$1 [L]
```
to your main suitecrm .htaccess file so that the api works ok.

# Api folder htaccess issue

If you use fcgid in your server you might want to create the file:
{{your-SuiteCRM-root}}/Api/.htaccess
with the following content:
[Api .htaccess](../php/api_htaccess)
.

# Missing authorization header

If you get the *Missing authorization header* message then you need to apply this commit: [https://github.com/salesagility/SuiteCRM/pull/7173/commits/8e4a76ac8c6403a9e7cec8ed2f738f4d0aeebfd6](https://github.com/salesagility/SuiteCRM/pull/7173/commits/8e4a76ac8c6403a9e7cec8ed2f738f4d0aeebfd6). I recommend to apply it manually because what it's important there is how the .htaccess rules order are and how you modify Api/Core/app.php file. The two other files are meant to fix the .htaccess file when you install or upgrade Suitecrm.

An example of .htaccess correct order is:
```
    RewriteRule ^Api/(.*)$ - [env=HTTP_AUTHORIZATION:%{HTTP:Authorization}]
    RewriteRule ^Api/access_token$ Api/index.php/access_token [L]
    RewriteRule ^Api/V8/(.*?)$ Api/index.php/V8/$1 [L]
```
.

## Fcgid

Additionally you might need to add your virtualhost configuration file so that HTTP_AUTHORIZATION header is actually passed to Suitecrm. After a DirectoryIndex line inside your usually https VirtualHost stanza you should add these lines:
```
<IfModule mod_fcgid.c>
FcgidPassHeader     Authorization
</IfModule>
```

In order to apply these changes you might need to reload or even restart apache2.
.

## FPM

Edit your Apache virtualhost file and below each one of the `DirectoryIndex` lines we add:

```
SetEnvIf Authorization "(.*)" HTTP_AUTHORIZATION=$1
```

and reload apache2.

## .htaccess

Obviously for the changes above to be applied you might need to setup your virtualhost configuration so that it reads .htaccess files.
