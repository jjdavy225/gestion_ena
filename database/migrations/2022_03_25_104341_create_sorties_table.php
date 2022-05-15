<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSortiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('sorties', function (Blueprint $table) {
            $table->id();
            $table->string('code',10)->unique();
            $table->date('date');
            $table->time('heure')->nullable();
            $table->string('obs')->nullable();
            $table->date('date_saisie')->nullable();
            $table->unsignedBigInteger('demande_id');
            $table->foreign('demande_id')
                ->references('id')
                ->on('demandes')
                ->onDelete('restrict')
                ->onUpdate('restrict');
            $table->string('code_sorn')->nullable();
            $table->string('code_structure')->nullable();
            $table->string('code_bureau')->nullable();
            $table->string('code_secteur')->nullable();
            $table->unsignedBigInteger('agent_id');
            $table->foreign('agent_id')
                ->references('id')
                ->on('agents')
                ->onDelete('restrict')
                ->onUpdate('restrict');
            $table->string('agent_matr_est_saisie')->nullable();
            $table->string('supprime')->nullable();
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
        Schema::dropIfExists('sorties');
    }
}
