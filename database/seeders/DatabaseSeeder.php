<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        //add products from json data
        $json = file_get_contents(database_path('data/products.json'));
        $products = json_decode($json, true);

        foreach ($products as $product) {
            DB::table('products')->insert([
                'seller_id' => $product['seller_id'],
                'title' => $product['title'],
                'price' => $product['price'],
                'description' => $product['description'],
                'category' => $product['category'],
                'image' => $product['image'],
                'created_at' => fake()->dateTimeBetween('-2 years'),
                'updated_at' => fake()->dateTimeBetween('created_at', 'now')
            ]);
        }

        //create a 50 reviews
        \App\Models\Review::factory(50)->create();
    }
}
