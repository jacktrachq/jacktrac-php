# jacktrac-php

Welcome to the JackTrac PHP API Documentation! This guide will walk you through using the JackTrac API to retrieve device log data from our IoT web API.

## Getting Started
To begin using the JackTrac PHP API, follow these steps:

1. **Authentication**: Obtain your API key from JackTrac. This key will be required for authenticating your requests.
2. **Installation**: Install the JackTrac PHP API client using Composer. Add the following to your ```composer.json``` file:

```json
{
    "require": {
        "jacktrac/jacktrac-php": "^0.1"
    }
}
```

Then run ```composer install``` to install the required package. Or simple ```composer require jacktrac/jacktrac-php```

3. **Usage**: Use the following example to get device log data:

```php
<?php
require 'vendor/autoload.php';

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
```

Replace ```'YOUR_API_KEY'``` with your actual API key obtained from JackTrac, and ```'DEVICE_ID'``` with the ID of the device for which you want to retrieve logs.

## API Reference

* ```JackTrac\Client``` Class
* ```__construct(string $api_key)```: Constructs a new JackTrac client with the specified API key.
* ```get_device_logs(string $device_id): array```: Retrieves logs for the specified device. Returns an array of log entries.

## Support
If you encounter any issues or have any questions, please don't hesitate to contact our support team at support@jacktrac.com.

## Terms of Use
By using the JackTrac PHP API, you agree to abide by the JackTrac Terms of Service, available at https://www.jacktrac.com/terms.

Thank you for using the JackTrac PHP API! We're excited to see what you build with it.
