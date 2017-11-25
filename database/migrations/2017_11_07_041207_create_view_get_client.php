<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateViewGetClient extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $sql = 'CREATE OR REPLACE VIEW public.get_clients AS 
 SELECT city.name AS city,
    country.name AS country,
    clients.id,
    clients.first_name,
    clients.second_name,
    clients.personal_code,
    clients.email,
    clients.address,
    clients.created_at,
    clients.updated_at
   FROM city,
    clients,
    country
  WHERE city.id = clients.city AND country.id = clients.country;
';
        $pdo = DB::connection()->getPdo();
        $sth = $pdo->prepare($sql);
        $sth->execute();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $sql = 'DROP VIEW public.get_clients';
        $pdo = DB::connection()->getPdo();
        $sth = $pdo->prepare($sql);
        $sth->execute();
    }
}
