<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePannesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pannes', function (Blueprint $table) {
            $table->id();
            $table->string('code',10);
            $table->foreignId('vehicule_id')->constrained()
                ->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('causes');
            $table->string('observation');
            $table->date('date_panne');
            $table->boolean('repare')->default(0);
            $table->foreignId('agent_id')->constrained()
                ->restrictOnDelete()->cascadeOnUpdate();
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
        Schema::dropIfExists('pannes');
    }
}
