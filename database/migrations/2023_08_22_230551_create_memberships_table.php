<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembershipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('memberships', function (Blueprint $table) {
            $table->id();
            $table->string('name', 125);
            $table->string('slug', 125);
            $table->string('ribbon', 255)->nullable();
            $table->string('ribbon_position', 25)->nullable()->comment('left,top,right');
            $table->text('details')->nullable();
            $table->integer('position')->default(999);
            $table->tinyInteger('is_default')->nullable();
            $table->integer('status')->default(1);
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
        Schema::dropIfExists('memberships');
    }
}
