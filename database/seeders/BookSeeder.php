<?php

namespace Database\Seeders;

use App\Models\Book;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        foreach (range(1, 20) as $index) {
            Book::create([
                'title' => $faker->sentence(3),
                'author' => $faker->name,
                'published_date' => $faker->date(),
                'genre' => $faker->word,
            ]);
        }
    }
}
