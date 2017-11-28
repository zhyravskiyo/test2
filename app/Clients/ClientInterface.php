<?php
/**
 * Created by PhpStorm.
 * User: oleg
 * Date: 25.11.17
 * Time: 16:17
 */

namespace App\Clients;


interface ClientInterface
{
    public static function load(int $id): ClientInterface;

    public static function loadAll(string $column = "*"):array ;

    public function fromArray(array $data): ClientInterface;

    public function toArray(): array;

    public function setAttribute(string $name, $data): ClientInterface;

    public function getAttribute(string $name);

    public function save():ClientInterface;

    public static function delete(int $id);
}
