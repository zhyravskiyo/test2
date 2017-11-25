<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFunctionSetCity extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $sql = 'CREATE OR REPLACE FUNCTION public.set_city(
    character varying,
    integer,
    integer)
  RETURNS integer AS
$BODY$INSERT INTO "city" ("name","created_at","updated_at")
VALUES ($1,$2,$3)
RETURNING "id" ;$BODY$
  LANGUAGE sql VOLATILE
  COST 100;
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
        $sql = 'DROP FUNCTION public.set_city(character varying,integer,integer);';
        $pdo = DB::connection()->getPdo();
        $sth = $pdo->prepare($sql);
        $sth->execute();
    }
}
