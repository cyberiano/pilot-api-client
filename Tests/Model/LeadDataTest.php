<?php

namespace Zephia\PilotApiClient\Tests;

use Zephia\PilotApiClient\Exception\InvalidArgumentException;
use Zephia\PilotApiClient\Model\LeadData;

class LeadDataTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider      missingRequiredValuesDataProvider
     * @expectedException InvalidArgumentException
     */
    public function testMissingRequiredValues($data, $missing_value)
    {
        $this->expectExceptionMessage(
            'Missing required value: ' . $missing_value . '.'
        );
        new LeadData($data);
    }

    public function testGettersAndSetters()
    {
        $lead_data = new LeadData([
            'firstname' => 'Test',
            'phone' => '123456',
            'contact_type_id' => 1,
            'business_type_id' => 1,
            'suborigin_id' => "FFFF0000",
        ]);

        $this->assertEquals('Test', $lead_data->getFirstname());
        $this->assertEquals(1, $lead_data->getContactTypeId());
        $this->assertEquals(1, $lead_data->getBusinessTypeId());
        $this->assertEquals('FFFF0000', $lead_data->getSuboriginId());
    }

    public function missingRequiredValuesDataProvider()
    {
        return [
            [[], 'firstname'],
            [['firstname' => 'Test'], 'phone'],
            [['firstname' => 'Test', 'phone' => '123456'], 'contact_type_id'],
            [['firstname' => 'Test', 'phone' => '123456', 'contact_type_id' => 1], 'business_type_id'],
            [['firstname' => 'Test', 'phone' => '123456', 'contact_type_id' => 1, 'business_type_id' => 1], 'suborigin_id'],
        ];
    }
}