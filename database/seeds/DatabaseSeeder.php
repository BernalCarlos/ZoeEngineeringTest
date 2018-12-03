<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ZipCodesTableSeeder::class);
        $this->call(ContactProfessionsTableSeeder::class);
        $this->call(ContactsTableSeeder::class);
    }
}
