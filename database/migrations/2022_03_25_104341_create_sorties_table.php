<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSortiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('sorties', function (Blueprint $table) {
            $table->id();
            $table->string('code',10)->unique();
            $table->date('date');
            $table->time('heure')->nullable();
            $table->string('obs')->nullable();
            $table->date('date_saisie');
            $table->foreignId('demande_id')->constrained()
                ->restrictOnDelete()->cascadeOnUpdate();
            $table->string('nature');
            $table->string('code_structure')->nullable();
            $table->foreignId('bureau_id')->constrained()
                ->restrictOnDelete()->cascadeOnUpdate();
            $table->string('code_secteur')->nullable();
            $table->foreignId('agent_id')->constrained()
                ->cascadeOnUpdate();
            $table->string('statut');
            $table->string('type');
            $table->json('json')->nullable();
            $table->string('agent_matr_est_saisie')->nullable();
            $table->string('supprime')->nullable();
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
        Schema::dropIfExists('sorties');
    }
}
