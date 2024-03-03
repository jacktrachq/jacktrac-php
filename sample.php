<?php

require_once('Jacktrac.php');

$api = new Jacktrac('https://jacktrac.com/v1', true);

$token = ''; // Place your token here!
$r = $api->get_device_logs($token, 'xxx');
echo '<pre>';
print_r($r);
echo '</pre>';