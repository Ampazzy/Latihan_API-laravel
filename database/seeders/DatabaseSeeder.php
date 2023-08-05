<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;
use App\Models\Post;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(20)->create();

        Post::create([
            'name' => 'Rendang',
            'price' => 20000,
            'description' => 'Makanan dari padang'
        ]);

        Post::create([
            'name' => 'Bika Ambon',
            'price' => 18000,
            'description' => 'Makanan dari medan'
        ]);

        Post::create([
            'name' => 'Gudeg',
            'price' => 8000,
            'description' => 'Makanan dari jawa tengah'
        ]);

        Post::create([
            'name' => 'Durian',
            'price' => 25000,
            'description' => 'Nama buah'
        ]);

        Post::create([
            'name' => 'Wortel',
            'price' => 15000,
            'description' => 'Nama sayuran'
        ]);
        Post::create([
            'name' => 'WKerupuk',
            'price' => 1000,
            'description' => 'Renyah'
        ]);
        Post::create([
            'name' => 'Pizza',
            'price' => 150000,
            'description' => 'Yummy'
        ]);
        Post::create([
            'name' => 'Burger',
            'price' => 25000,
            'description' => 'Enak asli ini mah'
        ]);
        Post::create([
            'name' => 'Keripik kentang',
            'price' => 5000,
            'description' => 'Kentang tapi ga lembek'
        ]);
        Post::create([
            'name' => 'Jengkol',
            'price' => 9000,
            'description' => 'Katanya bikin bau'
        ]);
    }
}
