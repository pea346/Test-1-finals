<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use App\Models\ItemsModel;

class ItemsSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['title' => 'Burger', 'cost' => 150.00, 'is_available' => 1, 'is_active' => 1],
            ['title' => 'Pizza', 'cost' => 250.00, 'is_available' => 1, 'is_active' => 1],
            ['title' => 'Pasta', 'cost' => 180.00, 'is_available' => 1, 'is_active' => 1],
        ];

        $model = new ItemsModel();
        $model->insertBatch($data);
    }
}
