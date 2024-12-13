<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $faker = Faker::create();
        $authors = DB::table('authors')->pluck('id')->toArray();
        $categories = DB::table('categories')->pluck('id')->toArray();

        $batchSize = 1000; // Jumlah data per batch
        $data = [];

        for ($i = 0; $i < 100000; $i++) {
            $data[] = [
                'title' => $faker->sentence(3),
                'author_id' => $faker->randomElement($authors),
                'category_id' => $faker->randomElement($categories),
                'created_at' => now(),
                'updated_at' => now(),
            ];

            // Insert batch setiap $batchSize
            if (count($data) === $batchSize) {
                DB::table('books')->insert($data);
                $data = []; // Reset array
            }
        }

        // Insert data sisa jika ada
        if (!empty($data)) {
            DB::table('books')->insert($data);
        }
    }
}
