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
    'app_key' = 'PILOT_APP_KEY',
    'debug' = true
];

$client = new Zephia\PilotApiClient\PilotApiClient($config);

$lead_data = [
    'firstname' => 'John',
    'lastname' = 'Doe',
    'phone' => '+543512345678',
    'email' => 'john.doe@domain.com'
];
$business_type_id = 1;
$contact_type_id = 1;

$client->storeLead($lead_data, $business_type_id, $contact_type_id);

// Returns API response.
```