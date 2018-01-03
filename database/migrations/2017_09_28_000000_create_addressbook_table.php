<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressbookTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     *
     */
    public function up()
    {
        Schema::create('addressbook', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('userid');
            $table->integer('title')->nullable(true);
            $table->integer('extendedinfo')->nullable(true);
            $table->string('firstname');
            $table->string('lastname');
            $table->string('deliveryadd1');
            $table->string('deliveryadd2')->nullable(true);
            $table->string('city');
            $table->string('state');
            $table->string('postalcode');
            $table->integer('country');
            $table->string('rephone')->nullable(true);
            $table->string('reemail')->nullable(true);
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
        Schema::dropIfExists('addressbook');
    }
}
