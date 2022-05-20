<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDemandesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('demandes', function (Blueprint $table) {
            $table->id();
            $table->string('code',10)->unique();
            $table->date('date');
            $table->string('objet');
            $table->string('fiche')->nullable();
            $table->integer('delai')->nullable();
            $table->date('date_saisie');
            $table->date('date_annul')->nullable();
            $table->date('date_val')->nullable();
            $table->foreignId('agent_id')->constrained()
                ->cascadeOnUpdate();
            $table->string('agt_matr_est_faite')->nullable();
            $table->string('code_secteur')->nullable();
            $table->foreignId('bureau_id')->constrained()
                ->restrictOnDelete()->cascadeOnUpdate();
            $table->string('statut');
            $table->date('date_auto')->nullable();
            $table->string('num_auto')->nullable();
            $table->string('siga_code')->nullable();
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
        Schema::dropIfExists('demandes');
    }
}
