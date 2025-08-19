<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use Database\Factories\ProductFactory;

class productSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create(
            [
            "name"=>"rice",
            "stock"=>200,
            "price"=>150,
            "description"=>"basmati"
            ]);
            Product::create( [
                "name"=>"flour",
                "stock"=>150,
                "price"=>100,
                "description"=>"whole wheat flour"
            ]);
            Product::create(
            [
                "name"=>"Cooking Oil",
                "stock"=>300,
                "price"=>240,
                "description"=>"avocado oil"
            ]);
            Product::create(
            [
                'name' => 'Sugar',
                'stock' => 100,
                'price' => 120,
                'description' => 'Brown Sugar'
            ]);
        Product::factory()->count(30)->create();
    }
}
