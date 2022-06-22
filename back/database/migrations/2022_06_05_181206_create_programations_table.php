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
            $table->unsignedBigInteger('description_id');
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('product_id');
            $table->string('nome_programacao');
            $table->string('pagamento');
            $table->string('valor');
            $table->char('situacao', 1);
            $table->string('descricao_outros')->nullable();
            $table->string('observacao')->nullable();
            $table->string('garantia');

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('condominium_id')->references('id')->on('condominium')->onDelete('cascade');
            $table->foreign('description_id')->references('id')->on('descriptions')->onDelete('cascade');
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
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
