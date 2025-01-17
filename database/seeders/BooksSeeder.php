<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Books;
use App\Models\Review;

class BooksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Books::factory(15)->create()->each(function ($book) {
            $numReviews = random_int(5, 30);

            Review::factory()->count($numReviews)->good()->for($book)->create();
        });

        Books::factory(15)->create()->each(function ($book) {
            $numReviews = random_int(5, 30);

            Review::factory()->count($numReviews)->bad()->for($book)->create();
        });
    }
}
