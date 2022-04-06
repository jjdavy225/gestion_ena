<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticleLivraisonTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('article_livraison', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('livraison_id');
            $table->foreign('livraison_id')
                ->references('id')
                ->on('livraisons')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->unsignedBigInteger('article_id');
            $table->foreign('article_id')
                ->references('id')
                ->on('articles')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->integer('quantite_livree');
            $table->integer('prix_unitaire');
            $table->integer('reste');
            $table->integer('pu_origine')->nullable();
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
        Schema::dropIfExists('article_livraison');
    }
}
