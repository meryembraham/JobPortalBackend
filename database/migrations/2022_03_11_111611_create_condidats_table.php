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
            $table->bigIncrements('id');
           // $table->foreignId('user_id');
           $table->foreignId('user_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
           $table->foreignId('secteur_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
           $table->foreignId('region_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('avatar')->nullable();
            $table->string('niveau')->nullable();
            $table->integer('tel');
            $table->string('ville')->nullable();
            $table->text('competences')->nullable();
            $table->text('langues')->nullable();
            $table->text('bio')->nullable();
            $table->string('civilite');
            $table->string('date_de_naissance');
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
