<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReponsesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reponses', function (Blueprint $table) {
            $table->id();          
            $table->unsignedBigInteger('projet');
            $table->foreign('projet')->references('id')->on('projects')->onDelete('cascade');
            $table->unsignedBigInteger('question_id');
            $table->foreign('question_id')->references('id')->on('questions')->onDelete('cascade');
            $table->integer('conformite');
            $table->text('commentaire');
            $table->unsignedBigInteger('site');
            $table->foreign('site')->references('id')->on('customer_sites')->onDelete('cascade');
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
        Schema::dropIfExists('reponses');

        Schema::table('reponses', function (Blueprint $table) {
            $table->dropTimestamps();
        });
    }
}
