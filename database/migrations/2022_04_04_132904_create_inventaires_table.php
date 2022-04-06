<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventairesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('inventaires', function (Blueprint $table) {
            $table->id();
            $table->string('code',10)->unique();
            $table->integer('initial')->nullable();
            $table->integer('physique')->nullable();
            $table->integer('final')->nullable();
            $table->integer('maj')->nullable();
            $table->string('exercice_code');
            $table->date('jour');
            $table->string('nature');
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
        Schema::dropIfExists('inventaires');
    }
}
