<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticleDemandeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('article_demande', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('demande_id');
            $table->foreign('demande_id')
                ->references('id')
                ->on('demandes')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->unsignedBigInteger('article_id');
            $table->foreign('article_id')
                ->references('id')
                ->on('articles')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->integer('quantite');
            $table->integer('quantite_sortie');
            $table->integer('reste');
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
        Schema::dropIfExists('article_demande');
    }
}
