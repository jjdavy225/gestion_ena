<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommandesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('commandes', function (Blueprint $table) {
            $table->id();
            $table->string('num', 20)->unique();
            $table->date('date');
            $table->text('objet');
            $table->string('num_fact')->nullable();
            $table->date('date_fact')->nullable();
            $table->integer('remise')->nullable();
            $table->integer('tva')->nullable();
            $table->integer('montant')->nullable();
            $table->integer('delai_paie')->nullable();
            $table->integer('delai_liv')->nullable();
            $table->date('date_liv')->nullable();
            $table->string('statut_liv');
            $table->date('date_saisie');
            $table->date('date_annul')->nullable();
            $table->unsignedBigInteger('fournisseur_id');
            $table->foreign('fournisseur_id')
                ->references('id')
                ->on('fournisseurs')
                ->onDelete('restrict')
                ->onUpdate('restrict');
            $table->unsignedBigInteger('agent_id');
            $table->foreign('agent_id')
                ->references('id')
                ->on('agents')
                ->onDelete('restrict')
                ->onUpdate('restrict');
            $table->integer('frais')->nullable();
            $table->integer('garantie')->nullable();
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
        Schema::dropIfExists('commandes');
    }
}
