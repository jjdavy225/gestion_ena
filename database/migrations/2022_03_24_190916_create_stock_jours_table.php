<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockJoursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('stock_jours', function (Blueprint $table) {
            $table->id();
            $table->string('code', 10)->unique();
            $table->string('nature');
            $table->date('jour');
            $table->integer('quantite_initiale')->nullable();
            $table->integer('montant_initial')->nullable();
            $table->integer('quantite_entree')->nullable();
            $table->integer('montant_entree')->nullable();
            $table->integer('quantite_stock')->nullable();
            $table->integer('montant_stock')->nullable();
            $table->integer('quantite_sortie')->nullable();
            $table->integer('montant_sortie')->nullable();
            $table->integer('quantite_finale')->nullable();
            $table->integer('montant_final')->nullable();
            $table->integer('montant_diff')->nullable();
            $table->string('exercice_code')->nullable();
            $table->unsignedBigInteger('agent_id');
            $table->foreign('agent_id')
                ->references('id')
                ->on('agents')
                ->onDelete('restrict')
                ->onUpdate('restrict');
            $table->date('date');
            $table->string('reference')->nullable();
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
        Schema::dropIfExists('stock_jours');
    }
}
