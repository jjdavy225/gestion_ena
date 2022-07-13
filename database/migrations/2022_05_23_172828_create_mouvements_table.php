<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMouvementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mouvements', function (Blueprint $table) {
            $table->id();
            $table->string('code',10)->unique();
            $table->date('date');
            $table->foreignId('bureau_initial_id')->constrained('bureaus')
                ->cascadeOnUpdate()
                ->restrictOnDelete();
            $table->foreignId('bureau_final_id')->constrained('bureaus')
                ->cascadeOnUpdate()
                ->restrictOnDelete();
            $table->string('type');
            $table->date('date_saisie');
            $table->string('observation');
            $table->string('agent_mouvement');
            $table->string('statut');
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
        Schema::dropIfExists('mouvements');
    }
}
