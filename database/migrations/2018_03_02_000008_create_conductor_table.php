<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConductorTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'conductor';

    /**
     * Run the migrations.
     * @table conductor
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('idconductor');
            $table->string('nombre', 145)->nullable();
            $table->string('celular', 15)->nullable();
            $table->integer('iddependencia')->unsigned();

            $table->index(["iddependencia"], 'fk_conductor_dependencia1_idx');


            $table->foreign('iddependencia', 'fk_conductor_dependencia1_idx')
                ->references('iddependencia')->on('dependencia')
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
