<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductnotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productnotes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('batche_id');
            $table->unsignedBigInteger('note_id');
            $table->double('amount', 8, 2)->nullable();
            $table->double('price', 8, 2)->nullable();
            $table->double('subtotal', 8, 2)->nullable();
            $table->timestamps();
            $table->enum('state', ['ACTIVE', 'INACTIVE', 'DELETED'])->default('ACTIVE');
            $table->foreign('batche_id')->references('id')->on('batches')->onDelete('cascade');
            $table->foreign('note_id')->references('id')->on('notes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('productnotes');
    }
}
