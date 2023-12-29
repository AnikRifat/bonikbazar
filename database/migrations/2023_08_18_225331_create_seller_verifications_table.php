<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSellerVerificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seller_verifications', function (Blueprint $table) {
            $table->id();
            $table->integer('seller_id');
            $table->string('membership', 25)->nullable();
            $table->dateTime('end_date')->nullable();
            $table->dateTime('verify_date')->nullable();
            $table->string('name', 255)->nullable();
            $table->string('shop_name', 255)->nullable();
            $table->string('shop_about', 225)->nullable();
            $table->string('owner_photo', 225)->nullable();
            $table->string('mobile', 255)->nullable();
            $table->string('email', 255)->nullable();
            $table->string('nid_front', 255)->nullable();
            $table->string('nid_back', 255)->nullable();
            $table->string('trade_license', 255)->nullable();
            $table->string('trade_license2', 255)->nullable();
            $table->string('trade_license3', 255)->nullable();
            $table->time('open_time')->nullable(); 
            $table->time('close_time')->nullable();
            $table->string('open_days', 75)->nullable();
            $table->integer('country')->nullable();
            $table->integer('region')->nullable();
            $table->integer('city')->nullable();
            $table->integer('area')->nullable();
            $table->string('address')->nullable();
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
        Schema::dropIfExists('seller_verifications');
    }
}
