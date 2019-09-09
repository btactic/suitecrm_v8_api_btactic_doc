<?php

//The initial URL needs to be changed to the one in your server, the "suitecrm.example.net" is just a placeholder.
$suitecrm_url = 'https://suitecrm.example.net'; // Correct: https://suitecrm.example.net // Incorrect: https://suitecrm.example.net/ .
$client_id = '12345678-9abc-def123456-789000000000';
$client_secret = 'mybelovedsecret';

$token_url = $suitecrm_url . '/Api/access_token';
$module_url = $suitecrm_url . '/Api/V8/module';

// Authentication - Begin
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
$auth_out = json_decode($output,true);

print_r ($output); // For debug purposes
print_r ($auth_out); // For debug purposes

// Authentication - End

$access_token = $auth_out["access_token"];

$ch = curl_init();
$header = array(

    'Accept: application/vnd.api+json',
    'authorization: Bearer '.$access_token,
    'Content-type: application/vnd.api+json'

);


$item = 'Accounts?sort=-name';

curl_setopt($ch, CURLOPT_URL, $module_url . '/' . $item);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
$output = curl_exec($ch);
$out = json_decode($output,true);
print_r ($output);
print_r ($out);

?>
