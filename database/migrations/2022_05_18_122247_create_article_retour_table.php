<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticleRetourTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('article_retour', function (Blueprint $table) {
            $table->id();
            $table->foreignId('article_id')->constrained()
                ->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('retour_id')->constrained()
                ->cascadeOnDelete()->cascadeOnUpdate();
            $table->integer('quantite');
            $table->integer('prix_unitaire');
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
        Schema::dropIfExists('article_retour');
    }
}
