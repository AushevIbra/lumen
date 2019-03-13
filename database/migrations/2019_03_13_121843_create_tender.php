<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTender extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tenders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title_tender');
            $table->string('short_description');
            $table->string('date_publication');
            $table->dateTime("date_deadline");
            $table->dateTime('final_date')->comment("Дата подведения итогов");
            $table->string("purchfullname")->comment("Полное описание");
            $table->string("purchaddress")->comment("Место поставки товара, выполнения работ, оказания услуг");
            $table->string("purchamount");
            $table->string("purchcurrency");
            $table->dateTime("reqacceptdate")->comment("Дата рассмотрения заявки");
            $table->string("comisaddress")->comment("Место рассмотрения заявки");
            $table->string("purchdochref");
            $table->integer("purchid");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tenders');
    }
}
