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
        Schema::create('ledgers', function (Blueprint $table) {
            $table->id();
            $table->string('user_id')->nullable();
            $table->string('from')->nullable();
            $table->string('from_id')->nullable();
            $table->string('party_id')->nullable();
            $table->string('date')->nullable();
            $table->string('amount')->nullable();
            $table->string('dr_cr')->nullable();
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
        Schema::dropIfExists('ledgers');
    }
};
