<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExhaustDyeingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exhaust_dyeings', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('mc_no');
            $table->string('target_kg');
            $table->string('actual_production_kg');
            $table->string('acheivement')->nullable();
            $table->text('remarks')->nullable();
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
        Schema::dropIfExists('exhaust_dyeings');
    }
}
