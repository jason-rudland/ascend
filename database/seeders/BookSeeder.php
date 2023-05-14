<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Loan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();
        for ($i = 1; $i <= 2; $i++) {
            for ($j = 1; $j <= 100; $j++) {
                $book = Book::create([
                    'isbn' => $faker->isbn13,
                    'title' => $faker->sentence(4),
                    'author' => $faker->name,
                    'library_id' => $i,
                    'loaned' => $faker->boolean(25) // 25% chance of being loaned
                ]);
                if ($book->loaned) {
                    Loan::create([
                        'book_id' => $book->id,
                        'user_id' => $faker->numberBetween(1, 5),
                        'action' => "Loaned"
                    ]);
                }
            }
        }
    }
}
