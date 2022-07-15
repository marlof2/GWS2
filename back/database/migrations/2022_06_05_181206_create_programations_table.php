<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('programations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('condominium_id');
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('forma_pagamento_id');
            $table->string('valor');
            $table->char('situacao', 1)->comment('A = Atendido, N = Não Atendido');
            $table->string('observacao')->nullable();
            $table->string('descricao')->nullable();
            $table->string('garantia');
            $table->date('data');
            $table->time('hora');


            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('condominium_id')->references('id')->on('condominium')->onDelete('cascade');
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
            $table->foreign('forma_pagamento_id')->references('id')->on('forma_pagamento')->onDelete('cascade');
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
        Schema::dropIfExists('programations');
    }
};
