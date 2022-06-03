<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExperiencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('experiences', function (Blueprint $table) {
            $table->id();
            $table->foreignId('condidat_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->string("nom_societe")->nullable();
            $table->string("nombre_annee")->nullable();
            $table->string("poste")->nullable();
            $table->string("date_debut")->nullable();
            $table->string("date_fin")->nullable();
            $table->string("description")->nullable();
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
        Schema::dropIfExists('experiences');
    }
}
