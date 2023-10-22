<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateYarnDashboardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('yarn_dashboards', function (Blueprint $table) {
            $table->id();  
            $table->unsignedBigInteger('company_id')->nullable();
            $table->unsignedBigInteger('division_id')->nullable();
            $table->unsignedBigInteger('department_id')->nullable(); 
            $table->date('date')->nullable();
            $table->string('opening_qty')->nullable();
            $table->string('received_qty')->nullable();
            $table->string('received_qumilative_qty')->nullable();
            $table->string('issue_qty')->nullable();
            $table->string('issue_qumilative_qty')->nullable();
            $table->string('stock_in_hand')->nullable();
            $table->string('created_by')->nullable();
            $table->string('created_date')->nullable();
            $table->string('updated_by')->nullable();
            $table->string('updated_date')->nullable();
            $table->string('remarks')->nullable(); 
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
        Schema::dropIfExists('yarn_dashboards');
    }
}
