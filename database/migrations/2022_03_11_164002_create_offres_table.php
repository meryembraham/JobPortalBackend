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
            $table->unsignedBigInteger('entreprise_id');
            $table->unsignedBigInteger('categorie_id');
            $table->unsignedBigInteger('region_id');
            $table->foreign('entreprise_id')->references('id')->on('entreprises')->onDelete('cascade');
            $table->foreign('categorie_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('region_id')->references('id')->on('regions')->onDelete('cascade');
            $table->string('titre');
            $table->string('type_contrat');
            $table->string('date_debut');
            $table->string('diplome');
            $table->string('exigences');
            $table->string('avantages');
            $table->string('rythme');
            $table->string('salaire');
            $table->text('outils');
            $table->text('desciption');
            $table->text('conpetences');
            $table->string('type_region');
            $table->string('etat_offre');
            $table->string('user_accept');
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
