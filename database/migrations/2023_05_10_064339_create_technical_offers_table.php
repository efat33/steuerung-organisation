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
        Schema::create('technical_offers', function (Blueprint $table) {
            $table->id();
            $table->string('get_over', 50)->nullable();
            $table->bigInteger('cs_order_number')->nullable();
            $table->date('received_date')->nullable();
            $table->string('received_from', 50)->nullable();
            $table->string('customer_number', 10)->nullable();
            $table->string('technical_place', 10)->nullable();
            $table->string('technical_place_address', 100)->nullable();
            $table->string('technical_postcode', 4)->nullable();
            $table->unsignedBigInteger('registered_by');
            $table->string('status', 50)->nullable();
            $table->string('offer_type', 10)->nullable();
            $table->integer('ktb_number')->nullable();
            $table->integer('quote_number')->nullable();
            $table->date('offer_date')->nullable();
            $table->decimal('offer_amount', 13, 2)->nullable();
            $table->date('offer_follow_up')->nullable();
            $table->string('conversation_status', 100)->nullable();
            $table->integer('order_number')->nullable();
            $table->date('order_date')->nullable();
            $table->decimal('order_amount', 13, 2)->nullable();
            $table->date('execution_date')->nullable();
            $table->date('approval_date')->nullable();
            $table->decimal('invice_amount', 13, 2)->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->foreign('registered_by')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('technical_offers');
    }
};
