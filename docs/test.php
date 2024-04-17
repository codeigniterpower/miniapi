<?php

$env = parse_ini_file('../.env');




/* *** send as json SAVE DATA ************************************************* */

$url = $env["APP_HOST"].':'.$env["APP_PORT"]."/api/v1/store";

// Create a new cURL resource
$ch = curl_init($url);

// Setup request to send json via POST
$data = array(
    'PAL' => 'PUV',
    'cedh' => '1234565',
    'cedp' => '1234567'
);

$payload = json_encode(array("user" => $data));

// Attach encoded JSON string to the POST fields
curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);

// Set the content type to application/json
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));

// Return response instead of outputting
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Execute the POST request
$result = curl_exec($ch);

// Close cURL resource
curl_close($ch);

var_dump($result);
/* *** end send as json ************************************************* */




/* *** send as post SAVE DATA ************************************************* */

$url = $env["APP_HOST"].':'.$env["APP_PORT"]."/api/v1/store";

// Create a new cURL resource
$ch = curl_init($url);

// Setup request to send json via POST
$fields = array(
    'PAL' => 'PUV',
    'cedh' => '1234565',
    'cedp' => '1234567'
);

$payload = http_build_query($data);

// Attach encoded fields string to the POST url
curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);

// Set the content type to http post
curl_setopt($ch, CURLOPT_POST, true);

// Return response instead of outputting
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Execute the POST request
$result = curl_exec($ch);

// Close cURL resource
curl_close($ch);

var_dump($result);
/* *** end send as post ************************************************* */

