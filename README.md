# Pilot API Client

[![Build Status](https://scrutinizer-ci.com/g/zephia/pilot-api-client/badges/build.png?b=master)](https://scrutinizer-ci.com/g/zephia/pilot-api-client/build-status/master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/zephia/pilot-api-client/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/zephia/pilot-api-client/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/zephia/pilot-api-client/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/zephia/pilot-api-client/?branch=master)
[![Latest Stable Version](https://poser.pugx.org/zephia/pilot-api-client/v/stable)](https://packagist.org/packages/zephia/pilot-api-client)
[![Total Downloads](https://poser.pugx.org/zephia/pilot-api-client/downloads)](https://packagist.org/packages/zephia/pilot-api-client)
[![License](https://poser.pugx.org/zephia/pilot-api-client/license)](https://packagist.org/packages/zephia/pilot-api-client)

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

// or programatically
$lead_data = (new \Zephia\PilotApiClient\Model\LeadData())
    ->setContactTypeId(1)
    ->setBusinessTypeId(1)
    ->setSuboriginId("FFFF0000")
    ->setFirstname("John")
    ->setLastname("Doe")
    ->setPhone("+543512345678")
    ->setEmail("john.doe@domain.com");

$client->storeLead($lead_data);

// Returns API response object.
```
