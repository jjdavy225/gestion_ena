<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReparationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reparations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('panne_id')->constrained()
                ->restrictOnDelete()->cascadeOnUpdate();
            $table->date('date');
            $table->integer('montant');
            $table->string('observation');
            $table->string('statut');
            $table->string('agent_reparation')->nullable();
            $table->foreignId('agent_id')->constrained()
                ->restrictOnDelete()->cascadeOnUpdate();
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
        Schema::dropIfExists('reparations');
    }
}
