<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableCompetitions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('table_competitions', function (Blueprint $table) {
            $table->id();
            $table->string('title_post')->nullable();
            $table->longText('post_content')->nullable();
            $table->longText('finish_post_content')->nullable();
            $table->boolean('users_link')->default(0);
            $table->boolean('users_count')->default(1);
            $table->integer('winners_count')->default(0);

            $table->longText('post_channels')->nullable();
            $table->longText('subscribe_channels')->nullable();

            $table->boolean('status')->default(0);

            $table->dateTime('post_start')->nullable();
            $table->dateTime('post_end')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('table_competitions');
    }
}
