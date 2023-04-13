<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shop_items', function (Blueprint $table) {
            $table->id();
            $table->integer('subcategory_id');
            $table->integer('vnum');
            $table->text('description');
            $table->integer('quantity');
            $table->integer('max_pcs')->default(1);
            $table->integer('max_pcs_account')->nullable();
            $table->integer('max_pcs_global')->nullable();
            $table->integer('price');
            $table->integer('discount')->default(0);
            $table->dateTime('discount_start')->nullable();
            $table->dateTime('discount_end')->nullable();
            $table->dateTime('available_start')->nullable();
            $table->dateTime('available_end')->nullable();
            $table->integer('attrtype0')->default(0);
            $table->integer('attrvalue0')->default(0);
            $table->integer('attrtype1')->default(0);
            $table->integer('attrvalue1')->default(0);
            $table->integer('attrtype2')->default(0);
            $table->integer('attrvalue2')->default(0);
            $table->integer('attrtype3')->default(0);
            $table->integer('attrvalue3')->default(0);
            $table->integer('attrtype4')->default(0);
            $table->integer('attrvalue4')->default(0);
            $table->integer('attrtype5')->default(0);
            $table->integer('attrvalue5')->default(0);
            $table->integer('attrtype6')->default(0);
            $table->integer('attrvalue6')->default(0);
            $table->enum('coin', ['MD', 'JD']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shop_items');
    }
};
