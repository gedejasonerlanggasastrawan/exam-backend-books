<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // Import the DB facade
use Faker\Factory as Faker;

class RatingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        set_time_limit(0); // Ensure script doesn't timeout
        $faker = Faker::create();
        $books = DB::table('books')->pluck('id')->toArray(); // Convert to array for better performance
        $batchSize = 500; // Adjust batch size for performance
        $data = [];
        $totalRecords = 500000; // Total records to insert

        for ($i = 0; $i < $totalRecords; $i++) {
            $data[] = [
                'book_id' => $faker->randomElement($books),
                'rating' => $faker->numberBetween(1, 5),
                'created_at' => now(),
                'updated_at' => now(),
            ];

            // Insert batch when the batch size is reached
            if (count($data) === $batchSize) {
                DB::table('ratings')->insert($data);
                $data = []; // Reset array
            }
        }

        // Insert remaining data if any
        if (!empty($data)) {
            DB::table('ratings')->insert($data);
        }
    }
}
