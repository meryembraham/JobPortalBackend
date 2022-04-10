<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOffresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offres', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('entreprise_id')->nullable();
            $table->unsignedBigInteger('categorie_id')->nullable();
            $table->unsignedBigInteger('region_id')->nullable();
            $table->string('titre')->nullable();
            $table->string('type_contrat')->nullable();
            $table->string('date_debut')->nullable();
            $table->string('diplome')->nullable();
            $table->string('exigences')->nullable();
            $table->string('avantages')->nullable();
            $table->string('rythme')->nullable();
            $table->string('salaire')->nullable();
            $table->text('outils')->nullable();
            $table->text('desciption')->nullable();
            $table->text('conpetences')->nullable();
            $table->string('type_region')->nullable();
            $table->string('etat_offre')->nullable();
            $table->string('user_accept')->nullable();
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
        Schema::dropIfExists('offres');
    }
}
