<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ItemsSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'title' => 'Pepperoni Pizza',
                'cost' => 299.00,
                'image' => '/images/pizzas/pepperoni.jpg',
            ],
            [
                'title' => 'Hawaiian Pizza',
                'cost' => 289.00,
                'image' => '/images/pizzas/hawaiian.jpg',
            ],
            [
                'title' => 'Cheese Classic',
                'cost' => 249.00,
                'image' => '/images/pizzas/cheese.jpg',
            ],
            [
                'title' => 'Meat Lovers',
                'cost' => 349.00,
                'image' => '/images/pizzas/meatlovers.jpg',
            ],
            [
                'title' => 'Veggie Supreme',
                'cost' => 319.00,
                'image' => '/images/pizzas/veggie.jpg',
            ],
            [
                'title' => 'BBQ Chicken Pizza',
                'cost' => 329.00,
                'image' => '/images/pizzas/bbq.jpg',
            ],
        ];

        // Insert all items
        $this->db->table('items')->insertBatch($data);
    }
}
