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
            $table->integer('initial')->nullable()->default(0);
            $table->integer('entree')->nullable()->default(0);
            $table->integer('assemblage')->nullable();
            $table->integer('sortie')->nullable()->default(0);
            $table->integer('retour')->nullable()->default(0);
            $table->integer('stock')->nullable()->default(0);
            $table->string('exercice_code')->nullable();
            $table->date('jour')->nullable();
            $table->string('nature');
            $table->integer('montant_initial')->nullable()->default(0);
            $table->integer('entree_montant')->nullable()->default(0);
            $table->integer('assemble_montant')->nullable()->default(0);
            $table->integer('sortie_montant')->nullable()->default(0);
            $table->integer('retour_montant')->nullable()->default(0);
            $table->integer('stock_montant')->nullable()->default(0);
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
