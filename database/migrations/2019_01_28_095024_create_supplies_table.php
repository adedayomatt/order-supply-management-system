<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSuppliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supplies', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('customer_id')->unsigned();
            $table->string('type');
            $table->integer('quantity');
            $table->bigInteger('value');
            $table->longText('note')->nullable();
            $table->timestamp('supplied_at');
            $table->integer('reverted_by')->nullable();
            $table->timestamp('reverted_at')->nullable();
            $table->timestamps();

            $table->index('customer_id');
            $table->foreign('customer_id')
                    ->references('id')
                    ->on('customers')
                    ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('supplies');
    }
}
