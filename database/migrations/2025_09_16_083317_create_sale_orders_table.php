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
        Schema::create('sale_orders', function (Blueprint $table) {
            $table->id();
            $table->string('sale_no')->nullable();
            $table->string('sale_date')->nullable();
            $table->string('account_id')->nullable();
            $table->string('total_quantity')->nullable();
            $table->string('total_sale_amount')->nullable();
            $table->string('total_paid_amount')->nullable();
            $table->string('payment_method')->nullable();
            $table->string('total_items')->nullable();
            $table->string('total_pending_amount')->nullable();
            $table->string('status')->nullable();
            $table->text('remarks')->nullable();
            $table->string('deleted_at')->nullable();
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
        Schema::dropIfExists('sale_orders');
    }
};
