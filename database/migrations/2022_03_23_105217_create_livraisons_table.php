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
            $table->unsignedBigInteger('commande_id');
            $table->foreign('commande_id')
                ->references('id')
                ->on('commandes')
                ->onDelete('restrict')
                ->onUpdate('restrict');
            $table->unsignedBigInteger('agent_id');
            $table->foreign('agent_id')
                ->references('id')
                ->on('agents')
                ->onDelete('restrict')
                ->onUpdate('restrict');
            $table->unsignedBigInteger('stock_id');
            $table->foreign('stock_id')
                ->references('id')
                ->on('stocks')
                ->onDelete('restrict')
                ->onUpdate('restrict');
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
