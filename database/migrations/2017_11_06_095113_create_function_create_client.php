<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFunctionCreateClient extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $sql = 'CREATE OR REPLACE FUNCTION public.create_client(var_firstname character varying, var_secondname character varying, var_personalcode character varying, var_email character varying, var_address character varying, var_city character varying, var_country character varying, integer, integer) RETURNS integer AS
$BODY$DECLARE
found INT;
found_city INT;
found_country INT;
result INT;
BEGIN	
	found := get_country(var_country);

	IF found IS NULL THEN
		found_country := set_country(var_country,$8,$9);
	ELSE
		 found_country := found;
	END IF;

	found := get_city(var_city);
	IF found IS NULL THEN
		found_city := set_city(var_city,$8,$9);
	ELSE
		found_city := found;
	END IF;

	result = set_client(var_firstname,var_secondname,var_personalcode,var_email,var_address,found_city,found_country,$8,$9);
	RETURN result; 
END;$BODY$
LANGUAGE plpgsql VOLATILE NOT LEAKPROOF
COST 100;';
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
        $sql = 'DROP FUNCTION public.create_client(var_firstname character varying, var_secondname character varying, var_personalcode character varying, var_email character varying, var_address character varying, var_city character varying, var_country character varying, integer, integer);';
        $pdo = DB::connection()->getPdo();
        $sth = $pdo->prepare($sql);
        $sth->execute();
    }
}
