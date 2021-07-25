<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string("title", 50);
            $table->mediumText("description");
            $table->string("image")->nullable();
            $table->string("author", 50);
            $table->string("genre", 50);
            $table->string("country", 50);
            $table->unsignedSmallInteger("year");
            $table->integer("pages");
            $table->longText("book");
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
        Schema::dropIfExists('books');
    }
}
