<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMedicineStockTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medicine_stock', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('medicine_id')->unsigned();
            $table->integer('quantity');
            $table->string('category');
            $table->date('expiry');
            $table->date('mfg_date');
            $table->double('price');
            $table->string('potency');
            $table->string('type');
            $table->foreign('medicine_id')->references('id')->on('medicines')->onDelete('cascade');
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
        Schema::dropIfExists('medicine_stock');
    }
}
