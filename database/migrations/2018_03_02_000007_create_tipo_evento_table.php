<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTipoEventoTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'tipo_evento';

    /**
     * Run the migrations.
     * @table tipo_evento
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('idtipo_evento');
            $table->string('nombre', 145)->nullable();
            $table->integer('categoria_idcategoria')->unsigned();

            $table->index(["categoria_idcategoria"], 'fk_tipo_evento_categoria1_idx');


            $table->foreign('categoria_idcategoria', 'fk_tipo_evento_categoria1_idx')
                ->references('idcategoria')->on('categoria')
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
