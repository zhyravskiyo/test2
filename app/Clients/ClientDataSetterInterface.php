<?php
/**
 * Created by PhpStorm.
 * User: oleg
 * Date: 25.11.17
 * Time: 16:44
 */

namespace App\Clients;


interface ClientDataSetterInterface
{
    public function setCreatedAt(int $timestamp = 0):ClientDataSetterInterface;

    public function setUpdatedAt(int $timestamp = 0):ClientDataSetterInterface;

    public function setFirstName(string $name = ''):ClientDataSetterInterface;

    public function setSecondName(string $name = ''):ClientDataSetterInterface;

    public function setPersonalCode(string $code = ''):ClientDataSetterInterface;

    public function setEmail(string $email = ''):ClientDataSetterInterface;

    public function setAddress(string $address = ''):ClientDataSetterInterface;

    public function setCity(string $city = ''):ClientDataSetterInterface;

    public function setCountry(string $country = ''):ClientDataSetterInterface;
}
