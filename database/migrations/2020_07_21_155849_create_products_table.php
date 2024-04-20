<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('post_id', 10)->nullable();
            $table->integer('user_id')->nullable();
            $table->string('title')->nullable();
            $table->string('slug')->nullable();
            $table->text('summery')->nullable();
            $table->longText('description')->nullable();
            $table->integer('category_id');
            $table->integer('subcategory_id')->nullable();
            $table->integer('childcategory_id')->nullable();
            $table->integer('brand_id')->nullable();
            $table->integer('model_id')->nullable();
            $table->char('feature_image', 225)->nullable();
            $table->string('post_type', 15)->nullable();
            $table->string('sale_type', 25)->nullable();
            $table->string('ad_type', 10)->default('free');
            $table->decimal('price')->default(0);
            $table->string('negotiable', 15)->nullable();
            $table->string('condition', 25)->nullable();
            $table->integer('state_id')->nullable();
            $table->text('reject_reason')->nullable();
            $table->text('website')->nullable();
            $table->integer('city_id')->nullable();
            $table->string('address', 225)->nullable();
            $table->string('contact_name', 125)->nullable();
            $table->string('contact_mobile', 25)->nullable();
            $table->string('contact_email', 125)->nullable();
            $table->string('contact_hidden', 125)->nullable();
            $table->integer('views')->default(0);
            $table->string('meta_title')->nullable();
            $table->text('meta_keywords')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_fimage')->nullable();
            $table->integer('position')->nullable();
            $table->dateTime('approved')->nullable();
            $table->text('delete_reason')->nullable();
            $table->string('status', '10')->default('pending')->comment('pending,active,reject');
            $table->integer('created_by');
            $table->integer('updated_by')->nullable();
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
        Schema::dropIfExists('products');
    }
}
