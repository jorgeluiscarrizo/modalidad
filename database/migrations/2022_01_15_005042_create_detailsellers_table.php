<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailsellersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detailsellers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_sellers')->nullable();
            $table->unsignedBigInteger('id_routes')->nullable();
            $table->date('date_i')->nullable();
            $table->date('date_f')->nullable();
            $table->string('slug')->inique();
            $table->timestamps();
            $table->enum('state', ['ACTIVE', 'INACTIVE', 'DELETED'])->default('ACTIVE');
            $table->foreign('id_sellers')
            ->references('id')
            ->on('sellers')
            ->onDelete('cascade');
            $table->foreign('id_routes')
            ->references('id')
            ->on('routes')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detailsellers');
    }
}
