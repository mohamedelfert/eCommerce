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
            $table->increments('id');
            $table->string('title');
            $table->longText('description');
            $table->string('photo');

            $table->integer('department_id')->unsigned()->nullable();
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');

            $table->integer('trade_mark_id')->unsigned()->nullable();
            $table->foreign('trade_mark_id')->references('id')->on('trade_marks')->onDelete('cascade');

            $table->integer('manufacture_id')->unsigned()->nullable();
            $table->foreign('manufacture_id')->references('id')->on('manufacturers')->onDelete('cascade');

            $table->integer('color_id')->unsigned()->nullable();
            $table->foreign('color_id')->references('id')->on('colors')->onDelete('cascade');

            $table->integer('size_id')->unsigned()->nullable();
            $table->foreign('size_id')->references('id')->on('sizes')->onDelete('cascade');

            $table->string('weight');
            $table->integer('weight_id')->unsigned()->nullable();
            $table->foreign('weight_id')->references('id')->on('weights')->onDelete('cascade');

            $table->integer('currency_id')->unsigned()->nullable();
            $table->foreign('currency_id')->references('id')->on('countries');

            $table->decimal('price',8,2)->default(0);
            $table->integer('stock')->default(0);

            $table->date('start_at')->nullable();
            $table->date('end_at')->nullable();

            $table->decimal('offer_price',8,2)->default(0);
            $table->date('offer_start_at')->nullable();
            $table->date('offer_end_at')->nullable();

            $table->longText('other_data')->nullable();
            $table->longText('reason')->nullable();
            $table->enum('status',['pending','refused','active'])->default('pending');


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
