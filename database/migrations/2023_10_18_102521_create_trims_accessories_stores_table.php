<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrimsAccessoriesStoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trims_accessories_stores', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('company_id')->nullable();
            $table->unsignedBigInteger('division_id')->nullable();
            $table->unsignedBigInteger('department_id')->nullable();
            $table->date('date')->nullable(); 
            $table->string('buyer_name')->nullable(); 
            $table->string('style_or_no')->nullable();
            $table->string('order_qty')->nullable();
            $table->string('item_no')->nullable();
            $table->string('color_name')->nullable();
            $table->string('unit')->nullable();
            $table->string('booking_qty')->nullable();
            $table->string('receive_qty')->nullable();
            $table->string('rcv_bal_qty')->nullable();
            $table->string('issue_qty')->nullable();
            $table->string('in_hand_qty')->nullable();
            $table->string('rack_no')->nullable();
            $table->string('self_bin_no')->nullable();
            $table->string('remarks')->nullable();
            $table->string('created_by')->nullable();
            $table->string('created_date')->nullable();
            $table->string('updated_by')->nullable();
            $table->string('updated_date')->nullable();
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
        Schema::dropIfExists('trims_accessories_stores');
    }
}
