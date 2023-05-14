<?php

namespace Database\Seeders;

use App\Models\Library;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LibrarySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $libraries = [
            ['name' => 'Alexandria Library'],
            ['name' => 'The Bodleian Library'],
        ];

        foreach ($libraries as $library) {
            Library::create($library);
        }
    }
}
