<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('order_id');
            $table->integer('userid');
            $table->integer('pro_id');
            $table->string('pro_name');
            $table->integer('pro_type');
            $table->integer('pro_qty');
            $table->string('pro_price');
            $table->string('pro_image');
            $table->text('pro_text')->nullable(true);
            $table->integer('title')->nullable(true);
            $table->integer('extendedinfo')->nullable(true);
            $table->string('firstname')->nullable(true);
            $table->string('lastname')->nullable(true);
            $table->string('deliveryadd1')->nullable(true);
            $table->string('deliveryadd2')->nullable(true);
            $table->string('city')->nullable(true);
            $table->string('state')->nullable(true);
            $table->string('postalcode')->nullable(true);
            $table->integer('country')->nullable(true);
            $table->string('rephone')->nullable(true);
            $table->string('reemail')->nullable(true);
            $table->text('deliverydate')->nullable(true);
            $table->integer('deliverytype')->nullable(true);
            $table->text('cardmessage')->nullable(true);
            $table->string('signature')->nullable(true);
            $table->integer('orderstate')->nullable(true);
            $table->integer('draftstate')->nullable(true);
            $table->text('adminnote')->nullable(true);
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
        Schema::dropIfExists('orders');
    }
}
