<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateZipCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zip_codes', function (Blueprint $table) {
            $table->string('zip_code');
            $table->double('latitude');
            $table->double('longitude');

            $table->primary('zip_code');
        });

        DB::statement('ALTER TABLE zip_codes ADD COLUMN geom geometry(Point) NOT NULL;');
        DB::statement('CREATE INDEX idx_zip_codes_geom ON zip_codes(geom);');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('zip_codes');
    }
}
