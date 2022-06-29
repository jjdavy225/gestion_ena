<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLivraisonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('livraisons', function (Blueprint $table) {
            $table->id();
            $table->string('code',10)->unique();
            $table->date('date');
            $table->integer('remise')->nullable();
            $table->integer('tva')->nullable();
            $table->integer('montant');
            $table->integer('delai')->nullable();
            $table->date('date_saisie');
            $table->foreignId('commande_id')->constrained()
                ->restrictOnDelete()
                ->cascadeOnUpdate();
            $table->foreignId('agent_id')->constrained()
                ->restrictOnDelete()
                ->cascadeOnUpdate();
            $table->foreignId('stock_id')->constrained()
                ->restrictOnDelete()
                ->cascadeOnUpdate();
            $table->string('statut');
            $table->string('num_bon')->nullable();
            $table->date('date_bon')->nullable();
            $table->string('fact_num')->nullable();
            $table->date('fact_date')->nullable();
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
        Schema::dropIfExists('livraisons');
    }
}
