<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRetoursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('retours', function (Blueprint $table) {
            $table->id();
            $table->string('code',10)->unique();
            $table->date('date');
            $table->string('observation');
            $table->date('date_saisie');
            $table->string('statut');
            $table->foreignId('bureau_id')->constrained()
                ->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('stock_id')->constrained()
                ->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('agent_id')->constrained()->cascadeOnUpdate();
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
        Schema::dropIfExists('retours');
    }
}
