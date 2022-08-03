<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDemandeVehiculesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('demande_vehicules', function (Blueprint $table) {
            $table->id();
            $table->string('code',10)->unique();
            $table->string('objet');
            $table->foreignId('conducteur_id')->constrained()
                ->cascadeOnDelete()->cascadeOnUpdate();
            $table->date('date_sortie');
            $table->date('date_retour');
            $table->foreignId('vehicule_id')->nullable()->constrained()
                ->nullOnDelete()->cascadeOnUpdate();
            $table->integer('kilometrage_depart')->nullable();
            $table->integer('kilometrage_retour')->nullable();
            $table->date('date_retour_reelle')->nullable();
            $table->string('statut');
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
        Schema::dropIfExists('demande_vehicules');
    }
}
