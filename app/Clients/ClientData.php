<?php
/**
 * Created by PhpStorm.
 * User: oleg
 * Date: 25.11.17
 * Time: 16:43
 */

namespace App\Clients;


class ClientData implements ClientDataInterface
{
    use ClientDataSetter;
    use ClientDataGetter;

    private $createdAt = null;

    private $updatedAt = null;

    private $personalCode = '';

    private $firstName = '';

    private $secondName = '';

    private $email = '';

    private $address = '';

    private $city = '';

    private $country = '';
}
