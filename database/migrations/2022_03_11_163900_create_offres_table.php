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
            $table->bigIncrements('id');
            $table->foreignId('entreprise_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
           
            $table->foreignId('secteur_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('region_id')->constrained();
            $table->tinyText('titre');
            $table->enum('type_contrat', ['sivp', 'cdd', 'cdi', 'karama','stage'])->nullable();
            $table->string('date_debut')->nullable();
            $table->string('diplome');
            $table->text('exigences')->nullable();
            $table->text('avantages');
            $table->string('rythme')->nullable();
            $table->string('salaire')->nullable();
            $table->text('outils')->nullable();
            $table->text('description');
            $table->text('experience');
            $table->text('competences')->nullable();
            $table->enum('etat_offre', ['active', 'close'])->default('active');
            $table->foreignId('condidat_id')->nullable()->constrained()->cascadeOnUpdate()->cascadeOnDelete();
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
