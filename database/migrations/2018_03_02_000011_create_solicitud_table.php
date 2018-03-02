<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSolicitudTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'solicitud';

    /**
     * Run the migrations.
     * @table solicitud
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('idsolicitud');
            $table->string('nombre_evento', 245)->nullable();
            $table->string('escala', 45)->nullable();
            $table->string('domicilio', 245)->nullable();
            $table->integer('personas')->nullable();
            $table->integer('distancia')->nullable();
            $table->dateTime('salida')->nullable();
            $table->dateTime('regreso')->nullable();
            $table->date('fecha')->nullable();
            $table->integer('dispone_vehiculo')->nullable();
            $table->integer('estado')->nullable();
            $table->string('reporte', 245)->nullable();
            $table->integer('solicita_conductorl')->nullable();
            $table->integer('idvehiculo')->unsigned();
            $table->integer('idsolicitante')->unsigned();
            $table->integer('idconductor')->unsigned();
            $table->integer('idtipo_evento')->unsigned();
            $table->string('jefe_codigo_jefe', 10)->unsigned();
            $table->longText('observaciones')->nullable();

            $table->index(["jefe_codigo_jefe"], 'fk_solicitud_jefe1_idx');

            $table->index(["idsolicitante"], 'fk_solicitud_solicitante1_idx');

            $table->index(["idvehiculo"], 'fk_solicitud_vehiculo1_idx');

            $table->index(["idconductor"], 'fk_solicitud_conductor1_idx');

            $table->index(["idtipo_evento"], 'fk_solicitud_tipo_evento1_idx');


            $table->foreign('idvehiculo', 'fk_solicitud_vehiculo1_idx')
                ->references('idvehiculo')->on('vehiculo')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('idsolicitante', 'fk_solicitud_solicitante1_idx')
                ->references('idsolicitante')->on('solicitante')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('idconductor', 'fk_solicitud_conductor1_idx')
                ->references('idconductor')->on('conductor')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('idtipo_evento', 'fk_solicitud_tipo_evento1_idx')
                ->references('idtipo_evento')->on('tipo_evento')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('jefe_codigo_jefe', 'fk_solicitud_jefe1_idx')
                ->references('codigo_jefe')->on('jefe')
                ->onDelete('no action')
                ->onUpdate('no action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
     public function down()
     {
       Schema::dropIfExists($this->set_schema_table);
     }
}
