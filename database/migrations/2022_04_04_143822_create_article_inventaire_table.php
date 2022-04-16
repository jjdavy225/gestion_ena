<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticleInventaireTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('article_inventaire', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('inventaire_id');
            $table->foreign('inventaire_id')
                ->references('id')
                ->on('inventaires')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->unsignedBigInteger('article_id');
            $table->foreign('article_id')
                ->references('id')
                ->on('articles')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->integer('quantite');
            $table->string('nature_stock');
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
        Schema::dropIfExists('article_inventaire');
    }
}
