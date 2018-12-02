<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContactProfessionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $professions = [
            'Corporate Finance',
            'Commercial Banking',
            'Investment Banking',
            'Hedge Funds',
            'Financial Planning',
        ];

        foreach ($professions as $profession) {
            DB::insert("INSERT INTO contact_professions (name) VALUES ('{$profession}');");
        }
    }
}
