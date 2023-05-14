<?php

namespace Database\Seeders;

use App\Models\Library;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LibrarySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        $libraries = [
            ['name' => 'Alexandria Library'],
            ['name' => 'The Bodleian Library'],
        ];

        foreach ($libraries as $library) {
            $newLibrary = Library::create($library);
            foreach($users as $user) {
                $user->libraries()->attach($newLibrary->id);
            }
        }
    }
}
