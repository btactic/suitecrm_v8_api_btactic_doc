<?php

if (!defined('sugarEntry') || !sugarEntry) {
   die('Not A Valid Entry Point');
}
require_once(__DIR__ . '/test_php_beans.php');
//The initial URL needs to be changed to the one in your server, the "suitecrm.example.net" is just a placeholder.
$token_url = 'https://suitecrm.example.net/Api/access_token';
$module_url = 'https://suitecrm.example.net/Api/V8/module/';
//This must be changed to the token generated in the CRM with the other steps.
$client_id = '93af01c4-96ab-e088-5b9e-5d4d4bad0a5a';
//This secret must be the same as the one generated in the other steps.
$client_secret = '';
$ch = curl_init();
$header = array(
    'Content-type: application/vnd.api+json',
    'Accept: application/vnd.api+json'
 );
$postStr = json_encode(array(
    'grant_type' => 'client_credentials',
    'client_id' => $client_id,
    'client_secret' => $client_secret
));
curl_setopt($ch, CURLOPT_URL, $token_url);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch, CURLOPT_POSTFIELDS, $postStr);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
$output = curl_exec($ch);
$out = json_decode($output,true);
print_r ($output);
print_r ($out);


$ch = curl_init();
$header = array(

    'Accept: application/vnd.api+json',
    'authorization: Bearer '.$out["access_token"],
    'Content-type: application/vnd.api+json'

);
//This information is only a placeholder for the information found in an Account bean, it must be change to watever you desire, or variables if needed
$postStr2 = json_encode(array(
    'id' => create_bean_account('John', 'john.smith@example.com', '666777888'),
    'name' => 'John Smith',
    'email' => array(
        array(
            'email_address' => 'john.smith@example.com',
            'primary_address' => true
        )
    ),
    ));


curl_setopt($ch, CURLOPT_URL, $module_url);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch, CURLOPT_POSTFIELDS, $postStr2);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
$output = curl_exec($ch);
$out = json_decode($output,true);
print_r ($output);
print_r ($out);
?>
