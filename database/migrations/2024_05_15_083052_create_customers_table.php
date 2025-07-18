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
            // other columns...
            $table->string('SN');
            $table->string('LN');
            $table->string('Logo');
            $table->text('Description');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('SecteurActivite');
            $table->string('Categorie');
            $table->string('Site_Web');
            $table->string('Adresse_mail');
            $table->string('Organigramme');
            $table->string('Network_Design');
            $table->string('Type');
            // Foreign key column for the self-referencing relationship
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
            Schema::dropIfExists('customers');    }
    }
    