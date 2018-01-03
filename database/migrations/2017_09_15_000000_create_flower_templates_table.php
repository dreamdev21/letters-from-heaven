<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFlowerTemplatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flower_templates', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->double('price');
            $table->string('image');
            $table->string('image1')->nullable(true);
            $table->string('image2')->nullable(true);
            $table->string('image3')->nullable(true);
            $table->string('image4')->nullable(true);
            $table->string('image5')->nullable(true);
            $table->string('image6')->nullable(true);
            $table->string('image7')->nullable(true);
            $table->string('image8')->nullable(true);
            $table->string('image9')->nullable(true);
            $table->string('image10')->nullable(true);
            $table->string('image11')->nullable(true);
            $table->string('image12')->nullable(true);
            $table->string('image13')->nullable(true);
            $table->string('image14')->nullable(true);
            $table->string('image15')->nullable(true);
            $table->string('image16')->nullable(true);
            $table->string('image17')->nullable(true);
            $table->string('image18')->nullable(true);
            $table->string('image19')->nullable(true);
            $table->text('detail');
            $table->integer('state');
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
        Schema::dropIfExists('flower_templates');
    }
}
