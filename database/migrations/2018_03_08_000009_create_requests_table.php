<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'requests';

    /**
     * Run the migrations.
     * @table requests
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('nombre_evento', 245)->nullable();
            $table->integer('estatus')->nullable();
            $table->date('fecha_solicitud')->nullable();
            $table->date('fecha_respuesta')->nullable();
            $table->date('fecha_evento')->nullable();
            $table->integer('event_types_id');
            $table->integer('drivers_id');
            $table->integer('solicitante_id');
            $table->integer('vehicles_id');
            $table->integer('jefe_id');


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
