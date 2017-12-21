<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTable2610 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('customers', function (Blueprint $table) {
          $table->increments('id');
          $table->string('name');
          $table->string('email')->unique();
          $table->string('password');
          $table->string('password2');
          $table->rememberToken();
          $table->timestamps();
      });
      Schema::create('categories', function (Blueprint $table) {
          $table->increments('id');
          $table->string('name');
          $table->rememberToken();
          $table->timestamps();
      });
      Schema::create('species', function (Blueprint $table) {
          $table->increments('id');
          $table->string('name');
          $table->rememberToken();
          $table->timestamps();
      });
      Schema::create('books', function (Blueprint $table) {
          $table->increments('id');
          $table->string('name');
          $table->string('author')->nullable();
          $table->string('preview');
          $table->string('date');
          $table->integer('view');
          $table->integer('like');
          $table->string('species');
          $table->string('recommend');
          $table->string('image');
          $table->string('adv')->nullable();
          $table->string('content')->nullable();
          $table->integer('customer_id')->unsigned()->nullable();
          $table->foreign('customer_id')->references('id')->on('customers');
          $table->integer('categories_id')->unsigned();
          $table->foreign('categories_id')->references('id')->on('categories');
          $table->rememberToken();
          $table->timestamps();
      });
      Schema::create('chaps', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('book_id')->unsigned();
          $table->datetime('date');
          $table->string('content');
          $table->foreign('book_id')->references('id')->on('books');
          $table->rememberToken();
          $table->timestamps();
      });
      Schema::create('subs', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('book_id')->unsigned();
          $table->integer('customers_id')->unsigned();
          $table->foreign('book_id')->references('id')->on('books');
          $table->foreign('customers_id')->references('id')->on('customers');
          $table->rememberToken();
          $table->timestamps();
      });
      Schema::create('comments', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('book_id')->unsigned();
          $table->integer('customers_id')->unsigned();
          $table->datetime('date');
          $table->string('content');
          $table->foreign('book_id')->references('id')->on('books');
          $table->foreign('customers_id')->references('id')->on('customers');
          $table->rememberToken();
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
        Schema::dropIfExists('customers');
        Schema::dropIfExists('categories');
        Schema::dropIfExists('species');
        Schema::dropIfExists('books');
        Schema::dropIfExists('chaps');
        Schema::dropIfExists('subs');
        Schema::dropIfExists('comments');
    }
}
