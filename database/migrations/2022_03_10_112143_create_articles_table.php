<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->text('code')->unique();
            $table->text('designation');
            $table->text('divisible')->nullable();
            $table->text('unite')->nullable();
            $table->integer('alerte')->nullable();
            $table->unsignedBigInteger('type_id');
            $table->foreign('type_id')
                ->references('id')
                ->on('types')
                ->onDelete('restrict')
                ->onUpdate('restrict');
            $table->unsignedBigInteger('marque_id');
            $table->foreign('marque_id')
                ->references('id')
                ->on('marques')
                ->onDelete('restrict')
                ->onUpdate('restrict');
            $table->char('supprime',1)->nullable();
            $table->integer('prix_jour')->nullable();
            $table->integer('prix_dal')->nullable();
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
        Schema::dropIfExists('articles');
    }
}
