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

    public function testSettersAndGetters()
    {
        $lead_data = new LeadData();

        $this->assertEquals($lead_data, $lead_data->setFirstname('Test'));
        $this->assertEquals('Test', $lead_data->getFirstname());
        $this->assertEquals($lead_data, $lead_data->setLastname('Test'));
        $this->assertEquals('Test', $lead_data->getLastname());
        $this->assertEquals($lead_data, $lead_data->setPhone(123456));
        $this->assertEquals(123456, $lead_data->getPhone());
        $this->assertEquals($lead_data, $lead_data->setCellphone(123456));
        $this->assertEquals(123456, $lead_data->getCellphone());
        $this->assertEquals($lead_data, $lead_data->setEmail('test@test.com'));
        $this->assertEquals('test@test.com', $lead_data->getEmail());
        $this->assertEquals($lead_data, $lead_data->setContactTypeId(1));
        $this->assertEquals(1, $lead_data->getContactTypeId());
        $this->assertEquals($lead_data, $lead_data->setBusinessTypeId(1));
        $this->assertEquals(1, $lead_data->getBusinessTypeId());
        $this->assertEquals($lead_data, $lead_data->setNotes('Test'));
        $this->assertEquals('Test', $lead_data->getNotes());
        $this->assertEquals($lead_data, $lead_data->setOriginId(1));
        $this->assertEquals(1, $lead_data->getOriginId());
        $this->assertEquals($lead_data, $lead_data->setSuboriginId('FFFF0000'));
        $this->assertEquals('FFFF0000', $lead_data->getSuboriginId());
        $this->assertEquals($lead_data, $lead_data->setAssignedUser(1234));
        $this->assertEquals(1234, $lead_data->getAssignedUser());
        $this->assertEquals($lead_data, $lead_data->setCarBrand('Test'));
        $this->assertEquals('Test', $lead_data->getCarBrand());
        $this->assertEquals($lead_data, $lead_data->setCarModelo('Test'));
        $this->assertEquals('Test', $lead_data->getCarModelo());
        $this->assertEquals($lead_data, $lead_data->setCity('Test'));
        $this->assertEquals('Test', $lead_data->getCity());
        $this->assertEquals($lead_data, $lead_data->setProvince('Test'));
        $this->assertEquals('Test', $lead_data->getProvince());
        $this->assertEquals($lead_data, $lead_data->setCountry('Test'));
        $this->assertEquals('Test', $lead_data->getCountry());
        $this->assertEquals($lead_data, $lead_data->setVendorName('Test'));
        $this->assertEquals('Test', $lead_data->getVendorName());
        $this->assertEquals($lead_data, $lead_data->setVendorEmail('test@test.com'));
        $this->assertEquals('test@test.com', $lead_data->getVendorEmail());
        $this->assertEquals($lead_data, $lead_data->setVendorPhone(123456));
        $this->assertEquals(123456, $lead_data->getVendorPhone());
        $this->assertEquals($lead_data, $lead_data->setProviderService('Test'));
        $this->assertEquals('Test', $lead_data->getProviderService());
        $this->assertEquals($lead_data, $lead_data->setProviderUrl('http://test.com'));
        $this->assertEquals('http://test.com', $lead_data->getProviderUrl());
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