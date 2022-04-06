<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFournisseursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('fournisseurs', function (Blueprint $table) {
            $table->id();
            $table->string('code', 20)->unique();
            $table->string('sigle');
            $table->string('siege');
            $table->string('adresse')->nullable();
            $table->string('tel');
            $table->string('fax')->nullable();
            $table->string('email')->nullable();
            $table->string('site_web')->nullable();
            $table->string('r_com')->nullable();
            $table->string('ccont')->nullable();
            $table->string('banque')->nullable();
            $table->string('compte')->nullable();
            $table->string('contact')->nullable();
            $table->string('activite')->nullable();
            $table->string('capital')->nullable();
            $table->string('regime_impot')->nullable();
            $table->string('centre_impot')->nullable();
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
        Schema::dropIfExists('fournisseurs');
    }
}
