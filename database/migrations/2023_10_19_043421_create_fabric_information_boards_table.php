<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFabricInformationBoardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fabric_information_boards', function (Blueprint $table) {
            $table->id(); 
            $table->unsignedBigInteger('company_id')->nullable();
            $table->unsignedBigInteger('division_id')->nullable();
            $table->unsignedBigInteger('department_id')->nullable();
            $table->date('date')->nullable();
            $table->string('buyer_name')->nullable();
            $table->string('style_or_no')->nullable();
            $table->string('order_qty')->nullable();
            $table->string('fabric_type')->nullable();
            $table->string('color_name')->nullable();
            $table->string('lot')->nullable();
            $table->string('dia')->nullable();
            $table->string('gsm')->nullable();
            $table->string('parts')->nullable();
            $table->string('cons_dz')->nullable();
            $table->string('booking_qty')->nullable();
            $table->string('receive_qty')->nullable();
            $table->string('rcv_bal_qty')->nullable();
            $table->string('dlv_cutting')->nullable();
            $table->string('closing_stock')->nullable(); 
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
        Schema::dropIfExists('fabric_information_boards');
    }
}
