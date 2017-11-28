<?php
/**
 * Created by PhpStorm.
 * User: oleg
 * Date: 25.11.17
 * Time: 16:44
 */

namespace App\Clients;


interface ClientDataGetterInterface
{
    public function getCreatedAt(): int;

    public function getUpdatedAt(): int;

    public function getFirstName(): string;

    public function getSecondName(): string;

    public function getPersonalCode(): string;

    public function getEmail(): string;

    public function getAddress(): string;

    public function getCity(): string;

    public function getCountry(): string;
}
