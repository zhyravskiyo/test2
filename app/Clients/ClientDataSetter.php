<?php
/**
 * Created by PhpStorm.
 * User: oleg
 * Date: 25.11.17
 * Time: 16:46
 */

namespace App\Clients;


trait ClientDataSetter
{
    /**
     * @param int $timestamp
     * @return \App\Clients\ClientDataSetterInterface
     */
    public function setCreatedAt(int $timestamp = 0): ClientDataSetterInterface
    {
        if ($timestamp === 0){
            $timestamp = time();
        }
        $this->createdAt = $timestamp;

        return $this;
    }

    /**
     * @param int $timestamp
     *
     * @return \App\Clients\ClientDataSetterInterface
     */
    public function setUpdatedAt(int $timestamp = 0): ClientDataSetterInterface
    {
        if ($timestamp === 0){
            $timestamp = time();
        }
        $this->updatedAt = $timestamp;

        return $this;
    }

    /**
     * @param string $name
     *
     * @return \App\Clients\ClientDataSetterInterface
     */
    public function setFirstName(string $name = ''): ClientDataSetterInterface
    {
        $this->firstName = $name;

        return $this;
    }

    /**
     * @param string $name
     *
     * @return \App\Clients\ClientDataSetterInterface
     */
    public function setSecondName(string $name = ''): ClientDataSetterInterface
    {
        $this->secondName = $name;

        return $this;
    }

    /**
     * @param string $code
     *
     * @return \App\Clients\ClientDataSetterInterface
     */
    public function setPersonalCode(string $code = ''): ClientDataSetterInterface
    {
        $this->personalCode = $code;

        return $this;
    }

    /**
     * @param string $email
     *
     * @return \App\Clients\ClientDataSetterInterface
     * @throws \Exception if email not be like example@gmail.com
     */
    public function setEmail(string $email = ''): ClientDataSetterInterface
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL) && strlen($email) < 255) {
            $this->email = $email;

            return $this;
        }

        throw new \Exception("not correct email");
    }

    /**
     * @param string $address
     *
     * @return \App\Clients\ClientDataSetterInterface
     */
    public function setAddress(string $address = ''): ClientDataSetterInterface
    {
        $this->address = $address;

        return $this;
    }

    /**
     * @param string $city
     *
     * @return \App\Clients\ClientDataSetterInterface
     */
    public function setCity(string $city = ''): ClientDataSetterInterface
    {
        $this->city = $city;

        return $this;
    }

    /**
     * @param string $country
     *
     * @return \App\Clients\ClientDataSetterInterface
     */
    public function setCountry(string $country = ''): ClientDataSetterInterface
    {
        $this->country = $country;

        return $this;
    }

}
