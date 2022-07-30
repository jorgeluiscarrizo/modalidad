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
            $table->unsignedBigInteger('id_batches');
            $table->unsignedBigInteger('id_notes');
            $table->double('amount', 8, 2)->nullable();
            $table->double('price', 8, 2)->nullable();
            $table->double('subtotal', 8, 2)->nullable();
            $table->string('slug')->inique();
            $table->timestamps();
            $table->enum('state', ['ACTIVE', 'INACTIVE', 'DELETED'])->default('ACTIVE');
            $table->foreign('id_batches')->references('id')->on('batches')->onDelete('cascade');
            $table->foreign('id_notes')->references('id')->on('notes')->onDelete('cascade');
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
