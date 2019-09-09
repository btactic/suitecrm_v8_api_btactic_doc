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

// Create email - Begin


$ch = curl_init();
$header = array(

    'Accept: application/vnd.api+json',
    'authorization: Bearer '.$access_token,
    'Content-type: application/vnd.api+json'

);

//This information is only a placeholder for the information found in an EmailAddresses bean, it must be change to watever you desire, or variables if needed
$postStr2 = json_encode(
                array(
                    'data' => array (
                        'type' => 'EmailAddresses',
                        'attributes' => array (
                            'email_address' => 'fromapi5@example.com',
                            'email_address_caps' => 'FROMAPI5@example.com',
                        ),
                        //'relationships' => array(),

                    )
                )
            );

curl_setopt($ch, CURLOPT_URL, $module_url);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch, CURLOPT_POSTFIELDS, $postStr2);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
$output = curl_exec($ch);
$email_out = json_decode($output,true);
print_r ($output); // For debug purposes
print_r ($email_out); // For debug purposes

// Create email - End

$email_id = $email_out['data']['id'];

// Create account - Begin

$ch = curl_init();
$header = array(

    'Accept: application/vnd.api+json',
    'authorization: Bearer '.$access_token,
    'Content-type: application/vnd.api+json'

);

//This information is only a placeholder for the information found in an Account bean, it must be change to watever you desire, or variables if needed
$postStr2 = json_encode(
                array(
                    'data' => array (
                        'type' => 'Accounts',
                        'attributes' => array (
                            'name' => 'random name',
                            //'description' => 'testing API',
                            //'account_type' => 'CP',
                            //'billing_address_city' => 'test',
                            //'billing_address_country' => 'test1',
                            //'billing_address_postalcode' => 'test2',
                            //'billing_address_state' => 'test3',
                            //'billing_address_street' => 'test4',
                            //'phone_fax' => 'random fax',
                            //'phone_office' => 'random phone',
                            //'website' => 'www.site.com'
                        ),
                    )
                )
            );

curl_setopt($ch, CURLOPT_URL, $module_url);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch, CURLOPT_POSTFIELDS, $postStr2);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
$output = curl_exec($ch);
$account_out = json_decode($output,true);
print_r ($output); // For debug purposes
print_r ($account_out); // For debug purposes

// Create account - End


$account_id = $account_out['data']['id'];

// Create relationship - Begin

$ch = curl_init();
$header = array(

    'Accept: application/vnd.api+json',
    'authorization: Bearer '.$access_token,
    'Content-type: application/vnd.api+json'

);

$postStr2 = json_encode(
                array(
                    'data' => array (
                        'type' => 'EmailAddresses',
                        'id' => $email_id,
                        ),
                )
            );

curl_setopt($ch, CURLOPT_URL, $module_url . '/' . 'Accounts' . '/' . $account_id . '/' . 'relationships');
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch, CURLOPT_POSTFIELDS, $postStr2);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
$output = curl_exec($ch);
$out = json_decode($output,true);
print_r ($output); // For debug purposes
print_r ($out); // For debug purposes

// Create relationship - End



?>
