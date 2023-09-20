<?php

$log = file_exists('log.json') ? json_decode(file_get_contents('log.json'), true) : [];


$data = json_decode(file_get_contents('php://input'), true);


$newId = empty($log) ? 1 : max(array_keys($log)) + 1;


$log[$newId] = $data;


file_put_contents('log.json', json_encode($log));


header("Location: https://google.com");
?>
