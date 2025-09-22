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
        Schema::create('purchase_orders', function (Blueprint $table) {
            $table->id();
            $table->string('purchase_no')->nullable();
            $table->string('date')->nullable();
            $table->string('vendor_id')->nullable();
            $table->string('total_items')->nullable();
            $table->string('total_stock')->nullable();
            $table->string('total_amount')->nullable();
            $table->string('total_paid_amount')->nullable();
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
        Schema::dropIfExists('purchase_orders');
    }
};
