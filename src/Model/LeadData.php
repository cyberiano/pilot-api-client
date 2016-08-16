<?php

namespace Zephia\PilotApiClient\Model;

use Zephia\PilotApiClient\Exception\InvalidArgumentException;

class LeadData
{
    const REQUIRED_VALUES = [
        'firstname',
        'contact_type_id',
        'business_type_id',
        'suborigin_id',
    ];

    private $firstname;
    private $lastname;
    private $phone;
    private $cellphone;
    private $email;
    private $contact_type_id;
    private $business_type_id;
    private $notes;
    private $origin_id;
    private $suborigin_id;
    private $assigned_user;
    private $car_brand;
    private $car_modelo;
    private $city;
    private $province;
    private $country;
    private $vendor_name;
    private $vendor_email;
    private $vendor_phone;
    private $provider_service;
    private $provider_url;

    /**
     * LeadData constructor.
     *
     * @param array $data
     */
    public function __construct($data = [])
    {
        $missing = array_diff_key(array_flip(self::REQUIRED_VALUES), $data);
        if (count($missing) > 0) {
            throw new InvalidArgumentException(
                'Missing required value: ' . array_keys($missing)[0] . '.'
            );
        }

        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                // snake_case to CamelCase
                $camel_case_key = implode(
                    '',
                    array_map('ucfirst', explode('_', $key))
                );
                $this->{'set' . $camel_case_key}($value);
            }
        }
    }

    public function toArray()
    {
        return [
            'pilot_firstname' => $this->getFirstname(),
            'pilot_lastname' => $this->getLastname(),
            'pilot_phone' => $this->getPhone(),
            'pilot_cellphone' => $this->getCellphone(),
            'pilot_email' => $this->getEmail(),
            'pilot_contact_type_id' => $this->getContactTypeId(),
            'pilot_business_type_id' => $this->getBusinessTypeId(),
            'pilot_notes' => $this->getNotes(),
            'pilot_origin_id' => $this->getOriginId(),
            'pilot_suborigin_id' => $this->getSuboriginId(),
            'pilot_assigned_user' => $this->getAssignedUser(),
            'pilot_car_brand' => $this->getCarBrand(),
            'pilot_car_modelo' => $this->getCarModelo(),
            'pilot_city' => $this->getCity(),
            'pilot_province' => $this->getProvince(),
            'pilot_country' => $this->getCountry(),
            'pilot_vendor_name' => $this->getVendorName(),
            'pilot_vendor_email' => $this->getVendorEmail(),
            'pilot_vendor_phone' => $this->getVendorPhone(),
            'pilot_provider_service' => $this->getProviderService(),
            'pilot_provider_url' => $this->getProviderUrl()
        ];
    }

    /**
     * @return mixed
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @param mixed $firstname
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    }

    /**
     * @return mixed
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @param mixed $lastname
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    }

    /**
     * @return mixed
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param mixed $phone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    /**
     * @return mixed
     */
    public function getCellphone()
    {
        return $this->cellphone;
    }

    /**
     * @param mixed $cellphone
     */
    public function setCellphone($cellphone)
    {
        $this->cellphone = $cellphone;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getContactTypeId()
    {
        return $this->contact_type_id;
    }

    /**
     * @param mixed $contact_type_id
     */
    public function setContactTypeId($contact_type_id)
    {
        $this->contact_type_id = $contact_type_id;
    }

    /**
     * @return mixed
     */
    public function getBusinessTypeId()
    {
        return $this->business_type_id;
    }

    /**
     * @param mixed $business_type_id
     */
    public function setBusinessTypeId($business_type_id)
    {
        $this->business_type_id = $business_type_id;
    }

    /**
     * @return mixed
     */
    public function getNotes()
    {
        return $this->notes;
    }

    /**
     * @param mixed $notes
     */
    public function setNotes($notes)
    {
        $this->notes = $notes;
    }

    /**
     * @return mixed
     */
    public function getOriginId()
    {
        return $this->origin_id;
    }

    /**
     * @param mixed $origin_id
     */
    public function setOriginId($origin_id)
    {
        $this->origin_id = $origin_id;
    }

    /**
     * @return mixed
     */
    public function getSuboriginId()
    {
        return $this->suborigin_id;
    }

    /**
     * @param mixed $suborigin_id
     */
    public function setSuboriginId($suborigin_id)
    {
        $this->suborigin_id = $suborigin_id;
    }

    /**
     * @return mixed
     */
    public function getAssignedUser()
    {
        return $this->assigned_user;
    }

    /**
     * @param mixed $assigned_user
     */
    public function setAssignedUser($assigned_user)
    {
        $this->assigned_user = $assigned_user;
    }

    /**
     * @return mixed
     */
    public function getCarBrand()
    {
        return $this->car_brand;
    }

    /**
     * @param mixed $car_brand
     */
    public function setCarBrand($car_brand)
    {
        $this->car_brand = $car_brand;
    }

    /**
     * @return mixed
     */
    public function getCarModelo()
    {
        return $this->car_modelo;
    }

    /**
     * @param mixed $car_modelo
     */
    public function setCarModelo($car_modelo)
    {
        $this->car_modelo = $car_modelo;
    }

    /**
     * @return mixed
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param mixed $city
     */
    public function setCity($city)
    {
        $this->city = $city;
    }

    /**
     * @return mixed
     */
    public function getProvince()
    {
        return $this->province;
    }

    /**
     * @param mixed $province
     */
    public function setProvince($province)
    {
        $this->province = $province;
    }

    /**
     * @return mixed
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param mixed $country
     */
    public function setCountry($country)
    {
        $this->country = $country;
    }

    /**
     * @return mixed
     */
    public function getVendorName()
    {
        return $this->vendor_name;
    }

    /**
     * @param mixed $vendor_name
     */
    public function setVendorName($vendor_name)
    {
        $this->vendor_name = $vendor_name;
    }

    /**
     * @return mixed
     */
    public function getVendorEmail()
    {
        return $this->vendor_email;
    }

    /**
     * @param mixed $vendor_email
     */
    public function setVendorEmail($vendor_email)
    {
        $this->vendor_email = $vendor_email;
    }

    /**
     * @return mixed
     */
    public function getVendorPhone()
    {
        return $this->vendor_phone;
    }

    /**
     * @param mixed $vendor_phone
     */
    public function setVendorPhone($vendor_phone)
    {
        $this->vendor_phone = $vendor_phone;
    }

    /**
     * @return mixed
     */
    public function getProviderService()
    {
        return $this->provider_service;
    }

    /**
     * @param mixed $provider_service
     */
    public function setProviderService($provider_service)
    {
        $this->provider_service = $provider_service;
    }

    /**
     * @return mixed
     */
    public function getProviderUrl()
    {
        return $this->provider_url;
    }

    /**
     * @param mixed $provider_url
     */
    public function setProviderUrl($provider_url)
    {
        $this->provider_url = $provider_url;
    }
}
