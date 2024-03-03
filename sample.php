<?php

require_once('src/Client.php');

// Initialize the JackTrac client
$client = new JackTrac\Client('JACKTRAC_URL');

try {
    // Specify the device ID for which you want to retrieve logs
    $device_id = 'DEVICE_ID';

    // Fetch logs for the specified device
    $devices = $client->get_device_logs('YOUR_TOKEN', $device_id)->data;

    // Output the logs
    foreach ($devices as $device) {
        foreach ($device->logs as $log) {
          echo $log->DateTime . "\n";
        }
    }
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}