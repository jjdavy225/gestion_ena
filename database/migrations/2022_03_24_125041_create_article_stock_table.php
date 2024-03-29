<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticleStockTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('article_stock', function (Blueprint $table) {
            $table->id();
            $table->foreignId('article_id')->constrained()
                ->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('stock_id')->constrained()
                ->onDelete('cascade')->onUpdate('cascade');
            $table->integer('quantite_totale');
            $table->integer('quantite_entree');
            $table->integer('quantite_retournee');
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
        Schema::dropIfExists('article_stock');
    }
}
