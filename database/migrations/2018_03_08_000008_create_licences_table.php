<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLicencesTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'licences';

    /**
     * Run the migrations.
     * @table licences
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('numero', 45)->nullable();
            $table->date('vencimiento')->nullable();
            $table->string('archivo', 145)->nullable();
            $table->integer('drivers_id');

            $table->index(["drivers_id"], 'fk_licences_drivers1_idx');


            $table->foreign('drivers_id', 'fk_licences_drivers1_idx')
                ->references('id')->on('drivers')
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
