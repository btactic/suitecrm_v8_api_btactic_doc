<?php

if (!defined('sugarEntry') || !sugarEntry) {
   die('Not A Valid Entry Point');
}
require_once(__DIR__ . '/test_php_beans.php');

$token_url = 'https://vidsigner2.btactic.net/Api/access_token';
$module_url = 'https://vidsigner2.btactic.net/Api/V8/module/';
$client_id = '93af01c4-96ab-e088-5b9e-5d4d4bad0a5a';
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
$postStr2 = json_encode(array(
    'id' => create_bean_account('Dani', 'daniel.bellet@btactic.com', '637070854'),
    'name' => 'Dani',
    'email' => array(
        array(
            'email_address' => 'daniel.bellet@btactic.com',
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
