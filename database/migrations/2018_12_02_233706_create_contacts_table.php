<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->tinyInteger('age');
            $table->string('gender');
            $table->string('zip_code')->index();
            $table->integer('profession_id')->index();
            $table->string('email')->unique();
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('zip_code')->references('zip_code')->on('zip_codes');
            $table->foreign('profession_id')->references('id')->on('contact_professions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contacts');
    }
}
