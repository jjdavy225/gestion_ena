<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatrimoinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patrimoines', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bureau_id')->constrained()
                ->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('article_id')->constrained()
                ->cascadeOnDelete()->cascadeOnUpdate();
            $table->integer('quantite');
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
        Schema::dropIfExists('patrimoines');
    }
}
