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
        Schema::create('item_details', function (Blueprint $table) {
            $table->id();
            $table->string('item_id')->nullable();
            $table->string('brand_id')->nullable();
            $table->string('category_id')->nullable();
            $table->string('article_name')->nullable();
            $table->string('barcode_value')->nullable();
            $table->string('size')->nullable();
            $table->string('color')->nullable();
            $table->string('quantity')->nullable();
            $table->string('purchase_price')->nullable();
            $table->string('selling_price')->nullable();
            $table->string('total_stocl')->nullable();
            $table->string('pending_stock')->nullable();
            $table->string('total_purchse_value')->nullable();
            $table->string('total_sale_value')->nullable();
            $table->string('result_sale_amount')->nullable();
            $table->string('result_profit_amount')->nullable();
            $table->string('is_temp')->nullable()->default(0);
            $table->string('status')->nullable()->default(1);
            $table->softDeletes();
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
        Schema::dropIfExists('item_details');
    }
};
