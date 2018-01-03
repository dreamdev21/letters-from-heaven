<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBillingAddressbookTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     *
     */
    public function up()
    {
        Schema::create('billingaddressbook', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('userid');
            $table->string('order_id')->nullable(true);
            $table->string('billingfirstname')->nullable(true);
            $table->string('billinglastname')->nullable(true);
            $table->string('billingaddress1')->nullable(true);
            $table->string('billingaddress2')->nullable(true);
            $table->string('billingcity')->nullable(true);
            $table->string('billingaddressstate')->nullable(true);
            $table->string('billingpostalcode')->nullable(true);
            $table->integer('billingcountry')->nullable(true);
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
        Schema::dropIfExists('billingaddressbook');
    }
}
