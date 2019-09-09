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

Obviously you might need to setup your virtualhost configuration so that it reads .htaccess files.