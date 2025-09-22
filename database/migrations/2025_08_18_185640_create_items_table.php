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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('from')->nullable();
            $table->string('from_id')->nullable();
            $table->string('brand_id')->nullable();
            $table->string('category_id')->nullable();
            $table->string('total_items')->nullable();
            $table->string('min_alert')->nullable();
            $table->string('max_alert')->nullable();
            $table->text('size_list')->nullable();
            $table->text('color_list')->nullable();
            $table->text('purchase_price_list')->nullable();
            $table->text('selling_price_list')->nullable();
            $table->string('total_purchase_amount')->nullable();
            $table->string('total_sale_amount')->nullable();
            $table->string('total_stock')->nullable();
            $table->string('pending_stock')->nullable();
            $table->string('total_profit')->nullable();
            $table->string('actual_profit')->nullable();
            $table->text('image')->nullable();
            $table->string('status')->default(1);
            $table->string('is_temp')->default(1);
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
        Schema::dropIfExists('items');
    }
};
