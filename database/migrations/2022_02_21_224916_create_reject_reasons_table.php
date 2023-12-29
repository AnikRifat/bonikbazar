<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRejectReasonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reject_reasons', function (Blueprint $table) {
            $table->id();
            $table->string('reason')->comment('admin set reject reason');
            $table->text('reason_details')->nullable();
            $table->integer('item_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->string('reason_for', 11)->nullable();
            $table->string('type', 11)->nullable();
            $table->integer('rejectBy')->nullable();
            $table->integer('status')->defualt(1);
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
        Schema::dropIfExists('reject_reasons');
    }
}
