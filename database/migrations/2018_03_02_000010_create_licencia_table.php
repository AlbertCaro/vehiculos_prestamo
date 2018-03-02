<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLicenciaTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'licencia';

    /**
     * Run the migrations.
     * @table licencia
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->string('idlicencia', 20);
            $table->date('vencimiento')->nullable();
            $table->string('tipo', 45)->nullable();
            $table->increments('idconductor')->unsigned();

            $table->index(["idconductor"], 'fk_licencia_conductor1_idx');


            $table->foreign('idconductor', 'fk_licencia_conductor1_idx')
                ->references('idconductor')->on('conductor')
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
