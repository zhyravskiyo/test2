<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFunctionSetClient extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $sql = 'CREATE OR REPLACE FUNCTION public.set_client(
    character varying,
    character varying,
    character varying,
    character varying,
    character varying,
    integer,
    integer,
    integer,
    integer)
  RETURNS integer AS
$BODY$INSERT INTO "clients" ("first_name","second_name","personal_code","email","address","city","country","created_at","updated_at")
	VALUES ($1,$2,$3,$4,$5,$6,$7,$8,$9)
	RETURNING "id";$BODY$
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
        $sql = 'DROP FUNCTION public.set_client(
    character varying,
    character varying,
    character varying,
    character varying,
    character varying,
    integer,
    integer,
    integer,
    integer);';
        $pdo = DB::connection()->getPdo();
        $sth = $pdo->prepare($sql);
        $sth->execute();
    }
}
