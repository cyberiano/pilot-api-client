<?php

namespace Zephia\PilotApiClient\Model;

use Zephia\PilotApiClient\Exception\InvalidArgumentException;

class LeadData
{
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
        if (count($data) > 0) {
            foreach ($data as $key => $value) {
                $this->set($key, $value);
            }
            $this->validate();
        }
    }

    /**
     * Object to array
     *
     * @return array
     */
    public function toArray()
    {
        $this->validate();
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
     * Validate
     *
     * @throws InvalidArgumentException
     */
    private function validate()
    {
        $required = '';

        if (empty($this->getFirstname()) && empty($this->getLastname())) {
            $required = "firstname or lastname";
        }
        if (empty($this->getPhone())
            && empty($this->getCellphone())
            && empty($this->getEmail())
            && empty($required)) {
            $required = "phone, cellphone or email";
        }
        if (empty($this->getContactTypeId()) && empty($required)) {
            $required = "contact_type_id";
        }
        if (empty($this->getBusinessTypeId()) && empty($required)) {
            $required = "business_type_id";
        }
        if (empty($this->getSuboriginId()) && empty($required)) {
            $required = "suborigin_id";
        }

        if (!empty($required)) {
            throw new InvalidArgumentException(
                sprintf('Missing required value: %s.', $required)
            );
        }
    }

    /**
     * Set
     *
     * @param $key
     * @param string $value
     */
    private function set($key, $value = "")
    {
        if (property_exists($this, $key)) {
            $key = implode('', array_map('ucfirst', explode('_', $key)));
            $this->{'set' . $key}($value);
        }
    }

    /**
     * @return mixed
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @param $firstname
     *
     * @return $this
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @param $lastname
     *
     * @return $this
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param $phone
     *
     * @return $this
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCellphone()
    {
        return $this->cellphone;
    }

    /**
     * @param $cellphone
     *
     * @return $this
     */
    public function setCellphone($cellphone)
    {
        $this->cellphone = $cellphone;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param $email
     *
     * @return $this
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getContactTypeId()
    {
        return $this->contact_type_id;
    }

    /**
     * @param $contact_type_id
     *
     * @return $this
     */
    public function setContactTypeId($contact_type_id)
    {
        $this->contact_type_id = $contact_type_id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getBusinessTypeId()
    {
        return $this->business_type_id;
    }

    /**
     * @param $business_type_id
     *
     * @return $this
     */
    public function setBusinessTypeId($business_type_id)
    {
        $this->business_type_id = $business_type_id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNotes()
    {
        return $this->notes;
    }

    /**
     * @param $notes
     *
     * @return $this
     */
    public function setNotes($notes)
    {
        $this->notes = $notes;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getOriginId()
    {
        return $this->origin_id;
    }

    /**
     * @param $origin_id
     *
     * @return $this
     */
    public function setOriginId($origin_id)
    {
        $this->origin_id = $origin_id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSuboriginId()
    {
        return $this->suborigin_id;
    }

    /**
     * @param $suborigin_id
     *
     * @return $this
     */
    public function setSuboriginId($suborigin_id)
    {
        $this->suborigin_id = $suborigin_id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAssignedUser()
    {
        return $this->assigned_user;
    }

    /**
     * @param $assigned_user
     *
     * @return $this
     */
    public function setAssignedUser($assigned_user)
    {
        $this->assigned_user = $assigned_user;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCarBrand()
    {
        return $this->car_brand;
    }

    /**
     * @param $car_brand
     *
     * @return $this
     */
    public function setCarBrand($car_brand)
    {
        $this->car_brand = $car_brand;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCarModelo()
    {
        return $this->car_modelo;
    }

    /**
     * @param $car_modelo
     *
     * @return $this
     */
    public function setCarModelo($car_modelo)
    {
        $this->car_modelo = $car_modelo;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param $city
     *
     * @return $this
     */
    public function setCity($city)
    {
        $this->city = $city;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getProvince()
    {
        return $this->province;
    }

    /**
     * @param $province
     *
     * @return $this
     */
    public function setProvince($province)
    {
        $this->province = $province;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param $country
     *
     * @return $this
     */
    public function setCountry($country)
    {
        $this->country = $country;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getVendorName()
    {
        return $this->vendor_name;
    }

    /**
     * @param $vendor_name
     *
     * @return $this
     */
    public function setVendorName($vendor_name)
    {
        $this->vendor_name = $vendor_name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getVendorEmail()
    {
        return $this->vendor_email;
    }

    /**
     * @param $vendor_email
     *
     * @return $this
     */
    public function setVendorEmail($vendor_email)
    {
        $this->vendor_email = $vendor_email;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getVendorPhone()
    {
        return $this->vendor_phone;
    }

    /**
     * @param $vendor_phone
     *
     * @return $this
     */
    public function setVendorPhone($vendor_phone)
    {
        $this->vendor_phone = $vendor_phone;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getProviderService()
    {
        return $this->provider_service;
    }

    /**
     * @param $provider_service
     *
     * @return $this
     */
    public function setProviderService($provider_service)
    {
        $this->provider_service = $provider_service;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getProviderUrl()
    {
        return $this->provider_url;
    }

    /**
     * @param $provider_url
     *
     * @return $this
     */
    public function setProviderUrl($provider_url)
    {
        $this->provider_url = $provider_url;
        return $this;
    }
}
