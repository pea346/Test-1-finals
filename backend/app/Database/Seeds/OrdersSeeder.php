<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class OrdersSeeder extends Seeder
{
    public function run()
    {
        $now = date('Y-m-d H:i:s');

        $data = [
            [
                'order_number' => uniqid('ORD-'),  // REQUIRED
                'user_id'      => 1,
                'item_id'      => 1,
                'quantity'     => 2,
                'status'       => 'pending',
                'created_at'   => $now,
                'updated_at'   => $now,
            ],
            [
                'order_number' => uniqid('ORD-'),  // REQUIRED
                'user_id'      => 2,
                'item_id'      => 2,
                'quantity'     => 1,
                'status'       => 'completed',
                'created_at'   => $now,
                'updated_at'   => $now,
            ],
        ];

        $this->db->table('orders')->insertBatch($data);
    }
}
