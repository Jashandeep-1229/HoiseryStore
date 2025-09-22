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
        Schema::create('manage_stocks', function (Blueprint $table) {
            $table->id();
            $table->string('from')->nullable();
            $table->string('from_id')->nullable();
            $table->string('brand_id')->nullable();
            $table->string('category_id')->nullable();
            $table->string('item_id')->nullable();
            $table->string('item_detail_id')->nullable();
            $table->string('quantity')->nullable();
            $table->string('in_out')->nullable();
            $table->string('remarks')->nullable();
            $table->string('software_remarks')->nullable();
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
        Schema::dropIfExists('manage_stocks');
    }
};
