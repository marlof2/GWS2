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
        Schema::create('programation_documents', function (Blueprint $table) {
            $table->unsignedBigInteger('documents_id');
            $table->unsignedBigInteger('programation_id');
            // $table->string('file')->nullable();
            // $table->string('type')->nullable();
            $table->timestamps();

            $table->foreign('programation_id')->references('id')->on('programations')->onDelete('cascade');
            $table->foreign('documents_id')->references('id')->on('documents')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('programation_documents');
    }
};
