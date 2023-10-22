<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQCSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('q_c_s', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('shift')->nullable();
            $table->string('grade_a')->nullable();
            $table->string('grade_b')->nullable();
            $table->string('grade_c')->nullable();
            $table->string('rejection')->nullable();
            $table->string('precentage_rejection')->nullable();
            $table->string('total_check')->nullable();
            $table->string('qc_pass_qty')->nullable();
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
        Schema::dropIfExists('q_c_s');
    }
}
