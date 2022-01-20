<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CustomerDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_data', function (Blueprint $table) {
            $table->bigIncrements('id');
            
            $table->string('nombre');
            $table->string('apellido_paterno');
            $table->string('apellido_materno');
            $table->string('rfc');
            $table->date('fecha_nacimiento');
            $table->integer('ingresos');
            $table->integer('egresos');
            $table->integer('no_dependientes');
            $table->string('estado_civil');
            $table->string('genero');
            $table->string('ultimo_grado_estudios');

            $table->unsignedBigInteger('status_id');
            $table->foreign('status_id')->references('id')->on('status');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customer_data');
    }
}
