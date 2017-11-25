<?php

namespace Tests\Feature\App;

use App\Clients\Client;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ClientTest extends TestCase
{
    /**
     * @dataProvider loadProvider
     */

    public function testLoad(int $id, array $result)
    {
        $client = Client::load($id)
                        ->toArray();

        $this->assertEquals($result, $client);
    }

    public function loadProvider()
    {
        $result = [];

        for ($i = 0; $i < 5; $i++) {
            $client = new Client();
            $data = $client->fromArray([
                'first_name'    => str_random(100),
                'second_name'   => str_random(100),
                'personal_code' => str_random(9),
                'email'         => str_random(200) . "@gmail.com",
                'address'       => str_random(255),
                'city'          => str_random(100),
                'country'       => str_random(100),
            ])
                           ->save()
                           ->toArray();
            $result[$data['id']] = $data;
        }

        return $result;
    }

    /**
     * @dataProvider fromArrayProvider
     */

    public function testFromArray($email)
    {
        $client = new Client();
        $client->fromArray(['email' => $email]);
        $this->expectExceptionMessage("not correct email");
    }

    public function fromArrayProvider()
    {
        return [
            str_random(255),
            str_random(200),
            str_random(255) . '@gmail.com',
        ];
    }

    public function testSetAttribute()
    {
        $client = new Client();
        $client->setAttribute('id', 111);
        $this->expectExceptionMessage('attribute id cant be sett');
    }

    /**
     * @dataProvider getAttributeProvider
     */

    public function testGetAttribute($name)
    {
        $client = new Client();
        $client->setAttribute('first_name', $name);
        $this->assertEquals($name, $client->getAttribute('first_name'));
        $client->setAttribute($name, 111);
        $this->expectExceptionMessage("not isset attribute \"$name\"");
    }

    public function getAttributeProvider()
    {
        return [
            str_random(100),
            str_random(100),
            str_random(100),
        ];
    }

    public function testLoadAll(){
        $clients = Client::loadAll();

        $this->assertInstanceOf(Client::class,reset($clients));
    }
}
