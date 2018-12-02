<?php

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class ZipCodesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fileHandler = fopen(database_path('seeds/data-files/2018_ZipCodes_Gaz_zcta_national.csv'), 'r');

        while(($zipCodeData = fgetcsv($fileHandler)) !== FALSE) {
            DB::insert("insert into zip_codes (zip_code, latitude, longitude, geom) values (
                        '{$zipCodeData[0]}',
                        {$zipCodeData[1]},
                        {$zipCodeData[2]},
                        ST_GeomFromText('POINT({$zipCodeData[1]} {$zipCodeData[2]})')
            )");
        }
    }
}
