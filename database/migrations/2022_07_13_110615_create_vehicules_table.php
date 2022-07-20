<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiculesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicules', function (Blueprint $table) {
            $table->id();
            $table->string('immatriculation')->unique();
            $table->string('carte_grise')->unique();
            $table->string('num_chassis')->unique();
            $table->date('date_mise_en_circulation');
            $table->string('type_acquisition');
            $table->date('date_acquisition');
            $table->integer('kilometrage');
            $table->foreignId('fournisseur_id')->constrained()
                ->restrictOnDelete()->cascadeOnUpdate();
            $table->boolean('dispo')->default(1);
            $table->foreignId('modele_id')->constrained()
                ->restrictOnDelete()->cascadeOnUpdate();
            $table->foreignId('marque_vehicule_id')->constrained()
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
        Schema::dropIfExists('vehicules');
    }
}
