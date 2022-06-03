<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntreprisesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entreprises', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('user_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('region_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('nom_entreprise')->nullable();
            $table->text('description')->nullable();
            $table->string('categorie')->nullable();
            $table->string('logo')->nullable();
            $table->string('cover_img')->nullable();
            $table->string('site')->nullable();
            $table->text('adresse')->nullable();
            $table->integer('tel')->nullable();
            $table->string('slogan')->nullable();

            $table->foreignId('secteur_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();

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
        Schema::dropIfExists('entreprises');
    }
}
