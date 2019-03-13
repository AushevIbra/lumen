<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomer extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("id_tender")->unsigned();
            $table->string("custname")->comment("Наименование");
            $table->string("custaddress");
            $table->string("custphone");
            $table->string("custemail");
            $table->string("custperson");

            $table->foreign('id_tender')->references('id')->on('tenders');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
}
