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

            $table->index(["jefe_id"], 'fk_requests_users2_idx');

            $table->index(["solicitante_id"], 'fk_requests_users1_idx');

            $table->index(["vehicles_id"], 'fk_requests_vehicles1_idx');

            $table->index(["event_types_id"], 'fk_requests_event_types1_idx');

            $table->index(["drivers_id"], 'fk_requests_drivers1_idx');


            $table->foreign('event_types_id', 'fk_requests_event_types1_idx')
                ->references('id')->on('event_types')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('drivers_id', 'fk_requests_drivers1_idx')
                ->references('id')->on('drivers')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('solicitante_id', 'fk_requests_users1_idx')
                ->references('id')->on('users')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('vehicles_id', 'fk_requests_vehicles1_idx')
                ->references('id')->on('vehicles')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('jefe_id', 'fk_requests_users2_idx')
                ->references('id')->on('users')
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
