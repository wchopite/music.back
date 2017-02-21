<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlbumsTable extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {

    Schema::create('albums', function (Blueprint $table) {
      $table->increments('id');
      $table->integer('artist_id')->unsigned();
      $table->integer('gender_id')->unsigned();
      $table->string('name',120);
      $table->integer('year')->nullable();
      $table->text('description');
      $table->string('path', 250);

      $table->foreign('artist_id')->references('id')->on('artists');
      $table->foreign('gender_id')->references('id')->on('genders');
      $table->softDeletes();
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::dropIfExists('albums');
  }
}
