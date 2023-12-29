<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSellerMembershipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seller_memberships', function (Blueprint $table) {
            $table->id();
            $table->integer('seller_id');
            $table->string('membership', 25)->nullable();
            $table->dateTime('start_date')->nullable();
            $table->dateTime('end_date')->nullable();
            $table->integer('duration')->nullable();
            $table->float('amount')->nullable();
            $table->string('payment_method', 20)->default('pending');
            $table->string('tnx_id', 55)->nullable();
            $table->string('payment_info')->nullable();
            $table->string('payment_status', 10)->default('pending')->comment('pending,process,complete');
            $table->string('reject_reason')->nullable();
            $table->string('status')->default("pending");
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
        Schema::dropIfExists('seller_memberships');
    }
}
