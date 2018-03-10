<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'users';

    /**
     * Run the migrations.
     * @table users
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('password', 245)->nullable();
            $table->string('cargo', 145)->nullable();
            $table->string('nombre', 145)->nullable();
            $table->string('apaterno', 145)->nullable();
            $table->string('amaterno', 145)->nullable();
            $table->string('email', 145)->nullable();
            $table->string('celular', 12)->nullable();
            $table->integer('id_jefe')->nullable();
            $table->integer('role_id');
            $table->timestamps();
            $table->rememberToken();

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
