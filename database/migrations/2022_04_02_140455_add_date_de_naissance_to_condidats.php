<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDateDeNaissanceToCondidats extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('condidats', function (Blueprint $table) {
            $table->string('date_de_naissance');//
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('condidats', function (Blueprint $table) {
            $table->dropColumn('date_de_naissance');//
        });
    }
}
