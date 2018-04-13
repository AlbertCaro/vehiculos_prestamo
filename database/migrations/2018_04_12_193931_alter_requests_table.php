<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('requests', function (Blueprint $table){
            $table->string('domicilio');
            $table->string('escala');
            $table->string('personas');
            $table->string('distancia');
            $table->date('fecha_regreso')->nullable();
            $table->integer('vehiculo_propio')->nullable();
            $table->integer('solicita_conductor')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('requests', function(Blueprint $table){
            $table->dropColumn('domicilio');
            $table->dropColumn('escala');
            $table->dropColumn('personas');
            $table->dropColumn('distancia');
            $table->dropColumn('fecha_regreso');
            $table->dropColumn('vechiculo_propio');
            $table->dropColumn('solicita_conductor');
        });
    }
}
