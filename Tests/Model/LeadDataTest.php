<?php

namespace Zephia\PilotApiClient\Tests;

use Zephia\PilotApiClient\Exception\InvalidArgumentException;
use Zephia\PilotApiClient\Model\LeadData;

class LeadDataTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider      missingRequiredValuesByArrayDataProvider
     * @expectedException InvalidArgumentException
     */
    public function testMissingRequiredValuesByArray($data, $missing_value)
    {
        $this->expectExceptionMessage(
            'Missing required value: ' . $missing_value . '.'
        );
        new LeadData($data);
    }

    /**
     * @dataProvider      missingRequiredValuesBySettersDataProvider
     * @expectedException InvalidArgumentException
     */
    public function testMissingRequiredValuesBySetters($data, $missing_value)
    {
        $this->expectExceptionMessage(
            'Missing required value: ' . $missing_value . '.'
        );
        $lead_data = $data;
        $lead_data->toArray();
    }

    public function testGetters()
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

    public function missingRequiredValuesByArrayDataProvider()
    {
        return [
            [['firstname' => 'Test'], 'phone, cellphone or email'],
            [['lastname' => 'Test'], 'phone, cellphone or email'],
            [['firstname' => 'Test', 'phone' => '123456'], 'contact_type_id'],
            [['lastname' => 'Test', 'phone' => '123456'], 'contact_type_id'],
            [['firstname' => 'Test', 'cellphone' => '123456'], 'contact_type_id'],
            [['lastname' => 'Test', 'cellphone' => '123456'], 'contact_type_id'],
            [['firstname' => 'Test', 'email' => 'test@test.com'], 'contact_type_id'],
            [['lastname' => 'Test', 'email' => 'test@test.com'], 'contact_type_id'],
            [['firstname' => 'Test', 'phone' => '123456', 'contact_type_id' => 1], 'business_type_id'],
            [['lastname' => 'Test', 'phone' => '123456', 'contact_type_id' => 1], 'business_type_id'],
            [['firstname' => 'Test', 'cellphone' => '123456', 'contact_type_id' => 1], 'business_type_id'],
            [['lastname' => 'Test', 'cellphone' => '123456', 'contact_type_id' => 1], 'business_type_id'],
            [['firstname' => 'Test', 'email' => 'test@test.com', 'contact_type_id' => 1], 'business_type_id'],
            [['lastname' => 'Test', 'email' => 'test@test,com', 'contact_type_id' => 1], 'business_type_id'],
            [['firstname' => 'Test', 'phone' => '123456', 'contact_type_id' => 1, 'business_type_id' => 1], 'suborigin_id'],
            [['lastname' => 'Test', 'phone' => '123456', 'contact_type_id' => 1, 'business_type_id' => 1], 'suborigin_id'],
            [['firstname' => 'Test', 'cellphone' => '123456', 'contact_type_id' => 1, 'business_type_id' => 1], 'suborigin_id'],
            [['lastname' => 'Test', 'cellphone' => '123456', 'contact_type_id' => 1, 'business_type_id' => 1], 'suborigin_id'],
            [['firstname' => 'Test', 'email' => 'test@test.com', 'contact_type_id' => 1, 'business_type_id' => 1], 'suborigin_id'],
            [['lastname' => 'Test', 'email' => 'test@test.com', 'contact_type_id' => 1, 'business_type_id' => 1], 'suborigin_id'],
        ];
    }

    public function missingRequiredValuesBySettersDataProvider()
    {
        return [
            [(new LeadData), 'firstname or lastname'],
            [(new LeadData)->setFirstname('Test'), 'phone, cellphone or email'],
            [(new LeadData)->setLastname('Test'), 'phone, cellphone or email'],
            [(new LeadData)->setFirstname('Test')->setPhone('123456'), 'contact_type_id'],
            [(new LeadData)->setLastname('Test')->setPhone('123456'), 'contact_type_id'],
            [(new LeadData)->setFirstname('Test')->setCellphone('123456'), 'contact_type_id'],
            [(new LeadData)->setLastname('Test')->setCellphone('123456'), 'contact_type_id'],
            [(new LeadData)->setFirstname('Test')->setEmail('test@test.com'), 'contact_type_id'],
            [(new LeadData)->setLastname('Test')->setEmail('test@test.com'), 'contact_type_id'],
            [(new LeadData)->setFirstname('Test')->setPhone('123456')->setContactTypeId(1), 'business_type_id'],
            [(new LeadData)->setLastname('Test')->setPhone('123456')->setContactTypeId(1), 'business_type_id'],
            [(new LeadData)->setFirstname('Test')->setCellphone('123456')->setContactTypeId(1), 'business_type_id'],
            [(new LeadData)->setLastname('Test')->setCellphone('123456')->setContactTypeId(1), 'business_type_id'],
            [(new LeadData)->setFirstname('Test')->setEmail('test@test.com')->setContactTypeId(1), 'business_type_id'],
            [(new LeadData)->setLastname('Test')->setEmail('test@test.com')->setContactTypeId(1), 'business_type_id'],
            [(new LeadData)->setFirstname('Test')->setPhone('123456')->setContactTypeId(1)->setBusinessTypeId(1), 'suborigin_id'],
            [(new LeadData)->setLastname('Test')->setPhone('123456')->setContactTypeId(1)->setBusinessTypeId(1), 'suborigin_id'],
            [(new LeadData)->setFirstname('Test')->setCellphone('123456')->setContactTypeId(1)->setBusinessTypeId(1), 'suborigin_id'],
            [(new LeadData)->setLastname('Test')->setCellphone('123456')->setContactTypeId(1)->setBusinessTypeId(1), 'suborigin_id'],
            [(new LeadData)->setFirstname('Test')->setEmail('test@test.com')->setContactTypeId(1)->setBusinessTypeId(1), 'suborigin_id'],
            [(new LeadData)->setLastname('Test')->setEmail('test@test.com')->setContactTypeId(1)->setBusinessTypeId(1), 'suborigin_id'],
        ];
    }
}