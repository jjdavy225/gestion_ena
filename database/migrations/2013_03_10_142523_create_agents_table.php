<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('agents', function (Blueprint $table) {
            $table->id();
            $table->string('matricule', 10)->unique();
            $table->string('nom');
            $table->string('prenom');
            $table->string('fonction')->nullable();
            $table->string('adresse')->nullable();
            $table->string('tel');
            $table->string('poste')->nullable();
            $table->string('login')->nullable();
            $table->unsignedBigInteger('role_id')->nullable();
            $table->foreign('role_id')
                ->references('id')
                ->on('roles')
                ->onDelete('restrict')
                ->onUpdate('restrict');
            $table->unsignedBigInteger('service_id')->nullable();
            $table->foreign('service_id')
                ->references('id')
                ->on('services')
                ->onDelete('restrict')
                ->onUpdate('restrict');
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
        Schema::dropIfExists('agents');
    }
}
