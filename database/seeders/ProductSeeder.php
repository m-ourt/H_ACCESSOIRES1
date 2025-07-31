<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $products = [
            ['name' => '5 collier',
             'price' => 155,
              'image' => 'img/PRD1.jpg'
            ],

            ['name' => 'Montre rolex', 'price' => 499, 'image' => 'img/PRD4.jpg'],
            ['name' => 'fillottes Rose', 'price' => 15, 'image' => 'img/PRD3.jpg'],
            ['name' => 'Montre Femme', 'price' => 299, 'image' => 'img/PRD5.jpg'],
            ['name' => 'Sac Cuir', 'price' => 499, 'image' => 'img/PRD6.jpg'],
            ['name' => 'Lunettes Homme', 'price' => 199, 'image' => 'img/PRD7.jpg'],
            ['name' => 'Montre Femme', 'price' => 299, 'image' => 'img/PRD8.jpg'],
            ['name' => 'Sac Cuir', 'price' => 499, 'image' => 'img/PRD9.jpg'],
            ['name' => 'Lunettes Homme', 'price' => 199, 'image' => 'img/PRD10.jpg'],
        ];

        foreach ($products as $product) {
            Product::create([
                'name' => $product['name'],
                'price' => $product['price'],
                'description' => 'Produit de qualité disponible en stock.',
                'image' =>  $product['image']
            ]);
        }
    }
}
