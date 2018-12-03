<?php

use App\Models\Contact;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContactsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        $allZipCodes = DB::table("zip_codes")->pluck('zip_code');
        $allProfessionIds = DB::table('contact_professions')->pluck('id');

        foreach ($allZipCodes as $zipCode) {
            $contactCreated = false;

            while (!$contactCreated) {
                try {
                    Contact::create([
                        'first_name' => $faker->firstName(),
                        'last_name' => $faker->lastName(),
                        'age' => $faker->numberBetween(27, 65),
                        'gender' => $faker->randomElement(['M', 'F']),
                        'zip_code' => $zipCode,
                        'profession_id' => $faker->randomElement($allProfessionIds),
                        'email' => $faker->email,
                    ]);

                    $contactCreated = true;
                } catch (Exception $exception) {
                    // Keep trying until you can create the agent
                }
            }
        }
    }
}