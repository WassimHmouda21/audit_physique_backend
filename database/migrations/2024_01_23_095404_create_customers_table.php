<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('SN');
            $table->string('LN');
            $table->string('Logo');
            $table->text('Description');
            $table->string('SecteurActivite');
            $table->string('Categorie');
            $table->string('Site Web');
            $table->string('Adresse mail'); // Corrected typo here
            $table->string('Organigramme');
            $table->string('Network_Design');
            $table->string('Type');

             // Foreign key column for the self-referencing relationship
        $table->unsignedBigInteger('Customer_Id')->nullable(); // Allow NULL for self-referencing
        $table->foreign('Customer_Id')->references('id')->on('customers')->onDelete('cascade');
            $table->timestamps();
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
