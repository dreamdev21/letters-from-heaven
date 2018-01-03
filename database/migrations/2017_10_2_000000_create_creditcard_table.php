<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCreditcardTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     *
     */
    public function up()
    {
        Schema::create('creditcard', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('userid');
            $table->string('order_id');
            $table->string('cardfirstname');
            $table->string('cardlastname');
            $table->string('card-number');
            $table->string('expiredatemonth');
            $table->string('expiredateyear');
            $table->string('cvv');
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
        Schema::dropIfExists('creditcard');
    }
}
