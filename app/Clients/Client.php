<?php
/**
 * Created by PhpStorm.
 * User: oleg
 * Date: 25.11.17
 * Time: 16:20
 */

namespace App\Clients;


use Illuminate\Support\Facades\DB;

class Client implements ClientInterface
{

    private $id = 0;

    private $new = true;

    private $data = null;
    /**
     * @var array types for sql query
     */
    private $config = [
        'firstName'    => 'character varying',
        'secondName'   => 'character varying',
        'personalCode' => 'character varying',
        'email'         => 'character varying',
        'address'       => 'character varying',
        'city'          => 'character varying',
        'country'       => 'character varying',
        'createdAt'   => 'integer',
        'updatedAt'   => 'integer',
    ];

    /**
     * Client constructor.
     */
    public function __construct()
    {
        $this->data = new ClientData();
    }

    /**
     * @param int $id
     *  load one client from db
     * @return \App\Clients\ClientInterface
     */
    public static function load(int $id): ClientInterface
    {
        $client = new Client();
        $client->new = false;

        $pdo = DB::connection()
                 ->getPdo();

        $sth = $pdo->prepare("SELECT * FROM get_clients WHERE id = $id ;");
        $sth->execute();

        $data = $sth->fetch(\PDO::FETCH_ASSOC);

        $client->id = $data['id'];

        unset($data['id']);

        $client->fromArray($data);

        return $client;
    }

    /**
     * @param string $column
     * load all clients if not set column parameter or load values only one column for all products
     * @return array
     */
    public static function loadAll(string $column = "*"): array
    {
        $result = [];

        $pdo = DB::connection()
                 ->getPdo();

        $sth = $pdo->prepare("SELECT $column FROM get_clients ORDER BY id ASC;");
        $sth->execute();

        $data = $sth->fetchAll(\PDO::FETCH_ASSOC);
        if ($column !== "*"){
            $data = array_map(function($item){
                return $item['id'];
            },$data);
            return $data;
        }
        foreach ($data as $clientData){
            $client = new Client();
            $client->fromArray($clientData);
            $result[] = $client;
        }

        return $result;
    }

    /**
     * @param array $data
     *  set attributes from array
     * @return \App\Clients\ClientInterface
     */
    public function fromArray(array $data): ClientInterface
    {
        foreach ($data as $field => $value) {
            if ($field === 'id'){
                $this->id = $value;
            }
            else{
                $this->setAttribute($field, $value);
            }
        }

        return $this;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'id'            => $this->id,
            'createdAt'    => $this->data->getCreatedAt(),
            'updatedAt'    => $this->data->getUpdatedAt(),
            'firstName'    => $this->data->getFirstName(),
            'secondName'   => $this->data->getSecondName(),
            'email'         => $this->data->getEmail(),
            'address'       => $this->data->getAddress(),
            'city'          => $this->data->getCity(),
            'country'       => $this->data->getCountry(),
            'personalCode' => $this->data->getPersonalCode(),
        ];
    }

    /**
     * @param string $name
     * @param        $data
     * attribute name atribute_name = atributeName
     * @return \App\Clients\ClientInterface
     * @throws \Exception if try set not isset attribute
     */
    public function setAttribute(string $name, $data): ClientInterface
    {
        $methodName = camel_case("set_" . $name);

        if (method_exists($this->data, $methodName)) {
            if (!is_null($data)){
                $this->data->{$methodName}($data);
            }


            return $this;
        }

        throw new \Exception("attribute $name cant be sett");
    }

    /**
     * @param string $name
     *
     * @return mixed
     * @throws \Exception if needed attribute not isset
     */
    public function getAttribute(string $name)
    {
        if ($name === 'id'){
            return $this->id;
        }

        $methodName = camel_case("get_" . $name);

        if (method_exists($this->data, $methodName)) {
            return $this->data->{$methodName}();
        }

        throw new \Exception("not isset attribute \"$name\"");
    }

    /**
     * @return \App\Clients\ClientInterface
     *
     * insert or update this client in db
     */
    public function save(): ClientInterface
    {
        $sql = "SELECT * FROM ";
        $config = $this->config;
        $this->data->setUpdatedAt();

        if ($this->new) {
            $sql .= " create_client( ";
            $this->data->setCreatedAt();
        } else {
            $sql .= " update_client( integer '" . $this->id . "', ";
            unset($config['createdAt']);
        }

        $sql .= $this->prepareConditions($config);
        $sql .= ");";

        $pdo = DB::connection()
                 ->getPdo();
        $sth = $pdo->prepare($sql);
        $sth->execute();
        $data = $sth->fetch(\PDO::FETCH_ASSOC);

        $this->id = reset($data);

        return $this;
    }

    /**
     * @param array $config
     * prepare conditions for sql query
     * @return string
     */
    private function prepareConditions(array $config)
    {
        $result = [];
        foreach ($config as $name => $type) {
            $result[] = "$type '" . $this->getAttribute($name) . "'";
        }

        return implode(' , ', $result);
    }

    /**
     * delete product what have ID = $id from DB
     * @param int $id
     */
    public static function delete(int $id)
    {
        $sql = "SELECT * FROM delete_client(integer '$id');";
        $pdo = DB::connection()
                 ->getPdo();
        $sth = $pdo->prepare($sql);
        $sth->execute();
    }

    /**
     *
     * create new Clients or update old clients in db
     *
     * @param $data
     */
    public static function import($data){
        $isset_ids = self::loadAll('id');

        foreach ($data as $item){
            if (isset($item['id']) && in_array($item['id'],$isset_ids)){
                Client::load($item['id'])->fromArray($item)->save();
            }
            else{
                $client = new Client();
                $client->fromArray($item)->save();
            }
        }
    }
}
