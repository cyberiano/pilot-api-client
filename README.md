# Pilot API Client

A PHP Pilot CRM API Client

## Installation

```bash
composer require zephia/pilot-api-client
```

## Usage

### Store

```php
<?php

$config = [
    'app_key' => 'PILOT_APP_KEY',
    'debug' => true
];

$client = new Zephia\PilotApiClient\Client\PilotApiClient($config);

$lead_data = new \Zephia\PilotApiClient\Model\LeadData([
    'contact_type_id' => 1,
    'business_type_id' => 1,
    'suborigin_id' => "FFFF0000",
    'firstname' => 'John',
    'lastname' => 'Doe',
    'phone' => '+543512345678',
    'email' => 'john.doe@domain.com'
]);

$client->storeLead($lead_data);

// Returns API response.
```
