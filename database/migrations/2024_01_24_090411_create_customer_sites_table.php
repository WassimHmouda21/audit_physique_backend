<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerSitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_sites', function (Blueprint $table) {
            $table->id();
            $table->integer('Numero_site');
            $table->string('Structure');
            $table->string('Lieu');
           
            $table->unsignedBigInteger('Customer_Id');
            $table->foreign('Customer_Id')->references('id')->on('customers')->onDelete('cascade');
      
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customer_sites');
    }
}
