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
            $table->string('nom')->nullable();
            $table->string('avatar')->nullable();
            $table->string('prenom')->nullable();
            $table->integer('tel')->nullable();
            $table->string('type')->nullable();
            $table->text('education')->nullable();
            $table->text('competences')->nullable();
            $table->text('experience')->nullable();
            $table->text('langues')->nullable();
            $table->text('description')->nullable();
            $table->string('localisation')->nullable();
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
