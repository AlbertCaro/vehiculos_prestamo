<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactoTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'contacto';

    /**
     * Run the migrations.
     * @table contacto
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->string('nombre', 145)->nullable();
            $table->string('parentesco', 45)->nullable();
            $table->string('domicilio', 245)->nullable();
            $table->string('telefono', 15)->nullable();
            $table->increments('idconductor')->unsigned();

            $table->index(["idconductor"], 'fk_contacto_conductor1_idx');


            $table->foreign('idconductor', 'fk_contacto_conductor1_idx')
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
