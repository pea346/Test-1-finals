<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class OrdersSeeder extends Seeder
{
    public function run()
    {
        $db = \Config\Database::connect();

        // Make sure you adjust these IDs based on your actual users and items
        $orders = [
            [
                'user_id'    => 1, // existing user id
                'item_id'    => 1, // existing item id
                'quantity'   => 2,
                'status'     => 'pending',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'user_id'    => 2, // another existing user
                'item_id'    => 2, // another existing item
                'quantity'   => 1,
                'status'     => 'completed',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];

        // Insert orders safely
        $db->table('orders')->insertBatch($orders);
    }
}
