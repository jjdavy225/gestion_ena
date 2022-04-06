<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('stocks', function (Blueprint $table) {
            $table->id();
            $table->string('code',10)->unique();
            $table->integer('initial')->nullable();
            $table->integer('entree')->nullable();
            $table->integer('assemblage')->nullable();
            $table->integer('sortie')->nullable();
            $table->integer('retour')->nullable();
            $table->integer('stock')->nullable();
            $table->string('exercice_code')->nullable();
            $table->date('jour')->nullable();
            $table->string('nature')->nullable();
            $table->integer('montant_initial')->nullable();
            $table->integer('entree_montant')->nullable();
            $table->integer('assemble_montant')->nullable();
            $table->integer('sortie_montant')->nullable();
            $table->integer('retour_montant')->nullable();
            $table->integer('stock_montant')->nullable();
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
        Schema::dropIfExists('stocks');
    }
}
