<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateViagemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('viagems', function (Blueprint $table) {
            $table->increments('id');

            $table->string('origem');
            $table->string('destino');

            $table->date('data');

            $table->time('horaInicio');
            $table->time('horaFim');

            $table->integer('preco')->nullable();

            $table->integer('user_id')->unsigned();
            // $table->foreign('user_id')->references('id')->on('users');//campo user_id referencia id da tabela user

            $table->integer('tipo_id')->unsigned();
            // $table->foreign('tipo_id')->references('id')->on('tipos');//campo tipo_id referencia id da tabela tipo

            $table->integer('estado_id')->unsigned();

            $table->timestamps();
        });

        Schema::table('viagems', function($table) {
            // $table->foreign('user_id')->references('id')->on('users');//campo user_id referencia id da tabela user
            // $table->foreign('produto_id')->references('id')->on('produtos');//campo produto_id referencia id da tabela produto
            // $table->foreign('tipo_id')->references('id')->on('tipos');//campo tipo_id referencia id da tabela tipo
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('viagems');
    }
}
