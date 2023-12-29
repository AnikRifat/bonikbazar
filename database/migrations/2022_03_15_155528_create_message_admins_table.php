<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessageAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('message_admins', function (Blueprint $table) {
            $table->id();
            $table->integer('sender_id')->nullable();
            $table->text('receiver_id')->nullable();
            $table->string('subject');
            $table->string('slug');
            $table->longText('details')->nullable();
            $table->string('attachment')->nullable();
            $table->dateTime('start_date')->nullable();
            $table->dateTime('end_date')->nullable();
            $table->string('send_via', 15)->nullable();
            $table->string('status', 10)->default('send');
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
        Schema::dropIfExists('message_admins');
    }
}
