<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAffectationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('affectations', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->date('date_debut');
            $table->date('date_fin_prevue');
            $table->date('date_fin_reelle')->nullable();
            $table->foreignId('vehicule_id')->constrained()
                ->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('conducteur_principal_id')->constrained('conducteurs')
                ->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('conducteur_secondaire_id')->nullable()->constrained('conducteurs')
                ->nullOnDelete()->cascadeOnUpdate();
            $table->string('direction');
            $table->string('service');
            $table->foreignId('agent_id')->constrained()
                ->restrictOnDelete()->cascadeOnUpdate();
            $table->string('statut');
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
        Schema::dropIfExists('affectations');
    }
}
