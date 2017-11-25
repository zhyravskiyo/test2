<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFunctionChangeClient extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $sql = 'CREATE OR REPLACE FUNCTION public.change_client(
    var_id integer,
    var_firstname character varying,
    var_secondname character varying,
    var_personalcode character varying,
    var_email character varying,
    var_address character varying,
    var_city integer,
    var_country integer,
    integer)
  RETURNS integer AS
$BODY$UPDATE "clients" SET "first_name" = var_firstname,
		   "second_name" = var_secondname,
		   "personal_code" = var_personalcode,
		   "email" = var_email,
		   "address" = var_address,
		   "city" = var_city,
		   "country" = var_country,
		   "updated_at" = $9
		WHERE "id" = var_id
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
        $sql = 'DROP FUNCTION public.change_client(
    var_id integer,
    var_firstname character varying,
    var_secondname character varying,
    var_personalcode character varying,
    var_email character varying,
    var_address character varying,
    var_city integer,
    var_country integer,
    integer);';
        $pdo = DB::connection()->getPdo();
        $sth = $pdo->prepare($sql);
        $sth->execute();
    }
}
