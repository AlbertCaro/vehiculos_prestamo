<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'contacts';

    /**
     * Run the migrations.
     * @table contacts
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('nombre', 75)->nullable();
            $table->string('apaterno', 75)->nullable();
            $table->string('amaterno', 75)->nullable();
            $table->string('parentesco', 45)->nullable();
            $table->string('telefono', 12)->nullable();
            $table->integer('drivers_id');

            $table->index(["drivers_id"], 'fk_contacts_drivers1_idx');


            $table->foreign('drivers_id', 'fk_contacts_drivers1_idx')
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
