# Pilot API Client

[![Build Status](https://travis-ci.org/zephia/pilot-api-client.svg?branch=master)](https://travis-ci.org/zephia/pilot-api-client)
[![Code Coverage](https://scrutinizer-ci.com/g/zephia/pilot-api-client/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/zephia/pilot-api-client/?branch=master)
[![Build Status](https://scrutinizer-ci.com/g/zephia/pilot-api-client/badges/build.png?b=master)](https://scrutinizer-ci.com/g/zephia/pilot-api-client/build-status/master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/zephia/pilot-api-client/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/zephia/pilot-api-client/?branch=master)

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
