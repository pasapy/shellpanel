<?php

$id = isset($_GET['id']) ? intval($_GET['id']) : null;

if ($id !== null) {

    $logData = file_exists('log.json') ? json_decode(file_get_contents('log.json'), true) : [];


    unset($logData[$id]);


    file_put_contents('log.json', json_encode($logData));


    http_response_code(200);
} else {

    http_response_code(400);
}
?>
