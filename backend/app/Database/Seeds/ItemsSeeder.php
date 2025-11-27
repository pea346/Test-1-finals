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
            ],
            [
                'title' => 'Hawaiian Pizza',
                'cost' => 289.00,
            ],
            [
                'title' => 'Cheese Classic',
                'cost' => 249.00,
            ],
            [
                'title' => 'Meat Lovers',
                'cost' => 349.00,
            ],
            [
                'title' => 'Veggie Supreme',
                'cost' => 319.00,
            ],
            [
                'title' => 'BBQ Chicken Pizza',
                'cost' => 329.00,
            ],
        ];

        // Insert all items
        $this->db->table('items')->insertBatch($data);
    }
}
