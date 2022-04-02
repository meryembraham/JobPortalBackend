<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCondidatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('condidats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('nom');
            $table->string('avatar');
            $table->string('prenom');
            $table->integer('tel');
            $table->string('type');
            $table->string('date_de_naissance');
            $table->text('education');
            $table->text('competences');
            $table->text('experience');
            $table->text('langues');
            $table->text('description');
            $table->string('localisation');
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
        Schema::dropIfExists('condidats');
    }
}
